<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use App\models\User;
use App\models\Post;

class PostLiked extends Mailable
{
    use Queueable, SerializesModels;

    public $liker;

    public $post;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct(User $liker, Post $post)
    {
        $this->liker = $liker;
        $this->post = $post;
        //liker and post set to public property 
        //so we can inject the liker name into post_liked.blade...
        //don't forget the import
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->markdown('emails.posts.post_liked')
        ->subject('Somone liked your post');
    }
}
