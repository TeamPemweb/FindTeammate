@extends('layouts.admin')

@section('title', 'Dashboard')

@section('content')
    <div class="w-full flex flex-col space-y-4 gap-4">
        <div class="flex flex-row gap-8">
            <div class="flex flex-col flex-1 justify-center items-center bg-slate-100 rounded-4xl py-6 px-10 gap-4">
                <div class="flex flex-col items-center gap-2">
                    <i data-lucide="users"></i>
                    <h1 class="text-lg font-normal">Pengguna Aktif</h1>
                </div>

                <h1 class="text-4xl font-bold text-primary-8">100</h1>
            </div>

            <div class="flex flex-col flex-1 justify-center items-center bg-slate-100 rounded-4xl py-6 px-10 gap-4">
                <div class="flex flex-col items-center gap-2">
                    <i data-lucide="folder"></i>
                    <h1 class="text-lg font-normal">Proyek Aktif</h1>
                </div>

                <h1 class="text-4xl font-bold text-primary-8">100</h1>
            </div>

            <div class="flex flex-col flex-1 justify-center items-center bg-slate-100 rounded-4xl py-6 px-10 gap-4">
                <div class="flex flex-col items-center gap-2">
                    <i data-lucide="users"></i>
                    <h1 class="text-lg font-normal">Total Pengguna</h1>
                </div>

                <h1 class="text-4xl font-bold text-primary-8">100</h1>
            </div>
        </div>
    </div>
@endsection
