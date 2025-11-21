{{-- resources/views/livewire/admin/product-form.blade.php --}}
<div class="max-w-7xl mx-auto py-8 px-4 sm:px-6 lg:px-8">
    <div class="bg-gray-800 rounded-2xl shadow-2xl overflow-hidden">
        <!-- Header -->
        <div class="bg-gradient-to-r from-yellow-600 to-yellow-500 px-8 py-6">
            <h1 class="text-3xl font-bold text-black">
                {{ $isEdit ? 'SỬA SẢN PHẨM' : 'THÊM SẢN PHẨM MỚI' }}
            </h1>
        </div>

        <form wire:submit.prevent="save" class="p-8 space-y-10">
            @csrf

            <!-- THÔNG TIN CHUNG -->
            <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
                <!-- Cột trái: Thông tin cơ bản -->
                <div class="lg:col-span-2 space-y-6">
                    <div>
                        <label class="block text-lg font-medium text-yellow-400 mb-2">Tên sản phẩm <span class="text-red-500">*</span></label>
                        <input type="text" wire:model="name" class="w-full px-5 py-4 bg-gray-700 rounded-xl text-white text-lg focus:ring-4 focus:ring-yellow-500 focus:outline-none" placeholder="Ví dụ: Rolex Datejust 41mm" required>
                        @error('name') <span class="text-red-400 text-sm mt-1">{{ $message }}</span> @enderror
                    </div>

                    <div class="grid grid-cols-2 gap-6">
                        <div>
                            <label class="block text-lg font-medium text-yellow-400 mb-2">Danh mục <span class="text-red-500">*</span></label>
                            <select wire:model="category_id" class="w-full px-5 py-4 bg-gray-700 rounded-xl text-white text-lg" required>
                                <option value="">— Chọn danh mục —</option>
                                @foreach($categories as $cat)
                                    <option value="{{ $cat->id }}">{{ $cat->name }}</option>
                                @endforeach
                            </select>
                            @error('category_id') <span class="text-red-400 text-sm mt-1">{{ $message }}</span> @enderror
                        </div>

                        {{-- <div>
                            <label class="block text-lg font-medium text-yellow-400 mb-2">Thương hiệu <span class="text-red-500">*</span></label>
                            <select wire:model="brand_id" class="w-full px-5 py-4 bg-gray-700 rounded-xl text-white text-lg" required>
                                <option value="">— Chọn thương hiệu —</option>
                                @foreach($brands as $brand)
                                    <option value="{{ $brand->id }}">{{ $brand->name }}</option>
                                @endforeach
                            </select>
                            @error('brand_id') <span class="text-red-400 text-sm mt-1">{{ $message }}</span> @enderror
                        </div> --}}
                    </div>

                    <div>
                        <label class="block text-lg font-medium text-yellow-400 mb-2">Mô tả chi tiết</label>
                        <textarea wire:model="description" rows="10" class="w-full px-5 py-4 bg-gray-700 rounded-xl text-white text-lg resize-none focus:ring-4 focus:ring-yellow-500 focus:outline-none" placeholder="Nhập mô tả đầy đủ..."></textarea>
                    </div>
                </div>

                <!-- Cột phải: Ảnh + Toggle biến thể -->
                <div class="space-y-6">
                    <!-- Upload ảnh chính -->
                    <div>
                        <label class="block text-lg font-medium text-yellow-400 mb-3">Ảnh sản phẩm (nhiều ảnh)</label>
                        <input type="file" wire:model="main_images" multiple accept="image/*"
                               class="w-full px-5 py-4 bg-gray-700 rounded-xl text-white file:mr-4 file:py-3 file:px-6 file:rounded-lg file:border-0 file:bg-yellow-500 file:text-black file:font-bold hover:file:bg-yellow-600 cursor-pointer">

                        <!-- Hiển thị ảnh cũ + ảnh mới -->
                        <div class="grid grid-cols-3 gap-4 mt-5">
                            @foreach($existing_images ?? [] as $img)
                                <div class="relative group">
                                    <img src="{{ asset('storage/'.$img) }}" loading="lazy" width="150px" class="w-full h-40 object-cover rounded-xl shadow-lg">
                                    <div class="absolute inset-0 bg-black bg-opacity-50 opacity-0 group-hover:opacity-100 transition rounded-xl flex items-center justify-center">
                                        <button type="button" wire:click="$set('existing_images', array_diff($existing_images, ['{{ $img }}']))"
                                                class="text-red-500 text-2xl"><i class="fas fa-trash"></i></button>
                                    </div>
                                </div>
                            @endforeach

                            @if($main_images)
                                @foreach($main_images as $img)
                                    <img src="{{ $img->temporaryUrl() }}" loading="lazy" width="150px" class="w-full h-40 object-cover rounded-xl shadow-lg">
                                @endforeach
                            @endif
                        </div>
                    </div>

                    <!-- Toggle biến thể -->
                    <div class="bg-gray-700 rounded-xl p-6">
                        <label class="relative inline-flex items-center cursor-pointer">
                            <input type="checkbox" wire:model.live="has_variations" class="sr-only form-checkbox peer">
                            <div class="w-16 h-9 bg-gray-600 rounded-full peer peer-checked:after:translate-x-full peer-checked:after:border-white after:content-[''] after:absolute after:top-0.5 after:left-0.5 after:bg-white after:rounded-full after:h-8 after:w-8 after:transition-all peer-checked:bg-yellow-500"></div>
                            <span class="ml-4 text-xl font-bold text-yellow-400">Sản phẩm có biến thể (Màu, Size...). Bấm vào để thêm</span>
                        </label>
                    </div>
                </div>
            </div>

            <!-- GIÁ & TỒN KHO (khi không có biến thể) -->
            @unless($has_variations)
                <div class="bg-gray-700 rounded-xl p-8">
                    <h3 class="text-2xl font-bold text-yellow-400 mb-6">Giá bán & Tồn kho</h3>
                    <div class="grid grid-cols-2 gap-8 max-w-2xl">
                        <div>
                            <label class="block text-lg font-medium text-gray-300 mb-2">Giá bán (VNĐ)</label>
                            <input type="number" wire:model="price" class="w-full px-5 py-4 bg-gray-600 rounded-xl text-xl font-bold text-yellow-400" placeholder="2.500.000">
                        </div>
                        <div>
                            <label class="block text-lg font-medium text-gray-300 mb-2">Số lượng tồn kho</label>
                            <input type="number" wire:model="stock" class="w-full px-5 py-4 bg-gray-600 rounded-xl text-xl" placeholder="50">
                        </div>
                    </div>
                </div>
            @endunless

            <!-- BIẾN THỂ (khi bật) -->
            @if($has_variations)
                <div class="bg-gray-700 rounded-xl p-8">
                    <div class="flex justify-between items-center mb-6">
                        <h3 class="text-2xl font-bold text-yellow-400">Quản lý biến thể</h3>
                        <button type="button" wire:click="addVariation" class="btn-primary text-lg px-6 py-3">
                            <i class="fas fa-plus"></i> Thêm biến thể
                        </button>
                    </div>

                    <div class="space-y-6">
                        @forelse($variations as $index => $v)
                            <div class="bg-gray-800 rounded-xl p-6 flex gap-6 items-end border border-gray-600">
                                <div class="grid grid-cols-5 gap-4 flex-1">
                                    <input type="text" wire:model="variations.{{ $index }}.option1" placeholder="Màu sắc (VD: Đen)" class="px-5 py-4 bg-gray-700 rounded-lg text-white">
                                    <input type="text" wire:model="variations.{{ $index }}.option2" placeholder="Size / Dây (VD: 42mm)" class="px-5 py-4 bg-gray-700 rounded-lg text-white">
                                    <input type="number" wire:model="variations.{{ $index }}.price" placeholder="Giá" class="px-5 py-4 bg-gray-700 rounded-lg text-white font-bold text-yellow-400">
                                    <input type="number" wire:model="variations.{{ $index }}.stock" placeholder="Tồn kho" class="px-5 py-4 bg-gray-700 rounded-lg text-white">
                                    <input type="file" wire:model="variations.{{ $index }}.temp_image" accept="image/*" class="px-5 py-4 bg-gray-700 rounded-lg text-sm">
                                </div>

                                <!-- Hiển thị ảnh biến thể -->
                                @if(isset($v['image']) || $v['temp_image'])
                                    <img src="{{ $v['temp_image'] ? $v['temp_image']->temporaryUrl() : asset('storage/'.$v['image']) }}"
                                        loading="lazy"
                                        width="150px"
                                         class="w-24 h-24 object-cover rounded-lg shadow-lg">
                                @endif

                                <button type="button" wire:click="removeVariation({{ $index }})"
                                        class="text-red-500 hover:text-red-400 text-3xl ml-4">
                                    <i class="fas fa-trash-alt"></i>
                                </button>
                            </div>
                        @empty
                            <p class="text-center text-gray-500 py-12 text-xl">Chưa có biến thể nào. Nhấn "Thêm biến thể" để bắt đầu.</p>
                        @endforelse
                    </div>
                </div>
            @endif

            <!-- NÚT HÀNH ĐỘNG -->
            <div class="flex justify-end gap-6 pt-8 border-t-4 border-yellow-500">
                <a href="{{ route('admin.products.index') }}"
                   class="px-12 py-5 bg-gray-600 hover:bg-gray-500 rounded-xl text-xl font-bold transition">
                    Hủy bỏ
                </a>
                <button type="submit"
                        class="px-16 py-5 bg-gradient-to-r from-yellow-500 to-yellow-600 hover:from-yellow-600 hover:to-yellow-700 rounded-xl text-black text-xl font-bold shadow-lg transform hover:scale-105 transition">
                    {{ $isEdit ? 'CẬP NHẬT SẢN PHẨM' : 'HOÀN TẤT THÊM MỚI' }}
                </button>
            </div>
        </form>
    </div>
</div>
