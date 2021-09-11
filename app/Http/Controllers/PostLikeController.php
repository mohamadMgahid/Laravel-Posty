<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\postLiked;
use Illuminate\Support\Facades\Mail;

class PostLikeController extends Controller
{

    public function __construct()
    {
        $this->middleware(['auth']);
    }

    public function store(Post $post, Request $request)
    {

        //dd($post->likes()->withTrashed()->get());
        //it would give us all deleted items 
        //we can use it in sending emails to send email only once

        if($post->likedBy($request->user())){
            return response(null, 409);
        }

        $post->likes()->create([
            'user_id' => $request->user()->id,
        ]);

        if(!$post->likes()->onlyTrashed()->where('user_id', $request->user()->id)->count()) {
            Mail::to($post->user)->send(new PostLiked(auth()->user(), $post));
            //we pasted two argument -> currently authinticated user "auth()->user" and the post was liked "$post"
            //the argument mean get post likes the deleted once in db for the same post and same liker count them not exist
        }

        return back();
    }

    public function destory(Post $post, Request $request)
    {
        $request->user()->likes()->where('post_id', $post->id)->delete();

        return back();
    }
}
