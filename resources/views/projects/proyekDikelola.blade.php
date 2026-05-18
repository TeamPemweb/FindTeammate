@extends('layouts.app')

@section('title', 'Proyek Dikelola')

@section('content')
<div class="flex flex-col gap-8">
    <x-back></x-back>

    @if(session('success'))
        <div class="bg-green-50 border border-green-200 rounded-2xl p-4 text-sm text-green-700">
            {{ session('success') }}
        </div>
    @endif

    <div class="w-full flex flex-col space-y-4 gap-12">
        <div class="flex flex-col gap-8">
            <x-project.projectHeader
                :name="'Dikelola oleh ' . ($project->owner->name ?? 'Unknown')"
                :title="$project->nama_proyek"
                :description="$project->deskripsi ?? ''"
                :project_field="is_array($project->bidang) ? $project->bidang : []"
            />
            <a href="{{ route('projects.edit', $project->project_id) }}">
                <x-button variant="primary" class="w-fit">Edit Proyek</x-button>
            </a>
        </div>

        <div class="flex flex-col gap-4">
            <h1 class="text-xl font-bold text-primary-8">Pelamar yang Masuk</h1>
            
            @php
                $pendingApps = $project->applications->where('status_lamaran', 'pending');
                $acceptedApps = $project->applications->where('status_lamaran', 'accepted');
                $rejectedApps = $project->applications->where('status_lamaran', 'rejected');
            @endphp

            <div id="lamaranTabs" class="flex flex-col gap-4">
                <div class="flex p-1 space-x-1 bg-slate-100 rounded-xl w-fit">
                    <button type="button" id="btn-pending" class="px-4 py-2 text-sm font-medium rounded-lg bg-white shadow transition-all" onclick="showTab('pending')">
                        Menunggu Konfirmasi ({{ $pendingApps->count() }})
                    </button>
                    <button type="button" id="btn-accepted" class="px-4 py-2 text-sm font-medium rounded-lg hover:bg-slate-200 transition-all text-slate-600" onclick="showTab('accepted')">
                        Diterima ({{ $acceptedApps->count() }})
                    </button>
                    <button type="button" id="btn-rejected" class="px-4 py-2 text-sm font-medium rounded-lg hover:bg-slate-200 transition-all text-slate-600" onclick="showTab('rejected')">
                        Ditolak ({{ $rejectedApps->count() }})
                    </button>
                </div>

                <!-- Tab Pending -->
                <div id="tab-pending" class="flex flex-col gap-3">
                    @forelse($pendingApps as $application)
                        <details class="group rounded-2xl border border-slate-200 bg-slate-50 overflow-hidden cursor-pointer open:bg-white open:shadow-sm">
                            <summary class="flex items-center justify-between px-5 py-4 list-none outline-none">
                                <div class="flex items-center gap-3">
                                    <div class="w-9 h-9 rounded-full bg-primary-5 flex items-center justify-center text-white text-sm font-bold">
                                        {{ strtoupper(substr($application->user->name ?? 'U', 0, 1)) }}
                                    </div>
                                    <div>
                                        <p class="text-sm font-semibold text-slate-800">{{ $application->user->name ?? 'Unknown' }}</p>
                                        <p class="text-xs text-slate-500">{{ $application->role->nama_peran ?? '-' }}</p>
                                    </div>
                                </div>
                                <div class="flex items-center gap-4">
                                    <span class="text-xs font-medium px-3 py-1 rounded-full bg-yellow-100 text-yellow-700">
                                        Menunggu Konfirmasi
                                    </span>
                                    <i data-lucide="chevron-down" class="w-4 h-4 text-slate-400 group-open:rotate-180 transition-transform"></i>
                                </div>
                            </summary>
                            
                            <div class="px-5 pb-5 border-t border-slate-100 mt-2 pt-4">
                                <h4 class="text-sm font-semibold text-slate-800 mb-3">Jawaban Pertanyaan:</h4>
                                <div class="flex flex-col gap-4">
                                    @if(is_array($application->jawaban_pertanyaan) && count($application->jawaban_pertanyaan) > 0)
                                        @foreach($application->jawaban_pertanyaan as $index => $jawaban)
                                            <div class="bg-slate-50 p-3 rounded-xl border border-slate-100">
                                                <p class="text-xs font-medium text-slate-500 mb-1">
                                                    Q: {{ $project->pertanyaan[$index] ?? 'Motivasi / Keahlian' }}
                                                </p>
                                                <p class="text-sm text-slate-800">{{ $jawaban }}</p>
                                            </div>
                                        @endforeach
                                    @else
                                        <p class="text-sm text-slate-500 italic">Tidak ada jawaban yang diberikan.</p>
                                    @endif
                                </div>
                                
                                <div class="flex gap-2 mt-6">
                                    <a href="{{ route('profilePelamar', $application->appl_id) }}" class="px-4 py-2 text-sm font-medium rounded-full bg-primary-50 text-primary-700 hover:bg-primary-100 transition-colors border border-primary-200">Profil Lengkap</a>
                                    <form action="{{ route('lamaran.accept', $application->appl_id) }}" method="POST" class="inline">
                                        @csrf
                                        @method('PATCH')
                                        <button type="submit" class="px-4 py-2 text-sm font-medium rounded-full bg-green-50 text-green-600 hover:bg-green-100 transition-colors border border-green-200">Terima Lamaran</button>
                                    </form>
                                    <form action="{{ route('lamaran.reject', $application->appl_id) }}" method="POST" class="inline" onsubmit="return confirm('Tolak lamaran ini?')">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="px-4 py-2 text-sm font-medium rounded-full bg-red-50 text-red-600 hover:bg-red-100 transition-colors border border-red-200">Tolak</button>
                                    </form>
                                </div>
                            </div>
                        </details>
                    @empty
                        <div class="text-center text-slate-500 py-8 rounded-2xl bg-slate-50 border border-slate-200 text-sm">
                            Tidak ada lamaran yang menunggu konfirmasi.
                        </div>
                    @endforelse
                </div>

                <!-- Tab Accepted -->
                <div id="tab-accepted" class="flex flex-col gap-3 hidden">
                    @forelse($acceptedApps as $application)
                        <details class="group rounded-2xl border border-green-50 bg-green-50 overflow-hidden cursor-pointer open:bg-white open:shadow-sm">
                            <summary class="flex items-center justify-between px-5 py-4 list-none outline-none">
                                <div class="flex items-center gap-3">
                                    <div class="w-9 h-9 rounded-full bg-green-500 flex items-center justify-center text-white text-sm font-bold">
                                        {{ strtoupper(substr($application->user->name ?? 'U', 0, 1)) }}
                                    </div>
                                    <div>
                                        <p class="text-sm font-semibold text-slate-800">{{ $application->user->name ?? 'Unknown' }}</p>
                                        <p class="text-xs text-slate-500">{{ $application->role->nama_peran ?? '-' }}</p>
                                    </div>
                                </div>
                                <div class="flex items-center gap-4">
                                    <span class="text-xs font-medium px-3 py-1 rounded-full bg-green-100 text-green-700">
                                        Diterima
                                    </span>
                                    <i data-lucide="chevron-down" class="w-4 h-4 text-slate-400 group-open:rotate-180 transition-transform"></i>
                                </div>
                            </summary>
                            
                            <div class="px-5 pb-5 border-t border-slate-100 mt-2 pt-4">
                                <h4 class="text-sm font-semibold text-slate-800 mb-3">Detail Kontak / Profil:</h4>
                                <div class="flex flex-col gap-4">
                                    <p class="text-sm text-slate-600">Pelamar ini sudah Anda terima. Anda dapat melihat detail kontaknya lebih lanjut melalui profil mereka.</p>
                                    <div class="flex gap-2">
                                        <a href="{{ route('profilePelamar', $application->appl_id) }}" class="px-4 py-2 text-sm font-medium rounded-full bg-primary-50 text-primary-700 hover:bg-primary-100 transition-colors border border-primary-200">Lihat Profil Lengkap</a>
                                    </div>
                                </div>
                            </div>
                        </details>
                    @empty
                        <div class="text-center text-slate-500 py-8 rounded-2xl bg-slate-50 border border-slate-200 text-sm">
                            Belum ada lamaran yang diterima.
                        </div>
                    @endforelse
                </div>

                <!-- Tab Rejected -->
                <div id="tab-rejected" class="flex flex-col gap-3 hidden">
                    @forelse($rejectedApps as $application)
                        <details class="group rounded-2xl border border-red-50 bg-red-50 overflow-hidden cursor-pointer open:bg-white open:shadow-sm">
                            <summary class="flex items-center justify-between px-5 py-4 list-none outline-none">
                                <div class="flex items-center gap-3">
                                    <div class="w-9 h-9 rounded-full bg-red-500 flex items-center justify-center text-white text-sm font-bold">
                                        {{ strtoupper(substr($application->user->name ?? 'U', 0, 1)) }}
                                    </div>
                                    <div>
                                        <p class="text-sm font-semibold text-slate-800">{{ $application->user->name ?? 'Unknown' }}</p>
                                        <p class="text-xs text-slate-500">{{ $application->role->nama_peran ?? '-' }}</p>
                                    </div>
                                </div>
                                <div class="flex items-center gap-4">
                                    <span class="text-xs font-medium px-3 py-1 rounded-full bg-red-100 text-red-700">
                                        Ditolak
                                    </span>
                                    <i data-lucide="chevron-down" class="w-4 h-4 text-slate-400 group-open:rotate-180 transition-transform"></i>
                                </div>
                            </summary>
                            
                            <div class="px-5 pb-5 border-t border-slate-100 mt-2 pt-4">
                                <h4 class="text-sm font-semibold text-slate-800 mb-3">Keterangan:</h4>
                                <div class="flex flex-col gap-4">
                                    <p class="text-sm text-slate-600">Pelamar ini telah Anda tolak.</p>
                                    <div class="flex gap-2">
                                        <a href="{{ route('profilePelamar', $application->appl_id) }}" class="px-4 py-2 text-sm font-medium rounded-full bg-primary-50 text-primary-700 hover:bg-primary-100 transition-colors border border-primary-200">Lihat Profil Lengkap</a>
                                    </div>
                                </div>
                            </div>
                        </details>
                    @empty
                        <div class="text-center text-slate-500 py-8 rounded-2xl bg-slate-50 border border-slate-200 text-sm">
                            Belum ada lamaran yang ditolak.
                        </div>
                    @endforelse
                </div>
            </div>
            
            <script>
                function showTab(tab) {
                    const tabs = ['pending', 'accepted', 'rejected'];
                    tabs.forEach(t => {
                        const tabContent = document.getElementById('tab-' + t);
                        const btn = document.getElementById('btn-' + t);
                        if (t === tab) {
                            tabContent.classList.remove('hidden');
                            btn.className = 'px-4 py-2 text-sm font-medium rounded-lg bg-white shadow transition-all';
                        } else {
                            tabContent.classList.add('hidden');
                            btn.className = 'px-4 py-2 text-sm font-medium rounded-lg hover:bg-slate-200 transition-all text-slate-600';
                        }
                    });
                }
            </script>
        </div>

        <x-project.titleCaption
            title="Deskripsi Proyek"
            :caption="$project->deskripsi ?? '-'"
        />

        <div class="flex flex-col gap-4">
            <x-project.title>Role yang Diperlukan</x-project.title>
            @forelse($project->roles as $role)
                <x-project.jobDescription
                    :role="$role->nama_peran"
                    :description="'Dibutuhkan ' . $role->jumlah_dibutuhkan . ' orang untuk peran ini.'"
                />
            @empty
                <p class="text-sm text-slate-400">Belum ada role yang ditentukan.</p>
            @endforelse
        </div>

        @if($project->informasi_pelamar)
            <div class="flex flex-col gap-4">
                <x-project.infoCard
                    title="Informasi kepada pelamar yang diterima"
                    :description="$project->informasi_pelamar"
                    link=""
                />
            </div>
        @endif

        <div class="pb-8">
            <form action="{{ route('projects.destroy', $project->project_id) }}" method="POST"
                onsubmit="return confirm('Apakah Anda yakin ingin menghapus proyek ini?')">
                @csrf
                @method('DELETE')
                <x-button type="submit" variant="danger" class="w-fit">Hapus Proyek</x-button>
            </form>
        </div>
    </div>
</div>
<script>lucide.createIcons();</script>
@endsection
