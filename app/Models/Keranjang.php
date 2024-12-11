<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Keranjang extends Model
{
    use HasFactory;

    protected $fillable = ['id_user', 'id_barang', 'jumlah_barang'];

    // Relasi ke tabel users
    public function user()
    {
        return $this->belongsTo(User::class, 'id_user');
    }

    // Relasi ke tabel barangs
    public function barang()
    {
        return $this->belongsTo(Barang::class, 'id_barang');
    }

     // Relasi ke tabel detail_pembayarans
     public function detailPembayarans()
     {
         return $this->hasMany(DetailPembayaran::class, 'id_keranjang');
     }
}
