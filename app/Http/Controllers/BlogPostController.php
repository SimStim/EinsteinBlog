<?php
namespace App\Http\Controllers;

use App\Models\BlogPost;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class BlogPostController extends Controller
{

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $cat_names = DB::table('blog_posts')->select('cat_name')
            ->distinct()
            ->get(); // fetch all category names
        $posts = BlogPost::all(); // fetch all blog posts from DB
        return view('blog.index', [
            'posts' => $posts,
            'cat_names' => $cat_names
        ]); // returns the view with posts
    }

    /**
     * Display all posts in a category
     */
    public function cat_index(Request $request)
    {
        $posts = DB::select('select * from blog_posts where cat_name = ?', [
            $request->cat_name
        ]);
        return view('blog.cat_index', [
            'posts' => $posts,
            'cat_name' => $request->cat_name
        ]); // returns the view with posts
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('blog.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $newPost = BlogPost::create([
            'title' => $request->title,
            'body' => $request->body,
            'cat_name' => $request->cat_name,
            'user_id' => 1
        ]);
        return redirect('blog/' . $newPost->id);
    }

    /**
     * Display the specified resource.
     *
     * @param \App\Models\BlogPost $blogPost
     * @return \Illuminate\Http\Response
     */
    public function show(BlogPost $blogPost)
    {
        return view('blog.show', [
            'post' => $blogPost
        ]); // returns the view with the post
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param \App\Models\BlogPost $blogPost
     * @return \Illuminate\Http\Response
     */
    public function edit(BlogPost $blogPost)
    {
        return view('blog.edit', [
            'post' => $blogPost
        ]); // returns the edit view with the post
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\BlogPost $blogPost
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, BlogPost $blogPost)
    {
        $blogPost->update([
            'title' => $request->title,
            'body' => $request->body,
            'cat_name' => $request->cat_name
        ]);
        return redirect('blog/' . $blogPost->id);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param \App\Models\BlogPost $blogPost
     * @return \Illuminate\Http\Response
     */
    public function destroy(BlogPost $blogPost)
    {
        $blogPost->delete();
        return redirect('/blog');
    }
}
