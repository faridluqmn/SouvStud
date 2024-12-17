<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
<<<<<<< HEAD
use Illuminate\Support\Facades\DB;

class DashboardController extends Controller
{
    public function showProducts()
    {
        $products = DB::select("
        SELECT b.nama_barang, b.harga, b.link_img, b.deskripsi, sb.jumlah_stok
        FROM barangs AS b
        LEFT JOIN stok_barangs AS sb ON b.id = sb.id_barang
    ");

        // return view('user.index', compact('products'));
        return view('admin.index', compact('products'));
=======

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
>>>>>>> 9e3fae605f9826c83057db3cad8c33aa87cf42ba
    }
}
