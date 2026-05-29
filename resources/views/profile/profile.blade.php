@extends('layouts.app')

@section('title', 'Profile')

@section('content')
<div class="flex flex-col gap-12">
    <div class="flex flex-row items-center gap-14">
        <div class="flex flex-row gap-8">
            <img src="{{ Auth::user()->foto_profil_url ? asset('storage/' . Auth::user()->foto_profil_url) : asset('assets/pfp.png') }}" alt="Profile Picture" class="size-24 rounded-full object-cover">
            <div class="flex flex-col justify-center items-start gap-6">
                <div class="flex flex-col justify-start items-start gap-2">
                    <h1 class="text-3xl text-primary-8 font-bold">{{ Auth::user()->name }}</h1>
                    <p class="text-xl font-normal text-primary-8">{{ Auth::user()->email }}</p>
                </div>

                <div class="flex flex-row gap-4">
                    @forelse(Auth::user()->skills as $skill)
                        <x-chips>{{ $skill->nama_skill }}</x-chips>
                    @empty
                        <span class="text-sm text-gray-500 mt-2">Belum ada role</span>
                    @endforelse
                </div>

            </div>
            
        </div>

        <div class="flex justify-end items-center flex-1">
            <a href="{{ route('editProfile') }}">
                <x-button>Edit Profile</x-button>
            </a>
        </div>
    </div>

    <div class="flex flex-col gap-4">
        <h1 class="text-primary-8 font-bold text-2xl">Biodata Saya</h1>
        <p class="text-black font-normal text-base">{{ Auth::user()->bio ?? 'Belum ada biodata.' }}</p>
    </div>

    <div class="flex flex-col gap-4">
        <h1 class="text-primary-8 font-bold text-2xl">Portofolio Saya</h1>
        <div class="flex flex-col gap-2">
            @forelse(Auth::user()->portfolios as $portfolio)
                <div class="p-4 border border-gray-200 rounded-lg">
                    <h2 class="font-semibold text-lg text-primary-8">{{ $portfolio->judul }}</h2>
                </div>
            @empty
                <p class="text-gray-500 text-base">Belum ada portofolio.</p>
            @endforelse
        </div>
    </div>

    <form method="POST" action="{{ route('logout') }}">
        @csrf
        <button type="submit" class="w-full h-12 flex justify-center items-center border-primary-5 border-2 rounded-4xl hover:bg-primary-5/10 cursor-pointer">
            <p class="text-primary-8 font-semibold text-md">Log Out</p>
        </button>
    </form>
</div>
@endsection