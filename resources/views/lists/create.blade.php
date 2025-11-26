@extends('layouts.app')

@section('title', 'Buat List Baru')

@section('content')
    <div class="content-header">
        <h1 class="page-title">Buat List Tugas Baru</h1>
        <div class="header-actions">
            <a href="{{ route('lists.index') }}" class="btn btn-outline">
                <i class="ph ph-arrow-left"></i>
                Kembali
            </a>
        </div>
    </div>

    <div class="form-container animate-fade-in">
        <div class="form-card">
            <div class="form-header">
                <div class="form-icon">
                    <i class="ph ph-plus-circle"></i>
                </div>
                <h2>Apa yang ingin Anda umumkan atau kerjakan bersama?</h2>
                <p>Buat list tugas baru untuk mengorganisir pekerjaan Anda</p>
            </div>

            @if ($errors->any())
                <div class="alert alert-error">
                    <i class="ph ph-warning-circle"></i>
                    <div>
                        <strong>Error!</strong>
                        <ul>
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                </div>
            @endif

            <form action="{{ route('lists.store') }}" method="POST" class="form">
                @csrf
                <div class="form-group">
                    <label for="title" class="form-label">
                        <i class="ph ph-text-aa"></i>
                        Judul List
                    </label>
                    <input type="text" id="title" name="title" value="{{ old('title') }}" required
                           class="form-input" placeholder="Contoh: Kerjakan PR Proyek Laravel">
                    <div class="form-hint">Beri nama yang jelas dan deskriptif untuk list Anda</div>
                </div>

                <div class="form-actions">
                    <button type="submit" class="btn btn-primary btn-lg">
                        <i class="ph ph-check"></i>
                        Simpan List
                    </button>
                    <a href="{{ route('lists.index') }}" class="btn btn-outline">
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

        .form-card {
            background: var(--bg-card);
            border-radius: var(--radius-lg);
            box-shadow: var(--shadow-md);
            padding: 2rem;
            border: 1px solid var(--border-light);
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

        .form-group {
            margin-bottom: 1.5rem;
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
        }

        .form-input:focus {
            outline: none;
            border-color: var(--accent-primary);
            box-shadow: 0 0 0 3px rgba(59, 130, 246, 0.1);
        }

        .form-hint {
            font-size: 0.875rem;
            color: var(--text-muted);
            margin-top: 0.5rem;
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

        @media (max-width: 768px) {
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
        }
    </style>
@endsection