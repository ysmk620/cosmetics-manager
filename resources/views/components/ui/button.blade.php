@props([
    'variant' => 'primary', // primary | secondary | ghost
    'type' => 'button',     // button | submit
    'as' => 'button',       // button | a
])

@php
    $variantClass = match ($variant) {
        'secondary' => 'btn-secondary',
        'ghost' => 'btn-ghost',
        default => 'btn-primary',
    };
@endphp

@if($as === 'a')
  <a {{ $attributes->merge(['class' => "btn {$variantClass}"]) }}>
    {{ $slot }}
  </a>
@else
  <button type="{{ $type }}" {{ $attributes->merge(['class' => "btn {$variantClass}"]) }}>
    {{ $slot }}
  </button>
@endif
