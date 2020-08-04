<?php

namespace App\Http\Controllers;


use App\Category;
use App\Comment;
use App\Events\NewNewsEvent;
use App\Group;
use App\Http\Requests\PostStoreRequest;
use App\Massage;
use App\Tag;
use App\User;
use Barryvdh\DomPDF\Facade as PDF;
use Couchbase\Document;
use Exception;
use Faker\Provider\DateTime;
use Illuminate\Http\Request;
use App\Post;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Intervention\Image\Facades\Image;
use Yajra\DataTables\DataTables;
use App\Traits\ImageUpload;

class PostController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        $posts = Post::with(['comments'])->with('category')->with('group')->orderBy('id', 'DESC')->paginate(10);
        $categories = Category::all();
        $groups = Group::all();
        $tags = Tag::all();

        return view('posts.index', compact(['posts', 'categories', 'groups', 'tags']));
    }

    public function managePosts()
    {
        $posts = Post::orderBy('id', 'desc')->paginate(10);
        return view('posts.manage', compact('posts'));
    }

    public function create()
    {
        if (Gate::denies('create-post')) {
            return redirect()->route('users.index');
        }
        $tags = Tag::get()->pluck('name', 'id');
        $category = Category::all();
        $groups = Group::all();

        return view('posts.create', compact('category', 'groups', 'tags'));
    }

    public function store(Request $request, PostStoreRequest $postStoreRequest)
    {
   //dd($request->category);
        $post = new Post();
        $post->title = $request->title;
        $post->slug = $this->createSlug($request->title);
        $post->body = $request->input('body');
        /*if ($request->hasfile('fileAdmin')) {
            foreach ($request->file('fileAdmin') as $file) {
                $attach = time() . '.' . $file->extension();
                $file->move(public_path() . '/files/', $attach);
                $data[] = $attach;
            }
            $post->filename = json_encode($data);
       }*/
        $attachments=array();
        if($attach=$request->file('fileAdmin')){
            foreach($attach as $filen){
                $fname=$filen->getClientOriginalName();
                $filen->move('files',$fname);
                $attachments[]=$fname;
            }
        }
        $post->filename = json_encode($attachments);
        $post->category_id = $request->input('category');
        $post->group_id = $request->input('groups');

        $images=array();
        if($files=$request->file('image')){
            foreach($files as $file){
                $name=$file->getClientOriginalName();
                $file->move('image',$name);
                $images[]=$name;
            }
        } else{
            $images[]= 'image.jpg';
        }
        $post->image = json_encode($images);
        $post->save();
        $post->tag()->sync((array)$request->input('tag'));
        //event(new NewNewsEvent());
        return redirect()->route('posts.index')->with('success', 'News was created successfully!');
    }

    public function createSlug($title, $id = 0)
    {
        // Normalize the title
        $slug = str_slug($title);
        // Get any that could possibly be related.
        // This cuts the queries down by doing it once.
        $allSlugs = $this->getRelatedSlugs($slug, $id);
        // If we haven't used it before then we are all good.
        if (!$allSlugs->contains('slug', $slug)) {
            return $slug;
        }
        // Just append numbers like a savage until we find not used.
        for ($i = 1; $i <= 10; $i++) {
            $newSlug = $slug . '-' . $i;
            if (!$allSlugs->contains('slug', $newSlug)) {
                return $newSlug;
            }
        }
        throw new Exception('Can not create a unique slug');
    }

    protected function getRelatedSlugs($slug, $id = 0)
    {
        return Post::select('slug')->where('slug', 'like', $slug . '%')
            ->where('id', '<>', $id)
            ->get();
    }

    public function show(Post $post)
    {
        $images = json_decode($post->image, true);
        $attachment = json_decode($post->filename, true);

        return view('posts.show', compact('post', 'images', 'attachment'));
    }

    public function postDelete($id)
    {
        $post = Post::findOrFail($id);
        $post->delete();
        return redirect()->route('posts-manage')->with('success', 'News was deleted successfully!');
    }

    public function edit(Post $post)
    {

        if (Gate::denies('update-posts')) {
            return redirect()->route('users.index');
        }
        $category = Category::all();
        $groups = Group::all();
        $tags = Tag::get()->pluck('name', 'id');
        $article = Post::findOrFail($post->id);

        return view('posts.edit', compact('post', 'category', 'groups', 'article', 'tags'));
    }

    public function update(Request $request, Post $post, PostStoreRequest $postStoreRequest)
    {
       // dd($request->hasfile('fileAdmin'));
        $post->title = $request->input('title');
        $post->slug = $this->createSlug($request->title);
        $post->body = $request->input('body');
        /*if ($request->hasfile('fileAdmin')) {
            foreach ($request->file('fileAdmin') as $file) {
                $attach = time() . '.' . $file->extension();
                $file->move(public_path() . '/files/', $attach);
                $data[] = $attach;
            }
            $post->filename = json_encode($data);
        }*/
        $attachments=array();
        if($attach=$request->file('fileAdmin')){
            foreach($attach as $filen){
                $fname=$filen->getClientOriginalName();
                $filen->move('files',$fname);
                $attachments[]=$fname;
            }
        }
        $post->filename = json_encode($attachments);
        $post->category_id = $request->input('category');
        $post->group_id = $request->input('groups');

        $images=array();
        if($files=$request->file('image')){
            foreach($files as $file){
                $name=$file->getClientOriginalName();
                $file->move('image',$name);
                $images[]=$name;
            }
        } else{
            $images[]= 'image.jpg';
        }
        $post->image = json_encode($images);
        $post->save();
        $post->tag()->sync((array)$request->input('tag'));

        return redirect()->route('posts-manage')->with('success', 'News was updated successfully!');
    }

    public function search(Request $request)
    {
        $keyword = $request->search;
        $search = Post::search($keyword)->query(function ($builder) {
            $builder->with('category');
        })->paginate(5);
        $search->appends($request->all())->links();

        return view('posts.result', compact(['search']));
    }

    public function downloadPDF()
    {
        $posts = Post::all();
        $pdf = PDF::loadView('posts.pdf', compact('posts'));

        return $pdf->download('posts.pdf');
    }

    public function searchGroups($id)
    {
        $posts = Post::where('group_id', $id)->paginate(5);

        return view('posts.result-group', compact('posts'));
    }

    public function tagSearch($id)
    {
        $posts = Tag::with('post')->where('id', $id)->paginate(5);

        return view('posts.tag-search', compact('posts'));
    }
}
