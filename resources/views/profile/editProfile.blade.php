@extends('layouts.app')

@section('title', 'Edit Profile')

@section('content')
<x-back></x-back>
    <div class="flex flex-col gap-14">
        <div class="flex flex-col justify-center items-center gap-4">
            <img src="assets/pfp-large.png" alt="Profile Photo" class="size-36">
            <x-button>Ubah Foto Profile</x-button>
        </div>

        <div class="flex flex-col gap-8">
            <x-textField label="Edit Biodata" ></x-textField>
            <x-textField label="Edit Skill" ></x-textField>
            <x-textField label="Edit Portofolio" ></x-textField>
        </div>

        <div class="flex gap-4">
            <x-button variant="secondary">Batalkan</x-button>
            <x-button variant="primary">Simpan Perubahan</x-button>
        </div>
    </div>
@endsection