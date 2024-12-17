<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class UserController extends Controller
{
    /**
     * Tampilkan dashboard user.
     */
    public function index()
    {
        if (Auth::user()->id_role != 2) { // Cek jika bukan user
            return redirect()->back()->with('error', 'Access denied!');
        }

        // Ambil produk dari database
        $products = DB::table('barangs')->select('id', 'nama_barang', 'deskripsi', 'harga', 'link_img', 'id_kategori')->get();

        // Ambil ID user yang login
        $userId = auth()->id();

        // Ambil data keranjang untuk user yang login
        $cartItems = DB::select("
        SELECT k.id AS cart_id, b.nama_barang, b.link_img, b.harga, k.jumlah_barang
        FROM keranjangs AS k
        JOIN barangs AS b ON k.id_barang = b.id
        WHERE k.id_user = ?
        ", [$userId]);

        // Hitung total harga
        $total = collect($cartItems)->sum(function ($item) {
            return $item->harga * $item->jumlah_barang;
        });

        // Kirim data produk ke view user
        return view('user.index', compact('products', 'cartItems', 'total'));
    }

    /**
     * Contoh fitur tambahan untuk user.
     */
    public function profile()
    {
        // Contoh logika untuk menampilkan profil user
        return view('user.profile');
    }
}
