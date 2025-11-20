<div class="table-container bg-gray-800 rounded-2xl shadow-xl overflow-hidden">
    <div class="table-header">
        <h3 class="chart-title">Đơn Hàng Gần Đây</h3>
        <a href="{{ route('admin.orders.index') }}" class="btn-primary">
            <i class="fas fa-plus"></i> Xem tất cả
        </a>
    </div>

    <div class="overflow-x-auto">
        <table class="admin-table">
            <thead>
                <tr>
                    <th>Mã Đơn</th>
                    <th>Sản Phẩm</th>
                    <th>Khách Hàng</th>
                    <th>Ngày Đặt</th>
                    <th>Giá Trị</th>
                    <th>Trạng Thái</th>
                    <th>Thao Tác</th>
                </tr>
            </thead>
            <tbody>
                @forelse($recentOrders ?? [] as $order)
                <tr>
                    <td>#{{ $order->code ?? 'DH-00847' }}</td>
                    <td>
                        <div class="flex items-center gap-3">
                            <div class="w-12 h-12 bg-gray-700 rounded-lg flex items-center justify-center">
                                <i class="fas fa-clock text-yellow-500 text-xl"></i>
                            </div>
                            <span>{{ $order->product_name ?? 'Rolex Submariner' }}</span>
                        </div>
                    </td>
                    <td>{{ $order->customer_name ?? 'Nguyễn Văn A' }}</td>
                    <td>{{ $order->created_at?->format('d/m/Y') ?? '15/01/2024' }}</td>
                    <td class="font-bold text-yellow-500">{{ number_format($order->total ?? 285000000) }}₫</td>
                    <td>
                        <span class="status-badge {{ $order->status === 'completed' ? 'completed' : ($order->status === 'processing' ? 'processing' : 'pending') }}">
                            {{ $order->status === 'completed' ? 'Hoàn Thành' : ($order->status === 'processing' ? 'Đang Xử Lý' : 'Chờ Xác Nhận') }}
                        </span>
                    </td>
                    <td>
                        <div class="action-btns">
                            <a href="#" class="action-btn text-blue-400"><i class="fas fa-eye"></i></a>
                            <a href="#" class="action-btn text-green-400"><i class="fas fa-edit"></i></a>
                            <button wire:click="delete({{ $order->id }})" class="action-btn text-red-400"><i class="fas fa-trash"></i></button>
                        </div>
                    </td>
                </tr>
                @empty
                    <tr><td colspan="7" class="text-center py-8 text-gray-500">Chưa có đơn hàng nào</td></tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>
