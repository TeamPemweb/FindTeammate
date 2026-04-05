@extends('layouts.app')

@section('title', 'Lamar Proyek')

@section('content')
<div class="mb-8">
  <x-back></x-back>
</div>
    <div class="flex flex-col gap-8">
        <h1 class="text-primary-8 font-bold text-3xl">Silakan jawab pertanyaan dibawah ini untuk melamar proyek.</h1>
    <div>
</div>
    <div class="flex flex-col gap-12">
        <div class="flex flex-col gap-4">
            <p class="text-xl font-normal text-primary-8">Role apa yang ingin kamu ambil?</p>
            
            <div class="flex flex-col gap-4">
                <label class="flex items-center gap-3 cursor-pointer">
                    <input type="radio" name="role" value="role 1" class="w-6 h-6 cursor-pointer" />
                    <x-chips>Role 1</x-chips>
                </label>
                
                <label class="flex items-center gap-3 cursor-pointer">
                    <input type="radio" name="role" value="role 2" class="w-6 h-6 cursor-pointer" />
                    <x-chips>Role 2</x-chips>
                </label>
            </div>
        </div>
        <form action="#" method="POST" class="space-y-8">
        <x-project.form
            question="Pertanyaan 1"
            name="question_1"
            type="textarea"
            placeholder="Tuliskan jawabanmu disini"
        />
            <div class="flex flex-col gap">
         <x-button variant="primary">Kirim Lamaran!</x-button>
    </div>
</div>
@endsection