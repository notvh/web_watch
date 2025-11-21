@extends('layouts.admin')
@section('title', 'Quản lý Đơn hàng')

@section('content')
<div class="space-y-6">
    @livewire('admin.order-show', ['order' => $order])
</div>
@endsection
