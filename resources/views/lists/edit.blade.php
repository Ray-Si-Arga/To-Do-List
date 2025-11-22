@extends('layouts.app')

@section('title', 'Edit List: ' . $list->title)

@section('content')
    <h1>Edit List: {{ $list->title }}</h1>
    <p>Perbarui judul list Anda di bawah ini.</p>

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

    <form action="{{ route('lists.update', $list->id) }}" method="POST">
        @csrf
        @method('PUT') <div style="margin-bottom: 1rem;">
            <label for="title">Judul List:</label><br>
            <input type="text" id="title" name="title" value="{{ old('title', $list->title) }}" required
                style="width: 100%; padding: 8px; box-sizing: border-box;">
        </div>

        <button type="submit"
            style="background-color: #007bff; color: white; padding: 10px 15px; border: none; border-radius: 5px; cursor: pointer;">
            Simpan Perubahan
        </button>
    </form>

@endsection
