@extends('layouts.app')

@section('title', 'Lamar Proyek')

@section('content')
<div class="mb-8">
  <x-back></x-back>
</div>

<div class="flex flex-col gap-8 pb-24">
    <div class="flex flex-col gap-2">
        <h1 class="text-primary-8 font-bold text-3xl">Silakan jawab pertanyaan dibawah ini untuk melamar proyek.</h1>
        <p class="text-slate-600 text-sm">Proyek: <strong>{{ $project->nama_proyek }}</strong></p>
    </div>

    @if(session('error'))
        <div class="bg-red-50 border border-red-200 text-red-600 px-4 py-3 rounded-xl text-sm">
            {{ session('error') }}
        </div>
    @endif

    @if ($errors->any())
        <div class="bg-red-50 border border-red-200 text-red-600 px-4 py-3 rounded-xl text-sm">
            <ul class="list-disc list-inside">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('storeLamaran', $project->project_id) }}" method="POST" class="flex flex-col gap-12">
        @csrf
        
        <div class="flex flex-col gap-4">
            <p class="text-xl font-semibold text-primary-8">Role apa yang ingin kamu ambil?</p>
            
            <div class="flex flex-col gap-4">
                @forelse($project->roles as $role)
                    <label class="flex items-center gap-3 cursor-pointer">
                        <input type="radio" name="role_id" value="{{ $role->roles_id }}" class="w-5 h-5 text-primary-6 cursor-pointer" required {{ old('role_id') == $role->roles_id ? 'checked' : '' }} />
                        <x-chips>{{ $role->nama_peran }} (Butuh {{ $role->jumlah_dibutuhkan }} orang)</x-chips>
                    </label>
                @empty
                    <p class="text-sm text-slate-500">Tidak ada role yang tersedia untuk proyek ini.</p>
                @endforelse
            </div>
        </div>

        <div class="space-y-8">
            <p class="text-xl font-semibold text-primary-8">Pertanyaan dari Pemilik Proyek</p>
            @if(is_array($project->pertanyaan) && count($project->pertanyaan) > 0)
                @foreach($project->pertanyaan as $index => $question)
                    <x-project.form
                        :question="$question"
                        name="jawaban[{{ $index }}]"
                        type="textarea"
                        placeholder="Tuliskan jawabanmu disini"
                        :value="old('jawaban.' . $index)"
                        rows="4"
                    />
                @endforeach
            @else
                <p class="text-sm text-slate-500">Tidak ada pertanyaan khusus untuk proyek ini. Silakan tuliskan motivasi atau keahlian Anda di bawah.</p>
                <x-project.form
                    question="Motivasi / Keahlian Utama"
                    name="jawaban[0]"
                    type="textarea"
                    placeholder="Tuliskan jawabanmu disini"
                    :value="old('jawaban.0')"
                    rows="4"
                />
            @endif
        </div>

        <div class="flex flex-col mt-4">
            <x-button type="submit" variant="primary" class="w-fit">Kirim Lamaran!</x-button>
        </div>
    </form>
</div>
@endsection
