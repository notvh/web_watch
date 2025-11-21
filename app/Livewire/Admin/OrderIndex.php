<?php

namespace App\Livewire\Admin;

use App\Models\Order;
use Livewire\Component;
use Livewire\WithPagination;

class OrderIndex extends Component
{
    use WithPagination;
    protected $paginationTheme = 'tailwind';

    public $search = '';
    public $status = '';
    public $perPage = 15;

    public function render()
    {
        $orders = Order::with(['user', 'items'])
            ->where('is_cart', false) // chỉ hiển thị đơn thật
            ->when($this->search, fn($q) => $q->where(function($sq) {
                $sq->where('code', 'like', "%{$this->search}%")
                   ->orWhere('customer_name', 'like', "%{$this->search}%")
                   ->orWhere('customer_phone', 'like', "%{$this->search}%");
            }))
            ->when($this->status, fn($q) => $q->where('status', $this->status))
            ->latest()
            ->paginate($this->perPage);

        return view('livewire.admin.order-index', compact('orders'));
    }

    public function updateStatus($orderId, $status)
    {
        Order::find($orderId)->update(['status' => $status]);
        $this->dispatch('toast', 'Cập nhật trạng thái thành công!', 'success');
    }

    public function printInvoice($orderId)
    {
        $this->dispatch('printInvoice', $orderId);
    }
}
