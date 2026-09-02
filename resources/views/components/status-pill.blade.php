@props(['status' => 'pending'])

@php
    $classes = 'inline-block rounded-full border px-2 py-1 text-xs font-medium';

    if($status === 'pending') {
        $classes .= ' bg-amber-300/10 text-amber-400';
    } elseif($status === 'in_progress') {
        $classes .= ' bg-green-300/10 text-green-400';
    } elseif($status === 'completed') {
        $classes .= ' bg-blue-300/10 text-blue-400';
    }
@endphp

<span {{ $attributes(['class' => $classes]) }}>
    {{ $slot }}
</span>
