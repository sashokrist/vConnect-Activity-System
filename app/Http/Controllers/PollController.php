<?php

namespace App\Http\Controllers;

use App\Category;
use App\Events\NewPollEvent;
use App\Events\UserPollEvent;
use App\Exports\PollExport;
use App\Http\Requests\PollCommentsStoreRequest;
use App\Jobs\SendEmailPollJob;
use App\Mail\MailForNewPoll;
use App\PollAnswerPicture;
use App\PollComment;
use App\Signup;
use App\SignupTitle;
use App\SubscribeUser;
use Barryvdh\DomPDF\Facade as PDF;
use App\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use Intervention\Image\Facades\Image;
use Maatwebsite\Excel\Facades\Excel;
use App\Http\Requests\PollStoreRequest;
use App\Poll;
use App\PollAnswer;
use App\PollResult;
use App\Charts\PollChart;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Gate;
use Yajra\DataTables\DataTables;

class PollController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {

        $polls = Poll::with('answer')->get()->sortByDesc('id')->first();

        if ($polls !== null){
            $id = $polls->id;
        }
        if (isset($id)){
            $answers = PollAnswer::where('poll_id', $id)->get();
            foreach ($answers as $ans){
                $ans_id = $ans->id;
            }
           // dd($answers);
        } else{
            $answers = [];
        }

       // $authUserName = auth()->user()->name;
       // $pollComments = Poll::with('pollComments')->get()->sortByDesc('id')->first();
       // dd($pollComments);
        $chart = New PollChart();
        $chart->labels(['Jamaica', 'Spain', 'Greece', 'Sozopol']);
        $chart->dataset('My dataset', 'line', $answers );

