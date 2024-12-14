<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Chat extends Model
{
    protected $fillable = [
        'customization_id',
        'sender_id',
        'receiver_id',
        'message',
    ];

    public function customization()
    {
        return $this->belongsTo(Customization::class);
    }
}
