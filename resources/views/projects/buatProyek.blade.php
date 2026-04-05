@extends('layouts.app')

@section('title', 'Buat Proyek')

@section('content')
<div class="mb-8">
  <x-back></x-back>
</div>
<div class="flex flex-col gap-8 pb-24">
    <div>
        <h1 class="text-primary-8 font-bold text-3xl">Silakan lengkapi detail dibawah untuk membuat proyek baru.</h1>
</div>

    <form action="#" method="POST" class="space-y-8">
        <x-project.form
            question="Nama Proyek"
            name="project_name"
            type="text"
            placeholder="Masukkan nama proyek"
        />

        <x-project.form
            question="Periode Waktu Pelamaran"
            name="application_period"
            type="date"
            placeholder="Input value"
            defaultIcon="calendar"
        />

        <x-project.form
            question="Bidang Proyek"
            name="project_field"
            type="text"
            placeholder="Masukkan bidang proyek, lalu tekan tombol spasi."
        />

        <x-project.form
            question="Deskripsi Proyek"
            name="project_plan"
            type="textarea"
            placeholder="Tuliskan jawabanmu disini"
            rows="5"
        />
        <div class="space-y-4">
            <h2 class="text-base font-semibold text-slate-900">Role yang diperlukan</h2>
        </div>

        <div class="space-y-3">
            <div class="flex items-center justify-between rounded-2xl border border-slate-200 bg-slate-50 px-4 py-3">
                <span class="text-sm text-slate-700">Front-End Developer</span>
                <div class="flex items-center gap-2">
                    <button type="button" class="h-8 w-8 rounded-full border border-slate-200 bg-slate-100 text-primary-8">-</button>
                    <span class="min-w-[28px] text-center text-sm font-semibold">1</span>
                    <button type="button" class="h-8 w-8 rounded-full border border-slate-200 bg-slate-100 text-primary-8">+</button>
                </div>
            </div>

            <div class="flex items-center justify-between rounded-2xl border border-slate-200 bg-slate-50 px-4 py-3">
                <span class="text-sm text-slate-700">Back-End Developer</span>
                <div class="flex items-center gap-2">
                    <button type="button" class="h-8 w-8 rounded-full border border-slate-200 bg-slate-100 text-primary-8">-</button>
                    <span class="min-w-[28px] text-center text-sm font-semibold">1</span>
                    <button type="button" class="h-8 w-8 rounded-full border border-slate-200 bg-slate-100 text-primary-8">+</button>
                </div>
            </div>
        </div>

        <div class="flex justify-start">
            <x-button type="button" variant="primary" class="rounded-full px-5 py-2 text-sm">+ Tambah Role Baru</x-button>
        </div>

        <div class="space-y-4">
            <h2 class="text-base font-semibold text-slate-900">Daftar Pertanyaan untuk Pelamar</h2>
        </div>

            <x-project.form
            question=""
            name="applicant_question_1"
            type="textarea"
            placeholder="Tuliskan pertanyaan untuk pelamar"
            rows="3"
        />

        <div class="flex justify-start">
            <x-button type="button" variant="primary" class="rounded-full px-5 py-2 text-sm">+ Tambah Pertanyaan Baru</x-button>
        </div>

        <x-project.form
            question="Informasi untuk pelamar setelah diterima"
            name="accepted_info"
            type="textarea"
            placeholder="Tuliskan jawabanmu disini"
            rows="5"
        />

        <div class="flex flex-col gap-4">
            <x-button type="submit" variant="primary">Unggah Proyek</x-button>
        </div>
    </form>
</div>
@endsection