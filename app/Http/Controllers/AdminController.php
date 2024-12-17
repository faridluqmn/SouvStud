<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

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

    public function coupons()
    {
        $coupons = DB::table('kupons')
            ->orderBy('exp_date', 'desc')
            ->paginate(12);

        // Mengirim data kupon ke view
        return view('admin.kupon', compact('coupons'));
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
