@extends('layouts.auth')

@section('title', 'Login')

@section('content')
  <div class="flex flex-col w-[461px] gap-9">
    <x-segmentedButtons></x-segmentedButtons>
    <div class="flex flex-col gap-2">
      <h1 class="text-4xl font-bold">Log In</h1>
      <p class="text-lg">Silahkan login menggunakan akun Find A Teammate</p>
    </div>
    
    <x-textField fieldType="text" label="Email" placeholder="Masukkan email anda"></x-textField>

    <x-textField fieldType="password" label="Password" placeholder="Masukkan password anda"></x-textField>

    <x-button variant="primary">Log In</x-button>
  </div>

@endsection