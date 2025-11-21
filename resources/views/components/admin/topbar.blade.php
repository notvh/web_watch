<header class="top-bar bg-gray-800 border-b border-gray-700 p-4 flex items-center justify-between">
    <div class="flex items-center gap-4 flex-1">
        <input type="text" class="search-bar w-full max-w-md px-4 py-2.5 bg-gray-700 rounded-lg text-white placeholder-gray-400 focus:outline-none focus:ring-2 focus:ring-yellow-500" placeholder="Tìm kiếm đơn hàng, sản phẩm, khách hàng...">
    </div>

    <div class="flex items-center gap-4">
        <!-- Notification -->
        {{-- <x-admin.dropdown icon="fa-bell" badge="12" title="Thông Báo">
            <x-slot name="items">
                <x-admin.dropdown-item icon="fa-file-invoice-dollar" title="Đơn hàng #DH-00847 đã hoàn thành" time="5 phút trước" />
                <x-admin.dropdown-item icon="fa-users" title="Khách hàng mới: Trần Thị B" time="1 giờ trước" />
                <x-admin.dropdown-item icon="fa-star" title="Đánh giá 5 sao mới" time="3 giờ trước" />
            </x-slot>
        </x-admin.dropdown>

        <!-- Messages -->
        <x-admin.dropdown icon="fa-envelope" badge="5" title="Tin Nhắn">
            <x-slot name="items">
                <x-admin.dropdown-item icon="fa-user-circle" title="Nguyễn Văn A" desc="Tôi cần tư vấn về mẫu Rolex..." />
                <x-admin.dropdown-item icon="fa-user-circle" title="Lê Văn C" desc="Sản phẩm có sẵn không?" />
            </x-slot>
        </x-admin.dropdown> --}}

        <!-- Profile -->
        {{-- <x-admin.dropdown>
            <x-slot name="trigger">
                <div class="user-profile flex items-center gap-3 cursor-pointer">
                    <div class="avatar w-10 h-10 bg-yellow-600 rounded-full flex items-center justify-center font-bold">AD</div>
                    <div>
                        <div class="font-semibold">Admin Name</div>
                        <div class="text-xs text-gray-400">Quản trị viên</div>
                    </div>
                    <i class="fas fa-chevron-down text-sm"></i>
                </div>
            </x-slot>
            {{-- <x-admin.dropdown-item icon="fa-user-circle" href="#">Hồ Sơ Của Tôi</x-admin.dropdown-item>
            <x-admin.dropdown-item icon="fa-cog" href="#">Cài Đặt</x-admin.dropdown-item>
            <x-admin.dropdown-item icon="fa-question-circle" href="#">Hỗ Trợ</x-admin.dropdown-item>
            <x-admin.dropdown-item icon="fa-sign-out-alt" href="#" class="danger">Đăng Xuất</x-admin.dropdown-item> --}}
        {{-- </x-admin.dropdown> --}}
    </div>
</header>
