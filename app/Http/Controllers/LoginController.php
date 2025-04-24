<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    public function login(Request $request)
    {
        // Валидация
        $credentials = $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);

        // Авторизация
        if (Auth::attempt($credentials)) {
            return redirect()->route('login');
        }

        return back()->withErrors(['email' => 'Кириш маълумотлари нотўғри']);
    }
}