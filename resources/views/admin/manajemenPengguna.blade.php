@extends('layouts.admin')

@section('title', 'Manajemen Pengguna')

@section('content')
<div class="w-full flex flex-col space-y-4 gap-4">
    @if(session('success'))
        <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded relative" role="alert">
            <span class="block sm:inline">{{ session('success') }}</span>
        </div>
    @endif

    <div class="flex flex-row w-full items-center gap-6">
        <x-textField name="search_user" placeholder="Cari pengguna" fieldType="search" class="flex-1"></x-textField>
    </div>

    <div class="overflow-x-auto">
        <table class="w-full text-left border-collapse">
            <tbody id="userTableBody">
                @foreach ($penggunaList as $pengguna)
                <tr class="border-b border-slate-50 hover:bg-slate-50 transition">
                    <td class="p-4">
                        <div class="flex items-center gap-4">
                            <img src="{{ $pengguna->foto_profil_url ?? '/assets/pfp.png' }}" alt="Profil" class="w-10 h-10 rounded-full">
                            <div>
                                <p class="font-semibold text-xl text-slate-900">{{ $pengguna->name }}</p>
                                <p class="text-base text-slate-500">{{ $pengguna->email }}</p>
                            </div>
                        </div>
                    </td>
                    <td class="p-4 text-right">
                        <form action="{{ route('admin.pengguna.toggle', $pengguna->id) }}" method="POST" class="inline-flex items-center justify-end gap-3 w-full">
                            @csrf
                            @if($pengguna->suspended_until && $pengguna->suspended_until > now())
                                <span class="text-sm text-red-500 font-medium">Sisa: {{ round(now()->diffInDays($pengguna->suspended_until)) }} hari</span>
                                <x-button type="submit" variant="primary">Aktifkan</x-button>
                            @else
                                <x-button type="submit" variant="danger">Nonaktifkan</x-button>
                            @endif
                        </form>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
        
        <div class="mt-4" id="paginationContainer">
            {{ $penggunaList->links() }}
        </div>
    </div>
</div>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        const searchInput = document.querySelector('input[name="search_user"]');
        const userTableBody = document.getElementById('userTableBody');
        const paginationContainer = document.getElementById('paginationContainer');

        let timeout = null;

        searchInput.addEventListener('input', function() {
            clearTimeout(timeout);
            timeout = setTimeout(() => {
                fetchUsers(this.value);
            }, 300); // 300ms debounce
        });

        function fetchUsers(query) {
            fetch(`/admin/api/pengguna/search?q=${encodeURIComponent(query)}`)
                .then(response => response.json())
                .then(data => {
                    renderUsers(data.data);
                    
                    // Update pagination if needed, or just hide it during search for simplicity
                    if (query.trim() === '') {
                        paginationContainer.style.display = 'block';
                    } else {
                        paginationContainer.style.display = 'none'; // simple approach
                    }
                })
                .catch(error => console.error('Error fetching users:', error));
        }

        function renderUsers(users) {
            userTableBody.innerHTML = '';
            
            if (users.length === 0) {
                userTableBody.innerHTML = `<tr><td colspan="2" class="p-4 text-center text-slate-500">Tidak ada pengguna ditemukan.</td></tr>`;
                return;
            }

            users.forEach(user => {
                const sisaHariText = user.isSuspended ? `<span class="text-sm text-red-500 font-medium mr-3">Sisa: ${user.sisaHari} hari</span>` : '';
                
                // Note: using JS template literal with hardcoded classes because blade components 
                // won't compile in pure JS. I'll replace it with standard HTML classes matching the blade component.
                const btnRender = user.isSuspended 
                    ? `<button type="submit" class="bg-[#4361EE] hover:bg-[#3249B3] text-white px-4 py-2 rounded-lg font-medium transition-colors">Aktifkan</button>`
                    : `<button type="submit" class="bg-red-500 hover:bg-red-600 text-white px-4 py-2 rounded-lg font-medium transition-colors">Nonaktifkan</button>`;

                const csrfToken = document.querySelector('meta[name="csrf-token"]')?.getAttribute('content') || '{{ csrf_token() }}';

                const tr = document.createElement('tr');
                tr.className = 'border-b border-slate-50 hover:bg-slate-50 transition';
                tr.innerHTML = `
                    <td class="p-4">
                        <div class="flex items-center gap-4">
                            <img src="${user.foto}" alt="Profil" class="w-10 h-10 rounded-full">
                            <div>
                                <p class="font-semibold text-xl text-slate-900">${user.name}</p>
                                <p class="text-base text-slate-500">${user.email}</p>
                            </div>
                        </div>
                    </td>
                    <td class="p-4 text-right">
                        <form action="${user.toggleUrl}" method="POST" class="inline-flex items-center justify-end gap-3 w-full">
                            <input type="hidden" name="_token" value="${csrfToken}">
                            ${sisaHariText}
                            ${btnRender}
                        </form>
                    </td>
                `;
                userTableBody.appendChild(tr);
            });
        }
    });
</script>
@endsection
