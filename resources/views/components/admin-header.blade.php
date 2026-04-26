<header class="flex items-center justify-between z-50 h-28 text-primary-8">
    <h1 class="text-4xl w-auto font-bold">Selamat Datang, {{ Auth::user()->name }}!</h1>

    <div class="flex flex-row hover:bg-secondary-0.5 gap-2 justify-center items-center rounded-full pl-3 transition-colors duration-300 ease-in-out">
        <div onclick="window.location.href='{{ route('admin.profile') }}'" class="flex flex-col text-right cursor-pointer">
            <h3 class="text-base font-bold">{{ Auth::user()->name }}</h3>
            <p class="text-xs font-normal">{{ Auth::user()->email }}</p>
        </div>
        <div class="rounded-full">
            <img src="{{ Auth::user()->profile_picture ? asset('storage/' . Auth::user()->profile_picture) : asset('assets/pfp.png') }}" alt="Profile">
        </div>
    </div>
</header>