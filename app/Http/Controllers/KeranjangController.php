<?php

namespace App\Http\Controllers;

use App\Models\Keranjang;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class KeranjangController extends Controller
{
    // Method to show the cart (keranjang index)
    public function index()
    {
        // Ambil barang-barang dalam keranjang untuk pengguna yang sedang login
        $keranjangs = Keranjang::where('id_user', Auth::id())->get();

        // Hitung total harga semua barang dalam keranjang
        $total = $keranjangs->sum(function($keranjang) {
            return $keranjang->barang->price * $keranjang->jumlah_barang;
        });

        // Kirim data ke view, termasuk total
        return view('keranjang.index', compact('keranjangs', 'total'));
    }


    // Method to redirect to the cart from the dashboard
    public function redirectToCart()
    {
        // Redirect to the cart index page
        return redirect()->route('keranjang.index');
    }
}
