@extends('layouts.app')

@section('title', 'Detail List: ' . $list->title)

@section('content')
<div class="content-header">
    <div class="header-content">
        <div class="header-text">
            <h1 class="page-title">{{ $list->title }}</h1>
            <div class="header-meta">
                <span class="meta-item">
                    <i class="ph ph-user"></i>
                    Dibuat oleh: {{ $list->user->name ?? 'Sistem' }}
                </span>
                <span class="meta-item">
                    <i class="ph ph-calendar"></i>
                    Dibuat: {{ $list->created_at->diffForHumans() }}
                </span>
            </div>
        </div>
        <div class="header-actions">
            <a href="{{ route('lists.edit', $list->id) }}" class="btn btn-warning">
                <i class="ph ph-pencil"></i>
                Edit List
            </a>
            <a href="{{ route('lists.index') }}" class="btn btn-outline">
                <i class="ph ph-arrow-left"></i>
                Kembali
            </a>
        </div>
    </div>
</div>

@if (session('success'))
    <div class="alert alert-success animate-fade-in">
        <i class="ph ph-check-circle"></i>
        {{ session('success') }}
    </div>
@endif

<div class="dashboard-grid">
    <!-- Left Column - Add Task Form -->
    <div class="form-container animate-fade-in">
        <div class="form-card">
            <div class="form-header">
                <div class="form-icon">
                    <i class="ph ph-plus-circle"></i>
                </div>
                <h2>Tambah Tugas Baru</h2>
                <p>Tambahkan tugas baru ke dalam list {{ $list->title }}</p>
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

            <form action="{{ route('tasks.store') }}" method="POST" class="form">
                @csrf
                <input type="hidden" name="lists_id" value="{{ $list->id }}">

                <div class="form-group">
                    <label for="deskripsi" class="form-label">
                        <i class="ph ph-text-aa"></i>
                        Deskripsi Tugas
                    </label>
                    <textarea name="deskripsi" id="deskripsi" class="form-input" rows="3" required 
                              placeholder="Masukkan deskripsi tugas...">{{ old('deskripsi') }}</textarea>
                </div>

                <div class="form-row">
                    <div class="form-group">
                        <label for="assigned_user_id" class="form-label">
                            <i class="ph ph-user"></i>
                            Tugaskan Kepada
                        </label>
                        <select name="assigned_user_id" id="assigned_user_id" class="form-input">
                            <option value="">-- Pilih User --</option>
                            @foreach ($users as $user)
                                <option value="{{ $user->id }}" {{ old('assigned_user_id') == $user->id ? 'selected' : '' }}>
                                    {{ $user->name }}
                                </option>
                            @endforeach
                        </select>
                    </div>

                    <div class="form-group">
                        <label for="due_date" class="form-label">
                            <i class="ph ph-calendar"></i>
                            Batas Waktu
                        </label>
                        <input type="date" name="due_date" id="due_date" class="form-input" 
                               value="{{ old('due_date') }}" required>
                    </div>
                </div>

                <div class="form-actions">
                    <button type="submit" class="btn btn-primary btn-lg">
                        <i class="ph ph-plus"></i>
                        Tambah Tugas
                    </button>
                </div>
            </form>
        </div>
    </div>

    <!-- Right Column - Tasks List -->
    <div class="tasks-container animate-fade-in" style="animation-delay: 0.1s">
        <div class="tasks-header">
            <h2 class="section-title">Daftar Tugas</h2>
            <div class="tasks-stats">
                <span class="stat-item">
                    <i class="ph ph-list-checks"></i>
                    Total: {{ $tasks->count() }}
                </span>
                <span class="stat-item">
                    <i class="ph ph-check-circle"></i>
                    Selesai: {{ $tasks->where('is_completed', true)->count() }}
                </span>
            </div>
        </div>

        @if ($tasks->isEmpty())
            <div class="empty-state">
                <div class="empty-icon">
                    <i class="ph ph-clipboard-text"></i>
                </div>
                <h3>Belum Ada Tugas</h3>
                <p>Mulai dengan menambahkan tugas pertama Anda</p>
            </div>
        @else
            <div class="tasks-grid">
                @foreach ($tasks as $task)
                <div class="task-card {{ $task->is_completed ? 'completed' : '' }}">
                    <div class="task-header">
                        <h3 class="task-title">{{ $task->deskripsi }}</h3>
                        <div class="task-status {{ $task->is_completed ? 'status-completed' : 'status-pending' }}">
                            {{ $task->is_completed ? 'Selesai' : 'Belum Selesai' }}
                        </div>
                    </div>

                    <div class="task-meta">
                        <div class="meta-item">
                            <i class="ph ph-user"></i>
                            <span>{{ $task->assigned_user_name ?? 'Tidak ditugaskan' }}</span>
                        </div>
                        <div class="meta-item">
                            <i class="ph ph-calendar"></i>
                            <span>{{ $task->due_date ? \Carbon\Carbon::parse($task->due_date)->format('d M Y') : 'Tidak ada' }}</span>
                        </div>
                    </div>

                    <div class="task-actions">
                        <form action="{{ route('tasks.toggle', $task->id) }}" method="POST" class="task-action-form">
                            @csrf
                            @method('PATCH')
                            @if ($task->is_completed)
                                <button type="submit" class="btn btn-outline">
                                    <i class="ph ph-arrow-counter-clockwise"></i>
                                    Batal Selesai
                                </button>
                            @else
                                <button type="submit" class="btn btn-primary">
                                    <i class="ph ph-check"></i>
                                    Tandai Selesai
                                </button>
                            @endif
                        </form>
                        
                        <form action="{{ route('tasks.destroy', $task->id) }}" method="POST" class="task-action-form">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger" 
                                    onclick="return confirm('Anda yakin ingin menghapus tugas ini?')">
                                <i class="ph ph-trash"></i>
                                Hapus
                            </button>
                        </form>
                    </div>
                </div>
                @endforeach
            </div>
        @endif
    </div>
