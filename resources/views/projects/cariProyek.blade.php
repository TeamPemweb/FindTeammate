@extends('layouts.app')

@section('title', 'Cari Proyek')

@section('content')
<div class="w-full flex flex-col gap-6">
    <h1 class="text-primary-8 text-2xl font-semibold">Cari Proyek Aktif</h1>

    {{-- Search Form --}}
    <form method="GET" action="{{ route('cariProyek') }}" class="w-full" onsubmit="return false;">
        <div class="relative w-full">
            <input
                type="text"
                name="q"
                id="search-input"
                value="{{ $query }}"
                placeholder="Ketik nama proyek atau bidang yang ingin Anda cari..."
                class="w-full h-12 text-sm rounded-4xl px-6 pr-14 py-3 outline outline-1 outline-slate-200 focus:outline-2 focus:outline-primary-5 transition-all"
                autocomplete="off"
            />
            <button type="submit" class="absolute right-4 top-1/2 -translate-y-1/2 text-primary-8 hover:text-primary-5 transition-colors">
                <i data-lucide="search" class="w-5 h-5"></i>
            </button>
        </div>
    </form>

    {{-- Results Info --}}
    <p id="results-info" class="text-sm text-slate-500">
        @if($query)
            Menampilkan <span class="font-semibold text-slate-700">{{ $projects->total() }}</span> hasil untuk
            "<span class="font-semibold text-primary-8">{{ $query }}</span>"
        @else
            Menampilkan semua proyek aktif ({{ $projects->total() }} proyek)
        @endif
    </p>

    {{-- Project List --}}
    <div id="project-list" class="flex flex-col gap-4">
        @forelse($projects as $project)
            @php
                $tags   = !empty($project->bidang) ? (is_array($project->bidang) ? $project->bidang : array_filter(array_map('trim', explode(' ', $project->bidang)))) : [];
                $period = $project->periode_awal->format('d/m/Y') . ' - ' . $project->periode_akhir->format('d/m/Y');
                $roles  = $project->roles->map(fn($r) => ['name' => $r->nama_peran, 'count' => $r->jumlah_dibutuhkan])->toArray();
            @endphp
            <a href="{{ route('detailProyek', ['id' => $project->project_id]) }}" class="block w-full">
                <x-card.card-big
                    :id="$project->project_id"
                    :title="$project->nama_proyek"
                    :tags="$tags"
                    :period="$period"
                    :description="$project->deskripsi"
                    :roles="$roles"
                    :ownerName="$project->owner->name ?? 'Unknown'"
                />
            </a>
        @empty
            <div class="text-center py-16 rounded-2xl bg-slate-50 border border-slate-200">
                <i data-lucide="search-x" class="w-12 h-12 text-slate-300 mx-auto mb-3"></i>
                <p class="text-slate-500 font-medium">
                    @if($query)
                        Tidak ada proyek yang cocok dengan "<strong>{{ $query }}</strong>"
                    @else
                        Belum ada proyek aktif saat ini.
                    @endif
                </p>
                @if($query)
                    <a href="#" onclick="document.getElementById('search-input').value=''; fetchProjects(''); return false;" class="text-primary-5 text-sm hover:underline mt-2 inline-block">Tampilkan semua proyek</a>
                @endif
            </div>
        @endforelse
    </div>

    {{-- Pagination --}}
    <div id="pagination-container" class="flex justify-center mt-4">
        @if($projects->hasPages())
            {{ $projects->links() }}
        @endif
    </div>
