@extends('layouts.app')

@section('title', 'Proyek Diikuti')

@section('content')
<div class="flex flex-col gap-8">
<x-back></x-back>
    <div class="w-full flex flex-col space-y-4 gap-12">
        <div class="flex flex-col gap-8">
            <x-project.projectHeader name="Name" title="Proyek 1" description="Deskripsi 1" roleTag="Role 1"></x-project.projectHeader>
        </div>
        <div class="flex flex-col gap-4">
            <x-project.infoCard
                title="Informasi dari Pemilik Proyek"
                description="deskripsi"
                link="link"
            />
        </div>

        <x-project.titleCaption title="Rancangan Proyek" caption="Deskripsi Proyek"></x-project.titleCaption>

        <div class="flex flex-col gap-4">
            <x-project.title>Role yang Diperlukan</x-project.title>
            <x-project.jobDescription role="Role 1" description="Deskripsi 1"></x-project.jobDescription>
        </div>
    </div>
</div>
@endsection 