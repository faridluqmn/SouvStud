<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AdminController extends Controller
{
    /**
     * Tampilkan dashboard admin.
     */
    public function index()
    {
        if (Auth::user()->id_role != 1) { // Cek jika bukan admin
            return redirect()->back()->with('error', 'Access denied!');
        }
        return view('admin.index'); // Tampilkan halaman admin
    }

    /**
     * Contoh fitur tambahan untuk admin.
     */
    public function manageUsers()
    {
        // Contoh logika untuk mengelola pengguna
        return view('admin.manage_users');
    }
}
