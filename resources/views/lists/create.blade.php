@extends('layouts.app')

@section('title', 'Buat List Baru')

@section('content')
    <h1>Buat List Tugas Baru</h1>
    <p>Apa yang ingin Anda umumkan atau kerjakan bersama?</p>

    @if ($errors->any())
        <div style="background-color: #f8d7da; color: #721c24; padding: 1rem; border-radius: 5px; margin-bottom: 1rem;">
            <strong>Error!</strong>
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('admin.lists.store') }}" method="POST">
        @csrf <div style="margin-bottom: 1rem;">
            <label for="title">Judul List:</label><br>
            <input type="text" id="title" name="title" value="{{ old('title') }}" required
                style="width: 100%; padding: 8px; box-sizing: border-box;" placeholder="Contoh: Kerjakan PR Proyek Laravel">
        </div>

        <button type="submit"
            style="background-color: #007bff; color: white; padding: 10px 15px; border: none; border-radius: 5px; cursor: pointer;">
            Simpan List
        </button>
    </form>

@endsection
