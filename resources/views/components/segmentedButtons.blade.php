
<div class="flex gap-5 bg-[#DDF1FF] rounded-full p-2 w-full max-w-md">
    {{-- Tombol Log In --}}
    <a href="{{ route('login') }}" class="flex items-center justify-center w-1/2 h-9 rounded-full font-bold transition-all duration-300
              {{ request()->routeIs('login') ? 'bg-primary-5 text-white shadow-md' : 'text-black hover:text-primary-5' }}">
        Log In
    </a>

    {{-- Tombol Sign Up --}}
    <a href="{{ route('signup') }}" class="flex items-center justify-center w-1/2 h-9 text-center py-2.5 rounded-full font-bold transition-all duration-300
              {{ request()->routeIs('signup') ? 'bg-[#0071C1] text-white shadow-md' : 'text-black hover:text-[#0071C1]' }}">
        Sign Up
    </a>
</div>