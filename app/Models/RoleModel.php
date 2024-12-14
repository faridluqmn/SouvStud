<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class RoleModel extends Model
{
    public function users()
    {
        return $this->hasMany(User::class, 'id_role');
    }

}
