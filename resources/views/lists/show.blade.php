@extends('layouts.app')

@section('title', 'Detail List: ' . $list->title)

@section('content')

    @if (session('success'))
        <div style="background-color: #d4edda; color: #155724; padding: 1rem; border-radius: 5px; margin-bottom: 1rem;">
            {{ session('success') }}
        </div>
    @endif

    <a href="{{ route('lists.index') }}">&larr; Kembali ke Semua List</a>

    <h1 style="margin-top: 1rem;">{{ $list->title }}</h1>
    <p>Dibuat oleh:
        <strong>
            {{-- Jika $list->user ada, tampilkan nama. Jika null, tampilkan teks cadangan --}}
            {{ $list->user->name }}
        </strong>
    </p>
    <hr>

    <hr>

    <h3 style="margin-bottom: 1rem;">Tambah Tugas Baru</h3>

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

    <form action="{{ route('task.store') }}" method="POST">
        @csrf

        <input type="hidden" name="lists_id" value="{{ $list->id }}">

        <div style="margin-bottom: 1rem;">
            <label for="deskripsi">Deskripsi Tugas:</label><br>
            <textarea id="deskripsi" name="deskripsi" rows="3" style="width: 100%; box-sizing: border-box;" required>{{ old('deskripsi') }}</textarea>
        </div>

        <div style="margin-bottom: 1rem;">
            <label for="assigned_user_id">Tugaskan Kepada:</label><br>
            <select name="assigned_user_id" id="assigned_user_id" style="width: 100%; padding: 8px;">
                <option value="">-- Pilih User --</option>

                @foreach ($users as $user)
                    <option value="{{ $user->id }}">{{ $user->name }} </option>
                @endforeach

            </select>
        </div>

        <div style="margin-bottom: 1rem;">
            <label for="due_date">Batas Waktu (Due Date):</label><br>
            <input type="date" id="due_date" name="due_date" value="{{ old('due_date') }}"
                style="width: 100%; padding: 8px; box-sizing: border-box;" required>
        </div>

        <button type="submit"
            style="background-color: #007bff; color: white; padding: 10px 15px; border: none; border-radius: 5px; cursor: pointer;">
            + Tambah Tugas
        </button>
    </form>
    <hr style="margin-top: 1.5rem;">

    <h2>Daftar Tugas:</h2>

    @if ($tasks->isEmpty())
        <p>Belum ada tugas di list ini.</p>
    @else
        <table style="width: 100%; border-collapse: collapse;">
            <thead>
                <tr style="background-color: #f4f4f4;">
                    <th style="padding: 8px; border: 1px solid #ddd; text-align: left;">Tugas</th>
                    <th style="padding: 8px; border: 1px solid #ddd; text-align: left;">Ditugaskan Kepada</th>
                    <th style="padding: 8px; border: 1px solid #ddd; text-align: left;">Status</th>
                    <th style="padding: 8px; border: 1px solid #ddd; text-align: left;">Aksi</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($tasks as $task)
                    <tr>
                        <td style="padding: 8px; border: 1px solid #ddd;">{{ $task->deskripsi }}</td>

                        <td style="padding: 8px; border: 1px solid #ddd;">
                            {{ $task->assigned_user_name ?? 'Belum ada' }}
                        </td>

                        <td style="padding: 8px; border: 1px solid #ddd;">
                            @if ($task->is_completed)
                                <span style="color: green; font-weight: bold;">Selesai</span>
                            @else
                                <span style="color: red; font-weight: bold;">Belum Selesai</span>
                            @endif
                        </td>

                        <td style="padding: 8px; border: 1px solid #ddd;">

                            <form action="{{ route('tasks.toggle', $task->id) }}" method="POST" style="margin: 0;">
                                @csrf
                                @method('PATCH') @if ($task->is_completed)
                                    <button type="submit"
                                        style="background: none; border: none; color: #fd7e14; cursor: pointer; padding: 0; text-decoration: underline; font-weight: bold;">
                                        Batal
                                    </button>
                                @else
                                    <button type="submit"
                                        style="background: none; border: none; color: #28a745; cursor: pointer; padding: 0; text-decoration: underline; font-weight: bold;">
                                        Tandai Selesai
                                    </button>
                                @endif
                            </form>
                            <form action="{{ route('tasks.destroy', $task->id) }}" method="POST"
                                style="display: inline-block; margin-left: 10px;">
                                @csrf
                                @method('DELETE')

                                <button type="submit"
                                    style="background: none; border: none; color: red; cursor: pointer; text-decoration: underline; font-weight: bold; padding: 0;"
                                    onclick="return confirm('Anda yakin ingin menghapus tugas ini?')">
                                    Hapus
                                </button>
                            </form>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    @endif

@endsection
