<div class="bg-gray-700 rounded-lg p-4 flex items-center justify-between hover:bg-gray-600 transition">
    <div class="flex items-center gap-4">
        <span style="margin-left: {{ ($category->depth ?? 0) * 30 }}px">
            @if($category->children->count()) → @endif
            {{ $category->name }}
        </span>
    </div>
    <div class="flex gap-3">
        <button wire:click="$dispatch('edit-category', {{ $category }})" class="text-blue-400"><i class="fas fa-edit"></i></button>
        <button wire:click="$dispatch('delete-category', {{ $category->id }})" class="text-red-400"><i class="fas fa-trash"></i></button>
    </div>
</div>

@foreach($category->children as $child)
    <x-admin.category-row :category="$child" />
@endforeach
