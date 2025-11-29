@extends('layouts.app')
@section('title', 'Dashboard')
{{-- 
    CATATAN: Penggunaan script @tailwindcss/browser@4 ini tidak biasa untuk produksi
    dan merupakan alasan mengapa Anda harus menggunakan style inline.
    Idealnya, Anda akan menggunakan kelas Tailwind (misal: class="bg-white dark:bg-gray-800")
    dan menghapus script ini.
    
    Namun, solusi di bawah ini akan bekerja dengan pengaturan Anda saat ini
    dengan mengganti warna statis dengan variabel CSS dari app.blade.php.
--}}
<script src="https://cdn.jsdelivr.net/npm/@tailwindcss/browser@4"></script>

@section('content')
    <div class="space-y-10">

        <div>
            <h1
                style="font-size: 2.25rem; font-weight: bold; background-image: linear-gradient(to right, #2563eb, #4f46e5); -webkit-background-clip: text; color: transparent;">
                List Pengerjaan
            </h1>
        </div>

        <br>

        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6 w-full">
            <div
                class="rounded-2xl p-6 bg-gradient-to-br from-blue-500 to-blue-600 text-white shadow-lg transition-all duration-300 hover:shadow-xl hover:-translate-y-1 relative overflow-hidden">
                <i class="ph ph-clipboard-text text-8xl opacity-10 absolute -right-4 -bottom-4"></i>
                <div class="flex items-center gap-4 relative">
                    <div><i class="ph ph-clipboard-text text-[2.5rem] opacity-90 mr-5"></i></div>
                    <div>
                        <h3 class="text-3xl font-bold">{{ $totalTasks ?? 0 }}</h3>
                        <p class="text-base opacity-90">Total Tugas</p>
                    </div>
                </div>
            </div>
            <div
                class="rounded-2xl p-6 bg-gradient-to-br from-green-500 to-green-600 text-white shadow-lg transition-all duration-300 hover:shadow-xl hover:-translate-y-1 relative overflow-hidden">
                <i class="ph ph-check-circle text-8xl opacity-10 absolute -right-4 -bottom-4"></i>
                <div class="flex items-center gap-4 relative">
                    <div><i class="ph ph-check-circle text-[2.5rem] opacity-90"></i></div>
                    <div>
                        <h3 class="text-3xl font-bold">{{ $completedTasks ?? 0 }}</h3>
                        <p class="text-base opacity-90">Selesai</p>
                    </div>
                </div>
            </div>
            <div
                class="rounded-2xl p-6 bg-gradient-to-br from-amber-500 to-amber-600 text-white shadow-lg transition-all duration-300 hover:shadow-xl hover:-translate-y-1 relative overflow-hidden">
                <i class="ph ph-clock text-8xl opacity-10 absolute -right-4 -bottom-4"></i>
                <div class="flex items-center gap-4 relative">
                    <div><i class="ph ph-clock text-[2.5rem] opacity-90"></i></div>
                    <div>
                        <h3 class="text-3xl font-bold">{{ $inProgressTasks ?? 0 }}</h3>
                        <p class="text-base opacity-90">Dalam Proses</p>
                    </div>
                </div>
            </div>
            <div
                class="rounded-2xl p-6 bg-gradient-to-br from-purple-500 to-purple-700 text-white shadow-lg transition-all duration-300 hover:shadow-xl hover:-translate-y-1 relative overflow-hidden">
                <i class="ph ph-warning-circle text-8xl opacity-10 absolute -right-4 -bottom-4"></i>
                <div class="flex items-center gap-4 relative">
                    <div><i class="ph ph-warning-circle text-[2.5rem] opacity-90"></i></div>
                    <div>
                        <h3 class="text-3xl font-bold">{{ $overdueTasks ?? 0 }}</h3>
                        <p class="text-base opacity-90">Terlambat</p>
                    </div>
                </div>
            </div>
        </div>

        <br>
        <br>

        <div style="grid-template-columns: repeat(1, minmax(0, 1fr)); gap: 2.5rem; lg:grid-template-columns: repeat(3, minmax(0, 1fr));">

            <div style="grid-column: span 2 / span 2; space-y: 3rem;">

                <div
                    style="background-color: var(--bg-card); border-radius: 1rem; box-shadow: var(--shadow-md); padding: 1.75rem; border: 1px solid var(--border-light);">
                    <div style="display: flex; align-items: center; justify-content: space-between; margin-bottom: 1.5rem;">
                        <h2 style="font-size: 1.5rem; font-weight: bold; color: var(--text-primary);">Quick Actions</h2>
                        <i class="ph ph-lightning" style="font-size: 2rem; color: #eab308;"></i>
                    </div>
                    <div
                        style="display: grid; grid-template-columns: repeat(2, minmax(0, 1fr)); gap: 1.25rem; md:grid-template-columns: repeat(4, minmax(0, 1fr));">
                        <a href="{{ route('lists.create') }}"
                            style="display: flex; flex-direction: column; align-items: center; justify-content: center; gap: 0.5rem; padding: 1.25rem; border-radius: 0.75rem; background-color: var(--bg-hover); border: 1px solid var(--border-light); color: var(--text-secondary); transition: all 0.2s; hover:scale(1.05); hover:border-color: #3b82f6; hover:color: #2563eb;">
                            <i class="ph ph-plus-circle" style="font-size: 2rem;"></i>
                            <span>Buat List</span>
                        </a>
                        <a href="{{ route('lists.index') }}"
                            style="display: flex; flex-direction: column; align-items: center; justify-content: center; gap: 0.5rem; padding: 1.25rem; border-radius: 0.75rem; background-color: var(--bg-hover); border: 1px solid var(--border-light); color: var(--text-secondary); transition: all 0.2s; hover:scale(1.05); hover:border-color: #3b82f6; hover:color: #2563eb;">
                            <i class="ph ph-list-checks" style="font-size: 2rem;"></i>
                            <span>Lihat Semua</span>
                        </a>
                        @if (Auth::user()->role == 'admin')
                            <a href="{{ route('admin.users.index') }}"
                                style="display: flex; flex-direction: column; align-items: center; justify-content: center; gap: 0.5rem; padding: 1.25rem; border-radius: 0.75rem; background-color: var(--bg-hover); border: 1px solid var(--border-light); color: var(--text-secondary); transition: all 0.2s; hover:scale(1.05); hover:border-color: #3b82f6; hover:color: #2563eb;">
                                <i class="ph ph-users" style="font-size: 2rem;"></i>
                                <span>Kelola User</span>
                            </a>
                        @endif
                    </div>
                </div>

                <br>

                <div style="background-color: var(--bg-card); border-radius: 1rem; box-shadow: var(--shadow-md); padding: 1.75rem; border: 1px solid var(--border-light);">
                    <div
                        style="display: flex; align-items: center; justify-content: space-between; margin-bottom: 1.75rem;">
                        <h2 style="font-size: 1.5rem; font-weight: bold; color: var(--text-primary);">Tugas Terbaru</h2>
                        <a href="{{ route('lists.index') }}" style="color: #3b82f6; hover:text-decoration: underline;">Lihat
                            Semua →</a>
                    </div>
                    <div style="space-y: 1.25rem;">
                        @forelse($recentTasks as $task)
                            <div
                                style="padding: 1.25rem; border-radius: 0.75rem; background-color: var(--bg-body); border: 1px solid var(--border-light); transition: all 0.2s; hover:border-color: #3b82f6;">
                                <div style="display: flex; align-items: center; gap: 1rem;">
                                    <div
                                        style="width: 0.75rem; height: 0.75rem; border-radius: 9999px; 
                                            @if ($task->is_completed) background-color: #10b981;
                                            @elseif($task->is_overdue)
                                                background-color: #ef4444;
                                            @else
                                                background-color: #f59e0b; @endif">
                                    </div>
                                    <div style="flex: 1 1 0%; min-width: 0;">
                                        <p style="font-size: 1rem; color: var(--text-primary);">
                                            {{ $task->deskripsi ?? 'Tanpa deskripsi' }}</p>
                                        <p style="font-size: 0.875rem; color: var(--text-secondary);">
                                            {{ $task->list->title ?? 'Tanpa list' }} •
                                            @if ($task->due_date)
                                                {{ \Carbon\Carbon::parse($task->due_date)->format('d M Y H:i') }}
                                                ({{ \Carbon\Carbon::parse($task->due_date)->diffForHumans() }})
                                            @else
                                                Tanpa tenggat
                                            @endif
                                        </p>
                                    </div>
                                    <span
                                        style="padding: 0.25rem 0.75rem; font-size: 0.75rem; font-weight: 500; border-radius: 9999px; 
                                            @if ($task->is_completed) background-color: #d1fae5; color: #065f46;
                                            @elseif($task->is_overdue)
                                                background-color: #fee2e2; color: #991b1b;
                                            @else
                                                background-color: #fef3c7; color: #92400e; @endif">
                                        @if ($task->is_completed)
                                            Selesai
                                        @elseif($task->is_overdue)
                                            Terlambat
                                        @else
                                            Proses
                                        @endif
                                    </span>
                                </div>
                            </div>
                        @empty
                            <div
                                style="text-align: center; padding-top: 2.5rem; padding-bottom: 2.5rem; color: var(--text-muted);">
                                <i class="ph ph-clipboard-text" style="font-size: 3rem; margin-bottom: 0.75rem;"></i>
                                <p>Belum ada tugas</p>
                            </div>
                        @endforelse
                    </div>
                </div>
            </div>

            <div style="display: flex; flex-direction: column; gap: 1rem; margin-block: 1rem;">
                <div style="background-color: var(--bg-card); border-radius: 1rem; box-shadow: var(--shadow-md); padding: 1.75rem; border: 1px solid var(--border-light);">
                    <h2 style="font-size: 1.5rem; font-weight: bold; margin-bottom: 1.5rem; color: var(--text-primary);"> Progress</h2>
                    <div style="space-y: 1.5rem;">
                        <div>
                            <div style="display: flex; justify-content: space-between; margin-bottom: 0.5rem;">
                                <span style="color: var(--text-secondary);">Tugas Selesai</span>
                                <span style="color: var(--text-primary);">{{ $completedTasks ?? 0 }} /
                                    {{ $totalTasks ?? 0 }}</span>
                            </div>
                            <div
                                style="height: 0.75rem; background-color: var(--border-light); border-radius: 9999px; overflow: hidden;">
                                <div
                                    style="height: 100%; background-color: #10b981; border-radius: 9999px; transition: all 0.7s; width: {{ $totalTasks > 0 ? ($completedTasks / $totalTasks) * 100 : 0 }}%;">
                                </div>
                            </div>
                        </div>
                        <div>
                            <div style="display: flex; justify-content: space-between; margin-bottom: 0.5rem;">
                                <span style="color: var(--text-secondary);">Dalam Proses</span>
                                <span style="color: var(--text-primary);">{{ $inProgressTasks ?? 0 }} /
                                    {{ $totalTasks ?? 0 }}</span>
                            </div>
                            <div
                                style="height: 0.75rem; background-color: var(--border-light); border-radius: 9999px; overflow: hidden;">
                                <div
                                    style="height: 100%; background-color: #f59e0b; border-radius: 9999px; transition: all 0.7s; width: {{ $totalTasks > 0 ? ($inProgressTasks / $totalTasks) * 100 : 0 }}%;">
                                </div>
                            </div>
                        </div>
                        <div>
                            <div style="display: flex; justify-content: space-between; margin-bottom: 0.5rem;">
                                <span style="color: var(--text-secondary);">Terlambat</span>
                                <span style="color: var(--text-primary);">{{ $overdueTasks ?? 0 }} /
                                    {{ $totalTasks ?? 0 }}</span>
                            </div>
                            <div
                                style="height: 0.75rem; background-color: var(--border-light); border-radius: 9999px; overflow: hidden;">
                                <div
                                    style="height: 100%; background-color: #ef4444; border-radius: 9999px; transition: all 0.7s; width: {{ $totalTasks > 0 ? ($overdueTasks / $totalTasks) * 100 : 0 }}%;">
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div
                    style="background-color: var(--bg-card); border-radius: 1rem; box-shadow: var(--shadow-md); padding: 1.75rem; border: 1px solid var(--border-light);">
                    <h2 style="font-size: 1.5rem; font-weight: bold; margin-bottom: 1.5rem; color: var(--text-primary);">
                        Deadline
                        Mendatang</h2>
                    <div style="space-y: 1.25rem;">
                        @forelse($upcomingTasks as $task)
                            <div
                                style="padding: 1.25rem; border-radius: 0.75rem; background-color: var(--bg-body); border: 1px solid var(--border-light);">
                                <div style="display: flex; align-items: center; gap: 1rem;">
                                    <div
                                        style="width: 2.5rem; height: 2.5rem; border-radius: 9999px; 
                                            @if ($task->is_overdue) background-color: #fee2e2;
                                            @else
                                                background-color: #dbeafe; @endif
                                            display: flex; align-items: center; justify-content: center;">
                                        <i class="ph ph-clock"
                                            style="font-size: 1.5rem; 
                                                  @if ($task->is_overdue) color: #ef4444;
                                                  @else
                                                      color: #3b82f6; @endif"></i>
                                    </div>
                                    <div style="flex: 1;">
                                        <p style="font-size: 1rem; color: var(--text-primary);">
                                            {{ $task->deskripsi ?? 'Tanpa deskripsi' }}</p>
                                        <p style="font-size: 0.875rem; color: var(--text-secondary);">
                                            @if ($task->due_date)
                                                {{ \Carbon\Carbon::parse($task->due_date)->format('d M Y H:i') }}
                                                ({{ \Carbon\Carbon::parse($task->due_date)->diffForHumans() }})
                                            @else
                                                Tanpa tenggat
                                            @endif
                                        </p>
                                    </div>
                                </div>
                            </div>
                        @empty
                            <div
                                style="text-align: center; padding-top: 2.5rem; padding-bottom: 2.5rem; color: var(--text-muted);">
                                <i class="ph ph-smiley" style="font-size: 2.5rem; margin-bottom: 0.5rem;"></i>
                                <p>Tidak ada deadline mendatang</p>
                            </div>
                        @endforelse
                    </div>
                </div>
            </div>
        </div>
    </div>

    {{-- 
        Saya juga memperbarui modal kalender ini agar mendukung mode gelap.
    --}}
    <div id="calendarModal"
        style="position: fixed; inset: 0; background-color: rgba(0,0,0,0.5); backdrop-filter: blur(0.25rem); z-index: 50; display: none; align-items: center; justify-content: center; padding: 1rem;">
        <div
            style="background-color: var(--bg-card); border-radius: 1rem; box-shadow: var(--shadow-lg); max-width: 60rem; width: 100%; max-height: 90vh; overflow: hidden; border: 1px solid var(--border-light);">
            <div
                style="display: flex; align-items: center; justify-content: space-between; padding: 1.5rem; border-bottom: 1px solid var(--border-light);">
                <h3 style="font-size: 1.25rem; font-weight: 600; color: var(--text-primary);">Kalender Tugas - Overview
                </h3>
                <button onclick="hideCalendar()"
                    style="padding: 0.5rem; border-radius: 0.5rem; background: transparent; border: none; color: var(--text-secondary); cursor: pointer; transition: all 0.2s; hover:background-color: var(--bg-hover); hover:color: var(--text-primary);">
                    <i class="ph ph-x"></i>
                </button>
            </div>
            <div style="padding: 1.5rem; overflow: auto;">
                <div style="display: grid; grid-template-columns: 1fr 300px; gap: 2rem;">
                    <div>
                        <div
                            style="display: flex; align-items: center; justify-content: space-between; margin-bottom: 1.5rem;">
                            <h4 style="font-size: 1.125rem; font-weight: 600; color: var(--text-primary);"
                                id="calendarTitle">Kalender
                            </h4>
                            <div style="display: flex; gap: 0.5rem;">
                                <button onclick="prevMonth()"
                                    style="padding: 0.5rem; border-radius: 0.375rem; background-color: var(--bg-hover); color: var(--text-primary); border: 1px solid var(--border-light); transition: all 0.2s; hover:background-color: #3b82f6; hover:color: white; cursor: pointer;">
                                    <i class="ph ph-caret-left"></i>
                                </button>
                                <button onclick="nextMonth()"
                                    style="padding: 0.5rem; border-radius: 0.375rem; background-color: var(--bg-hover); color: var(--text-primary); border: 1px solid var(--border-light); transition: all 0.2s; hover:background-color: #3b82f6; hover:color: white; cursor: pointer;">
                                    <i class="ph ph-caret-right"></i>
                                </button>
                            </div>
                        </div>
                        <div id="full-calendar"
                            style="border: 1px solid var(--border-light); border-radius: 0.5rem; padding: 1rem;">
                        </div>
                    </div>

                    <div>
                        <h4
                            style="font-size: 1.125rem; font-weight: 600; color: var(--text-primary); margin-bottom: 1rem;">
                            Tugas <span id="selectedDateText">Hari Ini</span></h4>
                        <div id="dateTasks" style="max-height: 400px; overflow-y: auto;">
                            <div style="text-align: center; padding: 2rem; color: var(--text-muted);">
                                <i class="ph ph-calendar-blank" style="font-size: 2rem; margin-bottom: 0.5rem;"></i>
                                <p>Pilih tanggal untuk melihat tugas</p>
                            </div>
                        </div>
                    </div>
                </div>

                <div style="margin-top: 2rem; padding-top: 1.5rem; border-top: 1px solid var(--border-light);">
                    <h4 style="font-size: 1.125rem; font-weight: 600; color: var(--text-primary); margin-bottom: 1rem;">
                        Statistik Bulan
                        Ini</h4>
                    <div style="display: grid; grid-template-columns: repeat(3, 1fr); gap: 1rem;">
                        <div style="text-align: center; padding: 1rem; background-color: #f0f9ff; border-radius: 0.5rem;">
                            <div style="font-size: 1.5rem; font-weight: bold; color: #0369a1;" id="monthCompleted">0
                            </div>
                            <div style="font-size: 0.875rem; color: #6b7280;">Selesai</div>
                        </div>
                        <div style="text-align: center; padding: 1rem; background-color: #fef3c7; border-radius: 0.5rem;">
                            <div style="font-size: 1.5rem; font-weight: bold; color: #92400e;" id="monthPending">0
                            </div>
                            <div style="font-size: 0.875rem; color: #6b7280;">Dalam Proses</div>
                        </div>
                        <div style="text-align: center; padding: 1rem; background-color: #fef2f2; border-radius: 0.5rem;">
                            <div style="font-size: 1.5rem; font-weight: bold; color: #dc2626;" id="monthOverdue">0
                            </div>
                            <div style="font-size: 0.875rem; color: #6b7280;">Terlambat</div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script>
        let currentDate = new Date();
        let tasksData = @json($recentTasks->merge($upcomingTasks)->unique('id')->values());

        // Variabel CSS untuk direferensikan dalam JS
        const cssVars = {
            textPrimary: getComputedStyle(document.documentElement).getPropertyValue('--text-primary'),
            borderLight: getComputedStyle(document.documentElement).getPropertyValue('--border-light')
        };
        // Perbarui variabel saat tema berubah
        new MutationObserver(() => {
            cssVars.textPrimary = getComputedStyle(document.documentElement).getPropertyValue('--text-primary');
            cssVars.borderLight = getComputedStyle(document.documentElement).getPropertyValue('--border-light');
            renderFullCalendar(); // Render ulang kalender saat tema berubah
        }).observe(document.body, {
            attributes: true,
            attributeFilter: ['class']
        });


        function renderFullCalendar() {
            const el = document.getElementById('full-calendar');
            const titleEl = document.getElementById('calendarTitle');
            const month = currentDate.toLocaleString('id-ID', {
                month: 'long'
            });
            const year = currentDate.getFullYear();
            const firstDay = new Date(year, currentDate.getMonth(), 1).getDay();
            const daysInMonth = new Date(year, currentDate.getMonth() + 1, 0).getDate();
            const today = new Date();

            titleEl.textContent = `${month} ${year}`;

            // Hitung statistik bulan ini
            const monthStart = new Date(year, currentDate.getMonth(), 1);
            const monthEnd = new Date(year, currentDate.getMonth() + 1, 0);

            const monthTasks = tasksData.filter(task => {
                if (!task.due_date) return false;
                const dueDate = new Date(task.due_date);
                return dueDate >= monthStart && dueDate <= monthEnd;
            });

            const completed = monthTasks.filter(task => task.is_completed).length;
            const pending = monthTasks.filter(task => !task.is_completed && new Date(task.due_date) >= new Date())
                .length;
            const overdue = monthTasks.filter(task => !task.is_completed && new Date(task.due_date) < new Date())
                .length;

            document.getElementById('monthCompleted').textContent = completed;
            document.getElementById('monthPending').textContent = pending;
            document.getElementById('monthOverdue').textContent = overdue;

            let html = `
            <div style="display: grid; grid-template-columns: repeat(7, minmax(0, 1fr)); gap: 0.5rem; text-align: center; font-weight: 500; color: var(--text-muted); margin-bottom: 1rem;">
                <div>Min</div><div>Sen</div><div>Sel</div><div>Rab</div><div>Kam</div><div>Jum</div><div>Sab</div>
            </div>
            <div style="display: grid; grid-template-columns: repeat(7, minmax(0, 1fr)); gap: 0.5rem;">
        `;

            for (let i = 0; i < firstDay; i++) {
                html += `<div style="aspect-ratio: 1 / 1;"></div>`;
            }

            for (let day = 1; day <= daysInMonth; day++) {
                const dateStr =
                    `${year}-${String(currentDate.getMonth() + 1).padStart(2, '0')}-${String(day).padStart(2, '0')}`;
                const isToday = today.getDate() === day && today.getMonth() === currentDate.getMonth() && today
                    .getFullYear() === year;

                // Cari tugas untuk tanggal ini
                const dayTasks = tasksData.filter(task => {
                    if (!task.due_date) return false;
                    const taskDate = new Date(task.due_date).toISOString().split('T')[0];
                    return taskDate === dateStr;
                });

                const hasTasks = dayTasks.length > 0;
                const completedTasks = dayTasks.filter(task => task.is_completed).length;
                const pendingTasks = dayTasks.filter(task => !task.is_completed).length;

                let taskIndicator = '';
                if (hasTasks) {
                    if (completedTasks === dayTasks.length) {
                        taskIndicator =
                            '<div style="width: 6px; height: 6px; background-color: #10b981; border-radius: 50%; margin: 2px auto 0;"></div>';
                    } else if (pendingTasks > 0) {
                        taskIndicator =
                            '<div style="width: 6px; height: 6px; background-color: #f59e0b; border-radius: 50%; margin: 2px auto 0;"></div>';
                    }
                }

                html += `
                <div style="aspect-ratio: 1 / 1; display: flex; flex-direction: column; align-items: center; justify-content: center; border-radius: 0.5rem; 
                    ${isToday ? 'background-color: #3b82f6; color: white; font-weight: bold;' : `color: ${cssVars.textPrimary}; border: 1px solid ${cssVars.borderLight};`} 
                    cursor: pointer; transition: all 0.2s; hover:background-color: #3b82f6; hover:color: white; position: relative;"
                    onclick="showDateTasks('${dateStr}')">
                    ${day}
                    ${taskIndicator}
                    ${hasTasks ? `<div style="position: absolute; top: 2px; right: 2px; font-size: 0.6rem;">${dayTasks.length}</div>` : ''}
                </div>
            `;
            }

            html += `</div>`;
            el.innerHTML = html;

            // Tampilkan tugas hari ini secara default
            const todayStr = today.toISOString().split('T')[0];
            showDateTasks(todayStr);
        }

        function showDateTasks(dateStr) {
            const date = new Date(dateStr + 'T00:00:00'); // Atur ke waktu lokal
            const options = {
                day: 'numeric',
                month: 'long',
                year: 'numeric'
            };
            document.getElementById('selectedDateText').textContent = date.toLocaleDateString('id-ID', options);

            const tasksListEl = document.getElementById('dateTasks');
            const dayTasks = tasksData.filter(task => {
                if (!task.due_date) return false;
                const taskDate = new Date(task.due_date).toISOString().split('T')[0];
                return taskDate === dateStr;
            });

            if (dayTasks.length === 0) {
                tasksListEl.innerHTML = `
                <div style="text-align: center; padding: 2rem; color: var(--text-muted);">
                    <i class="ph ph-calendar-check" style="font-size: 2rem; margin-bottom: 0.5rem;"></i>
                    <p>Tidak ada tugas untuk tanggal ini</p>
                </div>
            `;
                return;
            }

            let tasksHtml = '<div style="space-y: 0.75rem;">';
            dayTasks.forEach(task => {
                const taskDueDate = new Date(task.due_date);
                tasksHtml += `
                <div style="padding: 0.75rem; border-radius: 0.5rem; background-color: var(--bg-body); border: 1px solid var(--border-light); display: flex; align-items: center; gap: 0.75rem;">
                    <div style="width: 0.5rem; height: 0.5rem; border-radius: 50%;
                        ${task.is_completed ? 'background-color: #10b981;' : (task.is_overdue ? 'background-color: #ef4444;' : 'background-color: #f59e0b;')}
                    "></div>
                    <div>
                        <p style="color: var(--text-primary);">${task.deskripsi || 'Tanpa deskripsi'}</p>
                        <p style="font-size: 0.75rem; color: var(--text-secondary);">${taskDueDate.toLocaleTimeString('id-ID', { hour: '2-digit', minute: '2-digit' })} - ${task.list.title}</p>
                    </div>
                </div>
            `;
            });
            tasksHtml += '</div>';
            tasksListEl.innerHTML = tasksHtml;
        }

        function showCalendar() {
            renderFullCalendar();
            document.getElementById('calendarModal').style.display = 'flex';
        }

        function hideCalendar() {
            document.getElementById('calendarModal').style.display = 'none';
        }

        function prevMonth() {
            currentDate.setMonth(currentDate.getMonth() - 1);
            renderFullCalendar();
        }

        function nextMonth() {
            currentDate.setMonth(currentDate.getMonth() + 1);
            renderFullCalendar();
        }

        // Event listeners
        document.addEventListener('DOMContentLoaded', function() {
            // Hapus event listener lama jika ada, atau tambahkan jika tidak ada
            // (Ini hanya untuk mencegah penambahan ganda jika script ini dimuat ulang)
            // const oldCalendarBtn = document.getElementById('openCalendarBtn');
            if (oldCalendarBtn) {
                oldCalendarBtn.remove(); // Hapus jika ada
            }

            // Tambahkan tombol untuk membuka kalender di header
            const headerActions = document.querySelector('.header-actions');
            if (headerActions) {
                const calendarBtn = document.createElement('button');
                calendarBtn.id = 'openCalendarBtn';
                calendarBtn.className = 'btn btn-outline'; // Menggunakan style tombol dari app.blade.php
                calendarBtn.onclick = showCalendar;
                headerActions.appendChild(calendarBtn);
            }


            document.addEventListener('click', e => {
                if (e.target.id === 'calendarModal') hideCalendar();
            });
        });
    </script>
@endsection
