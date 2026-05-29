@extends('layouts.app')

@section('title', 'Edit Profile')

@section('content')
<x-back></x-back>
    <form method="POST" action="{{ route('updateProfile') }}" enctype="multipart/form-data" class="flex flex-col gap-14">
        @csrf
        @method('PUT')
        
        <div class="flex flex-col justify-center items-center gap-4">
            <img id="profilePreview" src="{{ Auth::user()->foto_profil_url ? asset('storage/' . Auth::user()->foto_profil_url) : asset('assets/pfp.png') }}" alt="Profile Photo" class="size-24 rounded-full object-cover">
            <x-button type="button" onclick="document.getElementById('foto_profil').click()">Ubah Foto Profile</x-button>
            <input type="file" id="foto_profil" name="foto_profil" class="hidden" accept="image/*" onchange="previewImage(event)">
        </div>

        <div class="flex flex-col gap-8">
            <x-textField label="Edit Biodata" name="bio" value="{{ Auth::user()->bio }}"></x-textField>
            <x-textField label="Edit Roles" name="skills" value="{{ Auth::user()->skills->pluck('nama_skill')->implode(', ') }}"></x-textField>
            <x-textField label="Edit Portofolio" name="portfolios" value="{{ Auth::user()->portfolios->pluck('judul')->implode(', ') }}"></x-textField>
        </div>

        <div class="flex gap-4">
            <x-button type="button" variant="secondary" onclick="window.history.back();">Batalkan</x-button>
            <x-button type="submit" variant="primary">Simpan Perubahan</x-button>
        </div>
    </form>

    <script>
        function previewImage(event) {
            const reader = new FileReader();
            reader.onload = function(){
                const output = document.getElementById('profilePreview');
                output.src = reader.result;
            };
            reader.readAsDataURL(event.target.files[0]);
        }
    </script>
@endsection