<?php

namespace App\Livewire\Admin;

use Livewire\Component;
use App\Models\Category;
use App\Models\Product;
use Livewire\WithPagination;

class ProductTable extends Component
{
    use WithPagination;

    public $search = '';
    public
        // $products,
        $categories,
        $category_id;

    public function search()
    {
        $this->resetPage();
    }
    public function mount()
    {
        $this->categories = Category::active()->get();
    }
    public function delete(Product $product)
    {
        $product->delete();
        $this->dispatch('toast', 'Xóa vĩnh viễn thành công!', 'success');
    // if ($product->trashed()) {
    //     // Đã ở thùng rác → xóa vĩnh viễn
    //     $product->forceDelete(); // sẽ trigger deleting → xóa ảnh + biến thể
    // } else {
    //     // Chưa xóa → đưa vào thùng rác
    //     $product->delete(); // soft delete
    //     $this->dispatch('toast', 'Đã chuyển vào thùng rác!', 'warning');
    // }

    // $this->loadProducts(); // refresh danh sách
    }
    public function toggleStatus(Product $product)
    {
        $product->is_active = !$product->is_active;
        $product->update();
    }
    public function render()
    {
        $products = Product::query()
            ->when($this->search, fn($q) => $q->where('name', 'like', "%{$this->search}%"))
            ->when($this->category_id, fn($q) => $q->where('category_id', $this->category_id))
            ->with([
                'category',

            ])
            // 'brand'
            ->latest()
            ->paginate(10)
            ->withQueryString();
        return view('livewire.admin.product-table', compact('products'));
    }
}
