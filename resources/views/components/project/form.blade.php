@props([
    'question' => 'Pertanyaan',
    'name' => 'answer',
    'value' => '',
    'type' => 'text',
    'placeholder' => 'Tuliskan jawabanmu disini',
    'rows' => 3,
    'id' => null,
    'icon' => null,
    'iconPosition' => 'right',
    'tag' => null,
    'buttonLabel' => null,
])

@php
    $fieldId = $id ?? $name;
    $defaultIcon = $icon;
    if (!$defaultIcon) {
        if ($type === 'date') {
            $defaultIcon = 'calendar';
        } elseif ($type === 'search') {
            $defaultIcon = 'search';
        }
    }
    $inputClass = 'w-full bg-transparent text-sm text-slate-700 outline-none ' . ($defaultIcon ? ($iconPosition === 'left' ? 'pl-10' : 'pr-10') : '');
@endphp

<h2 class="text-base font-semibold text-slate-900">{{ $question }}</h2>
<div class="space-y-4">
    <div class="rounded-2xl border border-slate-200 bg-slate-50 p-4">
        @switch($type)
            @case('textarea')
                <textarea
                    id="{{ $fieldId }}"
                    name="{{ $name }}"
                    class="w-full bg-transparent text-sm text-slate-700 outline-none resize-none"
                    placeholder="{{ $placeholder }}"
                    rows="{{ $rows }}">{{ $value }}</textarea>
                @break

            @case('date')
                <div class="relative">
                    <input
                        id="{{ $fieldId }}"
                        type="date"
                        name="{{ $name }}"
                        value="{{ $value }}"
                        class="w-full bg-transparent text-sm text-slate-700 outline-none {{ $defaultIcon ? 'pr-10' : '' }}"
                        placeholder="{{ $placeholder }}" />

                    @if($defaultIcon)
                        <i
                            class="absolute top-1/2 -translate-y-1/2 text-primary-8 right-4"
                            data-lucide="{{ $defaultIcon }}"></i>
                    @endif
                </div>
                @break

            @case('tag')
                <div class="flex flex-wrap items-center gap-2 rounded-3xl border border-slate-200 bg-white px-4 py-3">
                    @if($tag)
                        <span class="rounded-full bg-primary-5 px-3 py-1 text-sm text-primary-8">{{ $tag }}</span>
                    @endif
                    <input
                        id="{{ $fieldId }}"
                        type="text"
                        name="{{ $name }}"
                        value="{{ $value }}"
                        class="flex-1 bg-transparent text-sm text-slate-700 outline-none"
                        placeholder="{{ $placeholder }}" />
                </div>
                @break

            @default
                <div class="relative">
                    <input
                        id="{{ $fieldId }}"
                        type="{{ $type }}"
                        name="{{ $name }}"
                        value="{{ $value }}"
                        class="{{ $inputClass }}"
                        placeholder="{{ $placeholder }}" />

                    @if($defaultIcon)
                        <i
                            class="absolute top-1/2 -translate-y-1/2 text-primary-8 {{ $iconPosition === 'left' ? 'left-4' : 'right-4' }}"
                            data-lucide="{{ $defaultIcon }}"></i>
                    @endif
                </div>
        @endswitch
    </div>
</div>

@if($defaultIcon)
<script>
    lucide.createIcons();
</script>
@endif
