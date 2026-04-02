<div {{ $attributes->merge(['class'=>'flex flex-col gap-2']) }}>
    <x-chips>{{ $role }}</x-chips>
    <x-project.caption>{{ $description }}</x-project.caption>
</div>