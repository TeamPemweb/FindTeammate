@extends('layouts.app')

@section('title', 'Cari Proyek')

@section('content')
<div class="w-full flex flex-col gap-6">
    <h1 class="text-primary-8 text-2xl font-semibold">Cari Proyek Aktif</h1>

    {{-- Search Form --}}
    <form method="GET" action="{{ route('cariProyek') }}" class="w-full">
        <div class="relative w-full">
            <input
                type="text"
                name="q"
                id="search-input"
                value="{{ $query }}"
                placeholder="Ketik nama proyek atau bidang yang ingin Anda cari..."
                class="w-full h-12 text-sm rounded-4xl px-6 pr-14 py-3 outline outline-1 outline-slate-200 focus:outline-2 focus:outline-primary-5 transition-all"
                autocomplete="off"
            />
            <button type="submit" class="absolute right-4 top-1/2 -translate-y-1/2 text-primary-8 hover:text-primary-5 transition-colors">
                <i data-lucide="search" class="w-5 h-5"></i>
            </button>
        </div>
    </form>

    {{-- Results Info --}}
    @if($query)
        <p class="text-sm text-slate-500">
            Menampilkan <span class="font-semibold text-slate-700">{{ $projects->total() }}</span> hasil untuk
            "<span class="font-semibold text-primary-8">{{ $query }}</span>"
        </p>
    @else
        <p class="text-sm text-slate-500">Menampilkan semua proyek aktif ({{ $projects->total() }} proyek)</p>
    @endif

    {{-- Project List --}}
    <div class="flex flex-col gap-4">
        @forelse($projects as $project)
            @php
                $tags   = !empty($project->bidang) ? (is_array($project->bidang) ? $project->bidang : array_filter(array_map('trim', explode(' ', $project->bidang)))) : [];
                $period = $project->periode_awal->format('d/m/Y') . ' - ' . $project->periode_akhir->format('d/m/Y');
                $roles  = $project->roles->map(fn($r) => ['name' => $r->nama_peran, 'count' => $r->jumlah_dibutuhkan])->toArray();
            @endphp
            <a href="{{ route('detailProyek', ['id' => $project->project_id]) }}" class="block w-full">
                <x-card.card-big
                    :id="$project->project_id"
                    :title="$project->nama_proyek"
                    :tags="$tags"
                    :period="$period"
                    :description="$project->deskripsi"
                    :roles="$roles"
                    :ownerName="$project->owner->name ?? 'Unknown'"
                />
            </a>
        @empty
            <div class="text-center py-16 rounded-2xl bg-slate-50 border border-slate-200">
                <i data-lucide="search-x" class="w-12 h-12 text-slate-300 mx-auto mb-3"></i>
                <p class="text-slate-500 font-medium">
                    @if($query)
                        Tidak ada proyek yang cocok dengan "<strong>{{ $query }}</strong>"
                    @else
                        Belum ada proyek aktif saat ini.
                    @endif
                </p>
                @if($query)
                    <a href="{{ route('cariProyek') }}" class="text-primary-5 text-sm hover:underline mt-2 inline-block">Tampilkan semua proyek</a>
                @endif
            </div>
        @endforelse
    </div>

    {{-- Pagination --}}
    @if($projects->hasPages())
        <div class="flex justify-center mt-4">
            {{ $projects->links() }}
        </div>
    @endif
</div>

<script>lucide.createIcons();</script>
@endsection
