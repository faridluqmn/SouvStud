<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Customization extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'product_name',
        'custom_image',
        'custom_message',
    ];

    public function chats()
    {
        return $this->hasMany(Chat::class);
    }
}
