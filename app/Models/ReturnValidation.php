<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ReturnValidation extends Model
{
    use HasFactory, HasUuids;

    protected $fillable = [
        'booking_id',
        'return_date',
        'return_condition',
        'return_notes',
        'status',
        'validated_by'
    ];

    protected $casts = [
        'return_date' => 'datetime',
    ];

    public function booking()
    {
        return $this->belongsTo(Booking::class);
    }

    public function validator()
    {
        return $this->belongsTo(User::class, 'validated_by');
    }
}
