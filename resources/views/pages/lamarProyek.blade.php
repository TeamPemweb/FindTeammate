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
                <h2 class="text-base font-semibold text-slate-900">Pertanyaan 1</h2>
        <div class="space-y-4">
            <div 
                class="rounded-2xl border border-slate-200 bg-slate-50 p-4">
                <p class="mt-2 text-sm text-slate-700 leading-relaxed">Jawaban</p>
            </div>
            <h2 class="text-base font-semibold text-slate-900">Pertanyaan 2</h2>
        <div class="space-y-4">
            <div 
                class="rounded-2xl border border-slate-200 bg-slate-50 p-4">
                <p class="mt-2 text-sm text-slate-700 leading-relaxed">Jawaban</p>
            </div>
            <div class="flex flex-col gap">
         <x-button variant="primary">Kirim Lamaran!</x-button>
    </div>
</div>
@endsection