@props(['is' => 'div'])

<{{ $is }} {{ $attributes(['class' => 'flex space-y-2 gap-2 bg-neutral border w-full rounded-2xl border-neutral px-4 py-2']) }}>
    {{ $slot }}
</{{ $is }}>