<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Http\Request;

class PostController extends Controller
{
    public function __construct()
    {
        $this->middleware(['auth'])->only(['store', 'destroy']);
        //in order to be able to delete post or store a post we need to be signed in
    }

    public function index()
    {
        $posts = Post::latest()->with(['user', 'likes'])->paginate(20);
         //it is laravel collection will return all posts in db in same order - with(['user', 'likes']) part to prevent app from queyring through each like and get them all 
         //of them it is easier for the app to deal with db that way 'eager loading'
        
        return view('posts.index',[
            'posts' => $posts
        ]);
    }

    public function show(Post $post)
    {
        return view('posts.show', [
            'post' => $post
        ]);
    }
    public function store(Request $request)
    {
        $this->validate($request, [
            'body' => 'required'
        ]);

        $request->user()->posts()->create($request->only('body'));
            //here laravel will auto fill user id for us as it is chained to the posts method we created in user.php file 


        return back();

        // Post::create([//bad archtecture
        //     'user_id'=>auth()->id(),//we have to add user add in Post.php
        //     'body'=>$request->body
        // ]);
    }

    public function destroy(Post $post)
    {
        $this->authorize('delete', $post);
        //delete method was created inisde postpolicy.php $post is post we passed in method
        
        $post->delete();

        return back();
    }
}
