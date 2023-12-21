<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;
    protected $fillable = ['name', 'description', 'category_id', 'price', 'image', 'status', 'quantity', 'discount_percentage'];
    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    public function carts()
    {
        return $this->hasMany(Cart::class);
    }

    public function paymentDetails()
    {
        return $this->hasMany(PaymentDetail::class);
    }

    public function hasEnoughQuantity($quantity)
    {
        return $this->quantity >= $quantity;
    }

    public function getDiscountPercentage()
    {
        return $this->discount_percentage;
    }
}
