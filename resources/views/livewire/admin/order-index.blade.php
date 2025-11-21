<!-- resources/views/livewire/admin/order-index.blade.php -->
<div class="bg-gray-800 rounded-2xl shadow-xl overflow-hidden">
    <div class="p-6 border-b border-gray-700 flex flex-wrap gap-4 items-center justify-between">
        <h2 class="text-2xl font-bold text-yellow-500">Quản lý đơn hàng ({{ $orders->total() }})</h2>

        <div class="flex gap-4 flex-wrap">
            <input type="text" wire:model.live.debounce.500ms="search" placeholder="Tìm mã đơn, khách hàng..." class="search-input">
            <select wire:model.live="status" class="search-input">
                <option value="">Tất cả trạng thái</option>
                <option value="pending">Chờ xác nhận</option>
                <option value="confirmed">Đã xác nhận</option>
                <option value="processing">Đang xử lý</option>
                <option value="shipping">Đang giao</option>
                <option value="completed">Hoàn thành</option>
                <option value="canceled">Đã hủy</option>
            </select>
        </div>
    </div>

    <div class="overflow-x-auto">
        <table class="admin-table">
            <thead>
                <tr>
                    <th>Mã đơn</th>
                    <th>Khách hàng</th>
                    <th>Số lượng</th>
                    <th>Tổng tiền</th>
                    <th>Trạng thái</th>
                    <th>Ngày đặt</th>
                    <th>Hành động</th>
                </tr>
            </thead>
            <tbody>
                @forelse($orders as $order)
                <tr class="hover:bg-gray-700 transition">
                    <td class="font-bold text-yellow-400">{{ $order->code }}</td>
                    <td>
                        <div>{{ $order->customer_name }}</div>
                        <div class="text-sm text-gray-400">{{ $order->customer_phone }}</div>
                    </td>
                    <td>{{ $order->items->sum('quantity') }} sản phẩm</td>
                    <td class="text-xl font-bold text-green-400">
                        {{ number_format($order->total) }}₫
                    </td>
                    <td>
                        <select wire:change="updateStatus({{ $order->id }}, $event.target.value)"
                                class="px-3 py-1 rounded-lg text-sm font-bold {{ $order->status_color }}">
                            @foreach(['pending','confirmed','processing','shipping','completed','canceled','refunded'] as $stt)
                                <option value="{{ $stt }}" {{ $order->status == $stt ? 'selected' : '' }}>
                                    {{ __('order.status.' . $stt) }}
                                </option>
                            @endforeach
                        </select>
                    </td>
                    <td>{{ $order->created_at->format('d/m/Y H:i') }}</td>
                    <td class="action-btns">
                        <a href="{{ route('admin.orders.show', $order) }}" class="text-blue-400">
                            <i class="fas fa-eye"></i>
                        </a>
                        <button wire:click="printInvoice({{ $order->id }})" class="text-purple-400">
                            <i class="fas fa-print"></i>
                        </button>
                    </td>
                </tr>
                @empty
                <tr><td colspan="7" class="text-center py-12 text-gray-500">Chưa có đơn hàng nào</td></tr>
                @endforelse
            </tbody>
        </table>
    </div>

    <div class="p-6 border-t border-gray-700">
        {{ $orders->links('pagination::bootstrap-5') }}
    </div>
</div>

<!-- Toast + Print Invoice bằng Alpine -->
@push('scripts')
<script>
    document.addEventListener('livewire:init', () => {
        Livewire.on('printInvoice', (orderId) => {
            window.open('/admin/orders/' + orderId + '/invoice', '_blank');
        });
    });
</script>
@endpush
