<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Deposit extends Model
{
    protected $fillable = [
        'user_id',
        'amount',
        'status',
        'checkout_url',
        'payment_method',
        'external_id',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
