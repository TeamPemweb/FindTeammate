@props([
    'variant' => 'primary',
    'type'    => 'button',
    'disabled' => false
])

@php
    $variants = [
        'primary'   => 'bg-primary-5 text-white hover:bg-primary-3',
        'secondary' => 'bg-white text-primary-8 hover:bg-primary-8 hover:text-white border-1 border-primary-8',
        'danger'    => 'bg-red-500 text-white hover:bg-red-400',
        'sucess'    => 'bg-green-500 text-white hover:bg-green-400'
    ];

    $disabledStyle = $disabled 
        ? 'opacity-50 cursor-not-allowed grayscale pointer-events-none' 
        : 'cursor-pointer';

    $selectedVariant = $variants[$variant] ?? $variants['primary'];
@endphp

<button 
    type="{{ $type }}"
    @disabled($disabled)
    {{ $attributes->merge([
        'class' => "
            inline-flex items-center justify-center gap-2
            px-6 h-[48px] min-w-[140px] rounded-full
            
            font-sans text-base font-bold leading-none
            
            transition-all duration-200 ease-in-out cursor-pointer
                        
            disabled:opacity-50 disabled:cursor-not-allowed            
            {$selectedVariant}
            {$disabledStyle}
        "
    ]) }}
>
    {{ $slot }}
</button>