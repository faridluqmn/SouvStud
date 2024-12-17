<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Chat extends Model
{
    protected $fillable = [
<<<<<<< HEAD
=======
        'customization_id',
>>>>>>> 9e3fae605f9826c83057db3cad8c33aa87cf42ba
        'sender_id',
        'receiver_id',
        'message',
    ];

    public function sender()
    {
        return $this->belongsTo(User::class, 'sender_id');
    }

    public function receiver()
    {
        return $this->belongsTo(User::class, 'receiver_id');
    }

<<<<<<< HEAD
=======
    public function customization()
    {
        return $this->belongsTo(Customization::class);
    }
>>>>>>> 9e3fae605f9826c83057db3cad8c33aa87cf42ba
}
