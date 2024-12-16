<?php

namespace App\Http\Controllers;

use App\Models\Item;
use Illuminate\Http\Request;

class CarsController extends Controller
{
    public function cars()
    {

        $items = Item::with(['type', 'brand', 'reviews'])
            ->where('is_available', true)

            ->get()
            ->map(function ($item) {
                return (object) [
                    'id' => $item->id,
                    'name' => $item->name,
                    'slug' => $item->slug,
                    'photos' => $item->photos,
                    'type' => $item->type,
                    'price' => $item->price,
                    'brand' => $item->brand,
                    'reviews' => $item->reviews,
                    'avg_rating' => $item->reviews->avg('rating') ?? 0,
                    'review_count' => $item->reviews->count(),
                ];
            });

        return view('cars', [
            'items' => $items,
        ]);
    }
}
