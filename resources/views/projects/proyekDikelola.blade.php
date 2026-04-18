@extends('layouts.app')

@section('title', 'Proyek Dikelola')

@section('content')
<div class="flex flex-col gap-8">
    <x-back></x-back>
    <div class="w-full flex flex-col space-y-4 gap-12">
        <div class="flex flex-col gap-8">
            <x-project.projectHeader 
                name="Dikelola oleh {{ $project['owner'] ?? 'Unknown' }}" 
                title="{{ $project['project_name'] }}" 
                description="{{ $project['project_plan'] }}" 
                :project_field="array_map('trim', explode(',', $project['project_field'] ?? ''))"
            />
            <x-button variant="primary" class="w-fit">Edit Proyek</x-button>
        </div>

        <div>
            <h1 class="text-xl font-bold text-primary-8">Pelamar yang Masuk</h1>
            <!-- nanti bisa looping pelamar dari JSON juga -->
        </div>

        <x-project.titleCaption 
            title="Rancangan Proyek" 
            caption="{{ $project['project_plan'] }}"
        />

        <div class="flex flex-col gap-4">
            <x-project.title>Role yang Diperlukan</x-project.title>
            @foreach($project['roles'] ?? [] as $role)
                <x-project.jobDescription role="{{ $role }}" description="Deskripsi untuk {{ $role }}"></x-project.jobDescription>
            @endforeach
        </div>

        <div class="flex flex-col gap-4">
            <x-project.infoCard
                title="Informasi kepada pelamar"
                description="{{ $project['accepted_info'] }}"
                link="{{ $project['link'] ?? '#' }}"
            />
        </div>
    </div>
</div>
@endsection
