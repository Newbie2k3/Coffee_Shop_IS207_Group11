<?php

namespace App\Models;

use App\Models\Booking;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Paymentmethod extends Model
{
    use HasFactory;
    protected $table = 'paymentmethods';

    protected $fillable = [
        'name',
    ];
    public $timestamps = false;
    public function order()
    {
        return $this->belongsTo(Booking::class);
    }
}
