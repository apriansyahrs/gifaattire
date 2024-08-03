<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BookingTransaction extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'phone_number',
        'address',
        'attire_id',
        'booked_at',
        'note',
        'total_amount',
        'is_paid',
        'proof',
        'booking_trx_id',
    ];

    public function attire()
    {
        return $this->belongsTo(Attire::class);
    }
}
