<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
class UserAuthController extends Controller
{
     public function showLoginForm()
    {
        return view('auth.user-login');
    }

    public function login(Request $request)
    {
        $credentials = $request->only('email', 'password');
        
        if (Auth::guard('web')->attempt($credentials)) {
            return redirect()->route('casos.index'); // o a tu dashboard de usuarios
        }

        return back()->withErrors(['email' => 'Credenciales incorrectas.']);
    }

    public function logout()
    {
        Auth::logout();
        return redirect()->route('user.login');
    }
}
