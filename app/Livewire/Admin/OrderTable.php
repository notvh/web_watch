<?php

namespace App\Livewire\Admin;

use Livewire\Component;

class OrderTable extends Component
{
    public $status = '';
    public $search = '';

    public function render()
    {
        $orders = Order::with('user')
            ->when($this->search, fn($q) => $q->where('code', 'like', "%{$this->search}%"))
            ->when($this->status, fn($q) => $q->where('status', $this->status))
            ->latest()
            ->paginate(20);

        return view('livewire.admin.order-table', compact('orders'));
    }
}
