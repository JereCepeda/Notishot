<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Storage;

class LoginController extends Controller
{
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }
    
    public function register(Request $request) {
        $request->validate([
            'name' => 'required',
            'email' => 'required|unique:users,email',
            'password' => 'required|min:6'
        ]);
        $user = new User([
            'role' => 'lector',
            'name' => $request->name,
            'surname' => $request->surname,
            'email' => $request->email,
            'nick' =>$request->nick,
            'password' => Hash::make($request->password),
            'image'=>'avatar.jpeg'
        ]);

        $user->save();
        return redirect()->route('welcome')->with('success', 'Registration success. Please login!');
    }

    public function login(Request $req)  {
        
        $credentials = $req->only('email', 'password');
        $user = User::where('email',$credentials['email'])->first();
        if($user && Hash::check($credentials['password'],$user->password))
            {
                Auth::login($user);
                return redirect()->route('welcome');
            }
        else{echo 'error credenciales incorrectas';}

        return view('welcome');
    }
    public function logout(Request $request) {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect('/');
    }
}
