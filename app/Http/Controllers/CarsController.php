<?php

namespace App\Http\Controllers;

use App\Models\Item;
use Illuminate\Http\Request;

class CarsController extends Controller
{
    public function cars()
    {

        $items =  Item::with(['type', 'brand', 'reviews'])
            ->available()
            ->where('is_available', true)
            ->get()
            ->map(function ($item) {
                $item->avg_rating = $item->reviews->avg('rating') ?? 0;
                $item->review_count = $item->reviews->count();
                return $item;
            });

        return view('cars', [
            'items' => $items,
        ]);
    }
}
