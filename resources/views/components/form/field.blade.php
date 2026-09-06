@props(['label', 'name', 'type' => 'text', 'placeholder' => null])

<div class="space-y-2">
    <label class="label">{{ $label }}</label>
    @if ($type === 'textarea')
        <textarea class="textarea w-full" placeholder="{{ $placeholder ?? $label }}" name="{{ $name }}">{{ old($name) }}</textarea>
    @else
        <input type="{{ $type }}" class="input w-full" placeholder="{{ $placeholder ?? $label }}"
            name="{{ $name }}" value="{{ old($name) }}" />
    @endif

    <x-form.error name="$name"/>

</div>
