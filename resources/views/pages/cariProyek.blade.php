@extends('layouts.app')

@section('title', 'Cari Proyek')

@section('content')
<div class="w-full flex flex-col space-y-4 gap-4">
    <x-textField fieldType="search" placeholder="Ketik proyek yang ingin Anda cari" label="Cari Proyek Aktif"></x-textField>
    
</div>
@endsection