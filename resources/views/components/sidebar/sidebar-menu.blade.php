@props(['link' => '#', 'active' => false])

@php
$classes = 'flex gap-4 items-center p-4 w-full hover:bg-primary-0.5 rounded-lg transition-colors duration-300 ease-in-out cursor-pointer';
if ($active) {
    $classes .= ' bg-primary-1';
}
@endphp

<a href="{{ $link }}" {{ $attributes->merge(['class' => $classes]) }}>
    {{ $slot }}
</a>