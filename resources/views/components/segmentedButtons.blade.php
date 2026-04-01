@props([
    'variant' => 'auth' 
])

@php
    $config = [
        'auth' => [
            ['name' => 'Log In', 'route' => 'login'],
            ['name' => 'Sign Up', 'route' => 'signup'],
        ],
        'dashboard' => [
            ['name' => 'Dikelola', 'route' => 'dashboard.dikelola'],
            ['name' => 'Diikuti', 'route' => 'dashboard.diikuti'],
        ],
        'proyekSaya' => [
            ['name' => 'Dikelola', 'route' => 'proyekSaya.dikelola'],
            ['name' => 'Diikuti', 'route' => 'proyekSaya.diikuti'],
        ],
    ];

    $buttons = $config[$variant] ?? $config['auth'];
@endphp

<div {{ $attributes->merge(['class' => 'flex gap-2 bg-[#DDF1FF] rounded-full p-2 w-full']) }}>
    @foreach($buttons as $btn)
        @php $isActive = request()->routeIs($btn['route']); @endphp
        
        <a href="{{ route($btn['route']) }}" 
           class="flex-1 flex items-center justify-center h-9 rounded-full font-bold transition-all duration-300 
           {{ $isActive 
                ? 'bg-primary-5 text-white shadow-md' 
                : 'text-black hover:text-primary-5' 
           }}">
            {{ $btn['name'] }}
        </a>
    @endforeach
</div>