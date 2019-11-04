<?php

namespace App\Http\Controllers;

use App\Post;
use App\Category;
use App\Tag;

use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index()
    {           
        //$posts = Post::where('status',1)->orderBy('created_at', 'desc')->paginate(2);        

        $categories = Category::all();
        $popularPosts = Post::getPopularPosts()->take(2)->get();
        $recentPosts = Post::getRecentPosts();
  
        //return view('pages.index')->with('posts', $posts);
        return view('pages.index', compact('popularPosts', 'recentPosts', 'categories'));
    }

    public function list()
    {
        //$posts = Post::where('status',1)->paginate(3);
       
        $posts = Post::paginate(6);
        $categories = Category::all();
        $popularPosts = Post::getPopularPosts()->take(2)->get();

        return view('pages.list', compact('posts', 'popularPosts', 'categories'));
    }

    public function show($slug)
    {
        $post = Post::where('slug', $slug)->firstOrFail();
        $categories = Category::all();
        
        return view('pages.show', compact('post', 'categories'));
    }

    public function tag($slug)
    {
        $tag = Tag::where('slug', $slug)->firstOrFail();
        $posts = $tag->posts()->paginate(2);
        $categories = Category::all();

        //return view('pages.list', ['posts' => $posts]);
        return view('pages.list', compact('posts', 'categories'));
    }

    public function category($slug)
    {
        $category = Category::where('slug', $slug)->firstOrFail();

        $posts = $category->posts()->paginate(6);
        $categories = Category::all();
        $popularPosts = Post::getPopularPosts()->take(2)->get();

        //return view('pages.list', ['posts' => $posts]);
        return view('pages.list', compact('posts', 'popularPosts', 'categories'));
    }
}
