@extends('layouts.app')

@section('title', 'Detail Proyek')

@section('content')
<div class="flex flex-col gap-8">
<x-back></x-back>
    <div class="w-full flex flex-col space-y-4 gap-12">
        <div class="flex flex-col gap-8">
            <x-project.projectHeader name="Name" title="Proyek 1" description="Deskripsi 1" roleTag="Role 1"></x-project.projectHeader>
        </div>

        <x-project.titleCaption title="Rancangan Proyek" caption="Deskripsi Proyek"></x-project.titleCaption>

        <div class="flex flex-col gap-4">
            <x-project.title>Role yang Diperlukan</x-project.title>
            <x-project.jobDescription role="Role 1" description="Deskripsi 1"></x-project.jobDescription>
        </div>
        <div class="flex flex-col">
         <x-button variant="primary">Lamar Proyek</x-button>
    </div>
</div>
@endsection 