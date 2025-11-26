@extends('layouts.app')
@section('title', 'Tambah User Baru')

@section('content')
    <div class="content-header">
        <div class="header-content">
            <div class="header-text">
                <h1 class="page-title">Tambah User Baru</h1>
                <p class="header-subtitle">Isi formulir di bawah ini untuk menambahkan user baru ke sistem</p>
            </div>
            <div class="header-actions">
                <a href="{{ route('admin.users.index') }}" class="btn btn-outline">
                    <i class="ph ph-arrow-left"></i>
                    Kembali ke Daftar User
                </a>
            </div>
        </div>
    </div>

    <div class="form-container animate-fade-in">
        <div class="form-card">
            <div class="form-header">
                <div class="form-icon">
                    <i class="ph ph-user-plus"></i>
                </div>
                <h2>Form Tambah User</h2>
                <p>Lengkapi data berikut untuk menambahkan user baru ke sistem</p>
            </div>

            @if ($errors->any())
                <div class="alert alert-error">
                    <i class="ph ph-warning-circle"></i>
                    <div>
                        <strong>Terjadi Kesalahan!</strong>
                        <ul>
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                </div>
            @endif

            <form action="{{ route('admin.users.store') }}" method="POST" class="form">
                @csrf

                <div class="form-row">
                    <div class="form-group">
                        <label for="name" class="form-label">
                            <i class="ph ph-user"></i>
                            Nama Lengkap
                        </label>
                        <input type="text" id="name" name="name" value="{{ old('name') }}" required
                               class="form-input" placeholder="Masukkan nama lengkap">
                    </div>
                </div>

                <div class="form-row">
                    <div class="form-group">
                        <label for="email" class="form-label">
                            <i class="ph ph-envelope"></i>
                            Alamat Email
                        </label>
                        <input type="email" id="email" name="email" value="{{ old('email') }}" required
                               class="form-input" placeholder="Masukkan alamat email">
                    </div>
                </div>

                <div class="form-row">
                    <div class="form-group">
                        <label for="password" class="form-label">
                            <i class="ph ph-lock"></i>
                            Password
                        </label>
                        <input type="password" id="password" name="password" required
                               class="form-input" placeholder="Masukkan password">
                    </div>
                    <div class="form-group">
                        <label for="password_confirmation" class="form-label">
                            <i class="ph ph-lock-key"></i>
                            Konfirmasi Password
                        </label>
                        <input type="password" id="password_confirmation" name="password_confirmation" required
                               class="form-input" placeholder="Konfirmasi password">
                    </div>
                </div>

                <div class="form-row">
                    <div class="form-group">
                        <label for="role" class="form-label">
                            <i class="ph ph-shield"></i>
                            Role
                        </label>
                        <select name="role" id="role" class="form-input">
                            <option value="user">User</option>
                            <option value="admin">Admin</option>
                        </select>
                    </div>
                </div>

                <div class="form-actions">
                    <button type="submit" class="btn btn-primary btn-lg">
                        <i class="ph ph-user-plus"></i>
                        Tambah User
                    </button>
                    <a href="{{ route('admin.users.index') }}" class="btn btn-outline">
                        <i class="ph ph-x"></i>
                        Batal
                    </a>
                </div>
            </form>
        </div>
    </div>

    <style>
        .form-container {
            max-width: 600px;
            margin: 0 auto;
        }

        .header-content {
            display: flex;
            justify-content: space-between;
            align-items: flex-start;
            gap: 2rem;
        }

        .header-text {
            flex: 1;
        }

        .header-subtitle {
            color: var(--text-muted);
            margin-top: 0.5rem;
            font-size: 1.125rem;
        }

        .header-actions {
            flex-shrink: 0;
        }

        .form-card {
            background: var(--bg-card);
            border-radius: var(--radius-lg);
            box-shadow: var(--shadow-md);
            padding: 2rem;
            border: 1px solid var(--border-light);
            position: relative;
            overflow: hidden;
        }

        .form-card::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 4px;
            background: linear-gradient(135deg, var(--accent-primary), var(--accent-secondary));
        }

        .form-header {
            text-align: center;
            margin-bottom: 2rem;
        }

        .form-icon {
            font-size: 3rem;
            color: var(--accent-primary);
            margin-bottom: 1rem;
        }

        .form-header h2 {
            font-size: 1.5rem;
            color: var(--text-primary);
            margin-bottom: 0.5rem;
        }

        .form-header p {
            color: var(--text-muted);
        }

        .form-row {
            display: grid;
            grid-template-columns: 1fr;
            gap: 1.5rem;
            margin-bottom: 1.5rem;
        }

        @media (min-width: 768px) {
            .form-row:has(.form-group:only-child) {
                grid-template-columns: 1fr;
            }
            
            .form-row:has(.form-group:nth-child(2)) {
                grid-template-columns: 1fr 1fr;
            }
        }

        .form-group {
            display: flex;
            flex-direction: column;
        }

        .form-label {
            display: flex;
            align-items: center;
            gap: 0.5rem;
            font-weight: 600;
            color: var(--text-primary);
            margin-bottom: 0.5rem;
        }

        .form-input {
            width: 100%;
            padding: 0.75rem 1rem;
            border: 1px solid var(--border-medium);
            border-radius: var(--radius-md);
            background: var(--bg-input);
            color: var(--text-primary);
            font-size: 1rem;
            transition: var(--transition);
            font-family: inherit;
        }

        .form-input:focus {
            outline: none;
            border-color: var(--accent-primary);
            box-shadow: 0 0 0 3px rgba(59, 130, 246, 0.1);
        }

        select.form-input {
            appearance: none;
            background-image: url("data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' width='16' height='16' fill='currentColor' viewBox='0 0 256 256'%3E%3Cpath d='M213.66,101.66l-80,80a8,8,0,0,1-11.32,0l-80-80A8,8,0,0,1,53.66,90.34L128,164.69l74.34-74.35a8,8,0,0,1,11.32,11.32Z'%3E%3C/path%3E%3C/svg%3E");
            background-repeat: no-repeat;
            background-position: right 1rem center;
            background-size: 1rem;
            padding-right: 2.5rem;
        }

        .form-actions {
            display: flex;
            gap: 1rem;
            align-items: center;
            justify-content: flex-end;
            margin-top: 2rem;
            padding-top: 1.5rem;
            border-top: 1px solid var(--border-light);
        }

        .btn-lg {
            padding: 0.75rem 1.5rem;
            font-size: 1rem;
        }

        /* Alert Styles */
        .alert {
            padding: 1rem 1.5rem;
            border-radius: var(--radius-md);
            margin-bottom: 2rem;
            display: flex;
            align-items: flex-start;
            gap: 0.75rem;
            border-left: 4px solid transparent;
        }

        .alert-error {
            background: #fee2e2;
            color: #991b1b;
            border-left-color: #ef4444;
        }

        .dark-mode .alert-error {
            background: rgba(239, 68, 68, 0.1);
            color: #fecaca;
        }

        .alert i {
            font-size: 1.25rem;
            flex-shrink: 0;
            margin-top: 0.125rem;
        }

        .alert div {
            flex: 1;
        }

        .alert strong {
            display: block;
            margin-bottom: 0.5rem;
        }

        .alert ul {
            list-style: disc;
            margin-left: 1.25rem;
        }

        .alert li {
            margin-bottom: 0.25rem;
        }

        @media (max-width: 768px) {
            .header-content {
                flex-direction: column;
                gap: 1rem;
            }

            .header-actions {
                width: 100%;
            }

            .header-actions .btn {
                width: 100%;
                justify-content: center;
            }

            .form-card {
                padding: 1.5rem;
            }
            
            .form-actions {
                flex-direction: column;
            }
            
            .form-actions .btn {
                width: 100%;
                justify-content: center;
            }

            .form-row {
                grid-template-columns: 1fr;
            }
        }
    </style>
@endsection