@extends('layouts.admin')
@section('title', 'Quản lý Danh mục')

<div class="bg-gray-800 rounded-2xl shadow-xl p-6">
    <div class="flex justify-between items-center mb-6">
        <h2 class="text-2xl font-bold text-yellow-500">Danh mục sản phẩm</h2>
        <button wire:click="$dispatch('open-category-modal')" class="btn-primary">
            <i class="fas fa-plus"></i> Thêm danh mục
        </button>
    </div>

    <div class="space-y-2">
        @foreach(\App\Models\Category::get()->toTree() as $category)
            <x-admin.category-row :category="$category" />
        @endforeach
    </div>
</div>

{{-- @livewire('admin.category-modal') --}}
