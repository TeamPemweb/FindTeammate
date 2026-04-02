@props(['name'])

<div {{ $attributes->merge(['class' => 'flex flex-row gap-2 justify-center items-center']) }}>
    <img src="{{ asset('assets/pfp.png') }}" alt="Profile" draggable='false' class="size-8">
    <p class="text-base font-normal text-black">{{ $name }}</p>
</div>