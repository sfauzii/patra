<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class DocumentValidation extends Model
{
    use HasFactory, HasUuids, SoftDeletes;

    protected $fillable = [
        'booking_id',
        'document_type',
        'status',
        'rejection_reason'
    ];

    public function booking()
    {
        return $this->belongsTo(Booking::class);
    }
}
