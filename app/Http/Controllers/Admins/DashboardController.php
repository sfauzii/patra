<?php

namespace App\Http\Controllers\Admins;

use App\Models\Item;
use App\Models\Type;
use App\Models\Brand;
use App\Models\Review;
use App\Models\Booking;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    public function index()
    {
        // Get the authenticated user
        $user = Auth::user();

        // Count the records
        $brandCount = Brand::count();
        $typeCount = Type::count();
        $itemCount = Item::count();
        $bookingCount = Booking::count();

        // Get the latest 10 reviews
        $latestReviews = Review::with('user') // Assuming you want to get the user who made the review
            ->orderBy('created_at', 'desc')
            ->take(10)
            ->get();

        return view('pages.admins.dashboard', [
            'user' => $user,
            'brandCount' => $brandCount,
            'typeCount' => $typeCount,
            'itemCount' => $itemCount,
            'bookingCount' => $bookingCount,
            'latestReviews' => $latestReviews,
        ]);
    }
}
