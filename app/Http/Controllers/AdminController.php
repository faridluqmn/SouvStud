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

        // Join the barangs and stok_barangs tables to get product data and stock information
        $products = DB::table('barangs')
            ->join('stok_barangs', 'barangs.id', '=', 'stok_barangs.id')
            ->select('barangs.nama_barang', 'barangs.harga', 'stok_barangs.jumlah_stok', 'barangs.link_img')
            ->get();

        return view('admin.index', compact('products'));
    }

    public function coupons()
    {
        $coupons = DB::table('kupons')
            ->orderBy('exp_date', 'desc')
            ->paginate(12);

        // Mengirim data kupon ke view
        return view('admin.kupon', compact('coupons'));
    }

    public function savecoupons(Request $request)
    {
        // Validate the request
        $request->validate([
            'kode' => 'required|unique:kupons',
            'tipe' => 'required',
            'value' => 'required|numeric',
            'exp_date' => 'required|date',
        ]);

        // Insert coupon data directly into the database using DB facade
        DB::table('kupons')->insert([
            'kode' => $request->kode,
            'tipe' => $request->tipe,
            'value' => $request->value,
            'exp_date' => $request->exp_date,
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        // Redirect back to coupons index with success message
        return redirect()->route('coupons.index')->with('success', 'Coupon added successfully!');
    }

    public function validateCoupon(Request $request)
    {
        // Ambil kode kupon dan harga total dari request
        $couponCode = $request->coupon_code;
        $totalPrice = $request->total_price;

        // Gunakan query builder dengan raw SQL untuk memeriksa apakah kupon valid
        $coupon = DB::table('kupons')
            ->where('kode', $couponCode)
            ->where('exp_date', '>=', now())
            ->first();

        if (!$coupon) {
            return response()->json(['success' => false, 'message' => 'Kupon tidak valid!']);
        }

        // Validasi kupon dan hitung diskon berdasarkan tipe kupon
        $discountAmount = 0;

        if ($coupon->tipe === 'fixed') {
            // Jika tipe kupon 'fixed', diskon adalah nilai tetap
            $discountAmount = $coupon->value;
        } elseif ($coupon->tipe === 'persen') {
            // Jika tipe kupon 'persen', diskon dihitung sebagai persen dari harga total
            $discountAmount = $totalPrice * ($coupon->value / 100);
        }

        // Kembalikan response dengan informasi kupon yang valid
        return response()->json([
            'success' => true,
            'discount_amount' => $discountAmount,
            'message' => 'Kupon berhasil diterapkan!'
        ]);
    }

    /**
     * Contoh fitur tambahan untuk admin.
     */
    public function manageUsers(request $request)
    {
        $users = DB::table('users')
            ->when($request->has('search'), function ($query) use ($request) {
                // Filter users based on search query for name and email
                return $query->where('name', 'like', '%' . $request->search . '%')
                    ->orWhere('email', 'like', '%' . $request->search . '%');
            })
            ->paginate(10);  // Paginate the results with 10 users per page

        // Return the view with the users data
        return view('admin.data_user', compact('users'));
    }
}
