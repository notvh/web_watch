<?php

namespace App\Livewire\Admin;

use Carbon\Carbon;
use App\Models\User;
use App\Models\Product;
use Livewire\Component;

class DashboardStats extends Component
{
    public $totalRevenue = 0;
    public $todayRevenue = 0;
    public $totalOrders = 0;
    public $pendingOrders = 0;
    public $totalProducts = 0;
    public $lowStockProducts = 0;
    public $newCustomers = 0;

    public function mount()
    {
        $this->loadStats();
    }

    public function loadStats()
    {
        // $this->totalRevenue      = Order::where('status', 'completed')->sum('total');
        // $this->todayRevenue      = Order::where('status', 'completed')
        //                                 ->whereDate('created_at', today())
        //                                 ->sum('total');

        // $this->totalOrders       = Order::count();
        // $this->pendingOrders     = Order::whereIn('status', ['pending', 'processing'])->count();

        $this->totalProducts     = Product::count();
        $this->lowStockProducts  = Product::whereHas('variations', fn($q) => $q->where('stock', '<', 10))
                                        ->orWhere('stock', '<', 10)->count();

        $this->newCustomers      = User::where('created_at', '>=', Carbon::now()->subDays(7))->count();
    }
    public function render()
    {
        // $recentOrders = Order::with('user')->latest()->take(8)->get();
        $topProducts  = Product::withCount('orderItems')
                               ->orderByDesc('order_items_count')
                               ->take(6)
                               ->get();
        return view('livewire.admin.dashboard-stats');
    }
}
