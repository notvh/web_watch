<?php

namespace App\Livewire\Admin;

use App\Models\Product;
use App\Models\Category;
// use App\Models\Brand;
use Livewire\Component;
use Livewire\WithFileUploads;

class ProductManager extends Component
{
    use WithFileUploads;

    public
    // $products,
     $categories, $brands = [];
    public $name, $description, $category_id
    // ,$brand_id
    ;
    public $has_variations = false;
    public $price, $stock = 0;
    public $images = [];
    public $variations = []; // [{option1, option2, price, stock, image}]
    public $search = '';
    public $editId = null;
    public $isOpen = false;

    protected $rules = [
        'name' => 'required|string|max:255',
        'category_id' => 'required|exists:categories,id',
        // 'brand_id' => 'required|exists:brands,id',
        'images.*' => 'image|max:2048',
    ];

    public function mount()
    {
        $this->categories = Category::all();
        // $this->brands = Brand::all();
        // $this->loadProducts();
    }

    // public function loadProducts()
    // {
    //     $this->products = Product::with(['category',
    //     // 'brand'
    //     ])
    //         ->latest()
    //         ->paginate(15)
    //         ->withQueryString(); // quan trọng!
    // }

    public function updatedSearch()
    {
        $this->resetPage(); // reset về trang 1 khi tìm kiếm
        $this->loadProducts();
    }

    public function create()
    {
        $this->resetForm();
        $this->isOpen = true;
    }

    public function store()
    {
        $this->validate();

        $imagePaths = [];
        foreach ($this->images as $img) {
            $imagePaths[] = $img->store('products', 'public');
        }

        $product = Product::create([
            'name' => $this->name,
            'description' => $this->description,
            'category_id' => $this->category_id,
            // 'brand_id' => $this->brand_id,
            'price' => $this->has_variations ? null : $this->price,
            'stock' => $this->has_variations ? 0 : $this->stock,
            'images' => $imagePaths,
            'has_variations' => $this->has_variations,
        ]);

        if ($this->has_variations && count($this->variations)) {
            foreach ($this->variations as $v) {
                $varImage = $v['image'] ? $v['image']->store('products', 'public') : null;
                $product->variations()->create([
                    'option1' => $v['option1'] ?? null,
                    'option2' => $v['option2'] ?? null,
                    'price' => $v['price'],
                    'stock' => $v['stock'],
                    'image' => $varImage,
                ]);
            }
        }

        $this->resetForm();
        $this->dispatch('toast', 'Thêm sản phẩm thành công!', 'success');
        $this->loadProducts();
    }

    public function addVariation()
    {
        $this->variations[] = ['option1' => '', 'option2' => '', 'price' => 0, 'stock' => 0, 'image' => null];
    }

    public function removeVariation($index)
    {
        unset($this->variations[$index]);
        $this->variations = array_values($this->variations);
    }

    public function resetForm()
    {
        $this->reset([
            'name',
            'description',
            'category_id',
            // 'brand_id',
            'price',
            'stock',
            'images',
            'variations',
            'has_variations',
            'editId'
        ]);
        $this->isOpen = false;
    }

    public function render()
    {
        $products = Product::query()
            ->when($this->search, fn($q) => $q->where('name', 'like', "%{$this->search}%"))
            ->when($this->category_id, fn($q) => $q->where('category_id', $this->category_id))
            ->with(['category',
            ])
            // 'brand'
            ->latest()
            ->paginate(10)
            ->withQueryString();
        return view('livewire.admin.product-manager', compact('products'));
    }
}
