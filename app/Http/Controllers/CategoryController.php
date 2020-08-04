<?php

namespace App\Http\Controllers;

use App\Category;
use App\Http\Requests\CategoryStoreRequest;
use App\Post;
use Barryvdh\DomPDF\Facade as PDF;
use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;

class CategoryController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    /*

    public function store(Request $request, CategoryStoreRequest $categoryStoreRequest)
    {
        $name = $request->title;
        $category = new Category();
        $category->name = $name;
        $category->save();

        return redirect('categories-manage')->with('success', 'Category was created successfully!');
    }


    public function edit(Category $category)
    {

        return view('categories.edit', compact('category'));
    }

    public function update(Request $request, Category $category, CategoryStoreRequest $categoryStoreRequest)
    {
        $category->name = $request->title;
        $category->save();
        return redirect()->route('categories-manage')->with('success', 'Category was updated successfully!');
    }

    public function delete($id)
    {
        //dd($id);
        $cat = Category::find($id);
        $cat->post()->delete();
        $cat->delete();
        $post = Post::whereCategoryId($id)->update(['category_id' => null]);

        return redirect()->route('categories-manage')->with('success', 'Category was deleted successfully!');
    }*/

    public function index(Request $request)
    {
        if ($request->ajax()) {
            $data = Category::latest()->get();
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

        return view('categories.categoryAjax');
    }


    public function store(Request $request)
    {
        Category::updateOrCreate(['id' => $request->product_id],
            ['name' => $request->name]);

        return response()->json(['success'=>'Tag saved successfully.']);
    }

    public function edit($id)
    {
        $product = Category::find($id);
        return response()->json($product);
    }


    public function destroy($id)
    {
        Category::find($id)->delete();

        return response()->json(['success'=>'Tag deleted successfully.']);
    }

    public function search($id)
    {
        $search = Post::where('category_id', $id)->paginate(5);
        return view('categories.result', compact('search'));

    }

    public function downloadPDF() {
        $categories = Category::all();
        $pdf = PDF::loadView('categories.pdf', compact('categories'));
        return $pdf->download('categories.pdf');
    }
}
