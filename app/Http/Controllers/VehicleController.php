<?php

namespace App\Http\Controllers;

use App\Models\Item;
use Illuminate\Http\Request;

class VehicleController extends Controller
{
    public function cars()
    {

        $items = Item::with(['type', 'brand', 'reviews'])
            ->where('is_available', true)
            ->where('vehicle', 'car')
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

    public function motorcycle()
    {

        $items = Item::with(['type', 'brand', 'reviews'])
        ->where('is_available', true)
            ->where('vehicle', 'motorcycle')
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

        return view('motorcycle', [
            'items' => $items,
        ]);
    }
}
