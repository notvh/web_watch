<div class="bg-gray-800 rounded-2xl shadow-xl overflow-hidden">
    <div class="p-6 border-b border-gray-700 flex justify-end items-center">
        <h2 class="text-2xl font-bold text-yellow-500">Sản phẩm</h2>

    </div>

    <!-- Bộ lọc nhanh -->
    <div class="p-6 bg-gray-900 flex flex-wrap gap-4">
        <input type="text" wire:model.live.debounce.500ms="search"
            placeholder="Tìm tên, SKU..."
            class="search-bar w-full max-w-md px-4 py-2.5 bg-gray-700 rounded-lg text-white placeholder-gray-400 focus:outline-none focus:ring-2 focus:ring-yellow-500">
        <select wire:model.live="category_id" class="search-input">
            <option value="">Tất cả danh mục</option>
            @foreach($categories as $cat)
                <option value="{{ $cat->id }}">{{ $cat->name }}</option>
            @endforeach
        </select>
        {{-- <select wire:model.live="stock_status" class="search-input">
            <option value="">Tất cả tồn kho</option>
            <option value="low">Sắp hết (&lt;10)</option>
            <option value="out">Hết hàng</option>
        </select> --}}
        <a href="{{ route('admin.products.create') }}" class="btn-primary float-end">
            <i class="fas fa-plus"></i> Thêm sản phẩm mới
        </a>
    </div>

    <!-- Bảng -->
    <div class="overflow-x-auto">
        <table class="admin-table">
            <thead>
                <tr>
                    <th>Hình ảnh</th>
                    <th>Sản phẩm</th>
                    <th>Danh mục</th>
                    <th>Giá</th>
                    <th>Tồn kho</th>
                    <th>Trạng thái</th>
                    <th>Hành động</th>
                </tr>
            </thead>
            <tbody>
                @forelse($products as $p)
                <tr class="hover:bg-gray-700 transition">
                    <td>
                        <img src="{{ $p->images[0] ? asset('storage/'.$p->images[0]) : 'https://via.placeholder.com/60' }}"
                            loading="lazy"
                            width="150px"
                             class="w-14 h-14 object-cover rounded-lg">
                    </td>
                    <td class="font-medium">{{ $p->name }}</td>
                    <td>{{ $p->category?->name ?? '—' }}</td>
                    <td class="text-yellow-500 font-bold">
                        {{ number_format($p->has_variations ? $p->lowest_price : $p->price) }}₫
                    </td>
                    <td>
                        <span class="status-badge {{ $p->total_stock > 10 ? 'completed' : ($p->total_stock > 0 ? 'processing' : 'pending') }}">
                            {{ $p->total_stock }}
                        </span>
                    </td>
                    <td>
                        <button wire:click="toggleStatus({{ $p->id }})"
                                class="px-3 py-1 rounded text-xs {{ $p->is_active ? 'bg-green-600' : 'bg-gray-600' }} text-white">
                            {{ $p->is_active ? 'Hiển thị' : 'Ẩn' }}
                        </button>
                    </td>
                    <td>
                        <div class="action-btns">
                            <a href="{{ route('admin.products.edit', $p) }}" class="text-blue-400"><i class="fas fa-edit"></i></a>
                            <button wire:click="delete({{ $p->id }})" wire:confirm="Xóa sản phẩm {{ $p->name }} này?" class="text-red-400">
                                <i class="fas fa-trash"></i>
                            </button>
                        </div>
                    </td>
                </tr>
                @empty
                <tr><td colspan="7" class="text-center py-12 text-gray-500">Chưa có sản phẩm</td></tr>
                @endforelse
            </tbody>
        </table>
    </div>

    <div class="p-4 border-t border-gray-700">
        {{ $products->links('pagination::semantic-ui') }}
    </div>
</div>
