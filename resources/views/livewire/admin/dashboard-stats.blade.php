<div class="space-y-6">

    <!-- Stats Cards -->
    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6">
        <div class="bg-gradient-to-r from-blue-500 to-blue-600 text-white p-6 rounded-xl shadow-lg">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-blue-100 text-sm">Tổng doanh thu</p>
                    <p class="text-3xl font-bold mt-2">{{ number_format($totalRevenue) }}₫</p>
                </div>
                <i class="fas fa-wallet text-4xl opacity-80"></i>
            </div>
        </div>

        <div class="bg-gradient-to-r from-green-500 to-emerald-600 text-white p-6 rounded-xl shadow-lg">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-green-100 text-sm">Hôm nay</p>
                    <p class="text-3xl font-bold mt-2">+{{ number_format($todayRevenue) }}₫</p>
                </div>
                <i class="fas fa-arrow-trend-up text-4xl opacity-80"></i>
            </div>
        </div>

        <div class="bg-gradient-to-r from-purple-500 to-indigo-600 text-white p-6 rounded-xl shadow-lg">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-purple-100 text-sm">Đơn hàng mới</p>
                    <p class="text-3xl font-bold mt-2">{{ $pendingOrders }}</p>
                </div>
                <i class="fas fa-shopping-bag text-4xl opacity-80"></i>
            </div>
        </div>

        <div class="bg-gradient-to-r from-orange-500 to-red-600 text-white p-6 rounded-xl shadow-lg">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-orange-100 text-sm">Sắp hết hàng</p>
                    <p class="text-3xl font-bold mt-2">{{ $lowStockProducts }}</p>
                </div>
                <i class="fas fa-exclamation-triangle text-4xl opacity-80"></i>
            </div>
        </div>
    </div>

    <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
        <!-- Recent Orders -->
        <div class="lg:col-span-2 bg-white dark:bg-gray-800 rounded-xl shadow-lg overflow-hidden">
            <div class="p-6 border-b dark:border-gray-700">
                <h3 class="text-xl font-bold flex items-center gap-3">
                    <i class="fas fa-clock text-blue-600"></i>
                    Đơn hàng gần đây
                </h3>
            </div>
            <div class="overflow-x-auto">
                <table class="w-full">
                    <thead class="bg-gray-50 dark:bg-gray-700">
                        <tr>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Mã</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Khách</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Tổng</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Trạng thái</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-gray-200 dark:divide-gray-700">
                        @forelse($recentOrders as $order)
                            <tr class="hover:bg-gray-50 dark:hover
