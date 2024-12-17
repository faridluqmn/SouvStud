<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class RoleModel extends Model
{
    // Menyebutkan nama tabel yang sesuai
    protected $table = 'roles';  // Sesuaikan dengan nama tabel kamu

    // Menyebutkan primary key yang sesuai
    protected $primaryKey = 'idrole';  // Kolom primary key sesuai dengan yang ada di database

    // Relasi ke pengguna
    public function users()
    {
        return $this->hasMany(User::class, 'id_role');  // id_role di tabel users mengacu pada idrole di nama_role
    }
}
