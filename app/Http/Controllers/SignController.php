<?php

namespace App\Http\Controllers;

use App\Events\UserSignupEvent;
use App\Exports\SignupExport;
use App\Http\Requests\SignupStoreRequest;
use App\Poll;
use App\PollAnswer;
use App\Signup;
use App\SignupTitle;
use Barryvdh\DomPDF\Facade as PDF;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;
use Yajra\DataTables\DataTables;

class SignController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index(Request $request)
    {

        if ($request->ajax()) {
            $data = SignupTitle::latest()->get();
            return Datatables::of($data)
                ->addIndexColumn()
                ->addColumn('action', function($row){

                   $btn = '<a href="' .route('signups.edit',$row->id) . '" >Edit</a>';

                    /*$btn ='
                       <form action="' .route('signups.edit',$row->id) . '" method="post">
                      ' .csrf_field() .'
                       <input type="hidden" name="_method" value="PUT">
                         <button class="btn btn-danger">Edit</button></form>
                         ';*/
                    $btn .= ' <a href="javascript:void(0)" data-toggle="tooltip"  data-id="' . $row->id . '" data-original-title="Delete" class="btn btn-danger btn-sm deleteProduct">Delete</a>';

                    return $btn;
                })
                ->rawColumns(['action'])
                ->make(true);
        }

        return view('signup.signAjax');
    }

    public function newSign()
    {
        return view('signup.new-sign');
    }

    public function store(Request $request, SignupStoreRequest $signupStoreRequest)
    {
        $title = new SignupTitle();

        $title->title = $request->title;
        $title->save();
        $signup = SignupTitle::orderByDesc('id')->first();
        $id = $signup->id;

        if ($request->question === null){
            // event(new NewSignupEvent());
            return redirect()->route('signup.index')->with('success','Sign up was created successfully!');
        } else {

            $question = new Poll();
            $question->name = $request->question;
            $question->signup_id = $id;
            $question->save();
            $question->answer();
            $pollid = $question->id;


            $answer = new PollAnswer();
            $answer->name = $request->answer1;
            $answer->poll_id = $pollid;
            $answer->save();


            $answer2 = new PollAnswer();
            $answer2->name = $request->answer2;
            $answer2->poll_id = $pollid;
            $answer2->save();

            if ($request->answer3 === null){
                $answer3 = new PollAnswer();
                $answer3->name = '';
                $answer3->poll_id = $pollid;
                $answer3->save();
            }  else{
                $answer3 = new PollAnswer();
                $answer3->name = $request->answer3;
                $answer3->poll_id = $pollid;
                $answer3->save();
            }

            if ($request->answer4 === null){
                $answer4 = new PollAnswer();
                $answer4->name = '';
                $answer4->poll_id = $pollid;
                $answer4->save();
            } else{
                $answer4 = new PollAnswer();
                $answer4->name = $request->answer4;
                $answer4->poll_id = $pollid;
                $answer4->save();
            }
            // event(new NewSignupEvent());

            return redirect()->route('signup.index')->with('success','Sign up was created successfully!');
        }

    }

  /*  public function store(Request $request)
    {

        SignupTitle::updateOrCreate(['id' => $request->product_id],
            ['title' => $request->name]);

        $signup = SignupTitle::orderByDesc('id')->first();
        $id = $signup->id;

        if ($request->poll === null){
            // event(new NewSignupEvent());
            return redirect()->route('signup.signAjax')->with('success','Sign up was created successfully!');
        } else {

            Poll::updateOrCreate(
                ['name' => $request->poll], ['signup_id' => $id]);

            $poll = Poll::orderByDesc('id')->first();
            $pid = $poll->id;

            PollAnswer::updateOrCreate(
                ['name' => $request->answer1], ['poll_id' => $pid]);

            PollAnswer::updateOrCreate(
                ['name' => $request->answer2], ['poll_id' => $pid]);

            PollAnswer::updateOrCreate(
                ['name' => $request->answer3], ['poll_id' => $pid]);

            PollAnswer::updateOrCreate(
                ['name' => $request->answer4], ['poll_id' => $pid]);

            // event(new UserSignupEvent());
            return response()->json(['success'=>'Sign up saved successfully.']);
        }


    }*/

    public function edit($id)
    {
        $signup = SignupTitle::find($id);
        return view('signup.edit', compact('signup'));
    }

    public function update(Request $request, $id)
    {
        $title = SignupTitle::findOrFail($id);

        $title->title = $request->title;
        $title->save();
        $signup = SignupTitle::orderByDesc('id')->first();
        $id = $signup->id;

        if ($request->question === null) {
            // event(new NewSignupEvent());
            return redirect()->route('signup.index')->with('success', 'Sign up was created successfully!');
        } else {

            $question = new Poll();
            $question->name = $request->question;
            $question->signup_id = $id;
            $question->save();
            $question->answer();
            $pollid = $question->id;


            $answer = new PollAnswer();
            $answer->name = $request->answer1;
            $answer->poll_id = $pollid;
            $answer->save();


            $answer2 = new PollAnswer();
            $answer2->name = $request->answer2;
            $answer2->poll_id = $pollid;
            $answer2->save();

            if ($request->answer3 === null) {
                $answer3 = new PollAnswer();
                $answer3->name = '';
                $answer3->poll_id = $pollid;
                $answer3->save();
            } else {
                $answer3 = new PollAnswer();
                $answer3->name = $request->answer3;
                $answer3->poll_id = $pollid;
                $answer3->save();
            }

            if ($request->answer4 === null) {
                $answer4 = new PollAnswer();
                $answer4->name = '';
                $answer4->poll_id = $pollid;
                $answer4->save();
            } else {
                $answer4 = new PollAnswer();
                $answer4->name = $request->answer4;
                $answer4->poll_id = $pollid;
                $answer4->save();
            }
            // event(new NewSignupEvent());

            return redirect()->route('signup.index')->with('success', 'Sign up was created successfully!');
        }
    }


    public function destroy($id)
    {
        SignupTitle::find($id)->delete();

        return response()->json(['success'=>'Sign up deleted successfully.']);
    }

    public function allSignups($id)
    {
        $signup = SignupTitle::find($id);
        $results = Signup::where('signup_id', $id)->get();
        $authUserName = auth()->user()->name;
        $polls = Poll::where('signup_id', $id)->get();
        $archives = SignupTitle::all();

        return view('signup.archive', compact('signup', 'results', 'authUserName', 'polls', 'archives'));
    }

    public function storeArchive(Request $request)
    {
        $uname = $request->input('user');
        $signid = $request->signid;

        $userSign = Signup::where('signup_id', $signid)->where('name', $uname)->first();
        if (!$userSign){
            $signup = new Signup();

            $signup->user_id = auth()->user()->id;
            $signup->name = auth()->user()->name;
            $signup->signup_id = $signid;
            $signup->save();
            // Mail::to(auth()->user()->email)->send(new \App\Mail\Signup());
            /* $email = auth()->user()->email;
             $details['email'] = $email;
             dispatch(new SendEmailSignupJob($details));*/

            return redirect()->back()->with('success','You signed up successfully!');
        } else {
            return redirect()->back()->with('error','You already signed up, please delete your signup to be able to sign up again!');
        }
    }

    public function downloadPDF() {
        $signups = SignupTitle::all();
        $pdf = PDF::loadView('signup.pdf', compact('signups'));

        return $pdf->download('signup.pdf');
    }

    public function export(Request $request){

        if ($request->input('exportexcel') !== null ){
            return Excel::download(new SignupExport, 'signup.xlsx');
        }

        if ($request->input('exportcsv') !== null ){
            return Excel::download(new SignupExport, 'signup.csv');
        }

        return redirect()->back();
    }



}
