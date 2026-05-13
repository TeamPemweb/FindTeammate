@extends('layouts.app')

@section('title', 'Proyek Saya')

@section('content')
    <div class="w-full flex flex-col space-y-4 gap-4">
        <x-segmentedButtons variant="proyekSaya"></x-segmentedButtons>

        @if(session('success'))
            <div class="bg-green-50 border border-green-200 rounded-2xl p-4 text-sm text-green-700">
                {{ session('success') }}
            </div>
        @endif

        <div class="flex flex-row w-full items-center gap-6">
            @if(request()->routeIs('proyekSaya.dikelola'))
            <a href="{{ route('buatProyek') }}">
                <x-button variant="primary">+ Buat Proyek Baru</x-button>
            </a>
            @endif
            <x-textField placeholder="Cari proyek kamu" fieldType="search" class="flex-1"></x-textField>
        </div>

        @if(request()->routeIs('proyekSaya.dikelola'))
            <div class="flex flex-col gap-4 w-full mt-4">
                @if(isset($projects) && $projects->count() > 0)
                    @foreach($projects as $project)
                        @php
                            $tags   = !empty($project->bidang) ? (is_array($project->bidang) ? $project->bidang : array_filter(array_map('trim', explode(' ', $project->bidang)))) : [];
                            $period = $project->periode_awal->format('d/m/Y') . ' - ' . $project->periode_akhir->format('d/m/Y');
                            $roles  = $project->roles->map(fn($r) => ['name' => $r->nama_peran, 'count' => $r->jumlah_dibutuhkan])->toArray();
                        @endphp
                        <a href="{{ route('proyekDikelola', ['id' => $project->project_id]) }}" class="w-full block">
                            <x-card.card-big
                                :id="$project->project_id"
                                :title="$project->nama_proyek"
                                :tags="$tags"
                                :period="$period"
                                :description="$project->deskripsi"
                                :roles="$roles"
                                ownerName="You"
                                :deleteUrl="route('projects.destroy', ['id' => $project->project_id])"
                            />
                        </a>
                    @endforeach
                @else
                    <div class="text-center text-slate-500 py-12 rounded-2xl bg-slate-50 border border-slate-200">
                        Belum ada proyek yang dikelola.
                        <div class="mt-4">
                            <a href="{{ route('buatProyek') }}" class="text-primary-5 text-sm font-semibold hover:underline">Buat proyek pertamamu!</a>
                        </div>
                    </div>
                @endif
            </div>
        @endif
    </div>
@endsection
