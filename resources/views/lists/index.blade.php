@extends('layouts.app')
@section('title', 'Semua List Tugas')

@section('content')
    <div class="content-header">
        <h1 class="page-title">Semua List Tugas</h1>
        <div class="header-actions">
            <a href="{{ route('lists.create') }}" class="btn btn-primary">
                <i class="ph ph-plus"></i>
                Buat List Baru
            </a>
        </div>
    </div>

    @if (session('success'))
        <div class="alert alert-success animate-fade-in">
            <i class="ph ph-check-circle"></i>
            {{ session('success') }}
        </div>
    @endif

    @if (session('error'))
        <div class="alert alert-error animate-fade-in">
            <i class="ph ph-warning-circle"></i>
            {{ session('error') }}
        </div>
    @endif

    <div class="lists-container">
        @foreach ($lists as $list)
            <div class="list-card animate-fade-in" style="animation-delay: {{ $loop->index * 0.1 }}s">
                <div class="list-header">
                    <h3 class="list-title">{{ $list->title }}</h3>
                    <div class="list-meta">
                        <span class="meta-item">
                            <i class="ph ph-user"></i>
                            {{ $list->user->name ?? 'Sistem' }}
                        </span>
                        <span class="meta-item">
                            <i class="ph ph-clock"></i>
                            {{ $list->created_at->diffForHumans() }}
                        </span>
                    </div>
                </div>

                <div class="list-actions">
                    <a href="{{ route('lists.show', $list->id) }}" class="action-btn btn-primary">
                        <i class="ph ph-eye"></i>
                        Lihat Detail & Tugas
                    </a>
                    
                    <a href="{{ route('lists.edit', $list->id) }}" class="action-btn btn-warning">
                        <i class="ph ph-pencil"></i>
                        Edit
                    </a>

                    <form action="{{ route('lists.destroy', $list->id) }}" method="POST" class="delete-form">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="action-btn btn-danger" 
                                onclick="return confirm('Anda yakin ingin menghapus list ini? Ini akan menghapus semua tugas di dalamnya.')">
                            <i class="ph ph-trash"></i>
                            Hapus
                        </button>
                    </form>
                </div>
            </div>
        @endforeach

        @if($lists->isEmpty())
            <div class="empty-state animate-fade-in">
                <div class="empty-icon">
                    <i class="ph ph-clipboard-text"></i>
                </div>
                <h3>Belum Ada List Tugas</h3>
                <p>Mulai dengan membuat list tugas pertama Anda</p>
                <a href="{{ route('lists.create') }}" class="btn btn-primary">
                    <i class="ph ph-plus"></i>
                    Buat List Pertama
                </a>
            </div>
        @endif
    </div>

    <style>
        /* List Container */
        .lists-container {
            display: grid;
            gap: 1.5rem;
            margin-top: 1.5rem;
        }

        /* List Card */
        .list-card {
            background: var(--bg-card);
            border-radius: var(--radius-lg);
            box-shadow: var(--shadow-md);
            padding: 1.5rem;
            border: 1px solid var(--border-light);
            transition: var(--transition);
            position: relative;
            overflow: hidden;
        }

        .list-card::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            width: 4px;
            height: 100%;
            background: linear-gradient(135deg, var(--accent-primary), var(--accent-secondary));
            transform: scaleY(0);
            transition: var(--transition);
        }

        .list-card:hover {
            transform: translateY(-4px);
            box-shadow: var(--shadow-lg);
        }

        .list-card:hover::before {
            transform: scaleY(1);
        }

        /* List Header */
        .list-header {
            margin-bottom: 1.5rem;
        }

        .list-title {
            font-size: 1.25rem;
            font-weight: 600;
            color: var(--text-primary);
            margin-bottom: 0.75rem;
            line-height: 1.4;
        }

        .list-meta {
            display: flex;
            gap: 1rem;
            flex-wrap: wrap;
        }

        .meta-item {
            display: flex;
            align-items: center;
            gap: 0.5rem;
            font-size: 0.875rem;
            color: var(--text-muted);
        }

        .meta-item i {
            font-size: 1rem;
        }

        /* List Actions */
        .list-actions {
            display: flex;
            gap: 0.75rem;
            flex-wrap: wrap;
            align-items: center;
        }

        .action-btn {
            padding: 0.5rem 1rem;
            border-radius: var(--radius-md);
            font-size: 0.875rem;
            font-weight: 500;
            text-decoration: none;
            transition: var(--transition);
            display: flex;
            align-items: center;
            gap: 0.5rem;
            border: none;
            cursor: pointer;
        }

        .action-btn.btn-primary {
            background: var(--accent-primary);
            color: white;
        }

        .action-btn.btn-primary:hover {
            background: var(--accent-secondary);
            transform: translateY(-1px);
            box-shadow: var(--shadow-md);
        }

        .action-btn.btn-warning {
            background: var(--accent-warning);
            color: white;
        }

        .action-btn.btn-warning:hover {
            background: #eab308;
            transform: translateY(-1px);
            box-shadow: var(--shadow-md);
        }

        .action-btn.btn-danger {
            background: var(--accent-danger);
            color: white;
        }

        .action-btn.btn-danger:hover {
            background: #dc2626;
            transform: translateY(-1px);
            box-shadow: var(--shadow-md);
        }

        /* Delete Form */
        .delete-form {
            margin: 0;
        }

        /* Empty State */
        .empty-state {
            text-align: center;
            padding: 3rem 2rem;
            background: var(--bg-card);
            border-radius: var(--radius-lg);
            border: 2px dashed var(--border-medium);
        }

        .empty-icon {
            font-size: 4rem;
            color: var(--text-muted);
            margin-bottom: 1.5rem;
        }

        .empty-state h3 {
            font-size: 1.5rem;
            color: var(--text-primary);
            margin-bottom: 0.5rem;
        }

        .empty-state p {
            color: var(--text-muted);
            margin-bottom: 1.5rem;
        }

        /* Alerts */
        .alert {
            padding: 1rem 1.5rem;
            border-radius: var(--radius-md);
            margin-bottom: 1.5rem;
            display: flex;
            align-items: center;
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

        /* Animations */
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

        /* Responsive Design */
        @media (max-width: 768px) {
            .list-actions {
                flex-direction: column;
                align-items: stretch;
            }
            
            .action-btn {
                justify-content: center;
            }
            
            .list-meta {
                flex-direction: column;
                gap: 0.5rem;
            }
            
            .lists-container {
                gap: 1rem;
            }
            
            .list-card {
                padding: 1.25rem;
            }
        }

        @media (max-width: 480px) {
            .content-header {
                flex-direction: column;
                gap: 1rem;
                align-items: flex-start;
            }
            
            .header-actions {
                width: 100%;
            }
            
            .header-actions .btn {
                width: 100%;
                justify-content: center;
            }
        }
    </style>
@endsection