<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    // Method untuk menampilkan form login
    public function loginForm()
    {
        return view('auth.login');
    }
     // Method untuk Login
     public function login(Request $request)
     {
         // Validasi input
         $request->validate([
             'email' => 'required|email',
             'password' => 'required|min:4',
         ]);

         // Cek kredensial
         if (Auth::attempt($request->only('email', 'password'))) {
             return redirect()->route('dashboard');
         }

         return back()->withErrors(['email' => 'Invalid credentials'])->withInput();
     }

    // Method untuk menampilkan form register
    public function registerForm()
    {
        return view('auth.register');
    }

    // Method untuk Register
    public function register(Request $request)
    {
        // Validasi input
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|min:4|confirmed',
        ]);

        // Membuat user baru
        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
        ]);

        // Login setelah register
        Auth::login($user);

        return redirect()->route('login');
    }

    public function logout(Request $request)
    {
        // Logout pengguna
        Auth::logout();

        // Hapus sesi
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        // Redirect ke halaman login
        return redirect()->route('login');
    }
}
