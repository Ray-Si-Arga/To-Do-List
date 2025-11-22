@extends('layouts.app') @section('title', 'Kelola User') @section('content')

@if (session('success'))
    <div style="background-color: #d4edda; color: #155724; padding: 1rem; border-radius: 5px; margin-bottom: 1rem;">
        {{ session('success') }}
    </div>
@elseif (session('error'))
    <div style="background-color: #f8d7da; color: #721c24; padding: 1rem; border-radius: 5px; margin-bottom: 1rem;">
        {{ session('error') }}
    </div>
@endif

<h1>Kelola User</h1>
<p>Ini Adalah Halaman Tambah, Edit dan hapus</p>

<a href="{{ route('admin.users.create') }}"
    style="background-color: #28a745; color: white; padding: 8px 12px; text-decoration: none; border-radius: 5px;">
    + Tambah User Baru
</a>
<hr style="margin-top: 1rem">

<table style="width: 100%; border-collapse: collapse;">
    <thead>
        <tr style="background-color: #f4f4f4">
            <th style="padding: 8px; border: 1px solid #ddd; text-align: left;">ID</th>
            <th style="padding: 8px; border: 1px solid #ddd; text-align: left;">Nama</th>
            <th style="padding: 8px; border: 1px solid #ddd; text-align: left;">Email</th>
            <th style="padding: 8px; border: 1px solid #ddd; text-align: left;">Role</th>
            <th style="padding: 8px; border: 1px solid #ddd; text-align: left;">Aksi</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($users as $user)
            <tr>
                <td style="padding: 8px; border: 1px solid #ddd;">{{ $loop->iteration }}</td>
                <td style="padding: 8px; border: 1px solid #ddd;">{{ $user->name }}</td>
                <td style="padding: 8px; border: 1px solid #ddd;">{{ $user->email }}</td>
                <td style="padding: 8px; border: 1px solid #ddd;">{{ $user->role }}</td>
                <td style="padding: 8px; border: 1px solid #ddd;">
                    <a href="{{ route('admin.users.edit', $user->id) }}">Edit</a> |
                    <form action="{{ route('admin.users.destroy', $user->id) }}" method="POST" style="display: inline"
                        onsubmit="return confirm('Data Ingin Dihapus?')">
                        @csrf
                        @method('DELETE')

                        <button type="submit"
                            style="background: none; border: none; color: #007bff; cursor: pointer; padding: 0; text-decoration: underline;">
                            Hapus
                        </button>
                    </form>
                </td>
            </tr>
        @endforeach
    </tbody>
</table>
@endsection
