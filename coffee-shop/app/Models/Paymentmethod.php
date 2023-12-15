<?php

namespace App\Models;

use App\Models\Order;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Paymentmethod extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
    ];
    public $timestamps = false;
    public function order()
    {
        return $this->belongsTo(Order::class);
    }
}
