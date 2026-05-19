<div id="product-table-container">
    <div class="table-responsive">
        <table class="w-full text-left border-collapse min-w-[1000px]">
            <thead>
                <tr
                    class="text-[10px] uppercase tracking-widest text-neutral-500 bg-neutral-50/50 dark:bg-white/[0.02] border-b border-black/5 dark:border-white/5">
                    <th class="px-8 py-5 font-bold"><a href="{{ sort_url('product_name') }}">Product Name</a></th>
                    <th class="px-8 py-5 font-bold">SKU</th>
                    <th class="px-8 py-5 font-bold"><a href="{{ sort_url('category_id') }}">Category</a></th>
                    <th class="px-8 py-5 font-bold"><a href="{{ sort_url('price') }}">Price</a></th>
                    <th class="px-8 py-5 font-bold"><a href="{{ sort_url('stock') }}">Stock</a></th>
                    <th class="px-8 py-5 font-bold"><a href="{{ sort_url('is_active') }}">Status</a></th>
                    <th class="px-8 py-5 font-bold"><a href="{{ sort_url('created_at') }}">Created Date</a></th>
                    <th class="px-8 py-5 font-bold text-right">Actions</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-black/5 dark:divide-white/5 text-xs sm:text-sm">
                @forelse($products as $prod)
                    <tr class="hover:bg-primary-50 dark:hover:bg-white/[0.02] transition-colors group">
                        <td class="px-8 py-5">
                            <div class="flex items-center space-x-4">
                                <div
                                    class="w-10 h-10 rounded-xl glass p-0.5 border-primary-500/10 group-hover:scale-110 transition-transform">
                                    <img src="https://ui-avatars.com/api/?name={{ urlencode($prod->product_name) }}&background=eff6ff&color=3c50e0"
                                        class="w-full h-full rounded-[8px]" alt="Product">
                                </div>
                                <div>
                                    <p
                                        class="font-bold text-neutral-800 dark:text-white group-hover:text-primary-500 transition-colors">
                                        {{ $prod->product_name }}
                                    </p>
                                    <p class="text-[10px] text-neutral-400 font-medium">Edition: {{ $prod->sku }}</p>
                                </div>
                            </div>
                        </td>
                        <td class="px-8 py-5 font-mono text-neutral-500 dark:text-neutral-400">{{ $prod->sku }}</td>
                        <td class="px-8 py-5">
                            <span
                                class="px-2.5 py-1 rounded-lg bg-blue-50 dark:bg-blue-500/10 text-blue-600 dark:text-blue-400 text-[10px] font-bold uppercase">
                                {{ $prod->category->name ?? 'N/A' }}
                            </span>
                        </td>
                        <td class="px-8 py-5 text-neutral-800 dark:text-white font-bold">{{ $prod->price }}</td>
                        <td class="px-8 py-5">
                            <div class="flex flex-col">
                                <span class="font-bold text-neutral-800 dark:text-white">{{ $prod->stock }}</span>
                                <div
                                    class="w-16 h-1 bg-neutral-100 dark:bg-neutral-800 rounded-full mt-1.5 overflow-hidden">
                                    <div class="h-full bg-emerald-500 shadow-[0_0_8px_rgba(16,185,129,0.3)]"
                                        style="width: {{ min($prod->stock, 100) }}%">
                                    </div>
                                </div>
                            </div>
                        </td>
                        <td class="px-8 py-5">
                            <span
                                class="px-3 py-1 rounded-full text-[10px] font-bold uppercase tracking-wider {{ $prod->is_active ? 'bg-emerald-50 dark:bg-emerald-500/10 text-emerald-600 dark:text-emerald-400 border border-emerald-100 dark:border-emerald-500/20' : 'bg-rose-50 dark:bg-rose-500/10 text-rose-600 dark:text-rose-400 border border-rose-100 dark:border-rose-500/20' }}">
                                {{ $prod->is_active ? 'Active' : 'Inactive' }}
                            </span>
                        </td>
                        <td class="px-8 py-5 text-neutral-400 dark:text-neutral-500">
                            {{ $prod->created_at->format('d M, Y') }}
                        </td>
                        <td class="px-8 py-5 text-right">
                            <div
                                class="flex items-center justify-end space-x-2 opacity-0 group-hover:opacity-100 transition-opacity">
                                <button title="View"
                                    class="p-2 text-neutral-400 hover:text-primary-500 hover:bg-primary-50 dark:hover:bg-primary-500/10 rounded-lg transition-all">
                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" />
                                    </svg>
                                </button>
                                <a href="{{ route('products.edit', $prod->id) }}">
                                    <button title="Edit"
                                        class="p-2 text-neutral-400 hover:text-amber-500 hover:bg-amber-50 dark:hover:bg-amber-500/10 rounded-lg transition-all">
                                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z" />
                                        </svg>
                                    </button>
                                </a>
                                <form action="{{ route('products.destroy', $prod->id) }}" method="POST" class="inline"
                                    onsubmit="return confirm('Are you sure?')">
                                    @csrf
                                    @method('DELETE')
                                    <button title="Delete"
                                        class="p-2 text-neutral-400 hover:text-rose-500 hover:bg-rose-50 dark:hover:bg-rose-500/10 rounded-lg transition-all">
                                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" />
                                        </svg>
                                    </button>
                                </form>
                            </div>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="8" class="px-8 py-10 text-center text-neutral-500 italic">No products found.</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    {{-- Pagination --}}
    <div class="px-8 py-6 border-t border-black/5 dark:border-white/5">
        {{ $products->links() }}
    </div>
</div>