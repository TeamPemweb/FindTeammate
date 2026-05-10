@extends('projects.dashboard')

@section('dashboard_content')
    @if(isset($projects) && count($projects) > 0)
        @foreach($projects as $project)
            @php
                $tags = !empty($project['project_field']) ? array_filter(array_map('trim', explode(' ', $project['project_field']))) : [];
            @endphp
            <a href="{{ route('proyekDikelola', ['id' => $project['id']]) }}" class="block">
                <x-card.card-small 
                    :title="$project['project_name'] ?? 'Untitled'"
                    :tags="$tags"
                    :period="$project['application_period'] ?? ''"
                    ownerName="You" />
            </a>
        @endforeach
        
        <a href="{{ route('proyekSaya.dikelola') }}" class="text-primary-5 text-sm font-semibold hover:underline text-center mt-2 block">
            Lihat lebih banyak
        </a>
    @else
        <div class="text-center text-slate-500 py-8 text-sm">
            Belum ada proyek yang dikelola.
        </div>
    @endif
@endsection