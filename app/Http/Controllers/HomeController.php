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
        // $items = Item::with(['type', 'brand', 'reviews']) // Eager load 'reviews.user' untuk data pengulas
        //     ->available() // Add this scope
        //     ->inRandomOrder()
        //     ->get()
        //     ->map(function ($item) {
        //         $item->avg_rating = $item->reviews->avg('rating') ?? 0; // Default 0 jika tidak ada ulasan
        //         $item->review_count = $item->reviews->count();
        //         return $item;
        //     });

        // First set of random items
        $firstRandomItems = Item::with(['type', 'brand', 'reviews'])
            // ->available()
            ->where('is_available', true)
            ->inRandomOrder()
            ->get()
            ->map(function ($item) {
                $item->avg_rating = $item->reviews->avg('rating') ?? 0;
                $item->review_count = $item->reviews->count();
                return $item;
            });

        // Second set of random items (different random order)
        $secondRandomItems = Item::with(['type', 'brand', 'reviews'])
            // ->available()
            ->where('is_available', true)
            ->inRandomOrder() // This will generate a different random order
            ->get()
            ->map(function ($item) {
                $item->avg_rating = $item->reviews->avg('rating') ?? 0;
                $item->review_count = $item->reviews->count();
                return $item;
            });

        // Ambil 4 ulasan secara acak
        $randomReviews = Review::with(['user', 'item']) // Load user dan item terkait ulasan
            ->inRandomOrder()
            ->take(4)
            ->get()
            ->map(function ($review) {
                $review->avg_rating = $review->item->reviews->avg('rating') ?? 0; // Hitung rata-rata dari item terkait
                $review->review_count = $review->item->reviews->count(); // Hitung jumlah ulasan untuk item terkait
                return $review;
            });



        return view('home', [
            'brands' => $brands,
            // 'items' => $items,
            'firstItems' => $firstRandomItems,
            'secondItems' => $secondRandomItems,
            'randomReviews' => $randomReviews, // Ulasan acak
        ]);
    }

    public function view(Brand $brand)
    {
        // Ambil semua item berdasarkan brand
        $items = $brand->items()->with(['type', 'reviews'])
            // ->available()
            ->where('is_available', true)
            ->get()
            ->map(function ($item) {
                $item->avg_rating = $item->reviews->avg('rating') ?? 0; // Default 0 jika tidak ada ulasan
                $item->review_count = $item->reviews->count();
                return $item;
            });

        return view('brand-cars', [
            'brand' => $brand,
            'items' => $items,
        ]);
    }

    public function about()
    {

        return view('about');
    }
}
