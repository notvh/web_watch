@props(['href', 'active' => false])

<a href="{{ $href }}"
   {{ $attributes->merge(['class' => 'flex items-center px-4 py-3 rounded-lg transition ' .
       ($active ? 'bg-indigo-600 text-white shadow-lg' : 'hover:bg-gray-800 text-gray-300')]) }}>
    {{ $slot }}
</a>
