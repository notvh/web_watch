<?php

namespace App\Livewire\Admin;

use App\Models\Order;
use Livewire\Component;

class OrderShow extends Component
{
    public Order $order;
    public $status;

    protected $listeners = ['refreshOrder' => '$refresh'];

    public function mount(Order $order)
    {
        $this->order = $order->load('items.product', 'user');
        $this->status = $order->status;
    }

    public function updateStatus()
    {
        $this->validate(['status' => 'required|in:pending,confirmed,processing,shipping,completed,canceled,refunded']);

        $this->order->update(['status' => $this->status]);

        // Gửi thông báo realtime cho khách (nếu cần)
        // broadcast(new OrderStatusUpdated($this->order));

        $this->dispatch('toast', 'Cập nhật trạng thái thành công!', 'success');
    }

    public function printInvoice()
    {
        $this->dispatch('printInvoice', $this->order->id);
    }

    public function render()
    {
        return view('livewire.admin.order-show');
    }
}
