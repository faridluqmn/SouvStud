<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
// use Illuminate\Support\Facades\Mail;
// use Illuminate\Support\Facades\Session;

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

    //Method untuk Register
    public function register(Request $request)
    {
        // Validasi input
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|min:4|confirmed',
        ]);

        // Buat user baru
        User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'id_role' => 2, // Default role sebagai User
        ]);

        // Redirect ke halaman login
        return redirect()->route('login')->with('success', 'Account created successfully! Please login.');
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


//     public function register(Request $request)
//     {
//         // Validasi input
//         $request->validate([
//             'name' => 'required|string|max:255',
//             'email' => 'required|email|unique:users,email',
//             'password' => 'required|min:4|confirmed',
//         ]);

//         // Simpan data sementara di session
//         $otp = random_int(100000, 999999);
//         Session::put('otp', $otp);
//         Session::put('user_data', [
//             'name' => $request->name,
//             'email' => $request->email,
//             'password' => $request->password,
//         ]);

//         // Kirim OTP melalui email (contoh)
//         Mail::send('emails.otp', ['otp' => $otp], function ($message) use ($request) {
//             $message->to($request->email)->subject('Your OTP Code');
//         });

//         return redirect()->route('otp.form')->with('success', 'OTP sent to your email!');
//     }

//     // Konfirmasi OTP
//     public function confirmOtp(Request $request)
//     {
//         $request->validate(['otp' => 'required|numeric']);

//         if ($request->otp == Session::get('otp')) {
//             $userData = Session::get('user_data');
//             // @dd($userData);
            
//             // Simpan pengguna ke database
//             $user = User::create([
//                 'name' => $userData['name'],
//                 'email' => $userData['email'],
//                 'password' => Hash::make($userData['password']),
//                 'id_role' => 2,
//             ]);

//             // Login pengguna setelah registrasi
//             Auth::login($user);

//             // Bersihkan session
//             Session::forget(['otp', 'user_data']);

//             return redirect()->route('dashboard')->with('success', 'Account verified successfully!');
//         }

//         return back()->withErrors(['otp' => 'Invalid OTP']);
//     }

}


