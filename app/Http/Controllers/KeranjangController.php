<?php

namespace App\Http\Controllers;

use App\Models\Keranjang;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
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
    }
}
