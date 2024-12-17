<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
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
    }
}
