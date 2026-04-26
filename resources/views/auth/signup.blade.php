@extends('layouts.auth')

@section('title', 'Sign Up')

@section('content')
    <div class="flex flex-col w-[461px] gap-9">
        <x-segmentedButtons></x-segmentedButtons>
        <div class="flex flex-col gap-2">
            <h1 class="text-4xl font-bold">Sign Up</h1>
            <p class="text-lg">Silahkan daftar untuk akses Find A Teammate</p>
        </div>

        <form method="POST" action="{{ route('signup') }}" class="flex flex-col gap-6">
            @csrf

            @if ($errors->any())
                <div class="text-red-500 text-sm">
                    {{ $errors->first() }}
                </div>
            @endif

            <x-textField fieldType="text" name="name" label="Nama" placeholder="Masukkan nama anda"></x-textField>

            <x-textField fieldType="email" name="email" label="Email" placeholder="Masukkan email anda"></x-textField>

            <x-textField fieldType="password" name="password" label="Password" placeholder="Masukkan password anda"></x-textField>

            <x-textField fieldType="password" name="password_confirmation" label="Konfirmasi Password" placeholder="Masukkan konfirmasi password anda"></x-textField>

            <x-button type="submit" variant="primary">Sign Up</x-button>
        </form>
    </div>

@endsection