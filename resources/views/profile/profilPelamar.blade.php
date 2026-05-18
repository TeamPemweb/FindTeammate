@extends('layouts.app')

@section('title', 'Profil Pelamar - ' . ($application->user->name ?? 'Unknown'))

@section('content')
<div class="mb-8">
  <x-back></x-back>
</div>
<div class="flex flex-col gap-12">
    <div class="flex flex-row items-center gap-14">
        <div class="flex flex-row gap-8">
            <img src="{{ asset('assets/pfp.png') }}" alt="Profile Picture" class="size-12 rounded-full object-cover">
            <div class="flex flex-col justify-center items-start gap-6">
                <div class="flex flex-col justify-start items-start gap-2">
                    <h1 class="text-3xl text-primary-8 font-bold">{{ $application->user->name ?? 'Unknown' }}</h1>
                    <p class="text-xl font-normal text-primary-8">{{ $application->user->prodi ?? 'Prodi Belum Diatur' }} - {{ $application->user->angkatan ?? '-' }}</p>
                </div>

                <div class="flex flex-row gap-4">
                    <x-chips>{{ $application->role->nama_peran ?? 'Unknown Role' }}</x-chips>
                </div>

            </div>
            
        </div>

    </div>

    <div class="flex flex-col gap-4">
        <h1 class="text-primary-8 font-bold text-2xl">Biodata</h1>
        <p class="text-black font-normal text-base">{{ $application->user->deskripsi ?? 'Belum ada deskripsi biodata yang ditulis oleh pelamar ini.' }}</p>
    </div>

    <div class="flex flex-col gap-4">
        <h1 class="text-primary-8 font-bold text-2xl">Portofolio & Kontak</h1>
        <p class="text-black font-normal text-base">
            Email: <a href="mailto:{{ $application->user->email }}" class="text-primary-6 hover:underline">{{ $application->user->email }}</a><br>
            @if(!empty($application->user->portofolio))
                Link: <a href="{{ $application->user->portofolio }}" target="_blank" class="text-primary-6 hover:underline">{{ $application->user->portofolio }}</a>
            @else
                Tidak ada portofolio yang dicantumkan.
            @endif
        </p>
    </div>

    <div class="flex flex-col gap-4">
        <h1 class="text-primary-8 font-bold text-2xl">Jawaban Pertanyaan</h1>
        <div class="flex flex-col gap-4">
            @if(is_array($application->jawaban_pertanyaan) && count($application->jawaban_pertanyaan) > 0)
                @foreach($application->jawaban_pertanyaan as $index => $jawaban)
                    <div class="bg-slate-50 p-4 rounded-xl border border-slate-100">
                        <p class="font-medium text-slate-800 mb-2">Q: {{ $application->project->pertanyaan[$index] ?? 'Pertanyaan' }}</p>
                        <p class="text-slate-600">{{ $jawaban }}</p>
                    </div>
                @endforeach
            @else
                <p class="text-slate-500 italic">Tidak ada jawaban pertanyaan.</p>
            @endif
        </div>
    </div>
    
    @if($application->status_lamaran === 'pending')
        <div class="flex flex-col gap-4 mt-4">
            <div class="grid grid-cols-2 gap-4">
                <form action="{{ route('lamaran.reject', $application->appl_id) }}" method="POST" onsubmit="return confirm('Tolak lamaran ini?')" class="w-full">
                    @csrf
                    @method('DELETE')
                    <x-button type="submit" variant="danger" class="w-full">Tolak Lamaran</x-button>
                </form>
                
                <form action="{{ route('lamaran.accept', $application->appl_id) }}" method="POST" class="w-full">
                    @csrf
                    @method('PATCH')
                    <x-button type="submit" variant="sucess" class="w-full bg-green-500 hover:bg-green-600">Terima Lamaran</x-button>
                </form>
            </div>
        </div>
    @else
        <div class="p-4 rounded-xl bg-slate-100 text-center text-slate-600 font-medium">
            Status Lamaran: {{ ucfirst($application->status_lamaran) }}
        </div>
    @endif
</div>
@endsection