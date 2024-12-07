<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Booking extends Model
{
    use HasFactory;
    protected $fillable = [
        'booking_code',
        'user_id',
        'sales',
        'presales',
        'customer',
        'start_book',
        'end_book',
        'notes',
        'status',
    ];

    protected $casts = [
        'start_book' => 'datetime',
        'end_book' => 'datetime',
    ];

    /**
     * Relationship to the User model.
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    /**
     * Relationship to BookingItem.
     */
    public function products()
    {
        return $this->belongsToMany(Product::class, 'booking_products');
    }
}