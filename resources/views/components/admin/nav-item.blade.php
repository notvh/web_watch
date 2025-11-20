@props(['href' => '#', 'icon', 'active' => false, 'onclick' => ''])

<a href="{{ $href }}" {{ $attributes->merge(['class' => 'nav-item flex items-center gap-4 px-4 py-3 rounded-lg transition ' . ($active ? 'active bg-yellow-600' : 'hover:bg-gray-800')]) }}
   @if($onclick) onclick="{{ $onclick }}" @endif>
    <i class="fas {{ $icon }}"></i>
    <span>{{ $slot }}</span>
</a>
