<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User; // Ensure you have the User model imported

class LoginController extends Controller
{
    public function login(Request $request)
    {
        $credentials = $request->validate([
            'email' => 'required|email',
            'password' => 'required|string',
        ]);
       
        if(Auth::attempt($credentials)) {
            // Authentication passed
            $request->session()->regenerate();
            return redirect()->route('site.home')->with('success', 'Login successful!');
        }

        return back()->withErrors([
            'login' => "Email e/ou senha incorretos"
        ])->withInput();
    }

    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        
        return redirect()->route('site.home');
    }


    public function register(Request $request)
    {
        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => bcrypt($request->password),
        ]);
        Auth::login($user);

        return redirect()->route('site.home');
    }

}
