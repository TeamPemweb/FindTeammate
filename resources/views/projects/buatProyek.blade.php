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

    <form action="{{ route('projects.store') }}" method="POST" class="space-y-8">
        @csrf
        {{-- Form standard --}}
        <x-project.form question="Nama Proyek" name="project_name" type="text" placeholder="Masukkan nama proyek" />
        <x-project.form question="Periode Waktu Pelamaran" name="application_period" type="date" placeholder="Input value" defaultIcon="calendar" />
        <x-project.form question="Bidang Proyek" name="project_field" type="text" placeholder="Masukkan bidang proyek, lalu tekan tombol spasi." />
        <x-project.form question="Deskripsi Proyek" name="project_plan" type="textarea" placeholder="Tuliskan jawabanmu disini" rows="5" />

        <div class="space-y-4">
            <h2 class="text-base font-semibold text-slate-900">Role yang diperlukan</h2>
            
            <div id="role-container" class="space-y-3">
                </div>

            <div class="flex flex-col gap-3 mt-4">
                <div id="role-input-wrapper" class="hidden flex gap-2">
                    <input type="text" id="role-name-input" class="flex-1 rounded-xl border border-slate-200 px-4 py-2 text-sm focus:outline-none focus:ring-2 focus:ring-primary-8" placeholder="Ketik nama role (misal: UI Designer)">
                    <button type="button" onclick="confirmAddRole()" class="bg-primary-8 text-white px-4 py-2 rounded-xl text-sm font-semibold">Simpan</button>
                </div>
                <div class="flex justify-start">
                    <x-button type="button" id="btn-show-role-input" onclick="showRoleInput()" variant="primary" class="rounded-full px-5 py-2 text-sm">+ Tambah Role Baru</x-button>
                </div>
            </div>
        </div>

        <div class="space-y-4">
            <h2 class="text-base font-semibold text-slate-900">Daftar Pertanyaan untuk Pelamar</h2>
            
            <div id="question-container" class="space-y-6">
                </div>

            <div class="flex justify-start mt-4">
                <x-button type="button" onclick="addQuestion()" variant="primary" class="rounded-full px-5 py-2 text-sm">+ Tambah Pertanyaan Baru</x-button>
            </div>
        </div>

        <x-project.form question="Informasi untuk pelamar setelah diterima" name="accepted_info" type="textarea" placeholder="Tuliskan jawabanmu disini" rows="5" />

        <div class="flex flex-col gap-4">
            <x-button type="submit" variant="primary">Unggah Proyek</x-button>
        </div>
    </form>
</div>

<script>
    function showRoleInput() {
        document.getElementById('role-input-wrapper').classList.remove('hidden');
        document.getElementById('btn-show-role-input').classList.add('hidden');
        document.getElementById('role-name-input').focus();
    }

    function confirmAddRole() {
        const input = document.getElementById('role-name-input');
        const roleName = input.value.trim();

        if (roleName !== "") {
            addRoleElement(roleName);
            input.value = "";
            document.getElementById('role-input-wrapper').classList.add('hidden');
            document.getElementById('btn-show-role-input').classList.remove('hidden');
        }
    }

    function addRoleElement(name) {
        const container = document.getElementById('role-container');
        const roleId = Date.now();

        const div = document.createElement('div');
        div.id = `role-item-${roleId}`;
        div.className = "flex items-center justify-between rounded-2xl border border-slate-200 bg-slate-50 px-4 py-3";
        div.innerHTML = `
            <input type="hidden" name="roles[${name}][name]" value="${name}">
            <span class="text-sm text-slate-700 font-medium">${name}</span>
            <div class="flex items-center gap-2">
                <button type="button" onclick="updateCount('${roleId}', -1)" class="h-8 w-8 rounded-full border border-slate-200 bg-white text-primary-8 hover:bg-slate-100">-</button>
                <input type="number" name="roles[${name}][count]" id="count-${roleId}" value="1" readonly class="w-8 bg-transparent text-center text-sm font-semibold focus:outline-none">
                <button type="button" onclick="updateCount('${roleId}', 1)" class="h-8 w-8 rounded-full border border-slate-200 bg-white text-primary-8 hover:bg-slate-100">+</button>
            </div>
        `;
        container.appendChild(div);
    }

    function updateCount(id, delta) {
        const countInput = document.getElementById(`count-${id}`);
        let currentCount = parseInt(countInput.value);
        currentCount += delta;

        if (currentCount < 1) {
            document.getElementById(`role-item-${id}`).remove();
        } else {
            countInput.value = currentCount;
        }
    }

    function addQuestion() {
        const container = document.getElementById('question-container');
        const qId = Date.now();

        const div = document.createElement('div');
        div.id = `question-item-${qId}`;
        div.className = "relative p-4 rounded-2xl border border-slate-100 bg-slate-50/50 space-y-3";
        
        div.innerHTML = `
            <div class="flex justify-between items-center">
                <label class="text-sm font-medium text-slate-600">Pertanyaan Baru</label>
                <button type="button" onclick="removeQuestion('${qId}')" class="text-red-500 hover:text-red-700 text-xs font-semibold">Hapus</button>
            </div>
            <textarea 
                name="questions[]" 
                rows="3" 
                class="w-full rounded-xl border border-slate-200 p-3 text-sm focus:outline-none focus:ring-2 focus:ring-primary-8"
                placeholder="Tuliskan pertanyaan untuk pelamar"></textarea>
        `;
        container.appendChild(div);
    }

    function removeQuestion(id) {
        document.getElementById(`question-item-${id}`).remove();
    }
</script>
@endsection