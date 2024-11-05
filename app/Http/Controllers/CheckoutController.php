<?php

namespace App\Http\Controllers;

use App\Models\Item;
use App\Models\Booking;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;

class CheckoutController extends Controller
{
    public function index($slug)
    {

        $item = Item::with(['type', 'brand'])
            ->whereSlug($slug)
            ->firstOrFail();

        return view('checkout', [
            'item' => $item
        ]);
    }

}
