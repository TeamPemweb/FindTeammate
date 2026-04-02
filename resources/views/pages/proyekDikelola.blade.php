@extends('layouts.app')

@section('title', 'Proyek Dikelola')

@section('content')
    <div class="w-full flex flex-col space-y-4 gap-4">
        <x-project.projectHeader title="Proyek 1" description="Deskripsi 1" roleTag="Role 1"></x-project.projectHeader>

        <div>
            <h1 class="text-xl font-bold text-primary-8">Pelamar yang Masuk</h1>
        </div>
    </div>
@endsection 