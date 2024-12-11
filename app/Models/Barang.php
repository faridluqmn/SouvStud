<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Barang extends Model
{
    use HasFactory;

    protected $fillable = ['nama_barang', 'deskripsi', 'harga', 'id_kategori'];

    // Relasi ke tabel kategori_barangs
    public function kategori()
    {
        return $this->belongsTo(KategoriBarang::class, 'id_kategori');
    }

    // Relasi ke tabel keranjangs
    public function keranjangs()
    {
        return $this->hasMany(Keranjang::class, 'id_barang');
    }
}
