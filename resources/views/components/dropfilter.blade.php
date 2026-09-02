@props(['name' => 'Filter by Status'])

@php
    $filterLabel = $name ?: 'Filter by Status';

    if ($filterLabel !== 'Filter by Status') {
        $filterLabel = ucwords(str_replace('_', ' ', $filterLabel));
    }
@endphp

<div {{ $attributes(['class' => 'dropdown dropdown-hover']) }}>
    <div tabindex="0" role="button" class="btn m-1">{{ $filterLabel }}</div>
    <ul tabindex="-1" class="dropdown-content menu bg-base-100 rounded-box z-1 w-52 p-2 shadow-sm">
        {{ $slot }}
    </ul>
</div>
