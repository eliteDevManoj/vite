<?php

namespace App\Http\Controllers;

use App\Http\Requests\LoginRequest;
use App\Http\Requests\RegisterRequest;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{   
    public function dashboard(Request $request){

        if(Auth::check()){ 

            return view('dashboard');
        }

        return redirect()->route('login');
    }

    public function login(Request $request){

        if(Auth::check()){

            return redirect()->route('dashboard');
        }

        return view('auth.login');
    }

    public function authenticate(LoginRequest $request){

        $email = $request->email;
        $password = $request->password;

        if(Auth::attempt(['email' => $email, 'password' => $password])) {
            $request->session()->regenerate();

            return redirect()->route('dashboard');
        }

        return  back()->withErrors([
            'email' => 'The provided credentials do not match our records.',
        ])->onlyInput('email');
    }
    
    public function register(Request $request){

        if(Auth::check()){

            return redirect()->route('dashboard');
        }

        return view('auth.register');
    }

    public function create(RegisterRequest $request){

        User::create($request->all());

        return redirect()->route('login');
    }

    public function logout(Request $request){

        if(Auth::check()){

            Auth::logout();

            $request->session()->invalidate();

            $request->session()->regenerateToken();

            return redirect()->route('login');
        }   

        return redirect()->route('dashboard');
    }
}
