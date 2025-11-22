@extends('layouts.app')

@section('title', 'Edit User')

@section('content')
    <h1>Edit User: {{ $user->name }}</h1>
    <p>Ubah data user di bawah ini.</p>

    @if (session('success'))
        <div style="background-color: #d4edda; color: #155724; padding: 1rem; border-radius: 5px; margin-bottom: 1rem;">
            {{ session('success') }}
        </div>
    @elseif (session('error'))
        <div style="background-color: #f8d7da; color: #721c24; padding: 1rem; border-radius: 5px; margin-bottom: 1rem;">
            {{ session('error') }}
        </div>
    @endif

    <form action="{{ route('admin.users.update', $user->id) }}" method="POST">
        @csrf
        @method('PUT') <div style="margin-bottom: 1rem;">
            <label for="name">Nama:</label><br>
            <input type="text" id="name" name="name" value="{{ old('name', $user->name) }}" required ...>
        </div>

        <div style="margin-bottom: 1rem;">
            <label for="email">Email:</label><br>
            <input type="email" id="email" name="email" value="{{ old('email', $user->email) }}" required ...>
        </div>

        <div style="margin-bottom: 1rem;">
            <label for="password">Password:</label><br>
            <input type="password" id="password" name="password" style="..."
                placeholder="Isi hanya jika ingin ganti password">
            <small>Kosongkan jika tidak ingin mengubah password.</small>
        </div>

        <div style="margin-bottom: 1rem;">
            <label for="password_confirmation">Konfirmasi Password:</label><br>
            <input type="password" id="password_confirmation" name="password_confirmation" style="...">
        </div>

        <div style="margin-bottom: 1rem;">
            <label for="role">Role:</label><br>
            <select name="role" id="role" style="width: 100%; padding: 8px;">
                <option value="user" {{ old('role', $user->role) == 'user' ? 'selected' : '' }}>User</option>
                <option value="admin" {{ old('role', $user->role) == 'admin' ? 'selected' : '' }}>Admin</option>
            </select>
        </div>

        <button type="submit" style="...">
            Update User
        </button>
    </form>

@endsection
