<?php

namespace App\Http\Controllers;

use App\Models\Item;
use Illuminate\Http\Request;

class CarsController extends Controller
{
    public function cars()
    {

        $items =  Item::with(['type', 'brand'])
            ->available()
            ->where('is_available', true)
            ->get();

        return view('cars', [
            'items' => $items,
        ]);
    }
}
