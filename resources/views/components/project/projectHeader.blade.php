@props([
    'name',
    'title',
    'description',
    'project_field' => []
])
<div {{ $attributes->merge(['class' => 'flex flex-col gap-8']) }}>
    <div class="flex flex-col gap-4 justify-start items-start">
        <x-pfp-name :name="$name"></x-pfp-name>
        <div class="flex flex-col">
            <h1 class="text-3xl font-bold text-primary-8">{{ $title }}</h1>
            <p>{{ $description }}</p>
        </div>
        <div class="flex flex-row">
            <div class="flex flex-row gap-2">
                @foreach($project_field as $field)
                    <x-card.roleChips>{{ $field }}</x-card.roleChips>
                @endforeach
            </div>
        </div>
    </div>
</div>