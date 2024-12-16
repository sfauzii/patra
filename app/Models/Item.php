<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Item extends Model
{
    use HasFactory, SoftDeletes, HasUuids;

    protected $fillable = [
        'name',
        'slug',
        'brand_id',
        'type_id',
        'photos',
        'features',
        'price',
        // 'star',
        // 'review',
        'description',
        'is_available',
    ];

    protected $hidden = [];

    protected $casts = [
        'photos' => 'array'
    ];

    // Get first photo from photos
    public function getThumbnailAttribute()
    {
        // If photos exist
        if ($this->photos) {
            return Storage::url(json_decode($this->photos)[0]);
        }

        // return asset('images/default.png');
        return 'https::via.placeholders.com/800x600';
    }

    public function scopeSearch($query, $term)
    {
        return $query->where(function ($query) use ($term) {
            $query->where('name', 'like', '%' . $term . '%')
                ->orWhere('description', 'like', '%' . $term . '%');
        });
    }

    public function brand()
    {
        return $this->belongsTo(Brand::class);
    }

    public function type()
    {
        return $this->belongsTo(Type::class);
    }

    public function bookings()
    {
        return $this->hasMany(Booking::class);
    }


    public function reviews()
    {
        return $this->hasMany(Review::class);
    }

    // In app/Models/Item.php
    // public function scopeAvailable($query)
    // {
    //     return $query->whereDoesntHave('bookings', function ($q) {
    //         $q->where('end_date', '>=', now());
    //     });
    // }
}
