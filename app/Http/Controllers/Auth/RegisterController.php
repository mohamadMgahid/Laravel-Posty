<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class RegisterController extends Controller
{
    
    public function __construct()
    {
        $this->middleware(['guest']);
    }
 
    public function index()
    {
        return view('auth.register');
    }

    public function store(Request $request)
    {

        //dd($request->only('email', 'password'));// just for check

        $this->validate($request, [
            'name' => 'required|max:255',
            'username' => 'required|max:255',
            'email' => 'required|email|max:255',
            'password' => 'required|confirmed',
        ]);
        
        //dd('store');// it runs if any of the validation fails
        User::create([//here to specify what data will be saved in the db
            'name' => $request->name,
            'username' => $request->username,
            'email' => $request->email,
            'password'=>Hash::make($request->password),
        ]);

       // auth()->user(); //helpful when we wnt to grap the currently authenticated user it return a user model

        auth()->attempt($request->only('email', 'password')); //nice and faster
        //we could not use it in validate method bec we needed the hash password

        return redirect()->route('dashboard');

    }
}
//we did the same thing such as web.php file