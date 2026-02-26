@extends('layouts.admin')

@section('title', 'Add Product')

@section('content')

    <div class="relative min-h-[80vh]">
        <!-- Page Header & Breadcrumb -->
        <div class="mb-8">
            <h1 class="text-3xl font-bold text-neutral-800 dark:text-white tracking-tight">Add New Product</h1>
            <p class="text-neutral-500 mt-1 text-sm">Create a new entry in your product catalog.</p>

            <nav
                class="flex text-neutral-400 text-[10px] sm:text-xs font-bold uppercase tracking-widest space-x-2 items-center mt-4">
                <a href="{{ route('admin.dashboard') }}" class="hover:text-primary-500 transition-colors">Dashboard</a>
                <svg class="w-3 h-3 text-neutral-300" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7" />
                </svg>
                <span class="text-neutral-400">Products</span>
                <svg class="w-3 h-3 text-neutral-300" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7" />
                </svg>
                <span class="text-neutral-800 dark:text-white font-bold">Add Product</span>
            </nav>
        </div>

        <!-- Product Form Card -->
        <div class="glass p-8 rounded-3xl relative overflow-hidden z-10 shadow-2xl border-white/20 dark:border-white/5">
            <!-- Subtle Glowing Accent -->
            <div
                class="absolute -top-24 -right-24 w-64 h-64 bg-primary-500/10 rounded-full blur-[80px] pointer-events-none">
            </div>
            <div class="absolute -bottom-24 -left-24 w-64 h-64 bg-blue-500/10 rounded-full blur-[80px] pointer-events-none">
            </div>

            <form action="{{ isset($product) ? route('products.update', $product->id) : route('products.store')}}"
                method="POST" enctype="multipart/form-data" class="space-y-8">
                @csrf
                @if(isset($product))
                    @method('PUT')
                @endif
                <input type="hidden" name="is_active" value="0">
                <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
                    <!-- Product Name (Full Width in its row) -->
                    <div class="md:col-span-2 space-y-2">
                        <label for="name"
                            class="text-xs font-bold text-neutral-500 dark:text-neutral-400 uppercase tracking-widest flex items-center">
                            Product Name
                            <span class="ml-1 text-rose-500">*</span>
                        </label>
                        <input type="text" id="name" name="product_name"
                            value="{{ old('product_name', $product->product_name ?? '') }}"
                            placeholder="e.g. Octahedron Gaming Mouse"
                            class="w-full bg-black/5 dark:bg-white/5 border border-transparent focus:border-primary-500/50 rounded-2xl py-3 px-5 text-sm outline-none transition-all focus:ring-4 focus:ring-primary-500/10 dark:text-white placeholder:text-neutral-400">
                        <p class="text-[10px] text-neutral-400 font-medium">Use a descriptive name for better SEO and
                            searchability.</p>
                    </div>

                    <!-- Description (Full Width) -->
                    <div class="md:col-span-2 space-y-2">
                        <label for="description"
                            class="text-xs font-bold text-neutral-500 dark:text-neutral-400 uppercase tracking-widest flex items-center">
                            Description
                        </label>
                        <textarea id="description" name="description" rows="5"
                            placeholder="Describe the product features, materials, and benefits..."
                            class="w-full bg-black/5 dark:bg-white/5 border border-transparent focus:border-primary-500/50 rounded-2xl py-3 px-5 text-sm outline-none transition-all focus:ring-4 focus:ring-primary-500/10 dark:text-white placeholder:text-neutral-400">{{ old('description', $product->description ?? '') }}</textarea>
                    </div>

                    <!-- Price -->
                    <div class="space-y-2">
                        <label for="price"
                            class="text-xs font-bold text-neutral-500 dark:text-neutral-400 uppercase tracking-widest">
                            Price
                            <span class="ml-1 text-rose-500">*</span>
                        </label>
                        <div class="relative group">
                            <span
                                class="absolute left-4 top-1/2 -translate-y-1/2 text-neutral-400 font-bold text-sm">₹</span>
                            <input type="number" id="price" name="price" step="0.01"
                                value="{{ old('price', $product->price ?? '') }}" placeholder="0.00"
                                class="w-full bg-black/5 dark:bg-white/5 border border-transparent focus:border-primary-500/50 rounded-2xl py-3 pl-10 pr-5 text-sm outline-none transition-all focus:ring-4 focus:ring-primary-500/10 dark:text-white placeholder:text-neutral-400">
                        </div>
                    </div>

                    <!-- Stock -->
                    <div class="space-y-2">
                        <label for="stock"
                            class="text-xs font-bold text-neutral-500 dark:text-neutral-400 uppercase tracking-widest">
                            Stock Quantity
                            <span class="ml-1 text-rose-500">*</span>
                        </label>
                        <input type="number" id="stock" name="stock" value="{{ old('stock', $product->stock ?? '') }}"
                            placeholder="e.g. 50"
                            class="w-full bg-black/5 dark:bg-white/5 border border-transparent focus:border-primary-500/50 rounded-2xl py-3 px-5 text-sm outline-none transition-all focus:ring-4 focus:ring-primary-500/10 dark:text-white placeholder:text-neutral-400">
                    </div>

                    <!-- Category -->
                    <div class="space-y-2">
                        <label for="category"
                            class="text-xs font-bold text-neutral-500 dark:text-neutral-400 uppercase tracking-widest">
                            Category
                        </label>
                        <div class="relative">
                            <select id="category" name="category_id"
                                class="w-full appearance-none bg-black/5 dark:bg-white/5 border border-transparent focus:border-primary-500/50 rounded-2xl py-3 px-5 text-sm outline-none transition-all focus:ring-4 focus:ring-primary-500/10 dark:text-white">
                                <option value="" disabled selected class="dark:bg-neutral-900">Select Category</option>
                                @foreach($categories as $cat)
                                    <option value="{{$cat->id}}" {{ old('category_id', $product->category_id ?? '') == $cat->id ? 'selected' : '' }} class="dark:bg-neutral-900">{{$cat->name}}</option>
                                @endforeach
                            </select>
                            <div class="absolute right-4 top-1/2 -translate-y-1/2 pointer-events-none text-neutral-400">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M19 9l-7 7-7-7" />
                                </svg>
                            </div>
                        </div>
                    </div>

                    <!-- SKU -->
                    <div class="space-y-2">
                        <label for="sku"
                            class="text-xs font-bold text-neutral-500 dark:text-neutral-400 uppercase tracking-widest">
                            SKU
                        </label>
                        <input type="text" id="sku" name="sku" value="{{ old('sku', $product->sku ?? '') }}"
                            placeholder="e.g. OMS-MOUSE-01"
                            class="w-full bg-black/5 dark:bg-white/5 border border-transparent focus:border-primary-500/50 rounded-2xl py-3 px-5 text-sm outline-none transition-all focus:ring-4 focus:ring-primary-500/10 dark:text-white placeholder:text-neutral-400">
                    </div>

                    <!-- Weight -->
                    <div class="space-y-2">
                        <label for="weight"
                            class="text-xs font-bold text-neutral-500 dark:text-neutral-400 uppercase tracking-widest">
                            Weight
                        </label>
                        <div class="relative">
                            <input type="text" id="weight" name="weight" value="{{ old('weight', $product->weight ?? '') }}"
                                placeholder="e.g. 0.5"
                                class="w-full bg-black/5 dark:bg-white/5 border border-transparent focus:border-primary-500/50 rounded-2xl py-3 px-5 text-sm outline-none transition-all focus:ring-4 focus:ring-primary-500/10 dark:text-white placeholder:text-neutral-400">
                            <span
                                class="absolute right-5 top-1/2 -translate-y-1/2 text-neutral-400 text-xs font-bold">kg</span>
                        </div>
                    </div>

                    <!-- Dimension -->
                    <div class="space-y-2">
                        <label for="dimension"
                            class="text-xs font-bold text-neutral-500 dark:text-neutral-400 uppercase tracking-widest">
                            Dimension
                        </label>
                        <input type="text" id="dimension" name="dimension"
                            value="{{ old('dimension', $product->dimension ?? '') }}" placeholder="e.g. 10 x 5 x 2"
                            class="w-full bg-black/5 dark:bg-white/5 border border-transparent focus:border-primary-500/50 rounded-2xl py-3 px-5 text-sm outline-none transition-all focus:ring-4 focus:ring-primary-500/10 dark:text-white placeholder:text-neutral-400">
                        <p class="text-[10px] text-neutral-400 font-medium">Format: L x W x H in cm</p>
                    </div>

                    <!-- Product Images -->
                    <div class="md:col-span-2 space-y-4">
                        <label
                            class="text-xs font-bold text-neutral-500 dark:text-neutral-400 uppercase tracking-widest flex items-center">
                            Product Images
                        </label>

                        <!-- Existing Images Grid -->
                        @if(isset($product) && $product->images->count() > 0)
                            <div class="grid grid-cols-2 sm:grid-cols-3 md:grid-cols-4 lg:grid-cols-6 gap-4 mb-4">
                                @foreach($product->images as $image)
                                    <div class="relative group aspect-square rounded-2xl overflow-hidden border border-black/5 dark:border-white/5 bg-black/5 dark:bg-white/5"
                                        id="image-container-{{ $image->id }}">
                                        <img src="{{ asset('storage/' . $image->image_path) }}" alt="Product Image"
                                            class="w-full h-full object-cover">
                                        <button type="button" onclick="deleteImage({{ $image->id }})"
                                            class="absolute top-2 right-2 p-1.5 bg-rose-500 text-white rounded-lg opacity-0 group-hover:opacity-100 transition-opacity hover:bg-rose-600 shadow-lg">
                                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                    d="M6 18L18 6M6 6l12 12" />
                                            </svg>
                                        </button>
                                    </div>
                                @endforeach
                            </div>
                        @endif

                        <!-- Upload New Images -->
                        <div class="relative group">
                            <input type="file" name="images[]" id="images" multiple
                                class="absolute inset-0 w-full h-full opacity-0 cursor-pointer z-10"
                                onchange="updateFileCount(this)">
                            <div
                                class="w-full bg-black/5 dark:bg-white/5 border-2 border-dashed border-neutral-300 dark:border-neutral-700 rounded-2xl py-8 px-5 flex flex-col items-center justify-center transition-all group-hover:border-primary-500/50 group-hover:bg-primary-500/[0.02]">
                                <div
                                    class="w-12 h-12 bg-primary-500/10 text-primary-500 rounded-full flex items-center justify-center mb-3">
                                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z" />
                                    </svg>
                                </div>
                                <span class="text-sm font-bold text-neutral-800 dark:text-white" id="file-count-text">Click
                                    or drag images to upload</span>
                                <p class="text-[10px] text-neutral-400 font-medium mt-1">Upload up to 5 images. PNG, JPG or
                                    WEBP (Max 2MB each).</p>
                            </div>
                        </div>
                    </div>

                    <!-- Status Select / Toggle -->
                    <div
                        class="md:col-span-2 flex items-center justify-between p-4 bg-black/2.5 dark:bg-white/[0.02] rounded-2xl border border-black/5 dark:border-white/5 mt-4">
                        <div>
                            <h4 class="text-sm font-bold text-neutral-800 dark:text-white">Product Visibility</h4>
                            <p class="text-xs text-neutral-500 mt-0.5">Define if this product is publicly accessible or
                                hidden.</p>
                        </div>

                        <label class="relative inline-flex items-center cursor-pointer group">
                            <input type="checkbox" name="is_active" value="1" class="sr-only peer" {{ old('is_active', $product->is_active ?? 1) ? 'checked' : '' }}>
                            <div
                                class="w-12 h-6 bg-neutral-200 dark:bg-neutral-800 rounded-full peer peer-checked:after:translate-x-full after:content-[''] after:absolute after:top-0.5 after:left-[2px] after:bg-white after:rounded-full after:h-5 after:w-5 after:transition-all after:shadow-md peer-checked:bg-primary-500 group-hover:scale-105 transition-transform">
                            </div>
                            <span
                                class="ml-3 text-xs font-bold text-neutral-500 dark:text-neutral-400 uppercase tracking-widest">Active</span>
                        </label>
                    </div>
                </div>

                <!-- Form Actions -->
                <div
                    class="flex flex-col sm:flex-row items-center justify-between gap-4 pt-8 border-t border-black/5 dark:border-white/5">
                    <button type="button"
                        class="order-2 sm:order-1 w-full sm:w-auto px-8 py-3 rounded-2xl text-sm font-semibold text-neutral-600 dark:text-neutral-400 hover:bg-black/5 dark:hover:bg-white/5 transition-all text-center">
                        Cancel
                    </button>

                    <div class="order-1 sm:order-2 w-full sm:w-auto">
                        <!-- Backend Note: Add 'loading' class or state here during submission -->
                        <button type="submit"
                            class="relative w-full sm:w-auto bg-primary-500 text-white px-10 py-3.5 rounded-2xl text-sm font-bold hover:bg-primary-600 hover:scale-[1.02] active:scale-[0.98] transition-all shadow-xl shadow-primary-500/25 group overflow-hidden">
                            <span class="relative z-10">{{ isset($product) ? 'Update Product' : 'Save Product' }}</span>
                            <div
                                class="absolute inset-0 bg-gradient-to-r from-transparent via-white/10 to-transparent -translate-x-full group-hover:animate-shimmer">
                            </div>
                        </button>
                    </div>
                </div>
            </form>
        </div>

        <!-- Additional Floating Decorative Elements (Behind Content) -->
        <div class="fixed inset-0 pointer-events-none -z-5 overflow-hidden">
            <div class="absolute top-[30%] -right-12 w-48 h-48 opacity-20 dark:opacity-30 animate-float">
                <div class="w-full h-full bg-gradient-to-br from-primary-500 to-blue-600 rounded-[2rem] rotate-45 blur-xl">
                </div>
            </div>
            <div class="absolute bottom-[20%] -left-12 w-64 h-64 opacity-20 dark:opacity-30 animate-float-delayed">
                <div class="w-full h-full bg-gradient-to-tr from-violet-500 to-rose-600 rounded-full blur-3xl"></div>
            </div>
        </div>
    </div>

    <style>
        @keyframes shimmer {
            100% {
                transform: translateX(100%);
            }
        }

        .animate-shimmer {
            animation: shimmer 2s infinite;
        }
    </style>

    <script>
        function updateFileCount(input) {
            const textElement = document.getElementById('file-count-text');
            const files = input.files;
            if (files.length > 0) {
                textElement.innerText = `${files.length} image(s) selected`;
            } else {
                textElement.innerText = 'Click or drag images to upload';
            }
        }

        function deleteImage(imageId) {
            if (confirm('Are you sure you want to delete this image?')) {
                fetch(`/admin/product-images/${imageId}`, {
                    method: 'DELETE',
                    headers: {
                        'X-CSRF-TOKEN': '{{ csrf_token() }}',
                        'Accept': 'application/json'
                    }
                })
                    .then(response => response.json())
                    .then(data => {
                        if (data.success) {
                            const container = document.getElementById(`image-container-${imageId}`);
                            container.style.opacity = '0';
                            setTimeout(() => container.remove(), 300);
                        }
                    })
                    .catch(error => {
                        console.error('Error:', error);
                        alert('Failed to delete image');
                    });
            }
        }
    </script>
@endsection