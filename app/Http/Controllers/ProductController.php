<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Intervention\Image\Facades\Image;
use Illuminate\Support\Facades\Storage;

class ProductController extends Controller
{
    public function showCategories()
    {
        $categories = DB::select('SELECT * FROM kategori_barangs');
        return view('admin.kategori', compact('categories'));
    }

    public function storeCat(Request $request)
    {
        $request->validate([
            'nama_kategori' => 'required|string|max:255',
            'deskripsi' => 'nullable|string',
        ]);

        // Menyimpan data menggunakan raw SQL
        DB::insert(
            'INSERT INTO kategori_barangs (nama_kategori, deskripsi, created_at, updated_at) VALUES (?, ?, ?, ?)',
            [
                $request->nama_kategori,
                $request->deskripsi,
                now(),
                now()
            ]
        );

        return redirect()->back()->with('success', 'Category added successfully!');
    }

    public function showProduct()
    {
        $categories = DB::table('kategori_barangs')->select('id', 'nama_kategori')->get();
        // Mengambil data produk dengan join untuk mendapatkan nama kategori
        $products = DB::select('
        SELECT b.*, k.nama_kategori, sb.jumlah_stok
        FROM barangs AS b
        LEFT JOIN kategori_barangs AS k ON b.id_kategori = k.id
        INNER JOIN stok_barangs AS sb ON b.id = sb.id_barang
        ');

        return view('admin.produk', compact('products', 'categories'));
    }

    public function storeProd(Request $request)
    {
        // Validasi input
        $request->validate([
            'nama_barang' => 'required|string|max:255',
            'id_kategori' => 'required|exists:kategori_barangs,id',
            'harga' => 'required|numeric|min:0',
            'status' => 'required|string|in:Available,Out of Stock',
            'jumlah_stok' => 'required|integer|min:0',
            'deskripsi' => 'nullable|string',
            'link_img' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048', // Validasi gambar tunggal
        ]);

        DB::beginTransaction();
        try {
            // Proses upload gambar jika ada
            $imagePath = null;
            if ($request->hasFile('link_img')) {
                $image = $request->file('link_img');
                $imageName = time() . '_' . uniqid() . '.' . $image->getClientOriginalExtension();

                // Simpan gambar ke storage
                $imagePath = $image->storeAs('foto_produk', $imageName, 'public');

                // Generate thumbnail (opsional)
                // $this->generateThumbnail($image, $imageName);
            }

            // Insert data barang
            $queryBarang = "
                INSERT INTO barangs (nama_barang, id_kategori, deskripsi, harga, status, link_img, created_at, updated_at)
                VALUES (?, ?, ?, ?, ?, ?, ?, ?)
            ";
            $paramsBarang = [
                $request->nama_barang,
                $request->id_kategori,
                $request->deskripsi ?? '',
                $request->harga,
                $request->status,
                $imagePath, // Simpan path gambar
                now(),
                now(),
            ];
            DB::insert($queryBarang, $paramsBarang);

            // Ambil ID barang yang baru saja dimasukkan
            $idBarang = DB::getPdo()->lastInsertId();

            // Insert data stok barang
            $queryStok = "
                INSERT INTO stok_barangs (jumlah_stok, id_barang, created_at, updated_at)
                VALUES (?, ?, ?, ?)
            ";
            $paramsStok = [
                $request->jumlah_stok,
                $idBarang,
                now(),
                now(),
            ];
            DB::insert($queryStok, $paramsStok);

            DB::commit();

            return redirect()->route('product.index')->with('success', 'Produk berhasil ditambahkan!');
        } catch (\Exception $e) {
            DB::rollBack();
            return redirect()->back()->with('error', 'Terjadi kesalahan: ' . $e->getMessage());
        }
    }

    public function update(Request $request, $id)
    {
        DB::beginTransaction(); // Gunakan transaksi biar aman

        try {
            // Ambil data produk saat ini (untuk menghapus foto lama jika ada)
            $produk = DB::table('barangs')->where('id', $id)->first();

            // Cek apakah ada file gambar yang diunggah
            if ($request->hasFile('link_img')) {
                // Hapus gambar lama jika ada
                if ($produk->link_img) {
                    Storage::delete('public/' . $produk->link_img);
                }

                // Simpan gambar baru
                $file = $request->file('link_img');
                $fileName = time() . '_' . $file->getClientOriginalName();
                $filePath = $file->storeAs('public/images', $fileName); // Simpan ke storage
                $filePath = str_replace('public/', '', $filePath); // Simpan path yang sesuai
            } else {
                $filePath = $produk->link_img; // Jika tidak ada gambar baru, tetap gunakan yang lama
            }
            
            // Update tabel barangs (tanpa jumlah_stok)
            DB::table('barangs')->where('id', $id)->update([
                'nama_barang' => $request->nama_barang,
                'id_kategori' => $request->id_kategori,
                'harga' => $request->harga,
                'deskripsi' => $request->deskripsi,
                'updated_at' => now()
            ]);

            // Update tabel stok_barangs berdasarkan id_barang
            DB::table('stok_barangs')->where('id_barang', $id)->update([
                'jumlah_stok' => $request->jumlah_stok,
                'updated_at' => now()
            ]);

            // Ambil jumlah stok terbaru
            $stokTerbaru = DB::table('stok_barangs')
                ->where('id_barang', $id)
                ->value('jumlah_stok');

            // Tentukan status produk
            $status = ($stokTerbaru > 0) ? 'Available' : 'Out of Stock';

            // Update status di tabel barang
            DB::table('barangs')->where('id', $id)->update([
                'status' => $status
            ]);

            DB::commit(); // Simpan perubahan

            return redirect()->back()->with('success', 'Produk berhasil diperbarui!');
        } catch (\Exception $e) {
            DB::rollback(); // Batalkan perubahan jika error
            return redirect()->back()->with('error', 'Gagal memperbarui produk: ' . $e->getMessage());
        }
    }


    public function destroy($id)
    {
        DB::beginTransaction();

        try {
            // Ambil path gambar dari database
            $product = DB::selectOne('SELECT link_img FROM barangs WHERE id = ?', [$id]);

            // Jika produk tidak ditemukan
            if (!$product) {
                return redirect()->back()->with('error', 'Produk tidak ditemukan.');
            }

            // Hapus file gambar dari storage jika ada
            if ($product->link_img && file_exists(storage_path('app/public/' . $product->link_img))) {
                unlink(storage_path('app/public/' . $product->link_img));
            }

            // Hapus stok barang terkait
            DB::delete('DELETE FROM stok_barangs WHERE id_barang = ?', [$id]);

            // Hapus produk dari tabel barangs
            DB::delete('DELETE FROM barangs WHERE id = ?', [$id]);

            DB::commit();

            return redirect()->back()->with('success', 'Produk berhasil dihapus!');
        } catch (\Exception $e) {
            DB::rollBack();
            return redirect()->back()->with('error', 'Terjadi kesalahan: ' . $e->getMessage());
        }
    }
}
