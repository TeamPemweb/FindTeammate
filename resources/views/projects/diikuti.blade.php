@extends('projects.dashboard')

@section('dashboard_content')
    @if(isset($applications) && $applications->count() > 0)
        @foreach($applications as $application)
            @php
                $project = $application->project;
                $tags = !empty($project->bidang) ? (is_array($project->bidang) ? $project->bidang : array_filter(array_map('trim', explode(' ', $project->bidang)))) : [];
                $period = $project->periode_awal->format('d/m/Y') . ' - ' . $project->periode_akhir->format('d/m/Y');
                $ownerName = $project->owner->name ?? 'Unknown';
            @endphp
            <a href="{{ route('proyekDiikuti', $project->project_id) }}" class="block">
                <x-card.card-small 
                    :title="$project->nama_proyek"
                    :tags="$tags"
                    :period="$period"
                    :ownerName="$ownerName" />
            </a>
        @endforeach

        <a href="{{ route('proyekSaya.diikuti') }}" class="text-primary-5 text-sm font-semibold hover:underline text-center mt-2 block">
            Lihat lebih banyak
        </a>
    @else
        <div class="text-center text-slate-500 py-8 text-sm">
            Belum ada proyek yang diikuti.
        </div>
    @endif
@endsection