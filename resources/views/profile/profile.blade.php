@extends('layouts.app')

@section('title', 'Profile')

@section('content')
<div class="flex flex-col gap-12">
    <div class="flex flex-row items-center gap-14">
        <div class="flex flex-row gap-8">
            <img src="assets/pfp-large.png" alt="Profile Picture" class="size-40">
            <div class="flex flex-col justify-center items-start gap-6">
                <div class="flex flex-col justify-start items-start gap-2">
                    <h1 class="text-3xl text-primary-8 font-bold">Aurelia Callysta Mamahit</h1>
                    <p class="text-xl font-normal text-primary-8">Teknologi Informasi - 2024</p>
                </div>

                <div class="flex flex-row gap-4">
                    <x-chips>Roles goes here</x-chips>
                </div>

            </div>
            
        </div>

        <div class="flex justify-end items-center flex-1">
            <x-button>Edit Profile</x-button>
        </div>
    </div>

    <div class="flex flex-col gap-4">
        <h1 class="text-primary-8 font-bold text-2xl">Biodata Saya</h1>
        <p class="text-black font-normal text-base">Description goes here</p>
    </div>

    <div class="flex flex-col gap-4">
        <h1 class="text-primary-8 font-bold text-2xl">Portofolio Saya</h1>
    </div>

    <div>
        <h1 class="text-primary-8 font-bold text-2xl">Proyek Saya</h1>
    </div>

    <form method="POST" action="{{ route('logout') }}">
        @csrf
        <button type="submit" class="w-full h-12 flex justify-center items-center border-primary-5 border-2 rounded-4xl hover:bg-primary-5/10 cursor-pointer">
            <p class="text-primary-8 font-semibold text-md">Log Out</p>
        </button>
    </form>
</div>
@endsection