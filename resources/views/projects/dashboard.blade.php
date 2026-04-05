@extends('layouts.app')

@section('title', 'Dashboard')

@section('content')
    <section class="flex gap-13">
        <div class="flex flex-col gap-8 w-143.75">
            <h1 class="text-primary-8 text-2xl font-semibold">
                Sekilas Tentang Proyek Saya
            </h1>

            <x-segmentedButtons variant='dashboard'></x-segmentedButtons>

            <div class="flex flex-col gap-4">
                @yield('dashboard_content')
            </div>
        </div>

        <div class="flex flex-col gap-8">
            <h1 class="text-primary-8 text-2xl font-semibold">
                Informasi penting
            </h1>
        </div>
    </section>
    <x-chips>Dashboard</x-chips>
@endsection