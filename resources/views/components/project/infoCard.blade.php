<div class="bg-slate-50 border border-sky-100 rounded-2xl p-6 space-y-3">
    <h2 class="text-lg font-bold text-slate-900">{{ $title }}</h2>
    <p class="text-sm text-slate-600 leading-relaxed">{{ $description }}</p>
    @if($link)
        <a href="{{ $link }}" class="text-sm text-blue-600 hover:underline break-all">{{ $link }}</a>
    @endif
</div>