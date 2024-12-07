<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pembayaran extends Model
{
    use HasFactory;

    protected $fillable = ['tanggal_pembayaran', 'jumlah_pembayaran', 'metode_pembayaran', 'status_pembayaran'];

    // Relasi ke tabel detail_pembayarans
    public function detailPembayarans()
    {
        return $this->hasMany(DetailPembayaran::class, 'id_pembayaran');
    }
}
