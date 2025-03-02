<?php

namespace App\Http\Controllers;

use App\Models\Keranjang;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;

class KeranjangController extends Controller
{
    public function addToCart(Request $request)
    {
        $userId = auth()->id();  // Mendapatkan ID user yang sedang login
        $productId = $request->id_barang;  // ID barang yang ingin ditambahkan
        $quantity = (int) $request->jumlah_barang;  // Jumlah barang yang ingin ditambahkan

        // Validasi input
        if ($quantity <= 0) {
            return response()->json(['success' => false, 'message' => 'Invalid quantity!'], 400);
        }

        // Ambil stok barang dari database
        $product = DB::table('stok_barangs')
            ->where('id_barang', $productId)
            ->first();

        if (!$product) {
            return response()->json(['success' => false, 'message' => 'Product not found!'], 404);
        }

        // Cek apakah barang sudah ada di keranjang
        $existingItem = DB::table('keranjangs')
            ->where('id_user', $userId)
            ->where('id_barang', $productId)
            ->first();

        DB::beginTransaction(); // Mulai transaksi database

        try {
            if ($existingItem) {
                $newQuantity = $existingItem->jumlah_barang + $quantity;

                // Pastikan tidak melebihi stok
                if ($newQuantity > $product->jumlah_stok) {
                    return response()->json(['success' => false, 'message' => 'Stock not available!'], 400);
                }

                // Update jumlah barang di keranjang
                DB::table('keranjangs')
                    ->where('id_user', $userId)
                    ->where('id_barang', $productId)
                    ->update([
                        'jumlah_barang' => $newQuantity,
                        'updated_at' => now()
                    ]);
            } else {
                // Jika barang belum ada di keranjang, cek apakah stok cukup
                if ($quantity > $product->jumlah_stok) {
                    return response()->json(['success' => false, 'message' => 'Stock not available!'], 400);
                }

                // Insert barang baru ke keranjang
                DB::table('keranjangs')->insert([
                    'id_user' => $userId,
                    'id_barang' => $productId,
                    'jumlah_barang' => $quantity,
                    'created_at' => now(),
                    'updated_at' => now()
                ]);
            }

            DB::commit(); // Simpan transaksi jika tidak ada masalah
            return response()->json(['success' => true, 'message' => 'Product added to cart!']);
        } catch (\Exception $e) {
            DB::rollBack(); // Batalkan transaksi jika terjadi error
            return response()->json(['success' => false, 'message' => 'Something went wrong!'], 500);
        }
    }


    public function checkout(Request $request)
    {
        DB::beginTransaction();

        try {
            $selectedItems = $request->input('selectedItems'); // Ambil ID keranjang yang dipilih

            if (empty($selectedItems)) {
                return response()->json(['success' => false, 'message' => 'Tidak ada produk yang dipilih!'], 400);
            }

            foreach ($selectedItems as $cartId) {
                // Ambil data barang berdasarkan id_keranjang
                $cartItem = DB::select("SELECT * FROM keranjangs WHERE id = ?", [$cartId]);

                if (!$cartItem) {
                    DB::rollBack();
                    return response()->json(['success' => false, 'message' => "Item dengan ID $cartId tidak ditemukan!"], 400);
                }

                $cartItem = $cartItem[0]; // Karena hasil query adalah array
                $stok = DB::select("SELECT jumlah_stok FROM stok_barangs WHERE id_barang = ? LIMIT 1", [$cartItem->id_barang]);

                if (!$stok || $stok[0]->jumlah_stok < $cartItem->jumlah_barang) {
                    DB::rollBack();
                    return response()->json(['success' => false, 'message' => "Stok tidak cukup untuk {$cartItem->nama_barang}!"], 400);
                }

                // Kurangi stok barang
                DB::update("UPDATE stok_barangs SET jumlah_stok = jumlah_stok - ? WHERE id_barang = ?", [$cartItem->jumlah_barang, $cartItem->id_barang]);

                // Hapus barang dari keranjang setelah checkout
                DB::delete("DELETE FROM keranjangs WHERE id = ?", [$cartId]);
            }

            DB::commit();
            return response()->json(['success' => true, 'message' => 'Checkout berhasil!']);
        } catch (\Exception $e) {
            DB::rollBack();
            return response()->json([
                'success' => false,
                'message' => 'Terjadi kesalahan saat checkout!',
                'error' => $e->getMessage()
            ], 500);
        }
    }

    public function withCoupons(Request $request)
    {
        // Validasi input kupon
        $request->validate([
            'kode' => 'required|string',
        ]);

        // Ambil kode kupon dari request
        $couponCode = $request->kode;

        // Ambil kupon dari database menggunakan query builder
        $coupon = DB::table('kupons') // Pastikan nama tabel kupon sesuai dengan yang ada di database
            ->where('kode', $couponCode)
            ->where('exp_date', '>=', now())  // Pastikan kupon belum kedaluwarsa
            ->first();

        // Cek apakah kupon valid dan ada
        if (!$coupon) {
            return redirect()->back()->with('error', 'Kupon tidak valid atau sudah kedaluwarsa.');
        }

        // Ambil harga total keranjang dari session
        $totalPrice = session('keranjang_total_price', 0);

        // Cek jika total harga keranjang sudah ada
        if ($totalPrice == 0) {
            return redirect()->back()->with('error', 'Keranjang kosong.');
        }

        // Hitung diskon berdasarkan tipe kupon
        $discountAmount = 0;
        if ($coupon->tipe === 'fixed') {
            // Kupon fixed value mengurangi harga total dengan nilai diskon tetap
            $discountAmount = min($coupon->value, $totalPrice);  // Pastikan diskon tidak melebihi total harga
        } elseif ($coupon->tipe === 'persen') {
            // Kupon persen mengurangi harga berdasarkan persentase
            $discountAmount = $totalPrice * ($coupon->value / 100);
        }

        // Hitung harga setelah diskon
        $finalPrice = $totalPrice - $discountAmount;

        // Simpan informasi kupon dan diskon ke session
        session([
            'applied_coupon' => $coupon->kode,
            'coupon_discount' => $discountAmount,
            'final_price' => $finalPrice,
        ]);

        // Kembali ke halaman sebelumnya dengan pesan sukses
        return redirect()->back()->with('success', "Kupon '{$coupon->kode}' berhasil diterapkan! Diskon: Rp {$discountAmount}, Harga akhir: Rp {$finalPrice}.");
    }

    public function remove($id)
    {
        // Cek apakah produk ada di database
        $cartItem = DB::select('SELECT * FROM keranjangs WHERE id = ?', [$id]);

        if (!$cartItem) {
            return response()->json(['success' => false, 'message' => 'Item not found in cart'], 404);
        }

        // Hapus produk dari database
        DB::delete('DELETE FROM keranjangs WHERE id = ?', [$id]);

        return response()->json(['success' => true]);
    }
}
