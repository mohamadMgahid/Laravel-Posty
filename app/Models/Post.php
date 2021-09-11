<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    use HasFactory;

    protected $fillable = [
        'body'
    ];

    public function likedBy(User $user)
    {
        return $this->likes->contains('user_id', $user->id);//laravel collection method allow us to look inside that collection of object
    }

    //  removed to postpolicy file for better structure

    public function user()// we want to tie the post to specific user
    {
        return $this->belongsTo(User::class);
    }

    public function likes()
    {
        return $this->hasMany(Like::class);
    }
}
