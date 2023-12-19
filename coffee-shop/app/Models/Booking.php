<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Cart;
use App\Models\Paymentmethod;
use App\Models\Status;

class Booking extends Model
{
    use HasFactory;
    protected $table = 'bookings';
    protected $fillable = [
        'user_id',
        'total',
        'paymentmethod_id',
        'status_id',
    ];
    public $timestamps = false;
    public function user()
    {
        return $this->belongsTo(User::class);
    }
    public function paymentmethod()
    {
        return $this->belongsTo(Paymentmethod::class);
    }
    public function status()
    {
        return $this->belongsTo(Status::class);
    }
}
