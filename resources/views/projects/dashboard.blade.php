@extends('layouts.app')

@section('title', 'Dashboard')

@section('content')
    @if(session('success'))
        <div class="mb-6 bg-green-50 border border-green-200 rounded-2xl p-4 text-sm text-green-700 flex items-center gap-2">
            <i data-lucide="check-circle" class="w-4 h-4 flex-shrink-0"></i>
            {{ session('success') }}
        </div>
    @endif

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
                @if(isset($notifications) && $notifications->count() > 0)
                    @foreach($notifications as $notification)
                        <x-card.notification-item 
                            :message="$notification->pesan" />
                    @endforeach
                @else
                    <div class="text-center text-slate-500 py-6 px-4 text-sm">
                        Tidak ada notifikasi baru.
                    </div>
                @endif
            </div>
        </div>
    </section>

    <section class="flex flex-col gap-6 mt-12">
        <h1 class="text-primary-8 text-2xl font-semibold">
            Rekomendasi Proyek untuk Kamu
        </h1>

        <div class="flex flex-col gap-4">
            @if(isset($recommendations) && $recommendations->count() > 0)
                @foreach($recommendations as $rec)
                    @php
                        $recTags   = !empty($rec->bidang) ? (is_array($rec->bidang) ? $rec->bidang : array_filter(array_map('trim', explode(' ', $rec->bidang)))) : [];
                        $recPeriod = $rec->periode_awal->format('d/m/Y') . ' - ' . $rec->periode_akhir->format('d/m/Y');
                        $recRoles  = $rec->roles->map(fn($r) => ['name' => $r->nama_peran, 'count' => $r->jumlah_dibutuhkan])->toArray();
                    @endphp
                    <a href="{{ route('detailProyek', ['id' => $rec->project_id]) }}" class="block">
                        <x-card.card-big
                            :id="$rec->project_id"
                            :title="$rec->nama_proyek"
                            :tags="$recTags"
                            :period="$recPeriod"
                            :description="$rec->deskripsi"
                            :roles="$recRoles"
                            :ownerName="$rec->owner->name ?? 'Unknown'"
                        />
                    </a>
                @endforeach
            @else
                <div class="text-center text-slate-500 py-12 rounded-2xl bg-slate-50 border border-slate-200 text-sm">
                    Belum ada proyek aktif dari pengguna lain.
                </div>
            @endif
        </div>
    </section>

<script>lucide.createIcons();</script>
@endsection