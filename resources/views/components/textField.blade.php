@props([
    'fieldType' => 'text',
    'label' => 'Text Field',
    'placeholder' => 'Placeholder',
    'name' => '',
])

@php
    $uniqueId = 'field-' . $name . '-' . uniqid();
@endphp

<div {{ $attributes->merge(['class' => 'flex flex-col gap-2']) }}>
    @if($fieldType !== 'search')
        <div class="text-xl font-semibold">
            {{ $label }}
        </div>
    @endif

    <div class="relative w-full">
        <input
            id="{{ $uniqueId }}"
            class="w-full text-sm h-12 transition-colors ease-in-out duration-200 rounded-4xl px-6 py-3 outline-1 outline-slate-200 focus:outline-2 focus:outline-primary-5"
            type="{{ $fieldType }}"
            name="{{ $name }}"
            placeholder="{{ $placeholder }}"
        >

        @if($fieldType === 'password')
            <i
                id="{{ $uniqueId }}-toggle"
                class="absolute text-primary-8 top-1/2 -translate-y-1/2 right-4 cursor-pointer"
                data-lucide="eye"
                onclick="
                    (function() {
                        var input = document.getElementById('{{ $uniqueId }}');
                        var icon = document.getElementById('{{ $uniqueId }}-toggle');
                        var isHidden = input.type === 'password';
                        input.type = isHidden ? 'text' : 'password';
                        icon.setAttribute('data-lucide', isHidden ? 'eye-off' : 'eye');
                        lucide.createIcons();
                    })()
                "
            ></i>
        @endif

        @if($fieldType === 'search')
            <i class="absolute text-primary-8 top-1/2 -translate-y-1/2 right-4" data-lucide="search"></i>
        @endif
    </div>
</div>

<script>
    lucide.createIcons();
</script>