<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Requests\Admin\StoreProductRequest;
use App\Models\Product;
use App\Models\Category;
// dd(auth()->user());
class ProductController extends Controller
{
    public function index(Request $request)
    {
        $query = Product::with('category');
        //Search
        $query->when($request->search, function ($q) use ($request) {
            $q->where(function ($sub) use ($request) {
                $sub->where('product_name', 'like', '%' . $request->search . '%')
                    ->orWhere('sku', 'like', '%' . $request->search . '%');
            });
        });

        // Category Filter
        $query->when($request->category, function ($q, $category) {
            $q->where('category_id', $category);
        });

        // Status filter
        $query->when($request->status, function ($q, $status) {
            $q->where('is_active', $status === 'active');
        });

        // sorting
        $sortable = ['product_name', 'sku', 'category', 'price', 'stock', 'created_at'];
        $sort = in_array($request->sort, $sortable) ? $request->sort : 'created_at';
        $direction = $request->direction === 'asc' ? 'asc' : 'desc';
        $query->orderBy($sort, $direction);

        // Page size
        $perPage = in_array($request->per_page, [5, 10, 25, 50, 100]) ? $request->per_page : 5;


        $products = $query->latest()->paginate($perPage)->withQueryString();
        // dd($product->toArray());
        $active_product_count = Product::where('is_active', 1)->count();
        $product_outofstock = Product::where('stock', 0)->count();
        return view('admin.products.index', compact('products', 'active_product_count', 'product_outofstock'));
    }

    public function create()
    {
        $categories = Category::where('is_active', 1)->get();
        return view('admin.products.create', compact('categories'));
    }

    public function store(StoreProductRequest $request)
    {
        $product = Product::create($request->validated());

        if ($request->hasFile('images')) {
            foreach ($request->file('images') as $image) {
                $path = $image->store('products', 'public');
                $product->images()->create(['image_path' => $path]);
            }
        }

        return redirect()->route('products.index')->with('success', 'Product created successfully');
    }

    public function edit(Product $product)
    {
        $product->load('images');
        $categories = Category::where('is_active', 1)->get();
        return view('admin.products.create', compact('product', 'categories'));
    }

    public function update(StoreProductRequest $request, Product $product)
    {
        $product->update($request->validated());

        if ($request->hasFile('images')) {
            foreach ($request->file('images') as $image) {
                $path = $image->store('products', 'public');
                $product->images()->create(['image_path' => $path]);
            }
        }

        return redirect()->route('products.index')->with('success', 'Product updated successfully');
    }

    public function destroy(Product $product)
    {
        foreach ($product->images as $image) {
            \Storage::disk('public')->delete($image->image_path);
            $image->delete();
        }
        $product->delete();
        return redirect()->route('products.index')->with('success', 'Product deleted successfully');
    }

}
