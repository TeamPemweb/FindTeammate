<div {{ $attributes->merge(['class' => 'flex flex-col gap-8']) }}>
    <div class="flex flex-col gap-4 justify-start items-start">
        <x-pfp-name name="Aurellia Callysta Mamahit"></x-pfp-name>
        <div class="flex flex-col">
            <h1 class="text-3xl font-bold text-primary-8">{{ $title }}</h1>
            <p>{{ $description }}</p>
        </div>
        <div class="flex flex-row">
            <x-card.roleChips>{{ $roleTag }}</x-card.roleChips>
        </div>
    </div>

    <x-button variant="primary">Edit Proyek</x-button>
</div>