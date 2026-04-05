@extends('layouts.app')

@section('title', 'profilePelamar')

@section('content')
<div class="mb-8">
  <x-back></x-back>
</div>
<div class="flex flex-col gap-12">
    <div class="flex flex-row items-center gap-14">
        <div class="flex flex-row gap-8">
            <img src="assets/pfp-large.png" alt="Profile Picture" class="size-40">
            <div class="flex flex-col justify-center items-start gap-6">
                <div class="flex flex-col justify-start items-start gap-2">
                    <h1 class="text-3xl text-primary-8 font-bold">Name</h1>
                    <p class="text-xl font-normal text-primary-8">Prodi - Angkatan</p>
                </div>

                <div class="flex flex-row gap-4">
                    <x-chips>Roles goes here</x-chips>
                </div>

            </div>
            
        </div>

    </div>

    <div class="flex flex-col gap-4">
        <h1 class="text-primary-8 font-bold text-2xl">Biodata</h1>
        <p class="text-black font-normal text-base">Description goes here</p>
    </div>

    <div class="flex flex-col gap-4">
        <h1 class="text-primary-8 font-bold text-2xl">Portofolio</h1>
    </div>

    <div class="flex flex-col gap-4">
        <h1 class="text-primary-8 font-bold text-2xl">Proyek</h1>
    </div>

    <div class="flex flex-col gap-4">
        <h1 class="text-primary-8 font-bold text-2xl">Jawaban Pertanyaan</h1>
    </div>
        <form action="#" method="POST" class="space-y-8">
        <x-project.form
            question="Pertanyaan 1?"
            name="question_1"
            type="textarea"
            placeholder="Tuliskan jawabanmu disini"
        />
        <div class="grid grid-cols-2 gap-4">
            <x-button variant="danger" class="w-full">Tolak</x-button>
            <x-button variant="sucess" class="w-full">Terima</x-button>
        </div>
    </div>
</div>
@endsection