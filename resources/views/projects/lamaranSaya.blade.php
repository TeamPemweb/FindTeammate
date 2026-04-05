@extends('layouts.app')

@section('title', 'Lamaran Saya')

@section('content')
    <div class="w-full flex flex-col space-y-4 gap-4">
        <div class="flex flex-row w-full items-center gap-6">
            <x-textField placeholder="Cari lamaran kamu" fieldType="search" class="flex-1"></x-textField>
        </div>

    </div>
@endsection