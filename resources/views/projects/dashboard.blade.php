@extends('layouts.app')

@section('title', 'Dashboard')

@section('content')
    <section class="flex gap-10">
        <div class="flex flex-col gap-6 flex-1 min-w-0">
            <h1 class="text-primary-8 text-2xl font-semibold">
                Sekilas Tentang Proyek Saya
            </h1>

            <x-segmentedButtons variant='dashboard'></x-segmentedButtons>

            <div class="flex flex-col gap-4">
                @yield('dashboard_content')
            </div>
        </div>

        <div class="flex flex-col gap-6 w-72 flex-shrink-0">
            <h1 class="text-primary-8 text-2xl font-semibold">
                Informasi Penting
            </h1>

            <div class="rounded-2xl bg-slate-100 overflow-hidden">
                <x-card.notification-item 
                    message="Budi Setiawan melamar di proyek Lorem Ipsum! Segera cek" />
            </div>
        </div>
    </section>

    <section class="flex flex-col gap-6 mt-12">
        <h1 class="text-primary-8 text-2xl font-semibold">
            Rekomendasi Proyek untuk Kamu
        </h1>

        <div class="flex flex-col gap-4">
            <x-card.card-big 
                title="Riset Deteksi Kanker Kulit Menggunakan Computer Vision"
                :tags="['AI', 'ComputerVision', 'ML']"
                period="01/11/2025 - 09/11/2025"
                description="Lorem ipsum dolor sit amet consectetur. Suspendisse malesuada maecenas quisque sit tincidunt. Lectus suspendisse velit venenatis aenean odio tellus. Ultricies ut convallis tempus dignissim aliquam consequat massa libero urna. Libero sollicitu..."
                :roles="[
                    ['name' => 'CompVis Engineer', 'count' => 1],
                    ['name' => 'Data Scientist', 'count' => 2],
                    ['name' => 'Data Scientist', 'count' => 2],
                    ['name' => 'ML Engineer', 'count' => 1],
                    ['name' => 'Backend Dev', 'count' => 2],
                ]"
                ownerName="Aurelia Callysta M." />

            <x-card.card-big 
                title="Riset Deteksi Kanker Kulit Menggunakan Computer Vision"
                :tags="['AI', 'ComputerVision', 'ML']"
                period="01/11/2025 - 09/11/2025"
                description="Lorem ipsum dolor sit amet consectetur. Suspendisse malesuada maecenas quisque sit tincidunt. Lectus suspendisse velit venenatis aenean odio tellus. Ultricies ut convallis tempus dignissim aliquam consequat massa libero urna. Libero sollicitu..."
                :roles="[
                    ['name' => 'CompVis Engineer', 'count' => 1],
                    ['name' => 'Data Scientist', 'count' => 2],
                    ['name' => 'Data Scientist', 'count' => 2],
                    ['name' => 'ML Engineer', 'count' => 1],
                    ['name' => 'Backend Dev', 'count' => 2],
                ]"
                ownerName="Aurelia Callysta M." />
        </div>
    </section>
@endsection