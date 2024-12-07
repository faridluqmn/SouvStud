<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class KategoriBarang extends Model
{
    use HasFactory;

    protected $fillable = ['nama_kategori', 'deskripsi'];

    // Relasi ke tabel barangs
    public function barangs()
    {
        return $this->hasMany(Barang::class, 'id_kategori');
    }
}
