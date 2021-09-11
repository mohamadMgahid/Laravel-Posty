<?php

namespace App\Http\Controllers;

use App\Models\post;
use App\Models\postLiked;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

class DashboardController extends Controller
{

    public function __construct()
    {
        $this->middleware(['auth']);
    }

    public function index()
    {
        //dd(Post::find(4)->created_at);
       // dd(auth()->user())->name;
        return view('dashboard');
    }
}
