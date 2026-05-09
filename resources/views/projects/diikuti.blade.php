@extends('projects.dashboard')

@section('dashboard_content')
    <x-card.card-small 
        title="Platform E-Learning Fakultas Teknik"
        :tags="['WebDev', 'React', 'NodeJS']"
        period="05/11/2025 - 20/11/2025"
        ownerName="Andi Pratama" />

    <x-card.card-small 
        title="Aplikasi Monitoring Kualitas Udara"
        :tags="['IoT', 'Python', 'Dashboard']"
        period="12/11/2025 - 28/11/2025"
        ownerName="Dewi Lestari" />

    <a href="#" class="text-primary-5 text-sm font-semibold hover:underline text-center mt-2">
        Lihat lebih banyak
    </a>
@endsection