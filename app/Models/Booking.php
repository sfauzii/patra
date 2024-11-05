<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Booking extends Model
{
    use HasFactory, HasUuids, SoftDeletes;

    protected $fillable = [
        'item_id',
        'user_id',
        'booking_code',
        'name',
        'start_date',
        'end_date',
        'address',
        'payment_method',
        'payment_status',
        'payment_url',
        'total_price',
        'ktp_booking',
        'identity_booking',
        'selfie_booking',
        'phone',
    ];

    protected $dates = [
        'start_date',
        'end_date',
    ];

    public function item()
    {
        return $this->belongsTo(Item::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
