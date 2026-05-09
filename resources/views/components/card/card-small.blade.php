@props([
    'title' => '',
    'tags' => [],
    'period' => '',
    'ownerName' => '',
])

<div class="flex flex-col gap-3 p-5 rounded-2xl bg-slate-100 hover:shadow-md transition-shadow duration-300">
    <h3 class="text-lg font-bold text-primary-8 leading-tight">{{ $title }}</h3>

    @if(count($tags) > 0)
        <div class="flex flex-wrap gap-2">
            @foreach($tags as $tag)
                <span class="text-sm font-medium text-primary-5">#{{ $tag }}</span>
            @endforeach
        </div>
    @endif

    @if($period)
        <p class="text-sm text-slate-500">Periode : {{ $period }}</p>
    @endif

    <div class="flex justify-end">
        <x-pfp-name :name="$ownerName"></x-pfp-name>
    </div>
</div>
