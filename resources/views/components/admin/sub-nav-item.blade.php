@props(['href' => '#', 'icon'])

<a href="{{ $href }}" class="nav-item sub-nav-item flex items-center gap-4 px-4 py-2.5 text-sm rounded-lg hover:bg-gray-800 transition">
    <i class="fas {{ $icon }}"></i>
    <span>{{ $slot }}</span>
</a>
