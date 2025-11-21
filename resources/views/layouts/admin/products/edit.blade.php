@extends('layouts.admin')

@section('title', 'Thêm sản phẩm mới')

@push('styles')
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
@endpush

@push('scripts')
    {{-- <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script> --}}
    {{-- <script>
        document.addEventListener('livewire:load', () => {
            $('.select2').select2();
        });
    </script> --}}
@endpush
@section('content')
<div>
    @livewire('admin.product-form',['product' => $product])
</div>
@endsection
