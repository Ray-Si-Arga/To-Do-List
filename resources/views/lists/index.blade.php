@extends('layouts.app')
@section('title', 'Semua List Tugas')

@section('content')
    <h1>Semua List Tugas</h1>

    @if (session('success'))
        <div style="background-color: #d4edda; color: #155724; padding: 1rem; border-radius: 5px; margin-bottom: 1rem;">
            {{ session('success') }}
        </div>
    @endif

    @if (session('error'))
        <div style="background-color: #f8d7da; color: #721c24; padding: 1rem; border-radius: 5px; margin-bottom: 1rem;">
            {{ session('error') }}
        </div>
    @endif

    <a href="{{ route('lists.create') }}"
        style="background-color: #28a745; color: white; padding: 8px 12px; text-decoration: none; border-radius: 5px;">
        + Buat List Baru
    </a>

    <hr style="margin-top: 1rem;">

    <div>
        @foreach ($lists as $list)
            <div
                style="border: 1px solid #ddd; padding: 15px; margin-bottom: 15px; border-radius: 8px; background-color: #f9f9f9;">

                <h3 style="margin-top: 0;">{{ $list->title }}</h3>

                {{-- <small>Dibuat oleh: <strong>{{ $list->user->name }}</strong></small> --}}

                <br>

                <a href="{{ route('lists.show', $list->id) }}"
                    style="text-decoration: none; font-weight: bold; color: #007bff;">
                    Lihat Detail & Tugas
                </a>

                <a href="{{ route('lists.edit', $list->id) }}"
                    style="text-decoration: none; font-weight: bold; color: #ffc107; margin-left: 10px;">
                    Edit
                </a>


                <form action="{{ route('lists.destroy', $list->id) }}" method="POST"
                    style="display: inline-block; margin-left: 10px;">
                    @csrf
                    @method('DELETE')

                    <button type="submit"
                        style="background: none; border: none; color: red; cursor: pointer; text-decoration: underline; font-weight: bold; padding: 0;"
                        onclick="return confirm('Anda yakin ingin menghapus list ini? Ini akan menghapus semua tugas di dalamnya.')">
                        Hapus
                    </button>
                </form>
            </div>
        @endforeach
    </div>

@endsection
