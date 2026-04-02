@extends('layouts.app')

@section('title', 'Proyek Diikuti')

@section('content')
<div class="flex flex-col gap-8">
<x-back></x-back>
    <div class="w-full flex flex-col space-y-4 gap-12">
        <div class="flex flex-col gap-8">
            <x-project.projectHeader title="Proyek 1" description="Deskripsi 1" roleTag="Role 1"></x-project.projectHeader>
            <x-button variant="primary" class="w-fit">Edit Proyek</x-button>
        </div>

        <div>
            
        </div>

        <x-project.titleCaption title="Rancangan Proyek" caption="Deskripsi Proyek"></x-project.titleCaption>

        <div class="flex flex-col gap-4">
            <x-project.title>Role yang Diperlukan</x-project.title>
            <x-project.jobDescription role="Role 1" description="Deskripsi 1"></x-project.jobDescription>
        </div>
    </div>
</div>
@endsection 