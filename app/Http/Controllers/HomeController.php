<?php

namespace App\Http\Controllers;

use App\Models\Item;
use App\Models\Brand;
use App\Models\Review;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    // public function __construct()
    // {
    //     $this->middleware('auth');
    // }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {

        $brands = Brand::all();

        // Eager load `reviews` untuk menghitung rata-rata rating dan jumlah ulasan
        $items = Item::with(['type', 'brand', 'reviews']) // Eager load 'reviews.user' untuk data pengulas
            ->inRandomOrder()
            ->get()
            ->map(function ($item) {
                $item->avg_rating = $item->reviews->avg('rating') ?? 0; // Default 0 jika tidak ada ulasan
                $item->review_count = $item->reviews->count();
                return $item;
            });

        // Ambil 4 ulasan secara acak
        $randomReviews = Review::with(['user', 'item']) // Load user dan item terkait ulasan
            ->inRandomOrder()
            ->take(4)
            ->get();


        return view('home', [
            'brands' => $brands,
            'items' => $items,
            'randomReviews' => $randomReviews, // Ulasan acak
        ]);
    }
}
