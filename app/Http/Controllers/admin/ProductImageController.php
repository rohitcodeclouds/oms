<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\ProductImage;
use Illuminate\Support\Facades\Storage;

class ProductImageController extends Controller
{
    public function destroy(ProductImage $product_image)
    {
        Storage::disk('public')->delete($product_image->image_path);
        $product_image->delete();

        return response()->json(['success' => true]);
    }
}
