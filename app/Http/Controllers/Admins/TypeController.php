<?php

namespace App\Http\Controllers\Admins;

use App\Models\Type;
use Illuminate\Support\Str;
use Illuminate\Http\Request;

use function PHPSTORM_META\type;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Storage;

class TypeController extends Controller
{
    /**
     * Display a listing of the resource.
     */

    public function __construct()
    {
        // Apply permission middleware dynamically to resource actions
        $this->middleware('check.permission:create-type')->only(['create', 'store']);
        $this->middleware('check.permission:view-type')->only('index');
        $this->middleware('check.permission:edit-type')->only(['edit', 'update']);
        $this->middleware('check.permission:delete-type')->only(['destroy']);
    }

    public function index()
    {
        $types = Type::oldest('created_at')->get();
        return view('pages.admins.types.index', compact('types'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('pages.admins.types.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $data = $request->all();

        $request->validate([
            'name' => 'required|string|max:255',
            'icon_images' => 'nullable|iamge|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        $data['slug'] = Str::slug($data['name']) . '-' . Str::lower(Str::random(5));

        if ($request->hasFile('icon_images')) {
            $image = $request->file('icon_images');
            $imagePath = $image->file('type_images', 'public');
            $data['icon_images'] = $imagePath;
        }

        Type::create($data);

        toast('Your Type as been created!', 'success');


        return redirect()->route('types.index');
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
    public function edit(Type $type)
    {
        return view('pages.admins.types.edit', [
            'type' => $type
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Type $type)
    {
        $data = $request->all();

        $request->validate([
            'name' => 'required|string|max:255',
            'icon_images' => 'nullable|image|mimes:jpeg,jpg,png,gif|max:2048',
        ]);

        $data['slug'] = Str::slug($data['name']) . '-' . Str::lower(Str::random(5));

        if ($request->hasFile('icon_images')) {
            if ($type->icon_images) {
                Storage::disk('public')->delete($type->icon_images);
            }

            $image = $request->file('icon_images');
            $imagePath = $image->store('type_images', 'public');

            $data['icon_images'] = $imagePath;
        }

        $type->update($data);

        toast('Your Type as been edited!', 'success');


        return redirect()->route('types.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Type $type)
    {
        $type->delete();

        toast('Your Type as been deleted!', 'success');

        return redirect()->route('types.index');
    }
}
