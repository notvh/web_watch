<?php

namespace App\Livewire\Admin;

use Livewire\Component;
use App\Models\Category;
use App\Models\Product;

class ProductTable extends Component
{
    public function render()
    {

        return view('livewire.admin.product-table', [
            'products' => Product::all(),
            'categories' => Category::active()->get(),
        ]);
    }
}
