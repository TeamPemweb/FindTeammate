@extends('layouts.app')

@section('title', 'Proyek Diikuti')

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
        <div class="flex flex-col gap-4">
            <x-project.infoCard
                title="Informasi dari Pemilik Proyek"
                :description="$project->informasi_pelamar ?? 'Belum ada informasi khusus dari pemilik proyek.'"
                link=""
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
    </div>
</div>
@endsection 