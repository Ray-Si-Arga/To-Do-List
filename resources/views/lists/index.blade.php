@extends('layouts.app') @section('title', 'Semua List Tugas') @section('content')
<h1>Semua List Tugas</h1>

@if (session('success'))
    <div style="background-color: #d4edda; color: #155724; padding: 1rem; border-radius: 5px; margin-bottom: 1rem;">
        {{ session('success') }}
    </div>
@endif

<a href="{{ route('admin.lists.create') }}"
    style="background-color: #28a745; color: white; padding: 8px 12px; text-decoration: none; border-radius: 5px;">
    + Buat List Baru
</a>

<hr style="margin-top: 1rem;">

<div>
    @foreach ($lists as $list)
        <div style="border: 1px solid #ddd; padding: 15px; margin-bottom: 15px; ...">

            <h3 style="margin-top: 0;">{{ $list->title }}</h3>

            {{-- <small>Dibuat oleh: <strong>{{ $list->user->name }}</strong></small> --}}

            <br>

            <a href="{{ route('admin.lists.show', $list->id) }}"
                style="text-decoration: none; font-weight: bold; color: #007bff;">
                Lihat Detail & Tugas
            </a>
        </div>
    @endforeach
</div>

@endsection
