@extends('layouts.app')

@section('title', 'Detail List: ' . $list->title)

@section('content')
    <a href="{{ route('admin.lists.index') }}">&larr; Kembali ke Semua List</a>

    <h1 style="margin-top: 1rem;">{{ $list->title }}</h1>
    <p>Dibuat oleh:
        <strong>
            {{-- Jika $list->user ada, tampilkan nama. Jika null, tampilkan teks cadangan --}}
            <pre>{{ dd($list->user) }}</pre> 
            
            {{ $list->user->name ?? 'User tidak ditemukan' }}
        </strong>
    </p>
    <hr>

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
                            @if ($task->is_completed)
                                <a href="#">Tandai Belum Selesai</a>
                            @else
                                <a href="#">Tandai Selesai</a>
                            @endif
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    @endif

@endsection
