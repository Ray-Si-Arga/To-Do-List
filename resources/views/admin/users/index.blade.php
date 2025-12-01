@extends('layouts.app')
@section('title', 'Kelola User')

@section('content')
    {{-- 
  Saya mengganti 'space-y-6' dengan 'gap: 1.5rem' agar lebih modern 
  dan menghapus kebutuhan <style> di bawah.
--}}
    <div style="display: flex; flex-direction: column; gap: 1.5rem;">

        <div style="display: flex; justify-content: space-between; align-items: center;">
            <div>
                <h1
                    style="font-size: 2.25rem; font-weight: bold; background-image: linear-gradient(to right, #2563eb, #4f46e5); -webkit-background-clip: text; color: transparent;">
                    Kelola User
                </h1>
                <p style="color: var(--text-secondary); margin-top: 0.5rem;">Ini adalah halaman untuk menambah, mengedit, dan
                    menghapus user</p>
            </div>
            <a href="{{ route('admin.users.create') }}"
                style="background-image: linear-gradient(to right, #22c55e, #16a34a); color: white; padding: 0.75rem 1.5rem; border-radius: 0.5rem; font-weight: 600; transition: all 0.2s; box-shadow: 0 4px 6px -1px rgba(0,0,0,0.1), 0 2px 4px -2px rgba(0,0,0,0.1); display: flex; align-items: center; gap: 0.5rem; text-decoration: none;"
                onmouseover="this.style.backgroundImage='linear-gradient(to right, #16a34a, #15803d)'"
                onmouseout="this.style.backgroundImage='linear-gradient(to right, #22c55e, #16a34a)'">
                <i class="ph ph-user-plus" style="font-size: 1.125rem;"></i>
                Tambah User
            </a>
        </div>

        @if (session('success'))
            <div
                style="background-color: var(--bg-alert-success); border: 1px solid var(--border-alert-success); color: var(--text-alert-success); padding: 0.75rem 1rem; border-radius: 0.5rem;">
                <div style="display: flex; align-items: center; gap: 0.5rem;">
                    <i class="ph ph-check-circle" style="font-size: 1.125rem;"></i>
                    <span>{{ session('success') }}</span>
                </div>
            </div>
        @elseif (session('error'))
            <div
                style="background-color: var(--bg-alert-danger); border: 1px solid var(--border-alert-danger); color: var(--text-alert-danger); padding: 0.75rem 1rem; border-radius: 0.5rem;">
                <div style="display: flex; align-items: center; gap: 0.5rem;">
                    <i class="ph ph-warning-circle" style="font-size: 1.125rem;"></i>
                    <span>{{ session('error') }}</span>
                </div>
            </div>
        @endif

        <div
            style="background-color: var(--bg-card); border-radius: 0.75rem; box-shadow: var(--shadow-md); border: 1px solid var(--border-light); overflow: hidden;">
            <div style="overflow-x: auto;">
                <table style="width: 100%; border-collapse: collapse;">
                    <thead style="background-color: var(--bg-table-header);">
                        <tr>
                            <th
                                style="padding: 1rem 1.5rem; text-align: left; font-size: 0.75rem; font-weight: 600; color: var(--text-secondary); text-transform: uppercase; letter-spacing: 0.05em; border-bottom: 1px solid var(--border-light);">
                                ID</th>
                            <th
                                style="padding: 1rem 1.5rem; text-align: left; font-size: 0.75rem; font-weight: 600; color: var(--text-secondary); text-transform: uppercase; letter-spacing: 0.05em; border-bottom: 1px solid var(--border-light);">
                                Nama</th>
                            <th
                                style="padding: 1rem 1.5rem; text-align: left; font-size: 0.75rem; font-weight: 600; color: var(--text-secondary); text-transform: uppercase; letter-spacing: 0.05em; border-bottom: 1px solid var(--border-light);">
                                Email</th>
                            <th
                                style="padding: 1rem 1.5rem; text-align: left; font-size: 0.75rem; font-weight: 600; color: var(--text-secondary); text-transform: uppercase; letter-spacing: 0.05em; border-bottom: 1px solid var(--border-light);">
                                Role</th>
                            <th
                                style="padding: 1rem 1.5rem; text-align: left; font-size: 0.75rem; font-weight: 600; color: var(--text-secondary); text-transform: uppercase; letter-spacing: 0.05em; border-bottom: 1px solid var(--border-light);">
                                Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($users as $user)
                            <tr style="transition: background-color 0.15s;"
                                onmouseover="this.style.backgroundColor='var(--bg-hover)'"
                                onmouseout="this.style.backgroundColor='transparent'">

                                <td
                                    style="padding: 1rem 1.5rem; white-space: nowrap; border-bottom: 1px solid var(--border-light);">
                                    <span
                                        style="font-size: 0.875rem; font-weight: 500; color: var(--text-primary);">{{ $loop->iteration }}</span>
                                </td>
                                <td
                                    style="padding: 1rem 1.5rem; white-space: nowrap; border-bottom: 1px solid var(--border-light);">
                                    <span
                                        style="font-size: 0.875rem; font-weight: 500; color: var(--text-primary);">{{ $user->name }}</span>
                                </td>
                                <td
                                    style="padding: 1rem 1.5rem; white-space: nowrap; border-bottom: 1px solid var(--border-light);">
                                    <span
                                        style="font-size: 0.875rem; color: var(--text-secondary);">{{ $user->email }}</span>
                                </td>
                                <td
                                    style="padding: 1rem 1.5rem; white-space: nowrap; border-bottom: 1px solid var(--border-light);">
                                    <span
                                        style="display: inline-flex; align-items: center; padding: 0.25rem 0.75rem; border-radius: 9999px; font-size: 0.75rem; font-weight: 500; 
                                    @if ($user->role == 'admin') background-color: var(--bg-badge-purple); color: var(--text-badge-purple);
                                    @else
                                        background-color: var(--bg-badge-blue); color: var(--text-badge-blue); @endif
                                ">
                                        {{ ucfirst($user->role) }}
                                    </span>
                                </td>
                                <td
                                    style="padding: 1rem 1.5rem; white-space: nowrap; border-bottom: 1px solid var(--border-light);">
                                    <div style="display: flex; align-items: center; gap: 0.5rem;">
                                        <a href="{{ route('admin.users.edit', $user->id) }}"
                                            style="display: inline-flex; align-items: center; gap: 0.25rem; padding: 0.5rem 0.75rem; background-color: var(--bg-button-blue); color: var(--text-button-blue); border-radius: 0.5rem; transition: background-color 0.2s; border: 1px solid var(--border-button-blue); text-decoration: none; font-size: 0.875rem;"
                                            onmouseover="this.style.backgroundColor='var(--bg-button-blue-hover)'"
                                            onmouseout="this.style.backgroundColor='var(--bg-button-blue)'">
                                            <i class="ph ph-pencil-simple" style="font-size: 0.875rem;"></i>
                                            Edit
                                        </a>
                                        <form action="{{ route('admin.users.destroy', $user->id) }}" method="POST"
                                            onsubmit="return confirm('Apakah Anda yakin ingin menghapus user ini?')">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit"
                                                style="display: inline-flex; align-items: center; gap: 0.25rem; padding: 0.5rem 0.75rem; background-color: var(--bg-button-red); color: var(--text-button-red); border-radius: 0.5rem; transition: background-color 0.2s; border: 1px solid var(--border-button-red); cursor: pointer; font-size: 0.875rem;"
                                                onmouseover="this.style.backgroundColor='var(--bg-button-red-hover)'"
                                                onmouseout="this.style.backgroundColor='var(--bg-button-red)'">
                                                <i class="ph ph-trash" style="font-size: 0.875rem;"></i>
                                                Hapus
                                            </button>
                                        </form>
                                    </div>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="5">
                                    <div style="text-align: center; padding: 3rem 0;">
                                        <div
                                            style="margin: 0 auto; width: 6rem; height: 6rem; background-color: var(--bg-empty-icon); border-radius: 9999px; display: flex; align-items: center; justify-content: center; margin-bottom: 1rem;">
                                            <i class="ph ph-users-three"
                                                style="font-size: 2.25rem; color: var(--text-muted);"></i>
                                        </div>
                                        <h3
                                            style="font-size: 1.125rem; font-weight: 500; color: var(--text-primary); margin-bottom: 0.5rem;">
                                            Belum ada user</h3>
                                        <p style="color: var(--text-secondary); margin-bottom: 1rem; font-size: 0.875rem;">
                                            Mulai dengan menambahkan user pertama Anda</p>
                                        <a href="{{ route('admin.users.create') }}"
                                            style="display: inline-flex; align-items: center; gap: 0.5rem; background-color: var(--accent-primary); color: white; padding: 0.5rem 1rem; border-radius: 0.5rem; transition: filter 0.2s; text-decoration: none; font-size: 0.875rem;"
                                            onmouseover="this.style.filter='brightness(90%)'"
                                            onmouseout="this.style.filter='brightness(100%)'">
                                            <i class="ph ph-user-plus"></i>
                                            Tambah User
                                        </a>
                                    </div>
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    {{-- 
  BLOK <STYLE> ... </STYLE> YANG BESAR DI BAWAH INI TELAH DIHAPUS 
  KARENA SUDAH TIDAK DIPERLUKAN LAGI.
--}}
@endsection