</div>

<style>
    .dashboard-grid {
        display: grid;
        grid-template-columns: 1fr;
        gap: 2rem;
        margin-top: 1.5rem;
    }

    @media (min-width: 1024px) {
        .dashboard-grid {
            grid-template-columns: 400px 1fr;
        }
    }

    /* Header Improvements */
    .header-content {
        display: flex;
        justify-content: space-between;
        align-items: flex-start;
        gap: 2rem;
    }

    .header-text {
        flex: 1;
    }

    .header-meta {
        display: flex;
        gap: 1.5rem;
        margin-top: 0.5rem;
        flex-wrap: wrap;
    }

    .meta-item {
        display: flex;
        align-items: center;
        gap: 0.5rem;
        font-size: 0.875rem;
        color: var(--text-muted);
    }

    .header-actions {
        display: flex;
        gap: 0.75rem;
        flex-shrink: 0;
    }

    /* Button Styles - Fixed Warning Color */
    .btn {
        display: inline-flex;
        align-items: center;
        gap: 0.5rem;
        padding: 0.5rem 1rem;
        border-radius: var(--radius-md);
        font-size: 0.875rem;
        font-weight: 500;
        text-decoration: none;
        transition: var(--transition);
        border: none;
        cursor: pointer;
    }

    .btn-warning {
        background: var(--accent-warning);
        color: white;
    }

    .btn-warning:hover {
        background: #eab308;
        transform: translateY(-1px);
        box-shadow: var(--shadow-md);
    }

    .btn-outline {
        background: transparent;
        color: var(--text-primary);
        border: 1px solid var(--border-medium);
    }

    .btn-outline:hover {
        background: var(--bg-input);
    }

    .btn-primary {
        background: var(--accent-primary);
        color: white;
    }

    .btn-primary:hover {
        background: var(--accent-secondary);
    }

    .btn-danger {
        background: var(--accent-danger);
        color: white;
    }

    .btn-danger:hover {
        background: #dc2626;
    }

    /* Form Improvements */
    .form-container {
        height: fit-content;
        position: sticky;
        top: 2rem;
    }

    .form-card {
        background: var(--bg-card);
        border-radius: var(--radius-lg);
        box-shadow: var(--shadow-md);
        padding: 2rem;
        border: 1px solid var(--border-light);
        height: fit-content;
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
        gap: 1rem;
    }

    @media (min-width: 640px) {
        .form-row {
            grid-template-columns: 1fr 1fr;
        }
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

    .form-actions {
        margin-top: 2rem;
        padding-top: 1.5rem;
        border-top: 1px solid var(--border-light);
    }

    .btn-lg {
        padding: 0.75rem 1.5rem;
        font-size: 1rem;
        width: 100%;
    }

    /* Tasks Container */
    .tasks-container {
        background: var(--bg-card);
        border-radius: var(--radius-lg);
        box-shadow: var(--shadow-md);
        padding: 2rem;
        border: 1px solid var(--border-light);
    }

    .tasks-header {
        display: flex;
        justify-content: space-between;
        align-items: center;
        margin-bottom: 2rem;
        flex-wrap: wrap;
        gap: 1rem;
    }

    .section-title {
        font-size: 1.5rem;
        font-weight: 600;
        color: var(--text-primary);
        margin: 0;
    }

    .tasks-stats {
        display: flex;
        gap: 1rem;
        flex-wrap: wrap;
    }

    .stat-item {
        display: flex;
        align-items: center;
        gap: 0.5rem;
        padding: 0.5rem 1rem;
        background: var(--bg-input);
        border-radius: var(--radius-md);
        font-size: 0.875rem;
        color: var(--text-muted);
    }

    /* Tasks Grid */
    .tasks-grid {
        display: grid;
        gap: 1.5rem;
    }

    /* Task Card */
    .task-card {
        background: var(--bg-card);
        border-radius: var(--radius-lg);
        box-shadow: var(--shadow-sm);
        padding: 1.5rem;
        border: 1px solid var(--border-light);
        transition: var(--transition);
        position: relative;
        overflow: hidden;
    }

    .task-card::before {
        content: '';
        position: absolute;
        top: 0;
        left: 0;
        width: 4px;
        height: 100%;
        transition: var(--transition);
    }

    .task-card:not(.completed)::before {
        background: linear-gradient(135deg, var(--accent-warning), #f59e0b);
    }

    .task-card.completed::before {
        background: linear-gradient(135deg, var(--accent-success), #10b981);
    }

    .task-card:hover {
        transform: translateY(-2px);
        box-shadow: var(--shadow-md);
    }

    .task-card.completed {
        opacity: 0.8;
    }

    .task-header {
        display: flex;
        justify-content: space-between;
        align-items: flex-start;
        margin-bottom: 1rem;
        gap: 1rem;
    }

    .task-title {
        font-size: 1.125rem;
        font-weight: 600;
        color: var(--text-primary);
        margin: 0;
        flex: 1;
        line-height: 1.4;
    }

    .task-status {
        padding: 0.375rem 0.75rem;
        border-radius: var(--radius-full);
        font-size: 0.75rem;
        font-weight: 600;
        text-transform: uppercase;
        letter-spacing: 0.5px;
        white-space: nowrap;
    }

    .status-completed {
        background: var(--accent-success);
        color: white;
    }

    .status-pending {
        background: var(--accent-warning);
        color: white;
    }

    .task-meta {
        display: flex;
        flex-direction: column;
        gap: 0.75rem;
        margin-bottom: 1.5rem;
    }

    .meta-item {
        display: flex;
        align-items: center;
        gap: 0.5rem;
        font-size: 0.875rem;
        color: var(--text-muted);
    }

    .task-actions {
        display: flex;
        gap: 0.75rem;
        flex-wrap: wrap;
    }

    .task-action-form {
        margin: 0;
    }

    .task-action-form .btn {
        padding: 0.5rem 1rem;
        font-size: 0.875rem;
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

    /* Responsive Design */
    @media (max-width: 768px) {
        .header-content {
            flex-direction: column;
            gap: 1rem;
        }

        .header-actions {
            width: 100%;
        }

        .header-actions .btn {
            flex: 1;
            justify-content: center;
        }

        .tasks-header {
            flex-direction: column;
            align-items: flex-start;
        }

        .tasks-stats {
            width: 100%;
        }

        .stat-item {
            flex: 1;
            justify-content: center;
        }

        .task-header {
            flex-direction: column;
            align-items: flex-start;
        }

        .task-actions {
            flex-direction: column;
        }

        .task-action-form .btn {
            width: 100%;
            justify-content: center;
        }

        .form-card,
        .tasks-container {
            padding: 1.5rem;
        }
    }

    @media (max-width: 480px) {
        .form-row {
            grid-template-columns: 1fr;
        }
        
        .header-meta {
            flex-direction: column;
            gap: 0.5rem;
        }
    }
</style>
@endsection