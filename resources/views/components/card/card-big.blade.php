@props([
    'id' => uniqid(),
    'title' => '',
    'tags' => [],
    'period' => '',
    'description' => '',
    'roles' => [],
    'ownerName' => '',
    'maxRoles' => 3,
    'deleteUrl' => '',
])

@php
    $visibleRoles = array_slice($roles, 0, $maxRoles);
    $hiddenCount = count($roles) - $maxRoles;
@endphp

<div class="flex flex-col gap-4 p-6 rounded-2xl bg-slate-100 hover:shadow-md transition-shadow duration-300 relative">
    <div class="flex items-start justify-between">
        <h3 class="text-xl font-bold text-primary-8 leading-tight flex-1 pr-4">{{ $title }}</h3>
        
        @if($deleteUrl)
            <div class="relative">
                <button type="button" onclick="event.preventDefault(); event.stopPropagation(); document.getElementById('dropdown-{{$id}}').classList.toggle('hidden')" class="flex-shrink-0 w-8 h-8 flex items-center justify-center rounded-full hover:bg-slate-200 transition-colors cursor-pointer focus:outline-none relative z-20">
                    <i data-lucide="more-vertical" class="w-5 h-5 text-slate-500"></i>
                </button>
                <div id="dropdown-{{$id}}" onclick="event.stopPropagation();" class="hidden absolute right-0 mt-2 w-48 bg-white rounded-md shadow-lg z-50 border border-slate-100 overflow-hidden">
                    <form action="{{ $deleteUrl }}" method="POST" onsubmit="return confirm('Apakah Anda yakin ingin menghapus proyek ini?');">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="w-full text-left px-4 py-3 text-sm text-red-600 font-semibold hover:bg-red-50 hover:text-red-700 transition-colors">
                            Hapus Proyek
                        </button>
                    </form>
                </div>
            </div>
            <script>
                document.addEventListener('click', function(event) {
                    var dropdown = document.getElementById('dropdown-{{$id}}');
                    if(dropdown) {
                        var button = dropdown.previousElementSibling;
                        if (!dropdown.contains(event.target) && !button.contains(event.target)) {
                            dropdown.classList.add('hidden');
                        }
                    }
                });
            </script>
        @else
            <button class="flex-shrink-0 w-8 h-8 flex items-center justify-center rounded-full hover:bg-slate-200 transition-colors cursor-pointer">
                <i data-lucide="more-vertical" class="w-5 h-5 text-slate-500"></i>
            </button>
        @endif
    </div>

    @if(count($tags) > 0)
        <div class="flex flex-wrap gap-2">
            @foreach($tags as $tag)
                <span class="text-sm font-medium text-primary-5">#{{ $tag }}</span>
            @endforeach
        </div>
    @endif

    @if($period)
        <p class="text-sm text-slate-500">Periode : {{ $period }}</p>
    @endif

    @if($description)
        <p class="text-sm text-slate-600 leading-relaxed line-clamp-2">{{ $description }}</p>
    @endif

    @if(count($roles) > 0)
        <div class="flex flex-col gap-2">
            <p class="text-sm font-medium text-slate-700">Role yang diperlukan:</p>
            <div class="flex flex-wrap items-center gap-2">
                @foreach($visibleRoles as $role)
                    @if(is_array($role))
                        <x-chips>{{ $role['name'] ?? 'Unknown' }} ({{ $role['count'] ?? 1 }})</x-chips>
                    @else
                        <x-chips>{{ $role }}</x-chips>
                    @endif
                @endforeach
                @if($hiddenCount > 0)
                    <span class="text-sm text-slate-500 font-medium">+{{ $hiddenCount }} more</span>
                @endif
            </div>
        </div>
    @endif

    <div class="flex justify-end">
        <x-pfp-name :name="$ownerName"></x-pfp-name>
    </div>
</div>