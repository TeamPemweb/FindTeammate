@props(['application'])

@php
    $statusColors = [
        'pending' => 'bg-yellow-500',
        'accepted' => 'bg-green-500',
        'rejected' => 'bg-red-500',
    ];

    $statusLabels = [
        'pending' => 'Menunggu Konfirmasi',
        'accepted' => 'Diterima',
        'rejected' => 'Ditolak',
    ];

    $statusColor = $statusColors[$application->status_lamaran] ?? 'bg-gray-500';
    $statusLabel = $statusLabels[$application->status_lamaran] ?? ucfirst($application->status_lamaran);

    $project = $application->project;
    $owner = $project->owner;
    $role = $application->role;
    
    // Format tanggal
    $periodeAwal = \Carbon\Carbon::parse($project->periode_awal)->format('d/m/Y');
    $periodeAkhir = \Carbon\Carbon::parse($project->periode_akhir)->format('d/m/Y');
@endphp

<a href="{{ $application->status_lamaran === 'accepted' ? route('proyekDiikuti', $project->project_id) : route('detailProyek', $project->project_id) }}" class="block w-full bg-[#F4F7F9] rounded-3xl p-6 flex flex-col gap-4 relative hover:bg-gray-100 transition-colors">
    <!-- Status -->
    <div class="flex items-center gap-3">
        <div class="h-4 w-24 rounded-full {{ $statusColor }}"></div>
        <p class="text-gray-700 text-sm font-medium">{{ $statusLabel }}</p>
    </div>

    <!-- Title -->
    <div class="flex justify-between items-start">
        <h2 class="text-xl font-bold text-[#1F2937] leading-tight w-[90%]">
            {{ $project->nama_proyek }}
        </h2>
    </div>

    <!-- Tags -->
    <div class="flex flex-wrap gap-3">
        @if(is_array($project->bidang))
            @foreach($project->bidang as $tag)
                <span class="text-gray-500 text-sm font-medium">#{{ $tag }}</span>
            @endforeach
        @endif
    </div>

    <!-- Periode -->
    <p class="text-gray-600 text-sm">
        Periode : {{ $periodeAwal }} - {{ $periodeAkhir }}
    </p>

    <!-- Footer: Role & Owner -->
    <div class="mt-4 flex flex-col md:flex-row md:justify-between md:items-center gap-4">
        <!-- Role -->
        <div class="flex items-center gap-3">
            <span class="text-gray-400 text-sm">Role yang didaftarkan:</span>
            <div class="bg-blue-100 text-black px-4 py-1 rounded-full text-sm font-medium">
                {{ $role->nama_peran }} ({{ $role->jumlah_dibutuhkan }})
            </div>
        </div>

        <!-- Owner -->
        <div class="flex items-center gap-3">
            <span class="text-gray-600 text-sm font-medium">{{ $owner->name }}</span>
            <img src="{{ $owner->profile_picture ? asset('storage/' . $owner->profile_picture) : asset('assets/pfp.png') }}" alt="{{ $owner->name }}" class="w-8 h-8 rounded-full object-cover">
        </div>
    </div>
</a>
