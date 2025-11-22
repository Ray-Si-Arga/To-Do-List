@extends('layouts.app')

@section('title', 'Tambah User Baru')

@section('content')
    <h1>Tambah User Baru</h1>
    <p>Isi formulir di bawah ini untuk mengundang user baru.</p>

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

    <form action="{{ route('admin.users.store') }}" method="POST">
        @csrf <div style="margin-bottom: 1rem;">
            <label for="name">Nama:</label><br>
            <input type="text" id="name" name="name" value="{{ old('name') }}" required
                style="width: 100%; padding: 8px; box-sizing: border-box;">
        </div>

        <div style="margin-bottom: 1rem;">
            <label for="email">Email:</label><br>
            <input type="email" id="email" name="email" value="{{ old('email') }}" required
                style="width: 100%; padding: 8px; box-sizing: border-box;">
        </div>

        <div style="margin-bottom: 1rem;">
            <label for="password">Password:</label><br>
            <input type="password" id="password" name="password" required
                style="width: 100%; padding: 8px; box-sizing: border-box;">
        </div>

        <div style="margin-bottom: 1rem;">
            <label for="password_confirmation">Konfirmasi Password:</label><br>
            <input type="password" id="password_confirmation" name="password_confirmation" required
                style="width: 100%; padding: 8px; box-sizing: border-box;">
        </div>

        <div style="margin-bottom: 1rem;">
            <label for="role">Role:</label><br>
            <select name="role" id="role" style="width: 100%; padding: 8px;">
                <option value="user">User</option>
                <option value="admin">Admin</option>
            </select>
        </div>

        <button type="submit"
            style="background-color: #007bff; color: white; padding: 10px 15px; border: none; border-radius: 5px; cursor: pointer;">
            Simpan User
        </button>
    </form>

@endsection
