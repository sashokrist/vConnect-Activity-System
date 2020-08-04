<?php

namespace App\Http\Controllers;

use App\Category;
use App\Group;
use App\Http\Requests\GroupStoreRequest;
use App\User;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;

class GroupController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index(Request $request)
    {
        if ($request->ajax()) {
            $data = Group::latest()->get();
            return \Yajra\DataTables\DataTables::of($data)
                ->addIndexColumn()
                ->addColumn('action', function($row){

                    $btn = '<a href="javascript:void(0)" data-toggle="tooltip"  data-id="'.$row->id.'" data-original-title="Edit" class="edit btn btn-primary btn-sm editProduct">Edit</a>';

                    $btn .= ' <a href="javascript:void(0)" data-toggle="tooltip"  data-id="' . $row->id . '" data-original-title="Delete" class="btn btn-danger btn-sm deleteProduct">Delete</a>';

                    return $btn;
                })
                ->rawColumns(['action'])
                ->make(true);
        }

        return view('groups.groupAjax');
    }


    public function store(Request $request)
    {
        Group::updateOrCreate(['id' => $request->product_id],
            ['title' => $request->name]);

        return response()->json(['success'=>'Group saved successfully.']);
    }

    public function edit($id)
    {
        $product = Group::find($id);
        return response()->json($product);
    }


    public function destroy($id)
    {
        Group::find($id)->delete();

        return response()->json(['success'=>'Group deleted successfully.']);
    }

    public function manageUsers()
    {
        $groups = User::with('groups')->get();
        return view('groups.manage-users', compact('groups'));
    }

    public function destroyGroup(Request $request)
    {
        $groups = User::where('id', $request->id)->first();
        $groups->groups()->detach();

        return redirect()->back()->with('success','User groups was removed successfully!');
    }
}
