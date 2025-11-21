{{-- resources/views/livewire/admin/order-show.blade.php --}}
<div class="max-w-6xl mx-auto py-8 px-4">
    <div class="bg-gray-800 rounded-2xl shadow-2xl overflow-hidden">
        <!-- Header đơn hàng -->
        <div class="bg-gradient-to-r from-yellow-600 to-yellow-500 px-8 py-6 flex justify-between items-center">
            <div>
                <h1 class="text-3xl font-bold text-black">Đơn hàng #{{ $order->code }}</h1>
                <p class="text-black/80">Ngày đặt: {{ $order->created_at->format('d/m/Y H:i') }}</p>
            </div>
            <div class="flex gap-4">
                <button wire:click="printInvoice" class="bg-black/30 hover:bg-black/50 text-white px-6 py-3 rounded-xl font-bold flex items-center gap-3">
                    <i class="fas fa-print"></i> In hóa đơn
                </button>
            </div>
        </div>

        <div class="p-8 grid grid-cols-1 lg:grid-cols-3 gap-8">
            <!-- Cột trái: Thông tin khách + trạng thái -->
            <div class="lg:col-span-2 space-y-8">
                <!-- Trạng thái đơn hàng -->
                <div class="bg-gray-700 rounded-xl p-6">
                    <h3 class="text-xl font-bold text-yellow-400 mb-4">Trạng thái đơn hàng</h3>
                    <div class="flex items-center gap-6">
                        <select wire:model.live="status" wire:change="updateStatus"
                                class="px-6 py-4 bg-gray-600 rounded-xl text-lg font-bold text-white">
                            <option value="pending">Chờ xác nhận</option>
                            <option value="confirmed">Đã xác nhận</option>
                            <option value="processing">Đang xử lý</option>
                            <option value="shipping">Đang giao hàng</option>
                            <option value="completed">Hoàn thành</option>
                            <option value="canceled">Đã hủy</option>
                            <option value="refunded">Hoàn tiền</option>
                        </select>
                        <span class="px-6 py-4 rounded-xl text-2xl font-bold {{ $order->status_color }}">
                            {{ __('order.status.' . $order->status) }}
                        </span>
                    </div>
                </div>

                <!-- Danh sách sản phẩm -->
                <div class="bg-gray-700 rounded-xl p-6">
                    <h3 class="text-xl font-bold text-yellow-400 mb-6">Sản phẩm trong đơn hàng</h3>
                    <div class="space-y-4">
                        @foreach($order->items as $item)
                        <div class="bg-gray-800 rounded-lg p-5 flex gap-6 items-center">
                            <img src="{{ $item->image ? asset('storage/'.$item->image) : 'https://via.placeholder.com/100' }}"
                                 class="w-24 h-24 object-cover rounded-lg shadow-lg">

                            <div class="flex-1">
                                <h4 class="text-lg font-bold text-white">{{ $item->product_name }}</h4>
                                @if($item->variation)
                                    <p class="text-sm text-gray-400">Phân loại: {{ $item->variation }}</p>
                                @endif
                                <div class="flex justify-between mt-2">
                                    <span class="text-yellow-400 font-bold">x{{ $item->quantity }}</span>
                                    <span class="text-xl font-bold text-green-400">
                                        {{ number_format($item->total) }}₫
                                    </span>
                                </div>
                            </div>
                        </div>
                        @endforeach
                    </div>
                </div>
            </div>

            <!-- Cột phải: Thông tin khách + thanh toán -->
            <div class="space-y-6">
                <!-- Thông tin khách hàng -->
                <div class="bg-gray-700 rounded-xl p-6">
                    <h3 class="text-xl font-bold text-yellow-400 mb-4 flex items-center gap-3">
                        <i class="fas fa-user"></i> Thông tin khách hàng
                    </h3>
                    <div class="space-y-3 text-white">
                        <p><strong>Họ tên:</strong> {{ $order->customer_name }}</p>
                        <p><strong>SĐT:</strong> {{ $order->customer_phone }}</p>
                        <p><strong>Email:</strong> {{ $order->customer_email ?? 'Không có' }}</p>
                        <p><strong>Địa chỉ:</strong><br>
                            {{ $order->customer_address }}<br>
                            {{ $order->ward }}, {{ $order->district }}, {{ $order->province }}
                        </p>
                        @if($order->note)
                            <p class="mt-4 p-4 bg-gray-800 rounded-lg"><strong>Ghi chú:</strong> {{ $order->note }}</p>
                        @endif
                    </div>
                </div>

                <!-- Tổng tiền -->
                <div class="bg-gray-700 rounded-xl p-6">
                    <h3 class="text-xl font-bold text-yellow-400 mb-4">Chi tiết thanh toán</h3>
                    <div class="space-y-3 text-lg">
                        <div class="flex justify-between">
                            <span>Tạm tính</span>
                            <span>{{ number_format($order->subtotal) }}₫</span>
                        </div>
                        <div class="flex justify-between">
                            <span>Phí vận chuyển</span>
                            <span class="text-green-400">{{ number_format($order->shipping_fee) }}₫</span>
                        </div>
                        <div class="flex justify-between text-yellow-400">
                            <span>Giảm giá</span>
                            <span>-{{ number_format($order->discount) }}₫</span>
                        </div>
                        <div class="border-t border-gray-600 pt-3 flex justify-between text-2xl font-bold">
                            <span class="text-yellow-400">Tổng cộng</span>
                            <span class="text-green-400">{{ number_format($order->total) }}₫</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- In hóa đơn PDF (mở tab mới) -->
<script>
    document.addEventListener('livewire:init', () => {
        Livewire.on('printInvoice', (orderId) => {
            window.open('/admin/orders/' + orderId + '/invoice', '_blank');
        });
    });
</script>
