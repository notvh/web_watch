<div class="chart-container bg-gray-800 rounded-2xl p-6 shadow-xl">
    <div class="chart-header">
        <h3 class="chart-title">Thống Kê Doanh Thu</h3>
        <div class="chart-filters">
            <button class="filter-btn active" wire:click="$set('period', '7days')">7 Ngày</button>
            <button class="filter-btn" wire:click="$set('period', '30days')">30 Ngày</button>
            <button class="filter-btn" wire:click="$set('period', '90days')">90 Ngày</button>
            <button class="filter-btn" wire:click="$set('period', '1year')">1 Năm</button>
        </div>
    </div>
    <canvas id="revenueChart" height="350"></canvas>
</div>

@push('scripts')
<script>
document.addEventListener('livewire:load', () => {
    let chart;
    const ctx = document.getElementById('revenueChart').getContext('2d');

    function renderChart(data) {
        if (chart) chart.destroy();
        chart = new Chart(ctx, {
            type: 'line',
            data: {
                labels: data.labels,
                datasets: [{
                    label: 'Doanh thu',
                    data: data.values,
                    borderColor: '#facc15',
                    backgroundColor: 'rgba(250, 204, 21, 0.1)',
                    tension: 0.4,
                    fill: true,
                    pointBackgroundColor: '#facc15',
                    pointRadius: 5,
                }]
            },
            options: {
                responsive: true,
                plugins: { legend: { display: false } },
                scales: {
                    y: { beginAtZero: true, grid: { color: 'rgba(255,255,255,0.05)' } },
                    x: { grid: { display: false } }
                }
            }
        });
    }

    // Dữ liệu mẫu (bạn có thể thay bằng Livewire emit)
    renderChart({
        labels: ['01/01', '02/01', '03/01', '04/01', '05/01', '06/01', '07/01'],
        values: [85, 92, 110, 98, 135, 148, 165]
    });

    // Khi Livewire cập nhật (nếu bạn muốn realtime)
    document.addEventListener('revenue-updated', e => renderChart(e.detail));
});
</script>
@endpush
