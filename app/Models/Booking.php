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
        'return_status',
        'actual_return_date'
    ];

    protected $dates = [
        'start_date',
        'end_date',
        'actual_return_date' => 'datetime',
    ];

    public function item()
    {
        return $this->belongsTo(Item::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function documentValidations()
    {
        return $this->hasMany(DocumentValidation::class);
    }

    public function getDocumentValidationStatus($documentType)
    {
        return $this->documentValidations()->where('document_type', $documentType)->first();
    }

    public function returnValidation()
    {
        return $this->hasOne(ReturnValidation::class);
    }

    public function isReturned()
    {
        return $this->return_status === 'returned';
    }
}
