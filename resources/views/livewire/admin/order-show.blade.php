{{-- resources/views/livewire/admin/order-show.blade.php --}}
<div class="max-w-6xl mx-auto py-8 px-4">

    {{-- ==================== GIAO DIỆN ADMIN BÌNH THƯỜNG (hiển thị trên màn hình) ==================== --}}
    <div class="bg-gray-800 rounded-2xl shadow-2xl overflow-hidden">
        <!-- Header + Nút In -->
        <div class="bg-gradient-to-r from-yellow-600 to-yellow-500 px-8 py-6 flex justify-between items-center">
            <div>
                <h1 class="text-3xl font-bold text-black">Đơn hàng #{{ $order->code }}</h1>
                <p class="text-black/80">Ngày đặt: {{ $order->created_at->format('d/m/Y H:i') }}</p>
            </div>

            <button wire:click="printInvoice"
                    class="bg-black/20 hover:bg-black/40 text-white font-bold px-8 py-4 rounded-xl text-lg flex items-center gap-3 transition">
                <i class="fas fa-print"></i> IN HÓA ĐƠN
            </button>
        </div>

        <div class="p-8 grid grid-cols-1 lg:grid-cols-3 gap-8">
            <!-- Cột trái -->
            <div class="lg:col-span-2 space-y-8">
                <!-- Trạng thái (chỉ hiện trên màn hình) -->
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
                                    <span class="text-yellow-400 font-bold">×{{ $item->quantity }}</span>
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

            <!-- Cột phải -->
            <div class="space-y-6">
                <div class="bg-gray-700 rounded-xl p-6">
                    <h3 class="text-xl font-bold text-yellow-400 mb-4">Thông tin khách hàng</h3>
                    <div class="space-y-3 text-white text-lg">
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

                <div class="bg-gray-700 rounded-xl p-6">
                    <h3 class="text-xl font-bold text-yellow-400 mb-4">Chi tiết thanh toán</h3>
                    <div class="space-y-4 text-lg">
                        <div class="flex justify-between"><span>Tạm tính</span><span>{{ number_format($order->subtotal) }}₫</span></div>
                        <div class="flex justify-between"><span>Phí vận chuyển</span><span class="text-green-400">{{ number_format($order->shipping_fee) }}₫</span></div>
                        <div class="flex justify-between text-yellow-400><span>Giảm giá</span><span>-{{ number_format($order->discount) }}₫</span></div>
                        <div class="border-t-2 border-yellow-500 pt-4 flex justify-between text-2xl font-bold">
                            <span class="text-yellow-400">TỔNG CỘNG</span>
                            <span class="text-green-400">{{ number_format($order->total) }}₫</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    {{-- ==================== PHẦN IN HÓA ĐƠN (ẩn trên màn hình, hiện khi in) ==================== --}}
    <div id="print-section" >
        <div class="max-w-4xl mx-auto bg-white text-black p-12">
            <!-- Header hóa đơn -->
            <div class="text-center border-b-4 border-yellow-500 pb-8 mb-10">
                <h1 class="text-6xl font-bold text-yellow-500 mb-2">TIMEKEEPER</h1>
                <p class="text-2xl font-semibold">Shop Đồng hồ cao cấp chính hãng</p>
                <p class="text-lg">Hotline: 1900 1234 • Website: timekeeper.vn</p>
            </div>

            <div class="text-center mb-10">
                <h2 class="text-4xl font-bold">HÓA ĐƠN BÁN HÀNG</h2>
                <p class="text-2xl mt-6">Mã đơn hàng: <strong>{{ $order->code }}</strong></p>
                <p class="text-lg">Ngày đặt hàng: {{ $order->created_at->format('d/m/Y H:i') }}</p>
                <p class="text-lg">Ngày in: {{ now()->format('d/m/Y H:i') }}</p>
            </div>

            <!-- Thông tin khách hàng -->
            <div class="grid grid-cols-2 gap-12 mb-10 text-lg">
                <div>
                    <p><strong>Khách hàng:</strong> {{ $order->customer_name }}</p>
                    <p><strong>Số điện thoại:</strong> {{ $order->customer_phone }}</p>
                    <p><strong>Địa chỉ giao:</strong> {{ $order->customer_address }}, {{ $order->ward }}, {{ $order->district }}, {{ $order->province }}</p>
                </div>
                <div class="text-right">
                    <p><strong>Trạng thái:</strong></p>
                    <span class="inline-block mt-2 px-8 py-4 rounded-lg text-2xl font-bold {{ $order->status_color }}">
                        {{ __('order.status.' . $order->status) }}
                    </span>
                </div>
            </div>

            <!-- Bảng sản phẩm -->
            <table class="w-full border-collapse border-2 border-gray-700 mb-10">
                <thead>
                    <tr class="bg-gray-800 text-yellow-400">
                        <th class="border border-gray-600 px-6 py-4 text-left">STT</th>
                        <th class="border border-gray-600 px-6 py-4 text-left">Sản phẩm</th>
                        <th class="border border-gray-600 px-6 py-4 text-left">Phân loại</th>
                        <th class="border border-gray-600 px-6 py-4 text-center">SL</th>
                        <th class="border border-gray-600 px-6 py-4 text-right">Đơn giá</th>
                        <th class="border border-gray-600 px-6 py-4 text-right">Thành tiền</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($order->items as $i => $item)
                    <tr class="hover:bg-gray-50">
                        <td class="border border-gray-400 px-6 py-4 text-center">{{ $i + 1 }}</td>
                        <td class="border border-gray-400 px-6 py-4">{{ $item->product_name }}</td>
                        <td class="border border-gray-400 px-6 py-4">{{ $item->variation ?: '-' }}</td>
                        <td class="border border-gray-400 px-6 py-4 text-center">{{ $item->quantity }}</td>
                        <td class="border border-gray-400 px-6 py-4 text-right">{{ number_format($item->price) }}₫</td>
                        <td class="border border-gray-400 px-6 py-4 text-right font-bold">{{ number_format($item->total) }}₫</td>
                    </tr>
                    @endforeach
                    <tr class="bg-yellow-500 text-black font-bold text-xl">
                        <td colspan="5" class="px-6 py-5 text-right">TỔNG CỘNG</td>
                        <td class="px-6 py-5 text-right">{{ number_format($order->total) }}₫</td>
                    </tr>
                </tbody>
            </table>

            <div class="text-center text-lg">
                <p class="font-bold text-2xl mb-2">Xin chân thành cảm ơn Quý khách!</p>
                <p>Đổi trả trong 7 ngày • Bảo hành chính hãng toàn quốc</p>
            </div>
        </div>
    </div>

{{-- ==================== CSS & JS ĐIỀU KHIỂN IN ==================== --}}
@push('styles')
<style media="print">
    /* Ẩn toàn bộ giao diện admin khi in */
    body * {
        visibility: hidden;
    }
    #print-section, #print-section * {
        visibility: visible;
    }
    #print-section {
        position: absolute;
        left: 0;
        top: 0;
        width: 100%;
    }
</style>

<style>
    /* Ẩn phần in trên màn hình bình thường */
    #print-section {
        display: none;
    }
</style>
@endpush

@push('scripts')
<script>
    function printInvoice() {
        const print = document.querySelector('#print-section');
        print.classList.toggle('hidden');
        window.print();
    }

    document.addEventListener('livewire:init', () => {
        Livewire.on('printInvoice', () => {
            printInvoice();
        });
    });
</script>
@endpush

</div>
