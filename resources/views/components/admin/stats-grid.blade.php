<div class="stats-grid">
    <div class="stat-card">
        <div class="stat-icon revenue"><i class="fas fa-dollar-sign"></i></div>
        <div class="stat-value">{{ number_format($totalRevenue ?? 1245800000) }}₫</div>
        <div class="stat-label">Doanh Thu Tháng Này</div>
        <span class="stat-change positive"><i class="fas fa-arrow-up"></i> 12.5%</span>
    </div>

    <div class="stat-card">
        <div class="stat-icon orders"><i class="fas fa-shopping-cart"></i></div>
        <div class="stat-value">{{ $totalOrders ?? 1847 }}</div>
        <div class="stat-label">Đơn Hàng</div>
        <span class="stat-change positive"><i class="fas fa-arrow-up"></i> 8.2%</span>
    </div>

    <div class="stat-card">
        <div class="stat-icon products"><i class="fas fa-clock"></i></div>
        <div class="stat-value">{{ $totalProducts ?? 324 }}</div>
        <div class="stat-label">Sản Phẩm</div>
        <span class="stat-change positive"><i class="fas fa-arrow-up"></i> 3.1%</span>
    </div>

    <div class="stat-card">
        <div class="stat-icon customers"><i class="fas fa-users"></i></div>
        <div class="stat-value">{{ $totalCustomers ?? 12459 }}</div>
        <div class="stat-label">Khách Hàng</div>
        <span class="stat-change positive"><i class="fas fa-arrow-up"></i> 15.3%</span>
    </div>
</div>
