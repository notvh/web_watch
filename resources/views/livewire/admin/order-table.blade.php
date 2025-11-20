<div class="bg-gray-800 rounded-2xl shadow-xl overflow-hidden">
    <div class="p-6 border-b border-gray-700 flex justify-between items-center">
        <h2 class="text-2xl font-bold text-yellow-500">Đơn hàng</h2>
        <input type="text" wire:model.live.debounce.500ms="search" placeholder="Tìm mã đơn..." class="search-input">
    </div>

    <div class="p-6 bg-gray-900 flex gap-3">
        <button wire:click="$set('status', '')" class="filter-btn {{ $status=='' ? 'active' : '' }}">Tất cả</button>
        <button wire:click="$set('status', 'pending')" class="filter-btn {{ $status=='pending' ? 'active' : '' }}">Chờ xác nhận</button>
        <button wire:click="$set('status', 'processing')" class="filter-btn {{ $status=='processing' ? 'active' : '' }}">Đang xử lý</button>
        <button wire:click="$set('status', 'completed')" class="filter-btn {{ $status=='completed' ? 'active' : '' }}">Hoàn thành</button>
    </div>

    <table class="admin-table">
        <thead><tr><th>Mã đơn</th><th>Khách hàng</th><th>Tổng tiền</th><th>Ngày đặt</th><th>Trạng thái</th><th>Hành động</th></tr></thead>
        <tbody>
            @forelse($orders as $o)
            <tr>
                <td>#{{ $o->code }}</td>
                <td>{{ $o->user->name }}</td>
                <td class="text-yellow-500 font-bold">{{ number_format($o->total) }}₫</td>
                <td>{{ $o->created_at->format('d/m/Y H:i') }}</td>
                <td><span class="status-badge {{ $o->status }}">{{ ucfirst($o->status) }}</span></td>
                <td>
                    <a href="{{ route('admin.orders.show', $o) }}" class="text-blue-400"><i class="fas fa-eye"></i></a>
                </td>
            </tr>
            @empty
            <tr><td colspan="6" class="text-center py-12 text-gray-500">Không có đơn hàng</td></tr>
            @endforelse
        </tbody>
    </table>
</div>
