@extends('layouts.app')

@section('title', 'Proyek Saya')

@section('content')
    <div class="w-full flex flex-col space-y-4 gap-4">
        <x-segmentedButtons variant="proyekSaya"></x-segmentedButtons>

        <div class="flex flex-row w-full items-center gap-6">
            @if(request()->routeIs('proyekSaya.dikelola'))
            <a href="{{ route('buatProyek') }}">
                <x-button variant="primary">+ Buat Proyek Baru</x-button>
            </a>
            @endif
            <x-textField placeholder="Cari proyek kamu" fieldType="search" class="flex-1"></x-textField>
        </div>

        @if(request()->routeIs('proyekSaya.dikelola'))
            <div class="flex flex-col gap-4 w-full mt-4">
                @if(isset($projects) && count($projects) > 0)
                    @foreach($projects as $project)
                        @php
                            $tags = !empty($project['project_field']) ? array_filter(array_map('trim', explode(' ', $project['project_field']))) : [];
                        @endphp
                        <a href="{{ route('proyekDikelola', ['id' => $project['id']]) }}" class="w-full block">
                            <x-card.card-big 
                                id="{{ $project['id'] }}"
                                :title="$project['project_name'] ?? 'Untitled'"
                                :tags="$tags"
                                :period="$project['application_period'] ?? ''"
                                :description="$project['project_plan'] ?? ''"
                                :roles="isset($project['roles']) ? array_values($project['roles']) : []"
                                ownerName="You"
                                deleteUrl="{{ route('projects.destroy', ['id' => $project['id']]) }}"
                            />
                        </a>
                    @endforeach
                @else
                    <div class="text-center text-slate-500 py-12 rounded-2xl bg-slate-50 border border-slate-200">
                        Belum ada proyek yang dikelola.
                    </div>
                @endif
            </div>
        @endif
    </div>
@endsection