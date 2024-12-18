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

    public function remove($productId)
    {
        // Mengambil keranjang dari session
        $cart = Session::get('cart', []);

        // Memastikan bahwa produk ada di dalam keranjang
        if (isset($cart[$productId])) {
            // Menghapus produk berdasarkan ID
            unset($cart[$productId]);

            // Menyimpan kembali keranjang ke session
            Session::put('cart', $cart);

            return response()->json(['success' => true]);
        }

        return response()->json(['success' => false, 'message' => 'Product not found in cart.']);
    }
}
