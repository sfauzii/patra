<?php

namespace App\Http\Controllers;

use App\Models\Item;
use Illuminate\Http\Request;

class ItemController extends Controller
{
    public function show($slug)
    {
        $item = Item::with(['type', 'brand'])
            ->whereSlug($slug)
            ->firstOrFail();

        $similiarItems = Item::with(['type', 'brand'])
            // ->where('type_id', $item->type_id)
            ->where('id', '!=', $item->id)
            ->inRandomOrder()
            ->get();

        // $otherCars = Item::with(['type', 'brand'])->inRandomOrder()->take(4)->get();

        return view('pages.items.detail', [
            'item' => $item,
            'showFooter' => false,
            'similiarItems' => $similiarItems,
            // 'otherCars' => $otherCars,
        ]);
    }
}
