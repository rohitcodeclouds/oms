<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

use App\Models\User;

class AuthController extends Controller
{
    public function showLogin() {
        return view('auth.login');
    }

    public function showRegister() {
        return view('auth.register');
    }

    public function forgotPassword() {
        return view('auth.forgot-password');
    }

    public function login(Request $request) {
        $credentials = $request->validate([
            'email' => 'required|email',
            'password'  => 'required'
        ]);

        $remember = $request->has('remember');

        if(Auth::attempt($credentials, $remember)){
            $request->session()->regenerate();
            return redirect('/admin/dashboard');
        }

        return back()->withErrors(['error'=> 'Invalid credentials! Please check.' ]);
    }

    public function register(Request $request) {
        $data = $request->validate([
            'name'=> 'required',
            'email' => 'required|email|unique:users',
            'password' => 'required|min:8|confirmed',  
        ]);

        User::create([
            'name'=> $data['name'],
            'email' => $data['email'],
            'password' => Hash::make($data['password']),  
        ]);

        return redirect('/login')->with('success', 'Account Created! Now, You Can Login.');

    }

    public function logout(Request $request) {
        Auth::logout();
        $request->session()->invalidate();
        redirect('/login');
    }

}
