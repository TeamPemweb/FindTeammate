<div class="flex flex-col rounded-lg gap-4">
    <div class="flex flex-col gap-0">
        <x-card.title>
            {{ $title }}
        </x-card.title>
        <x-card.captions>
            {{ $caption }}
        </x-card.captions>
    </div>

    <x-card.captions>{{ $slot }}</x-card.captions>

    <div>
        <x-card.captions>{{ $slot }}</x-card.captions>
        
    </div>

</div>