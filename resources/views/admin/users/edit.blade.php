@extends('layouts.app')
@section('title', 'Edit User: ' . $user->name)

@section('content')
    <div class="content-header">
        <div class="header-content">
            <div class="header-text">
                <h1 class="page-title">Edit User: {{ $user->name }}</h1>
                <p class="header-subtitle">Ubah data user sesuai kebutuhan</p>
            </div>
            <div class="header-actions">
                <a href="{{ route('admin.users.index') }}" class="btn btn-outline">
                    <i class="ph ph-arrow-left"></i>
                    Kembali ke Daftar User
                </a>
            </div>
        </div>
    </div>

    @if (session('success'))
        <div class="alert alert-success animate-fade-in">
            <i class="ph ph-check-circle"></i>
            <div>
                <strong>Berhasil!</strong>
                <span>{{ session('success') }}</span>
            </div>
        </div>
    @elseif (session('error'))
        <div class="alert alert-error animate-fade-in">
            <i class="ph ph-warning-circle"></i>
            <div>
                <strong>Error!</strong>
                <span>{{ session('error') }}</span>
            </div>
        </div>
    @endif

    <div class="form-container animate-fade-in">
        <div class="form-card">
            <div class="form-header">
                <div class="form-icon">
                    <i class="ph ph-user-circle"></i>
                </div>
                <h2>Form Edit User</h2>
                <p>Perbarui informasi user sesuai kebutuhan</p>
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

            <form action="{{ route('admin.users.update', $user->id) }}" method="POST" class="form">
                @csrf
                @method('PUT')

                <div class="form-row">
                    <div class="form-group">
                        <label for="name" class="form-label">
                            <i class="ph ph-user"></i>
                            Nama Lengkap
                        </label>
                        <input type="text" id="name" name="name" value="{{ old('name', $user->name) }}" required
                               class="form-input" placeholder="Masukkan nama lengkap">
                    </div>
                </div>

                <div class="form-row">
                    <div class="form-group">
                        <label for="email" class="form-label">
                            <i class="ph ph-envelope"></i>
                            Alamat Email
                        </label>
                        <input type="email" id="email" name="email" value="{{ old('email', $user->email) }}" required
                               class="form-input" placeholder="Masukkan alamat email">
                    </div>
                </div>

                <div class="form-row">
                    <div class="form-group">
                        <label for="password" class="form-label">
                            <i class="ph ph-lock"></i>
                            Password Baru
                        </label>
                        <input type="password" id="password" name="password"
                               class="form-input" placeholder="Kosongkan jika tidak ingin mengubah">
                        <div class="form-hint">Biarkan kosong jika tidak ingin mengubah password</div>
                    </div>
                    <div class="form-group">
                        <label for="password_confirmation" class="form-label">
                            <i class="ph ph-lock-key"></i>
                            Konfirmasi Password Baru
                        </label>
                        <input type="password" id="password_confirmation" name="password_confirmation"
                               class="form-input" placeholder="Konfirmasi password baru">
                    </div>
                </div>

                <div class="form-row">
                    <div class="form-group">
                        <label for="role" class="form-label">
                            <i class="ph ph-shield"></i>
                            Role
                        </label>
                        <select name="role" id="role" class="form-input">
                            <option value="user" {{ old('role', $user->role) == 'user' ? 'selected' : '' }}>User</option>
                            <option value="admin" {{ old('role', $user->role) == 'admin' ? 'selected' : '' }}>Admin</option>
                        </select>
                    </div>
                </div>

                <div class="form-info">
                    <div class="info-item">
                        <i class="ph ph-calendar"></i>
                        <div>
                            <strong>Dibuat pada:</strong>
                            <span>{{ $user->created_at->format('d M Y H:i') }}</span>
                        </div>
                    </div>
                    <div class="info-item">
                        <i class="ph ph-clock"></i>
                        <div>
                            <strong>Terakhir diupdate:</strong>
                            <span>{{ $user->updated_at->diffForHumans() }}</span>
                        </div>
                    </div>
                </div>

                <div class="form-actions">
                    <button type="submit" class="btn btn-warning btn-lg">
                        <i class="ph ph-check"></i>
                        Update User
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
            background: linear-gradient(135deg, var(--accent-warning), #eab308);
        }

        .form-header {
            text-align: center;
            margin-bottom: 2rem;
        }

        .form-icon {
            font-size: 3rem;
            color: var(--accent-warning);
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
            border-color: var(--accent-warning);
            box-shadow: 0 0 0 3px rgba(234, 179, 8, 0.1);
        }

        select.form-input {
            appearance: none;
            background-image: url("data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' width='16' height='16' fill='currentColor' viewBox='0 0 256 256'%3E%3Cpath d='M213.66,101.66l-80,80a8,8,0,0,1-11.32,0l-80-80A8,8,0,0,1,53.66,90.34L128,164.69l74.34-74.35a8,8,0,0,1,11.32,11.32Z'%3E%3C/path%3E%3C/svg%3E");
            background-repeat: no-repeat;
            background-position: right 1rem center;
            background-size: 1rem;
            padding-right: 2.5rem;
        }

        .form-hint {
            font-size: 0.875rem;
            color: var(--text-muted);
            margin-top: 0.5rem;
        }

        .form-info {
            background: var(--bg-input);
            border-radius: var(--radius-md);
            padding: 1.5rem;
            margin-bottom: 2rem;
            border: 1px solid var(--border-light);
        }

        .info-item {
            display: flex;
            align-items: center;
            gap: 1rem;
            padding: 0.75rem 0;
        }

        .info-item:not(:last-child) {
            border-bottom: 1px solid var(--border-light);
        }

        .info-item i {
            font-size: 1.25rem;
            color: var(--accent-warning);
            width: 1.5rem;
            text-align: center;
        }

        .info-item div {
            flex: 1;
        }

        .info-item strong {
            display: block;
            font-size: 0.875rem;
            color: var(--text-muted);
            margin-bottom: 0.25rem;
        }

        .info-item span {
            color: var(--text-primary);
            font-weight: 500;
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

        .alert-success {
            background: #d1fae5;
            color: #065f46;
            border-left-color: #10b981;
        }

        .dark-mode .alert-success {
            background: rgba(16, 185, 129, 0.1);
            color: #a7f3d0;
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
            margin-bottom: 0.25rem;
        }

        .animate-fade-in {
            animation: fadeInUp 0.6s ease-out;
        }

        @keyframes fadeInUp {
            from {
                opacity: 0;
                transform: translateY(20px);
            }
            to {
                opacity: 1;
                transform: translateY(0);
            }
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

            .info-item {
                flex-direction: column;
                align-items: flex-start;
                gap: 0.5rem;
                text-align: left;
            }

            .info-item i {
                align-self: flex-start;
            }
        }
    </style>
@endsection