</div>
<script>
    document.addEventListener('DOMContentLoaded', function() {
        const searchInput = document.getElementById('search-input');
        const projectList = document.getElementById('project-list');
        const resultsInfo = document.getElementById('results-info');
        const paginationContainer = document.getElementById('pagination-container');
        
        let timeout = null;

        searchInput.addEventListener('input', function(e) {
            clearTimeout(timeout);
            timeout = setTimeout(() => {
                fetchProjects(e.target.value);
            }, 300);
        });

        // Make fetchProjects available globally for the 'Tampilkan semua proyek' link
        window.fetchProjects = function(query) {
            fetch(`/api/proyek/search?q=${encodeURIComponent(query)}`, {
                headers: {
                    'Accept': 'application/json',
                    'X-Requested-With': 'XMLHttpRequest'
                }
            })
            .then(response => response.json())
            .then(data => {
                // Update results info
                if (data.query) {
                    resultsInfo.innerHTML = `Menampilkan <span class="font-semibold text-slate-700">${data.total}</span> hasil untuk "<span class="font-semibold text-primary-8">${data.query}</span>"`;
                } else {
                    resultsInfo.innerHTML = `Menampilkan semua proyek aktif (${data.total} proyek)`;
                }

                // Render projects
                projectList.innerHTML = '';
                
                if (data.data.length > 0) {
                    data.data.forEach(project => {
                        // Render tags
                        let tagsHtml = '';
                        if (project.tags.length > 0) {
                            tagsHtml = '<div class="flex flex-wrap gap-2">';
                            project.tags.forEach(tag => {
                                tagsHtml += `<span class="text-sm font-medium text-primary-5">#${tag}</span>`;
                            });
                            tagsHtml += '</div>';
                        }
                        
                        // Render roles
                        let rolesHtml = '';
                        if (project.roles.length > 0) {
                            rolesHtml = '<div class="flex flex-col gap-2"><p class="text-sm font-medium text-slate-700">Role yang diperlukan:</p><div class="flex flex-wrap items-center gap-2">';
                            let maxRoles = 3;
                            let visibleRoles = project.roles.slice(0, maxRoles);
                            let hiddenCount = project.roles.length - maxRoles;
                            
                            visibleRoles.forEach(role => {
                                rolesHtml += `<div class="inline-flex items-center justify-center px-4 py-1.5 rounded-full text-sm font-semibold border bg-slate-50 text-slate-700 border-slate-200">${role.name} (${role.count})</div>`;
                            });
                            
                            if (hiddenCount > 0) {
                                rolesHtml += `<span class="text-sm text-slate-500 font-medium">+${hiddenCount} more</span>`;
                            }
                            rolesHtml += '</div></div>';
                        }
                        
                        let pfpAsset = '{{ asset("assets/pfp.png") }}';
                        
                        let cardHtml = `
                        <a href="${project.detail_url}" class="block w-full">
                            <div class="flex flex-col gap-4 p-6 rounded-2xl bg-slate-100 hover:shadow-md transition-shadow duration-300 relative">
                                <div class="flex items-start justify-between">
                                    <h3 class="text-xl font-bold text-primary-8 leading-tight flex-1 pr-4">${project.nama_proyek}</h3>
                                    <button class="flex-shrink-0 w-8 h-8 flex items-center justify-center rounded-full hover:bg-slate-200 transition-colors cursor-pointer">
                                        <i data-lucide="more-vertical" class="w-5 h-5 text-slate-500"></i>
                                    </button>
                                </div>
                                ${tagsHtml}
                                <p class="text-sm text-slate-500">Periode : ${project.period}</p>
                                <p class="text-sm text-slate-600 leading-relaxed line-clamp-2">${project.deskripsi || ''}</p>
                                ${rolesHtml}
                                <div class="flex justify-end">
                                    <div class="flex items-center gap-2">
                                        <div class="flex flex-col text-right">
                                            <span class="text-sm font-medium text-slate-900">${project.ownerName}</span>
                                            <span class="text-xs text-slate-500">Pemilik Proyek</span>
                                        </div>
                                        <img src="${pfpAsset}" alt="Profile Picture" class="w-10 h-10 rounded-full object-cover">
                                    </div>
                                </div>
                            </div>
                        </a>`;
                        
                        projectList.insertAdjacentHTML('beforeend', cardHtml);
                    });
                } else {
                    let msg = data.query 
                        ? 'Tidak ada proyek yang cocok dengan "<strong>' + data.query + '</strong>"' 
                        : 'Belum ada proyek aktif saat ini.';
                    let linkHtml = data.query 
                        ? `<a href="#" onclick="document.getElementById('search-input').value=''; fetchProjects(''); return false;" class="text-primary-5 text-sm hover:underline mt-2 inline-block">Tampilkan semua proyek</a>`
                        : '';

                    let emptyHtml = `
                    <div class="text-center py-16 rounded-2xl bg-slate-50 border border-slate-200">
                        <i data-lucide="search-x" class="w-12 h-12 text-slate-300 mx-auto mb-3"></i>
                        <p class="text-slate-500 font-medium">${msg}</p>
                        ${linkHtml}
                    </div>`;
                    
                    projectList.insertAdjacentHTML('beforeend', emptyHtml);
                }

                if (paginationContainer) {
                    if (data.has_pages) {
                        paginationContainer.innerHTML = data.links;
                        paginationContainer.style.display = 'flex';
                    } else {
                        paginationContainer.style.display = 'none';
                    }
                }
                
                lucide.createIcons();
            })
            .catch(error => console.error('Error fetching projects:', error));
        }
    });
</script>
@endsection
