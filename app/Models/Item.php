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
        'star',
        'review',
    ];

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

    public function brand()
    {
        return $this->belongsTo(Brand::class);
    }

    public function type()
    {
        return $this->belongsTo(Type::class);
    }
}
