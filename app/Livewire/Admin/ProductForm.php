<?php

namespace App\Livewire\Admin;

use App\Models\Brand;
use App\Models\Product;
use Livewire\Component;
use App\Models\Category;
use Illuminate\Support\Str;
use Livewire\WithFileUploads;

class ProductForm extends Component
{
    use WithFileUploads;

    public Product $product; // nếu edit
    public $isEdit = false;
    public $categories, $brands = [];

    // Dữ liệu form
    public $name, $description, $category_id, $brand_id;
    public $has_variations = false;
    public $price = 0, $stock = 0;
    public $main_images = [];
    public $existing_images = [];
    public $variations = [];

    public function mount($product = null)
    {
        $this->categories = Category::where('is_active', true)->get();
        // $this->brands = Brand::where('is_active', true)->get();

        if ($product) {
            $this->isEdit = true;
            $this->product = $product;
            // 'brand_id',
            $this->fill($product->only(['name', 'description', 'category_id',
             'price', 'stock', 'has_variations']));
            $this->existing_images = $product->images;
            $this->variations = $product->variations->map(fn($v) => [
                'option1' => $v->option1,
                'option2' => $v->option2,
                'price' => $v->price,
                'stock' => $v->stock,
                'image' => $v->image,
                'temp_image' => null,
            ])->toArray();
        }
    }

    public function addVariation()
    {
        $this->variations[] = ['option1' => '', 'option2' => '', 'price' => 0, 'stock' => 0, 'image' => null, 'temp_image' => null];
    }

    public function removeVariation($i)
    {
        unset($this->variations[$i]);
        $this->variations = array_values($this->variations);
    }

    public function save()
    {
        $this->validate([
            'name' => 'required|max:255',
            'category_id' => 'required|exists:categories,id',
            'main_images.*' => 'image|max:2048',
        ]);
        // 'brand_id' => 'required|exists:brands,id',

        $images = $this->existing_images ?? [];
        foreach ($this->main_images as $img) {
            $images[] = $img->store('products', 'public');
        }

        $data = [
            'name' => $this->name,
            'slug' => Str::slug($this->name),
            'description' => $this->description,
            'category_id' => $this->category_id,
            // 'brand_id' => $this->brand_id,
            'images' => $images,
            'has_variations' => $this->has_variations,
            'price' => $this->has_variations ? null : $this->price,
            'stock' => $this->has_variations ? 0 : $this->stock,
        ];

        if ($this->isEdit) {
            $this->product->update($data);
            $this->product->variations()->delete();
        } else {
            $this->product = Product::create($data);
        }

        if ($this->has_variations) {
            foreach ($this->variations as $v) {
                $img = $v['temp_image'] ? $v['temp_image']->store('products', 'public') : $v['image'];
                $this->product->variations()->create([
                    'option1' => $v['option1'],
                    'option2' => $v['option2'],
                    'price' => $v['price'],
                    'stock' => $v['stock'],
                    'image' => $img,
                ]);
            }
        }
        if ($this->isEdit) {
            return redirect()->route('admin.products.edit',['product' => $this->product])
                ->with('success', $this->isEdit ? 'Cập nhật thành công!' : 'Thêm sản phẩm thành công!');
        }
            return redirect()->route('admin.products.index')
                ->with('success', $this->isEdit ? 'Cập nhật thành công!' : 'Thêm sản phẩm thành công!');
    }

    public function render()
    {
        return view('livewire.admin.product-form');
    }
}
