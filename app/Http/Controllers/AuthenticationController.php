<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class AuthenticationController extends Controller
{
    public function register(Request $request) {
        try {
        $user = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|tring|max:255|unique:users',
            'password' => 'required|string|min:6|confirmed'
        
        ]);
        $hashedPassword = Hash::make($user['password']);
        $user['password'] = $hashedPassword;
        User::create($user);

        return redirect('/dashboard')->with(['user'=>$user]);
     }catch (\Exception $e){
        return back()->withErrors(['register'=> $e->getMessage()]);

     }
     
      }

      public function login(Request $request) {
        try {
        $credentials = $request->validate([
            'email' => 'required|string|email|max:255',
            'password' => 'required|string|min:6',
        ]);
        Auth::attempt($credentials);
        return redirect('/dashboard')->with(['user'=> Auth::user()]);
    
     }catch (\Exception $e){
        return back()->withErrors(['login'=> $e->getMessage()]);
     }
    
}

     public function logout(Request $request) {
        Auth::logout();
        return redirect('/login');
     }

 }

