@extends('layouts.auth')

@section('title', 'Sign Up')

@section('content')
    <div class="flex flex-col w-[461px] gap-9">
        <x-segmentedButtons></x-segmentedButtons>
        <div class="flex flex-col gap-2">
        <h1 class="text-4xl font-bold">Sign Up</h1>
        <p class="text-lg">Silahkan daftar untuk akses Find A Teammate</p>
        </div>
        
        <x-textField fieldType="text" label="Email" placeholder="Masukkan email anda"></x-textField>

        <x-textField fieldType="password" label="Password" placeholder="Masukkan password anda"></x-textField>
        
        <x-textField fieldType="password" label="Konfirmasi Password" placeholder="Masukkan konfirmasi password anda"></x-textField>

        <x-button variant="primary">Sign Up</x-button>
    </div>


@endsection