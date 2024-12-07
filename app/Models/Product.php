<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;

    protected $fillable = [
        'nama',
        'model',
        'kategori',
        'serial_number',
        'deskripsi',
        'isAvailable',
        'foto'
    ];

    public function bookings()
    {
        return $this->belongsToMany(Booking::class, 'booking_products');
    }
}