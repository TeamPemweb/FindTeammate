@props([
    'message' => '',
])

<div class="flex items-start gap-3 p-4 border-b border-slate-100 last:border-b-0">
    <div class="flex-shrink-0 w-9 h-9 rounded-full bg-primary-0 flex items-center justify-center mt-0.5">
        <i data-lucide="bell" class="w-4 h-4 text-primary-5"></i>
    </div>

    <p class="text-sm text-slate-700 leading-relaxed">{{ $message }}</p>
</div>
