<?php

namespace App\Http\Controllers;

use App\Events\NewSignupEvent;
use App\Http\Requests\SignupStoreRequest;
use App\Poll;
use App\PollAnswer;
use Barryvdh\DomPDF\Facade as PDF;
use Maatwebsite\Excel\Facades\Excel;
use App\Exports\SignupExport;
use App\SignupTitle;
use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;

class SignupTitleController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        return view('signup.create');
    }

    public function manageSignup(Request $request)
    {
        $signups = SignupTitle::all();
        /*if ($request->ajax()) {
            $data = SignupTitle::latest()->get();
            return Datatables::of($data)
                ->addIndexColumn()
                ->addColumn('action', function($row){
                    $btn ='
                       <form action="' .route('signup-title.destroy',$row->id) . '" method="post">
                      ' .csrf_field() .'
                       <input type="hidden" name="_method" value="DELETE">
                         <button class="btn btn-danger">Delete</button></form>
                         ';
                    return $btn;
                })
                ->rawColumns(['action', 'delete'])
                ->make(true);
        }*/
        return view('signup.manage-signups', compact('signups'));
    }

    public function create()
    {
        return view('signup.create');
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

    public function manage()
    {
        $signups = SignupTitle::all();

        return view('signup.index2', compact('signups'));
    }

    public function destroy($id)
    {
        $signup = SignupTitle::find($id);
        $signup->delete();

        return redirect()->back()->with('success', 'Signup was deleted successfully!');
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

    public function downloadPDF() {
        $signups = SignupTitle::all();
        $pdf = PDF::loadView('signup.pdf', compact('signups'));

        return $pdf->download('signup.pdf');
    }
}
