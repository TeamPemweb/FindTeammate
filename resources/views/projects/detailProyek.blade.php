@extends('layouts.app')

@section('title', 'Detail Proyek')

@section('content')
<div class="flex flex-col gap-8">
<x-back></x-back>
    <div class="w-full flex flex-col space-y-4 gap-12">
        <div class="flex flex-col gap-8">
            <x-project.projectHeader 
                :name="$project->owner->name ?? 'Unknown'" 
                :title="$project->nama_proyek" 
                :description="$project->deskripsi ?? ''" 
                :project_field="is_array($project->bidang) ? $project->bidang : (is_string($project->bidang) ? json_decode($project->bidang, true) : [])"
            />
        </div>

        <x-project.titleCaption title="Rancangan Proyek" :caption="$project->deskripsi ?? '-'"></x-project.titleCaption>

        <div class="flex flex-col gap-4">
            <x-project.title>Role yang Diperlukan</x-project.title>
            @forelse($project->roles as $role)
                <x-project.jobDescription 
                    :role="$role->nama_peran" 
                    :description="'Dibutuhkan ' . $role->jumlah_dibutuhkan . ' orang untuk peran ini.'"
                ></x-project.jobDescription>
            @empty
                <p class="text-sm text-slate-400">Belum ada role yang ditentukan.</p>
            @endforelse
        </div>
        
        <div class="flex flex-col mt-4">
             <a href="{{ route('lamarProyek', ['id' => $project->project_id]) }}">
                 <x-button variant="primary">Lamar Proyek</x-button>
             </a>
        </div>
    </div>
</div>
@endsection
