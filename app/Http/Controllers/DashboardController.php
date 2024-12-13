<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    public function authenticate(Request $request)
    {
        // Validasi input
        $request->validate([
            'email' => 'required|email',
            'password' => 'required|min:8',
        ]);

        // Cek kredensial
        if (Auth::attempt($request->only('email', 'password'))) {
            return redirect()->intended('dashboard'); // Redirect ke dashboard setelah login
        }

        return back()->withErrors(['email' => 'Invalid credentials'])->withInput();
    }

    public function index()
    {
        if (Auth::check()) {
            return view('welcome'); // Ganti dengan nama view dashboard Anda
        }

        return redirect()->route('login');
    }
}
