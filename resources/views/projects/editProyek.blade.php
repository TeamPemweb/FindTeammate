@extends('layouts.app')

@section('title', 'Edit Proyek')

@section('content')

<div class="mb-8">
  <x-back />
</div>

<div class="flex flex-col gap-8 pb-24">
    <div>
        <h1 class="text-primary-8 font-bold text-3xl">Edit Proyek</h1>
        <p class="text-sm text-slate-600 mt-2">Perbarui informasi proyek sebelum dibuka kembali untuk pendaftaran pelamar.</p>
    </div>

    @if($errors->any())
        <div class="bg-red-50 border border-red-200 rounded-2xl p-4">
            <ul class="text-sm text-red-600 list-disc list-inside space-y-1">
                @foreach($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    @if(session('success'))
        <div class="bg-green-50 border border-green-200 rounded-2xl p-4 text-sm text-green-700">
            {{ session('success') }}
        </div>
    @endif

    <form action="{{ route('projects.update', $project->project_id) }}" method="POST" class="space-y-8">
        @csrf
        @method('PUT')

        <x-project.form
            question="Nama Proyek"
            name="project_name"
            type="text"
            placeholder="Masukkan nama proyek"
            :value="old('project_name', $project->nama_proyek)"
        />

        <div class="space-y-4">
            <h2 class="text-base font-semibold text-slate-900">Periode Waktu Proyek</h2>
            <div class="flex gap-4">
                <div class="flex-1 space-y-1">
                    <label class="text-sm text-slate-500">Tanggal Mulai</label>
                    <div class="rounded-2xl border border-slate-200 bg-slate-50 p-4">
                        <input type="date" name="periode_awal"
                            value="{{ old('periode_awal', $project->periode_awal->format('Y-m-d')) }}"
                            class="w-full bg-transparent text-sm text-slate-700 outline-none" />
                    </div>
                </div>
                <div class="flex-1 space-y-1">
                    <label class="text-sm text-slate-500">Tanggal Selesai</label>
                    <div class="rounded-2xl border border-slate-200 bg-slate-50 p-4">
                        <input type="date" name="periode_akhir"
                            value="{{ old('periode_akhir', $project->periode_akhir->format('Y-m-d')) }}"
                            class="w-full bg-transparent text-sm text-slate-700 outline-none" />
                    </div>
                </div>
            </div>
        </div>

        <div class="space-y-4">
            <h2 class="text-base font-semibold text-slate-900">Bidang Proyek</h2>
            <div class="rounded-2xl border border-slate-200 bg-slate-50 p-4">
                <div class="flex flex-wrap gap-2 mb-2" id="tag-display"></div>
                <input type="text" id="tag-input"
                    class="w-full bg-transparent text-sm text-slate-700 outline-none"
                    placeholder="Masukkan bidang proyek, lalu tekan spasi atau Enter" />
                <input type="hidden" name="project_field" id="tag-hidden"
                    value="{{ old('project_field', json_encode($project->bidang ?? [])) }}" />
            </div>
            <p class="text-xs text-slate-400">Tekan Spasi atau Enter untuk menambah tag</p>
        </div>

        <x-project.form
            question="Deskripsi Proyek"
            name="description"
            type="textarea"
            placeholder="Tuliskan deskripsi proyek disini"
            rows="5"
            :value="old('description', $project->deskripsi)"
        />

        <div class="space-y-4">
            <h2 class="text-base font-semibold text-slate-900">Role yang diperlukan</h2>
            <div id="role-container" class="space-y-3"></div>
            <div class="flex flex-col gap-3 mt-4">
                <div id="role-input-wrapper" class="hidden flex gap-2">
                    <input type="text" id="role-name-input"
                        class="flex-1 rounded-xl border border-slate-200 px-4 py-2 text-sm focus:outline-none focus:ring-2 focus:ring-primary-8"
                        placeholder="Ketik nama role (misal: UI Designer)">
                    <button type="button" onclick="confirmAddRole()"
                        class="bg-primary-8 text-white px-4 py-2 rounded-xl text-sm font-semibold">Simpan</button>
                </div>
                <div class="flex justify-start">
                    <x-button type="button" id="btn-show-role-input" onclick="showRoleInput()" variant="primary" class="rounded-full px-5 py-2 text-sm">+ Tambah Role Baru</x-button>
                </div>
            </div>
        </div>

        <div class="space-y-4">
            <h2 class="text-base font-semibold text-slate-900">Daftar Pertanyaan untuk Pelamar</h2>
            <div id="question-container" class="space-y-6"></div>
            <div class="flex justify-start mt-4">
                <x-button type="button" onclick="addQuestion()" variant="primary" class="rounded-full px-5 py-2 text-sm">+ Tambah Pertanyaan Baru</x-button>
            </div>
        </div>

        <x-project.form
            question="Informasi untuk pelamar setelah diterima"
            name="accepted_info"
            type="textarea"
            placeholder="Tuliskan informasi untuk pelamar yang diterima"
            rows="5"
            :value="old('accepted_info', $project->informasi_pelamar)"
        />

        <div class="flex flex-wrap items-center justify-start gap-4">
            <x-button type="button" variant="secondary" onclick="window.history.back();">Batalkan</x-button>
            <x-button type="submit" variant="primary">Simpan Perubahan</x-button>
        </div>
    </form>
</div>

@php
    $rolesData = $project->roles->map(function($r) {
        return [
            'id'    => $r->roles_id,
            'name'  => $r->nama_peran,
            'count' => $r->jumlah_dibutuhkan,
        ];
    })->values()->toArray();
@endphp

<script>
    const existingRoles = @json($rolesData);

    const existingQuestions = @json($project->pertanyaan ?? []);

    let tags = [];
    const tagInput   = document.getElementById('tag-input');
    const tagDisplay = document.getElementById('tag-display');
    const tagHidden  = document.getElementById('tag-hidden');

    if (tagHidden.value) {
        try {
            const parsed = JSON.parse(tagHidden.value);
            if (Array.isArray(parsed)) tags = parsed;
        } catch(e) { tags = tagHidden.value ? [tagHidden.value] : []; }
        renderTags();
    }

    tagInput.addEventListener('keydown', function(e) {
        if (e.key === ' ' || e.key === 'Enter') {
            e.preventDefault();
            const val = this.value.trim();
            if (val && !tags.includes(val)) { tags.push(val); renderTags(); }
            this.value = '';
        } else if (e.key === 'Backspace' && this.value === '' && tags.length) {
            tags.pop(); renderTags();
        }
    });

    function renderTags() {
        tagDisplay.innerHTML = tags.map((t, i) => `
            <span class="inline-flex items-center gap-1 rounded-full bg-primary-5 px-3 py-1 text-xs font-medium text-primary-8">
                #${t}
                <button type="button" onclick="removeTag(${i})" class="hover:text-red-500 font-bold leading-none">&times;</button>
            </span>
        `).join('');
        tagHidden.value = JSON.stringify(tags);
    }

    function removeTag(i) { tags.splice(i, 1); renderTags(); }

    let roleIndex = 0;

    function showRoleInput() {
        document.getElementById('role-input-wrapper').classList.remove('hidden');
        document.getElementById('btn-show-role-input').classList.add('hidden');
        document.getElementById('role-name-input').focus();
    }

    function confirmAddRole() {
        const input    = document.getElementById('role-name-input');
        const roleName = input.value.trim();
        if (roleName !== '') {
            addRoleElement({ name: roleName, count: 1, id: null });
            input.value = '';
            document.getElementById('role-input-wrapper').classList.add('hidden');
            document.getElementById('btn-show-role-input').classList.remove('hidden');
        }
    }

    document.getElementById('role-name-input').addEventListener('keydown', function(e) {
        if (e.key === 'Enter') { e.preventDefault(); confirmAddRole(); }
    });

    function addRoleElement(role) {
        const container = document.getElementById('role-container');
        const idx = roleIndex++;
        const uid = Date.now() + idx;
        const idValue = role.id ?? '';

        const div = document.createElement('div');
        div.id = `role-item-${uid}`;
        div.className = 'flex items-center justify-between rounded-2xl border border-slate-200 bg-slate-50 px-4 py-3';
        div.innerHTML = `
            <input type="hidden" name="roles[${idx}][id]" value="${idValue}">
            <input type="hidden" name="roles[${idx}][name]" value="${role.name}">
            <span class="text-sm text-slate-700 font-medium">${role.name}</span>
            <div class="flex items-center gap-2">
                <button type="button" onclick="updateCount('${uid}',${idx},-1)" class="h-8 w-8 rounded-full border border-slate-200 bg-white text-primary-8 hover:bg-slate-100">-</button>
                <input type="number" name="roles[${idx}][count]" id="count-${uid}" value="${role.count}" min="1" readonly
                    class="w-8 bg-transparent text-center text-sm font-semibold focus:outline-none">
                <button type="button" onclick="updateCount('${uid}',${idx},1)" class="h-8 w-8 rounded-full border border-slate-200 bg-white text-primary-8 hover:bg-slate-100">+</button>
            </div>
        `;
        container.appendChild(div);
    }

    function updateCount(uid, idx, delta) {
        const countInput = document.getElementById(`count-${uid}`);
        let current = parseInt(countInput.value) + delta;
        if (current < 1) {
            document.getElementById(`role-item-${uid}`).remove();
        } else {
            countInput.value = current;
        }
    }

    function addQuestion(value = '') {
        const container = document.getElementById('question-container');
        const qId = Date.now();
        const div = document.createElement('div');
        div.id = `question-item-${qId}`;
        div.className = 'relative p-4 rounded-2xl border border-slate-100 bg-slate-50/50 space-y-3';
        div.innerHTML = `
            <div class="flex justify-between items-center">
                <label class="text-sm font-medium text-slate-600">Pertanyaan</label>
                <button type="button" onclick="removeQuestion('${qId}')" class="text-red-500 hover:text-red-700 text-xs font-semibold">Hapus</button>
            </div>
            <textarea name="questions[]" rows="3"
                class="w-full rounded-xl border border-slate-200 p-3 text-sm focus:outline-none focus:ring-2 focus:ring-primary-8"
                placeholder="Tuliskan pertanyaan untuk pelamar">${value}</textarea>
        `;
        container.appendChild(div);
    }

    function removeQuestion(id) {
        document.getElementById(`question-item-${id}`).remove();
    }

    existingRoles.forEach(role => addRoleElement(role));
    existingQuestions.forEach(q => addQuestion(q));
</script>

@endsection