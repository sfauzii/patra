<?php

namespace App\Http\Controllers\Admins;

use App\Models\Brand;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Storage;

class BrandController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $brands = Brand::all(); 
        return view('pages.admins.brands.index', compact('brands'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('pages.admins.brands.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $data = $request->all();

        // Validate the request, including image
        $request->validate([
            'name' => 'required|string|max:255',
            'icon_images' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        // Generate a slug
        $data['slug'] = Str::slug($data['name']) . '-' . Str::lower(Str::random(5));

        // Handle image upload if provided
        if ($request->hasFile('icon_images')) {
            $image = $request->file('icon_images');
            $imagePath = $image->store('brand_images', 'public'); // Store in public disk
            $data['icon_images'] = $imagePath;
        }

        // Create the brand
        Brand::create($data);

        return redirect()->route('brands.index');
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
    public function edit(Brand $brand)


    {
        return view('pages.admins.brands.edit', [
            'brand' => $brand,
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Brand $brand)
    {
        $data = $request->all();

        // Validate the request, including image
        $request->validate([
            'name' => 'required|string|max:255',
            'icon_images' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        // Generate a new slug
        $data['slug'] = Str::slug($data['name']) . '-' . Str::lower(Str::random(5));

        // Handle image upload if a new image is provided
        if ($request->hasFile('icon_images')) {
            // Delete the old image if it exists
            if ($brand->icon_images) {
                Storage::disk('public')->delete($brand->icon_images);
            }

            $image = $request->file('icon_images');
            $imagePath = $image->store('brand_images', 'public'); // Store in public disk
            $data['icon_images'] = $imagePath;
        }

        // Update the brand
        $brand->update($data);

        return redirect()->route('brands.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Brand $brand)


    {
        $brand->delete();

        return redirect()->route('brands.index');
    }
}
