<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Cliente;

class ClienteAuthController extends Controller
{
    public function showLoginForm()
    {
        return view('auth.cliente-login');
    }

    public function login(Request $request)
    {
        $credentials = $request->only('email', 'password');
        if (Auth::guard('cliente')->attempt($credentials)) {

            return redirect()->route('portal.index');
        }
        return back()->withErrors(['email' => 'Credenciales incorrectas.']);
    }

    public function logout()
    {
        Auth::guard('cliente')->logout();
        return redirect()->route('cliente.login');
    }
}
