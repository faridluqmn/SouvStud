<?php

namespace App\Http\Controllers;

use App\Models\Keranjang;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
<<<<<<< HEAD
use Illuminate\Support\Facades\DB;

class KeranjangController extends Controller
{
    public function addToCart(Request $request)
    {
        $userId = auth()->id();  // Mendapatkan ID user yang sedang login
        $productId = $request->id_barang;  // ID barang yang ingin ditambahkan
        $quantity = $request->jumlah_barang;  // Jumlah barang yang ingin ditambahkan
    
        // Cek apakah barang sudah ada di keranjang
        $existingItem = DB::table('keranjangs')
            ->where('id_user', $userId)
            ->where('id_barang', $productId)
            ->first();
    
        if ($existingItem) {
            // Jika barang sudah ada, update jumlahnya
            DB::table('keranjangs')
                ->where('id_user', $userId)
                ->where('id_barang', $productId)
                ->update([
                    'jumlah_barang' => $existingItem->jumlah_barang + $quantity
                ]);
        } else {
            // Jika barang belum ada, insert barang baru
            DB::table('keranjangs')->insert([
                'id_user' => $userId,
                'id_barang' => $productId,
                'jumlah_barang' => $quantity
            ]);
        }
    
        return response()->json(['success' => true]);
    }
    

    public function checkout(Request $request)
    {
        $userId = auth()->id(); // Ambil ID user yang login

        // Ambil data keranjang dari database
        $cartItems = DB::select("
            SELECT id_barang, quantity AS jumlah_barang
            FROM keranjangs
            WHERE user_id = ?
        ", [$userId]);

        // Simpan data transaksi
        DB::beginTransaction();
        try {
            foreach ($cartItems as $item) {
                DB::insert("
                    INSERT INTO transaksi (user_id, id_barang, jumlah_barang, created_at, updated_at)
                    VALUES (?, ?, ?, NOW(), NOW())
                ", [$userId, $item->id_barang, $item->jumlah_barang]);
            }

            // Hapus keranjang setelah checkout
            DB::delete("DELETE FROM keranjangs WHERE user_id = ?", [$userId]);

            DB::commit();
            return redirect()->route('cart.index')->with('success', 'Checkout successful!');
        } catch (\Exception $e) {
            DB::rollBack();
            return redirect()->back()->with('error', 'Checkout failed: ' . $e->getMessage());
        }
=======

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
>>>>>>> 9e3fae605f9826c83057db3cad8c33aa87cf42ba
    }
}
