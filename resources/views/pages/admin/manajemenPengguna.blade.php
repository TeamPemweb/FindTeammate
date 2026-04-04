@extends('layouts.admin')

@section('title', 'Manajemen Pengguna')

@section('content')
<div class="w-full flex flex-col space-y-4 gap-4">
    <div class="flex flex-row w-full items-center gap-6">
        <x-textField placeholder="Cari pengguna" fieldType="search" class="flex-1"></x-textField>
    </div>

    <div class="overflow-x-auto">
        @php
            $daftarPengguna = [
                ['nama' => 'Aurelia Callysta M.', 'email' => 'aur@student.ub.ac.id', 'foto' => '/assets/pfp.png'],
                ['nama' => 'Budi Santoso', 'email' => 'budi.s@student.ub.ac.id', 'foto' => '/assets/pfp.png'],
                ['nama' => 'Citra Dewi', 'email' => 'citradewi@student.ub.ac.id', 'foto' => '/assets/pfp.png'],
                ['nama' => 'Dimas Pratama', 'email' => 'dimas.pratama@student.ub.ac.id', 'foto' => '/assets/pfp.png'],
                ['nama' => 'Eka Putri', 'email' => 'ekaputri@student.ub.ac.id', 'foto' => '/assets/pfp.png'],
            ];
        @endphp
        <table class="w-full text-left border-collapse">
            <tbody>
                @foreach ($daftarPengguna as $pengguna)
                <tr class="border-b border-slate-50 hover:bg-slate-50 transition">
                    <td class="p-4">
                        <div class="flex items-center gap-4">
                            <img src="{{ $pengguna['foto'] }}" alt="Profil" class="w-10 h-10 rounded-full">
                            <div>
                                <p class="font-semibold text-xl text-slate-900">{{ $pengguna['nama'] }}</p>
                                <p class="text-base text-slate-500">{{ $pengguna['email'] }}</p>
                            </div>
                        </div>
                    </td>
                    <td class="p-4 text-right">
                        <x-button variant="danger">Nonaktifkan</x-button>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>

</div>
@endsection
