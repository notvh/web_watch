<!-- dropdown.blade.php -->
<div x-data="{ open: false }" @click.away="open = false" class="dropdown-container">
    <div @click="open = !open" class="icon-btn relative cursor-pointer">
        <i class="fas {{ $icon ?? 'fa-user' }}"></i>
        @if(isset($badge)) <span class="notification-badge">{{ $badge }}</span> @endif
        {{ $trigger ?? '' }}
    </div>

    <div x-show="open" x-transition class="dropdown-menu dropdown-lg">
        <div class="dropdown-header">{{ $title ?? 'Menu' }}</div>
        {{ $items }}
        <div class="dropdown-footer"><a href="#" class="dropdown-item">Xem tất cả</a></div>
    </div>
</div>
