<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DetailPembayaran extends Model
{
    use HasFactory;

    protected $fillable = ['id_barang', 'id_keranjang', 'id_pembayaran', 'jumlah_barang', 'harga_barang', 'subtotal'];

    // Relasi ke tabel pembayaran
    public function pembayaran()
    {
        return $this->belongsTo(Pembayaran::class, 'id_pembayaran');
    }

    // Relasi ke tabel keranjang
    public function keranjang()
    {
        return $this->belongsTo(Keranjang::class, 'id_keranjang');
    }

    // Relasi ke tabel barang
    public function barang()
    {
        return $this->belongsTo(Barang::class, 'id_barang');
    }
}
