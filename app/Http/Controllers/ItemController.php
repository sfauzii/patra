<?php

namespace App\Http\Controllers;

use App\Models\Item;
use Illuminate\Http\Request;

class ItemController extends Controller
{
    public function show($slug)
    {
        $item = Item::with(['type', 'brand', 'reviews.user'])
            ->whereSlug($slug)
            ->firstOrFail();

        // Hitung rata-rata rating dan jumlah ulasan
        $avgRating = $item->reviews()->avg('rating');
        $reviewCount = $item->reviews()->count();


        $reviews = $item->reviews()->with('user')->get();

        $similiarItems = Item::with(['type', 'brand'])
            // ->where('type_id', $item->type_id)
            ->where('id', '!=', $item->id)
            ->available()
            ->inRandomOrder()
            ->get()
            ->map(function ($item) {
                // Tambahkan rata-rata rating dan jumlah ulasan ke setiap item
                $item->avg_rating = $item->reviews->avg('rating') ?? 0; // Default 0 jika tidak ada ulasan
                $item->review_count = $item->reviews->count();
                return $item;
            });

        // $otherCars = Item::with(['type', 'brand'])->inRandomOrder()->take(4)->get();

        return view('pages.items.detail', [
            'item' => $item,
            'reviews' => $reviews, // Pass reviews to the view
            'showFooter' => false,
            'avgRating' => $avgRating, // Rata-rata rating
            'reviewCount' => $reviewCount, // Jumlah ulasan
            'similiarItems' => $similiarItems,
            // 'otherCars' => $otherCars,
        ]);
    }
}
