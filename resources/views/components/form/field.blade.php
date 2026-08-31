@props(['label', 'name', 'type' => 'text'])

<div>
<label class="label">{{ $label }}</label>
<input type="{{ $type }}" class="input" placeholder="{{ $label }}" name="{{ $name }}" required />

@error($name)
    <p class="text-error">{{ $message }}</p>
@enderror

</div>