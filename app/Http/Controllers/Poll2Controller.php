<?php

namespace App\Http\Controllers;

use App\Events\NewPollEvent;
use App\Exports\SignupExport;
use App\Poll;
use App\PollAnswer;
use App\Signup;
use App\SignupTitle;
use Barryvdh\DomPDF\Facade as PDF;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;
use Yajra\DataTables\DataTables;

class Poll2Controller extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index(Request $request)
    {

        if ($request->ajax()) {
            $data = Poll::latest()->get();
            return Datatables::of($data)
                ->addIndexColumn()
                ->addColumn('action', function($row){

                   // $btn = '<a href="javascript:void(0)" data-toggle="tooltip"  data-id="'.$row->id.'" data-original-title="Edit" class="edit btn btn-primary btn-sm editProduct">Edit</a>';

                    $btn = ' <a href="javascript:void(0)" data-toggle="tooltip"  data-id="' . $row->id . '" data-original-title="Delete" class="btn btn-danger btn-sm deleteProduct">Delete</a>';

                    return $btn;
                })
                ->rawColumns(['action'])
                ->make(true);
        }

        return view('polls.pollAjax');
    }


    public function store(Request $request)
    {


            Poll::updateOrCreate(
                ['name' => $request->poll]);

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

        //event(new NewPollEvent());
            return response()->json(['success'=>'Poll saved successfully.']);



    }

    public function edit($id)
    {
        $product = Poll::find($id);
        return response()->json($product);
    }


    public function destroy($id)
    {
        Poll::find($id)->delete();

        return response()->json(['success'=>'Poll deleted successfully.']);
    }

  /*  public function show()
    {

    }*/

}
