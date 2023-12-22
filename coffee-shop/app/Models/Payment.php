<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Payment extends Model
{
    use HasFactory;
    protected $fillable = [
        'user_id',
        'email',
        'amount',
        'currency', 
        'payment_method', 
        'status', 
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function payment_details()
    {
        return $this->hasMany(PaymentDetail::class);
    }
}
