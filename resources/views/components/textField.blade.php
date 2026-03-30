@props([
    'fieldType' => 'text',
    'label' => 'Text Field',
    'placeholder' => 'Placeholder'
])

<div class="flex flex-col gap-2">
    <div class="text-xl font-semibold">
        {{ $label }}
    </div>
    <input class="text-sm h-12 transition-colors ease-in-out duration-200 rounded-4xl px-6 py-3 outline-1 outline-slate-200 focus:outline-2 focus:outline-primary-5" type="{{ $fieldType }}" placeholder="{{ $placeholder }}">
</div>