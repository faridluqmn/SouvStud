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
        $products = DB::table('barangs')
            ->join('stok_barangs', 'barangs.id', '=', 'stok_barangs.id') // Menghubungkan barangs dengan stok_barangs
            ->select(
                'barangs.id',
                'barangs.nama_barang',
                'barangs.deskripsi',
                'barangs.harga',
                'barangs.link_img',
                'barangs.id_kategori',
                'stok_barangs.jumlah_stok as jumlah_stok'
            )
            ->get();

        //kategori
        $categories = DB::table('kategori_barangs')->get();

        // Ambil ID user yang login
        $userId = auth()->id();

        // Ambil data keranjang dari tabel keranjangs
        $cartItems = DB::select("
            SELECT k.*, b.nama_barang, b.link_img, b.harga 
            FROM keranjangs AS k
            JOIN barangs AS b ON k.id_barang = b.id
            WHERE k.id_user = ?
        ", [auth()->id()]); // Filter keranjang untuk user yang sedang login

        // Hitung total harga
        $total = array_sum(array_map(function ($item) {
            return $item->jumlah_barang * $item->harga;
        }, $cartItems));

        // Kirim data produk ke view user
        return view('user.index', compact('products', 'categories', 'cartItems', 'total'));
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
