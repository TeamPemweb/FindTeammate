<div {{ $attributes->merge(['class' => 'flex flex-row gap-2']) }}>
    <img src="assets/pfp.png" alt="Profile Photo" class="size-8">
    <p class="text-base font-normal text-black">{{ $slot }}</p>
</div>