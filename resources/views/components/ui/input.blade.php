@props([
    'label' => null,
    'name',
    'type' => 'text',
    'value' => null,
])

<div {{ $attributes->class(['w-full'])->except(['class']) }}>
    @if($label)
        <label for="{{ $name }}" class="form-label">{{ $label }}</label>
    @endif

    <input
        id="{{ $name }}"
        name="{{ $name }}"
        type="{{ $type }}"
        value="{{ old($name, $value) }}"
        {{ $attributes->merge(['class' => 'form-input']) }}
    />

    @error($name)
        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
    @enderror
</div>

