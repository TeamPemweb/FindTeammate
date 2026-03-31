
@props([
    'fieldType' => 'text',
    'label' => 'Text Field',
    'placeholder' => 'Placeholder'
])

<div class="flex flex-col gap-2">
    <div class="text-xl font-semibold">
        {{ $label }}
    </div>
    <div class="relative">
        <input class="w-full text-sm h-12 transition-colors ease-in-out duration-200 rounded-4xl px-6 py-3 outline-1 outline-slate-200 focus:outline-2 focus:outline-primary-5" type="{{ $fieldType }}" placeholder="{{ $placeholder }}">
        
        @if($fieldType === 'password')
            <i class="absolute text-primary-8 top-1/2 -translate-y-1/2 right-4" data-lucide="eye"></i>
        @endif

    </div>
</div>

<script>
    lucide.createIcons();
</script>