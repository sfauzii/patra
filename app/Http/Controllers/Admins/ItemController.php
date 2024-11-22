<?php

namespace App\Http\Controllers\Admins;

use App\Models\Item;
use App\Models\Type;
use App\Models\Brand;
use Illuminate\Support\Str;
use App\Http\Requests\ItemRequest;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;

class ItemController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()


    {
        $items = Item::orderBy('created_at', 'desc')->get();
        return view('pages.admins.items.index', compact('items'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $brands = Brand::all();
        $types = Type::all();

        return view('pages.admins.items.create', [
            'brands' => $brands,
            'types' => $types,
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(ItemRequest $request)
    {
        $data = $request->all();

        $data['slug'] = Str::slug($data['name']) . '-' . Str::lower(Str::random(5));

        if ($request->hasFile('photos')) {
            $photos = [];

            foreach ($request->file('photos') as $photo) {
                $photoPath = $photo->store('assets/item', 'public');

                array_push($photos, $photoPath);
            }
            $data['photos'] = json_encode($photos);
        }

        Item::create($data);

        toast('Your Item has been created!', 'success');

        return redirect()->route('items.index');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Item $item)
    {
        $item->load('brand', 'type');

        $brands = Brand::all();
        $types = Type::all();

        return view('pages.admins.items.edit', [
            'item' => $item,
            'brands' => $brands,
            'types' => $types,
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(ItemRequest $request, Item $item)


    {
        $data = $request->all();

        // If photos is not empty, then upload new photos
        if ($request->hasFile('photos')) {
            $photos = [];

            foreach ($request->file('photos') as $photo) {
                $photoPath = $photo->store('assets/item', 'public');

                // Store as json
                array_push($photos, $photoPath);
            }

            $data['photos'] = json_encode($photos);
        } else {
            // If photos is empty, then use old photos
            $data['photos'] = $item->photos;
        }

        $item->update($data);

        toast('Your Item has been updated!', 'success');

        return redirect()->route('items.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Item $item)
    {
        $item->delete();

        toast('Your Item as been deleted!', 'success');

        return redirect()->route('items.index');
    }

    public function toggleAvailability(Item $item)
    {
        // Toggle the is_available status
        $item->is_available = !$item->is_available;
        $item->save();

        // Provide feedback based on the new status
        $message = $item->is_available
            ? 'Item has been activated successfully!'
            : 'Item has been deactivated successfully!';

        toast($message, 'success');

        return redirect()->route('items.index');
    }
}
