<?php

namespace App\Http\Controllers;

use App\Http\Requests\TagStoreRequest;
use App\Tag;
use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;

class TagController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    /*public function index()
    {
        $tags = Tag::all();
        return view('tags.index', compact('tags'));
    }

    public function create()
    {
        return view('tags.create');
    }

    public function store(Request $request)
    {
        $tag = new Tag();
        $tag->name = $request->name;
        $tag->save();

        return redirect()->route('tags.index')->with('success', 'Tag was added successfully!');
    }

    public function delete($id)
    {
        $tag = Tag::findOrFail($id);
        $tag->delete();
        return back()->with('success', 'Tag was deleted successfully!');
    }*/
    public function index(Request $request)
    {
        if ($request->ajax()) {
            $data = Tag::latest()->get();
            return Datatables::of($data)
                ->addIndexColumn()
                ->addColumn('action', function($row){

                    $btn = '<a href="javascript:void(0)" data-toggle="tooltip"  data-id="'.$row->id.'" data-original-title="Edit" class="edit btn btn-primary btn-sm editProduct">Edit</a>';

                    $btn .= ' <a href="javascript:void(0)" data-toggle="tooltip"  data-id="' . $row->id . '" data-original-title="Delete" class="btn btn-danger btn-sm deleteProduct">Delete</a>';

                    return $btn;
                })
                ->rawColumns(['action'])
                ->make(true);
        }

        return view('tags.tagAjax');
    }

    public function newTag()
    {
        return view('tags.new-tag');
    }


    public function store(Request $request)
    {
        Tag::updateOrCreate(['id' => $request->product_id],
            ['name' => $request->name]);

       // return response()->json(['success'=>'Tag saved successfully.']);
        return redirect()->route('tags.index')->with('success', 'Tag was saved successfully');
    }

    public function edit($id)
    {
        $product = Tag::find($id);
        return response()->json($product);
    }


    public function destroy($id)
    {
        Tag::find($id)->delete();

      return response()->json(['success'=>'Tag deleted successfully.']);
      //  return redirect()->with('success', 'Tag deleted successfully.');
    }

}
