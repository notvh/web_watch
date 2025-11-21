<aside class="sidebar w-64 bg-black text-white flex flex-col shadow-2xl">
    <div class="logo-container p-6 border-b border-gray-800">
        <div class="logo flex items-center gap-3">
            <i class="fas fa-clock text-3xl text-yellow-500"></i>
            <span class="text-2xl font-bold">TimeKeeper</span>
        </div>
    </div>

    <nav class="flex-1 p-4 space-y-1">
        <x-admin.nav-item href="{{ route('admin.dashboard') }}" icon="fa-home" :active="request()->routeIs('admin.dashboard')">
            Trang Chủ
        </x-admin.nav-item>

        <x-admin.nav-item href="{{ route('admin.orders.index') }}" icon="fa-shopping-bag">
            Đơn hàng
        </x-admin.nav-item>

        <!-- Menu có submenu -->
        <div x-data="{ open: false }">
            <x-admin.nav-item icon="fa-clock" @click="open = !open" class="cursor-pointer">
                Quản lý
                <i class="fas fa-chevron-down nav-arrow ml-auto transition" :class="open ? 'rotate-180' : ''"></i>
            </x-admin.nav-item>

            <div x-show="open" x-transition class="ml-8 space-y-1">
                <x-admin.sub-nav-item href="{{ route('admin.categories.index') }}" icon="fa-tags">
                    Quản lý danh mục
                </x-admin.sub-nav-item>
                <x-admin.sub-nav-item href="{{ route('admin.products.index') }}" icon="fa-box-open">
                    Quản lí sản phẩm
                </x-admin.sub-nav-item>
                {{-- <x-admin.sub-nav-item href="{{ route('admin.brands.index') }}" icon="fa-copyright">
                    Quản lí thương hiệu
                </x-admin.sub-nav-item> --}}
            </div>
        </div>

        <x-admin.nav-item href="#" icon="fa-users">Khách Hàng</x-admin.nav-item>
        <x-admin.nav-item href="#" icon="fa-chart-line">Thống Kê</x-admin.nav-item>
        <x-admin.nav-item href="#" icon="fa-warehouse">Kho Hàng</x-admin.nav-item>
        <x-admin.nav-item href="#" icon="fa-tags">Khuyến Mãi</x-admin.nav-item>
        <x-admin.nav-item href="#" icon="fa-star">Đánh Giá</x-admin.nav-item>
        <x-admin.nav-item href="#" icon="fa-cog">Cài Đặt</x-admin.nav-item>
    </nav>
</aside>
