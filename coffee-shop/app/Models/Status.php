<?php

namespace App\Models;

use App\Models\Booking;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Status extends Model
{
    use HasFactory;
    protected $table = 'status';
    protected $fillable = [
        'name',
    ];
    public $timestamps = false;
    public function order()
    {
        return $this->belongsTo(Booking::class);
    }
}
