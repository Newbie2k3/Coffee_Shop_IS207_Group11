<?php

namespace App\Models;

use App\Models\Paymentmethod;
use App\Models\Status;
use App\Models\Cart;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;
    protected $table = 'orders';
    protected $fillable = ['user_id', 'cart_id', 'paymentmethod_id', 'status_id', 'time', 'total'];
    public $timestamps = false;
    public function user()
    {
        return $this->belongsTo(User::class);
    }
    public function carts()
    {
        return $this->belongsTo(Cart::class);
    }
    public function paymentmethods()
    {
        return $this->belongsTo(Paymentmethod::class);
    }
    public function status()
    {
        return $this->belongsTo(Status::class);
    }
}
