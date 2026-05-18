@extends('layouts.app')

@section('title', 'Lamaran Saya')

@section('content')
    <div class="w-full flex flex-col space-y-4 gap-4">
        <div class="flex flex-row w-full items-center gap-6 mb-4">
            <x-textField placeholder="Cari lamaran kamu" fieldType="search" class="flex-1"></x-textField>
        </div>

        @forelse($applications as $application)
            <x-card.application-item :application="$application" />
        @empty
            <div class="text-center text-gray-500 py-10">
                Belum ada lamaran proyek.
            </div>
        @endforelse
    </div>
@endsection