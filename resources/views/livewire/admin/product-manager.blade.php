<!-- resources/views/livewire/admin/product-manager.blade.php -->
<div class="bg-gray-800 rounded-2xl shadow-xl overflow-hidden">
    <div class="p-6 border-b border-gray-700 flex justify-between items-center">
        <h2 class="text-2xl font-bold text-yellow-500">Quản lý Sản phẩm</h2>
        <input type="text" wire:model.live.debounce.500ms="search"
       wire:keydown.enter="$refresh"
       class="search-input" placeholder="Tìm sản phẩm...">
        <button wire:click="create" class="btn-primary">
            <i class="fas fa-plus"></i> Thêm sản phẩm
        </button>
    </div>

    <div class="p-6">
        <table class="admin-table">
            <thead>
                <tr>
                    <th>Ảnh</th>
                    <th>Tên sản phẩm</th>
                    <th>Danh mục</th>
                    <th>Giá</th>
                    <th>Tồn kho</th>
                    <th>Biến thể</th>
                    <th>Hành động</th>
                </tr>
            </thead>
            <tbody>
                @foreach($products as $p)
                <tr>
                    <td>
                        {{-- <img src="{{ count($p->images) ? asset('storage/'.$p->images[0]) : 'https://via.placeholder.com/60' }}"
                             class="w-14 h-14 object-cover rounded-lg"> --}}
                    </td>
                    <td class="font-medium">{{ $p->name }}</td>
                    <td>{{ $p->category->name }}</td>
                    <td class="text-yellow-500 font-bold">{{ number_format($p->lowest_price) }}₫</td>
                    <td>{{ $p->total_stock }}</td>
                    <td>
                        @if($p->has_variations)
                            <span class="px-3 py-1 bg-purple-600 text-xs rounded-full">{{ $p->variations_count }} biến thể</span>
                        @else
                            <span class="text-gray-500">Không</span>
                        @endif
                    </td>
                    <td class="action-btns">
                        <button wire:click="edit({{ $p->id }})" class="text-blue-400"><i class="fas fa-edit"></i></button>
                        <button wire:click="$set('editId', {{ $p->id }})" wire:confirm="Xóa sản phẩm này?" class="text-red-400"><i class="fas fa-trash"></i></button>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
        {{-- <div class="mt-4">{{ $products->links() }}</div> --}}
    </div>
</div>
