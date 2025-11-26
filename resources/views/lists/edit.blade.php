@extends('layouts.app')

@section('title', 'Edit List: ' . $list->title)

@section('content')
    <div class="content-header">
        <div class="header-content">
            <div class="header-text">
                <h1 class="page-title">Edit List: {{ $list->title }}</h1>
                <p class="header-subtitle">Perbarui judul list Anda di bawah ini</p>
            </div>
            <div class="header-actions">
                <a href="{{ route('lists.show', $list->id) }}" class="btn btn-outline">
                    <i class="ph ph-arrow-left"></i>
                    Kembali ke Detail
                </a>
            </div>
        </div>
    </div>

    <div class="form-container animate-fade-in">
        <div class="form-card">
            <div class="form-header">
                <div class="form-icon">
                    <i class="ph ph-pencil-simple"></i>
                </div>
                <h2>Edit List Tugas</h2>
                <p>Perbarui informasi list untuk mengorganisir pekerjaan Anda dengan lebih baik</p>
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

            <form action="{{ route('lists.update', $list->id) }}" method="POST" class="form">
                @csrf
                @method('PUT')
                
                <div class="form-group">
                    <label for="title" class="form-label">
                        <i class="ph ph-text-aa"></i>
                        Judul List
                    </label>
                    <input type="text" id="title" name="title" value="{{ old('title', $list->title) }}" required
                           class="form-input" placeholder="Contoh: Kerjakan PR Proyek Laravel">
                    <div class="form-hint">Beri nama yang jelas dan deskriptif untuk list Anda</div>
                </div>

                <div class="form-info">
                    <div class="info-item">
                        <i class="ph ph-user"></i>
                        <div>
                            <strong>Dibuat oleh:</strong>
                            <span>{{ $list->user->name ?? 'Sistem' }}</span>
                        </div>
                    </div>
                    <div class="info-item">
                        <i class="ph ph-calendar"></i>
                        <div>
                            <strong>Dibuat pada:</strong>
                            <span>{{ $list->created_at->format('d M Y H:i') }}</span>
                        </div>
                    </div>
                    <div class="info-item">
                        <i class="ph ph-clock"></i>
                        <div>
                            <strong>Terakhir diupdate:</strong>
                            <span>{{ $list->updated_at->diffForHumans() }}</span>
                        </div>
                    </div>
                </div>

                <div class="form-actions">
                    <button type="submit" class="btn btn-primary btn-lg">
                        <i class="ph ph-check"></i>
                        Simpan Perubahan
                    </button>
                    <a href="{{ route('lists.show', $list->id) }}" class="btn btn-outline">
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

        .form-group {
            margin-bottom: 2rem;
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
            border-color: var(--accent-warning);
            box-shadow: 0 0 0 3px rgba(234, 179, 8, 0.1);
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