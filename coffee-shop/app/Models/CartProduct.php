<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Cart;
use App\Models\Product;

class CartProduct extends Model
{
    use HasFactory;
    protected $table = 'cart_products';
    protected $fillable = [
        'cart_id',
        'product_id',
        'quantity',
        'total'
    ];

    public $timestamps = false;

    public function cart()
    {
        return $this->belongsTo(Cart::class);
    }
    public function product()
    {
        return $this->belongsTo(Product::class);
    }
}
