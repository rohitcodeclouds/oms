<?php

namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class StoreProductRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        // return false;
        $user = auth()->user();
        $allowedRoles = ['admin'];
        return $user && in_array($user->role, $allowedRoles);
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'product_name' => 'required|string|max:255',
            'description' => 'nullable|string',
            'price' => 'required|numeric|min:0',
            'stock' => 'required|numeric|min:0',
            'category_id' => 'exists:categories,id',
            'sku' => ['nullable', 'string', Rule::unique('products', 'sku')->whereNull('deleted_at')->ignore($this->product)],
            'weight' => 'nullable|numeric|min:0',
            'dimension' => 'nullable|string',
            'is_active' => 'sometimes|boolean',
            'images' => 'nullable|array',
            'images.*' => 'image|mimes:jpeg,png,jpg,gif,webp|max:2048'
        ];
    }

    public function messages()
    {
        return [
            'product_name.required' => 'Product name is required',
            'price.required' => 'Price is required',
            'stock.required' => 'Stock is required',
            'category_id.required' => 'Category is required',
            'category_id.exists' => 'Selected category does not exist',
            'sku.unique' => 'SKU must be unique',
            'weight.numeric' => 'Weight must be a number',
            'dimension.string' => 'Dimension must be text',
            'is_active.boolean' => 'Status must be true or false',
        ];
    }
}
