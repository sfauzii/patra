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
        'rejection_reason',
        'history'
    ];

    protected $casts = [
        'history' => 'array',
    ];

    // Helper to add a new entry to history
    public function addHistory($status, $rejectionReason = null)
    {
        $currentHistory = $this->history ?? [];
        $currentHistory[] = [
            'status' => $status,
            'rejection_reason' => $rejectionReason,
            'timestamp' => now()->format('d-m-Y H:i:s'),
        ];
        $this->update(['history' => $currentHistory]);
    }


    public function booking()
    {
        return $this->belongsTo(Booking::class);
    }
}
