<?php

namespace App\Http\Requests;

use Illuminate\Support\Facades\Auth;
use Illuminate\Foundation\Http\FormRequest;

class ItemRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'name' => 'required|string|max:255',
            'type_id' => 'required|exists:types,id',
            'brand_id' => 'required|exists:brands,id',
            'photos' => 'nullable|array',
            'photos.*' => 'nullable|image|mimes:png,jpg,jpeg,webp|max:2048',
            'features' => 'nullable|string',
            'price' => 'required|numeric',
            'vehicle' => 'required|in:car,motorcycle', 
        ];
    }
}
