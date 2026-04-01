@extends('layouts.app')

@section('title', 'Proyek Saya')

@section('content')
    <div class="w-full flex flex-col space-y-4 gap-4">
        <x-segmentedButtons variant="proyekSaya"></x-segmentedButtons>

        <div class="flex flex-row w-full items-center gap-6">
            @if(request()->routeIs('proyekSaya.dikelola'))
                <x-button variant="primary">+ Buat Proyek Baru</x-button>
            @endif
            <x-textField placeholder="Cari proyek kamu" fieldType="search" class="flex-1"></x-textField>
        </div>

    </div>
@endsection