        $allPolls = Poll::all();
        if (isset($id)) {
            $signup = SignupTitle::where('id', $id)->first();
        } else{
            $signup = null;
        }
      $ansPicture = PollAnswerPicture::where('answer_id', $ans_id)->first();
     // dd($ansPicture);
        return view('polls.index', compact(['polls', 'answers', 'chart', 'allPolls', 'signup', 'ansPicture']));
    }

    public function managePools(Request $request)
    {
        $polls = Poll::all();

        return view('polls.manage-pools', compact('polls'));
    }

    public function store(Request $request)
    {
       // dd($request->all());
        $user = auth()->user();
        $uname = $request->input('user');
        $p_id = $request->input('pollid');
        $userSign = PollResult::where('poll_id', $p_id)->where('username', $uname)->first();
        $answerObj = PollAnswer::where('id', $request->input('answer'))->first();
        /*if ($user->isAdmin()){
            return redirect()->back()->with('error', 'Admin cant vote');
        }*/
       if (!$userSign) {
            $result = new PollResult();

            $result->answer_id = $request->input('answer');
            $result->answer = $answerObj->name;
            $result->question = $request->input('title');
            $result->username = auth()->user()->name;
            $result->poll_id = $request->pollid;
            $result->save();

            //event(new UserPollEvent());

            $polls = Poll::with('answer')->get()->sortByDesc('id')->first();
            $allVotes = PollResult::where('poll_id', $p_id)->get();
           // dd($allVotes);
            $pollAnswers = $polls->answer->pluck('name')->toArray();
            $count = PollResult::where('poll_id', $p_id)->get()->groupBy('answer');
            $chart = New PollChart();
            $data = array();
            $num = [];
            foreach ($pollAnswers as $k => $pollAnswer) {
                if (array_key_exists($pollAnswer, $count->toArray())) {
                    $data[$k] =  count($count->toArray()[$pollAnswer]);
                    $num[] = $pollAnswer;
                } else {
                    $data[$k] = 0;
                    $num[] = $pollAnswer;
                }
            }

           // $chart->labels([$num[0], $num[1], $num[2], $num[3]]);
           // $chart->dataset('Poll Result', 'bar', [$data[0], $data[1], $data[2], $data[3]] );


            return view('polls.result', compact(['userSign', 'allVotes', 'count', 'chart']))->with('success', 'Thank you for voting!');

        } else
        {
            return redirect('poll/result')->with('error', 'You already have voted, please delete your vote to be able to vote again!');
        }


    }

    public function result()
    {
        $polls = Poll::with('answer')->get()->sortByDesc('id')->first();
        $pollAnswers = $polls->answer->pluck('name')->toArray();
        $id = $polls->id;
        $allVotes = PollResult::where('poll_id', $id)->get()->sortByDesc('id');
        $authUserName = auth()->user()->name;
        $count = PollResult::where('poll_id', $id)->get()->groupBy('answer');
        $chart = New PollChart();
        $data = array();
        $num = [];
        foreach ($pollAnswers as $k => $pollAnswer) {
            if (array_key_exists($pollAnswer, $count->toArray())) {
                $data[$k] =  count($count->toArray()[$pollAnswer]);
                $num[] = $pollAnswer;
            } else {
                $data[$k] = 0;
                $num[] = $pollAnswer;
            }
        }
       // $chart->labels([$num[0], $num[1], $num[2], $num[3]]);
       // $chart->dataset('Poll Result', 'bar', [$data[0], $data[1], $data[2], $data[3]] );
        return view('polls.result', compact(['allVotes', 'authUserName', 'count', 'chart']));
    }

    public function destroy(Request $request, $id)
    {
        $vote = PollResult::find($id);
        $vote->delete();
        return redirect()->route('polls.index')->with('success', 'Your vote was deleted successfully!');
    }

    public function deletePoll($id)
    {
        $poll = Poll::findOrFail($id);
        $poll->answer()->delete();
        $poll->delete();
        return redirect()->back()->with('success', 'Poll was deleted successfully!');
    }

    public function manage()
    {
        $polls = Poll::all();
        return view('polls.index2', compact('polls'));
    }

    public function create()
    {
        $polls = Poll::with('answer')->get()->sortByDesc('id')->first();

        if ($polls !== null){
            $id = $polls->id;
        }
        $allPolls = Poll::all();
        if (isset($id)) {
            $signup = SignupTitle::where('id', $id)->first();
        } else{
            $signup = null;
        }
        return view('polls.create', compact('signup'));
    }

    public function newpoll(Request $request)
    {
     //dd($request->all());
      $question = new Poll();
        $question->name = $request->question;
        $question->save();
        $question->answer();
        $pollid = $question->id;


        //dd($images);
            foreach ($request->input('answers') as $ans) {
               // dd($ans);
                if ($ans === null) {
                    continue;
                }
                $answer = new PollAnswer();
                $answer->name = $ans;
                $answer->poll_id = $pollid;
                //$answer->picture = $pic;
                $answer->save();
            }
        if($files=$request->file('filenames')) {
            foreach ($files as $file) {
                $name = $file->getClientOriginalName();
                $file->move('uploads/poll/', $name);
                //$images[] = $name;
                $ans_picture = PollAnswer::where('poll_id', $pollid)->first();
                $ans_picture->picture = $name;
                $ans_picture->save();
            }
        }




        //event(new NewPollEvent());
        return redirect()->route('polls.index')->with('success', 'New poll was created successfully!');
    }

    public function charRender()
    {
        $chart = New PollChart();

        return view('layouts.app', compact('chart'));
    }

    // Export data
    public function export(Request $request){

        if ($request->input('exportexcel') !== null ){
            return Excel::download(new PollExport, 'polls.xlsx');
        }

        if ($request->input('exportcsv') !== null ){
            return Excel::download(new PollExport, 'polls.csv');
        }

        return redirect()->action('PollController@result');
    }

    public function downloadPDF() {
        $polls = Poll::all();
        $pdf = PDF::loadView('polls.pdf', compact('polls'));

        return $pdf->download('polls.pdf');
    }

    public function storeComments(Request $request, PollCommentsStoreRequest $pollCommentsStoreRequest)
    {
        $pollComment = new PollComment();
        $pollComment->username = auth()->user()->name;
        $pollComment->poll_id = $request->pollid;
        $pollComment->comments = $request->comments;

        $pollComment->save();

        return redirect()->route('polls.index')->with('success', 'Your comment was added!');


    }

    public function allPolls($id)
    {
        //dd($id);
        $poll = Poll::find($id);
       //dd($poll);
        $answers = PollAnswer::where('poll_id', $id)->get();
        $pollComments = Poll::with('pollComments')->get()->sortByDesc('id')->first();
        $allPolls = Poll::all();
     //  dd($answers);
        return view('polls.archive', compact('poll', 'answers', 'pollComments', 'allPolls'));

    }

    public function signup($id)
    {
        $signup = SignupTitle::where('id', $id)->first();
        $signid = $signup->id;
        $polls = Poll::where('signup_id', $signid)->get();
        $archives = SignupTitle::all();
        // dd($signid);
        $results = Signup::where('signup_id', $signid)->get();

        return view('polls.related', compact('signup', 'results', 'signid', 'polls', 'archives'));
    }

}
