@extends('layouts.auth')

@section('title', 'Login')

@section('content')
  <div class="flex flex-col w-[461px] gap-9">
    <x-segmentedButtons></x-segmentedButtons>
    <div class="flex flex-col gap-2">
      <h1 class="text-4xl font-bold">Log In</h1>
      <p class="text-lg">Silahkan login menggunakan akun Find A Teammate</p>
    </div>

    <form method="POST" action="{{ route('login') }}" class="flex flex-col gap-6">
      @csrf

      @if ($errors->any())
        <div class="text-red-500 text-sm">
          {{ $errors->first() }}
        </div>
      @endif

      <x-textField fieldType="email" name="email" label="Email" placeholder="Masukkan email anda" :value="old('email')"></x-textField>

      <x-textField fieldType="password" name="password" label="Password" placeholder="Masukkan password anda"></x-textField>

      <x-button type="submit" variant="primary">Log In</x-button>
    </form>
  </div>

@endsection