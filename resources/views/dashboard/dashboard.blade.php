@extends('layouts.app')
@section('title', 'Dashboard')
<script src="https://cdn.jsdelivr.net/npm/@tailwindcss/browser@4"></script>

@section('content')
    <div class="space-y-10">

        <!-- Header: Judul + Tanggal di bawahnya -->
        <div>
            <h1
                style="font-size: 2.25rem; font-weight: bold; background-image: linear-gradient(to right, #2563eb, #4f46e5); -webkit-background-clip: text; color: transparent;"> List Pengerjaan
            </h1>
        </div>

        <br>

        <!-- Statistics Cards -->
        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6 w-full">

            <div
                class="rounded-2xl p-6 bg-gradient-to-br from-blue-500 to-blue-600 text-white shadow-lg transition-all duration-300 hover:shadow-xl hover:-translate-y-1 relative overflow-hidden">

                <i class="ph ph-clipboard-text text-8xl opacity-10 absolute -right-4 -bottom-4"></i>

                <div class="flex items-center gap-4 relative">
                    <div>
                        <i class="ph ph-clipboard-text text-[2.5rem] opacity-90 mr-5"></i>
                    </div>
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
                    <div>
                        <i class="ph ph-check-circle text-[2.5rem] opacity-90"></i>
                    </div>
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
                    <div>
                        <i class="ph ph-clock text-[2.5rem] opacity-90"></i>
                    </div>
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
                    <div>
                        <i class="ph ph-warning-circle text-[2.5rem] opacity-90"></i>
                    </div>
                    <div>
                        <h3 class="text-3xl font-bold">{{ $overdueTasks ?? 0 }}</h3>
                        <p class="text-base opacity-90">Terlambat</p>
                    </div>
                </div>
            </div>
        </div>

        <br>


        <!-- Main Content -->
        <div
            style="display: grid; grid-template-columns: repeat(1, minmax(0, 1fr)); gap: 2.5rem; lg:grid-template-columns: repeat(3, minmax(0, 1fr));">

            <!-- Left Column -->
            <div style="grid-column: span 2 / span 2; space-y: 3rem;">

                <!-- Quick Actions -->
                <div
                    style="background-color: white; border-radius: 1rem; box-shadow: 0 4px 6px -1px rgba(0,0,0,0.1), 0 2px 4px -1px rgba(0,0,0,0.06); padding: 1.75rem; border: 1px solid #e5e7eb;">
                    <div style="display: flex; align-items: center; justify-content: space-between; margin-bottom: 1.5rem;">
                        <h2 style="font-size: 1.5rem; font-weight: bold; color: #1f2937;">Quick Actions</h2>
                        <i class="ph ph-lightning" style="font-size: 2rem; color: #eab308;"></i>
                    </div>
                    <div
                        style="display: grid; grid-template-columns: repeat(2, minmax(0, 1fr)); gap: 1.25rem; md:grid-template-columns: repeat(4, minmax(0, 1fr));">
                        <a href="{{ route('lists.create') }}"
                            style="display: flex; flex-direction: column; align-items: center; justify-content: center; gap: 0.5rem; padding: 1.25rem; border-radius: 0.75rem; background-color: #f3f4f6; border: 1px solid #e5e7eb; color: #4b5563; transition: all 0.2s; hover:scale(1.05); hover:border-color: #3b82f6; hover:color: #2563eb;">
                            <i class="ph ph-plus-circle" style="font-size: 2rem;"></i>
                            <span>Buat List</span>
                        </a>
                        <a href="{{ route('lists.index') }}"
                            style="display: flex; flex-direction: column; align-items: center; justify-content: center; gap: 0.5rem; padding: 1.25rem; border-radius: 0.75rem; background-color: #f3f4f6; border: 1px solid #e5e7eb; color: #4b5563; transition: all 0.2s; hover:scale(1.05); hover:border-color: #3b82f6; hover:color: #2563eb;">
                            <i class="ph ph-list-checks" style="font-size: 2rem;"></i>
                            <span>Lihat Semua</span>
                        </a>
                        @if (Auth::user()->role == 'admin')
                            <a href="{{ route('admin.users.index') }}"
                                style="display: flex; flex-direction: column; align-items: center; justify-content: center; gap: 0.5rem; padding: 1.25rem; border-radius: 0.75rem; background-color: #f3f4f6; border: 1px solid #e5e7eb; color: #4b5563; transition: all 0.2s; hover:scale(1.05); hover:border-color: #3b82f6; hover:color: #2563eb;">
                                <i class="ph ph-users" style="font-size: 2rem;"></i>
                                <span>Kelola User</span>
                            </a>
                        @endif
                    </div>
                </div>

                <br>

                <!-- Recent Tasks -->
                <div
                    style="background-color: white; border-radius: 1rem; box-shadow: 0 4px 6px -1px rgba(0,0,0,0.1), 0 2px 4px -1px rgba(0,0,0,0.06); padding: 1.75rem; border: 1px solid #e5e7eb;">
                    <div
                        style="display: flex; align-items: center; justify-content: space-between; margin-bottom: 1.75rem;">
                        <h2 style="font-size: 1.5rem; font-weight: bold; color: #1f2937;">Tugas Terbaru</h2>
                        <a href="{{ route('lists.index') }}" style="color: #3b82f6; hover:text-decoration: underline;">Lihat
                            Semua →</a>
                    </div>
                    <div style="space-y: 1.25rem;">
                        @forelse($recentTasks as $task)
                            <div
                                style="padding: 1.25rem; border-radius: 0.75rem; background-color: #f9fafb; border: 1px solid #e5e7eb; transition: all 0.2s; hover:border-color: #3b82f6;">
                                <div style="display: flex; align-items: center; gap: 1rem;">
                                    <div
                                        style="width: 0.75rem; height: 0.75rem; border-radius: 9999px; {{ $task->is_completed ? 'background-color: #10b981;' : 'background-color: #f59e0b;' }}">
                                    </div>
                                    <div style="flex: 1 1 0%; min-width: 0;">
                                        <p style="font-size: 1rem; color: #1f2937;">
                                            {{ $task->deskripsi ?? 'Tanpa deskripsi' }}</p>
                                        <p style="font-size: 0.875rem; color: #6b7280;">
                                            {{ $task->list->title ?? 'Tanpa list' }} •
                                            {{ $task->due_date ? \Carbon\Carbon::parse($task->due_date)->diffForHumans() : 'Tanpa tenggat' }}
                                        </p>
                                    </div>
                                    <span
                                        style="padding: 0.25rem 0.75rem; font-size: 0.75rem; font-weight: 500; border-radius: 9999px; {{ $task->is_completed ? 'background-color: #d1fae5; color: #065f46;' : 'background-color: #fef3c7; color: #92400e;' }}">
                                        {{ $task->is_completed ? 'Selesai' : 'Proses' }}
                                    </span>
                                </div>
                            </div>
                        @empty
                            <div style="text-align: center; padding-top: 2.5rem; padding-bottom: 2.5rem; color: #6b7280;">
                                <i class="ph ph-clipboard-text" style="font-size: 3rem; margin-bottom: 0.75rem;"></i>
                                <p>Belum ada tugas</p>
                            </div>
                        @endforelse
                    </div>
                </div>
            </div>

            <!-- Right Column -->
            <div style="space-y: 3rem;">

                <!-- Progress Chart -->
                    <h2 style="font-size: 1.5rem; font-weight: bold; margin-bottom: 1.5rem; color: #1f2937;">Progress</h2>
                    <div style="space-y: 1.5rem;">
                        <div>
                            <div style="display: flex; justify-content: space-between; margin-bottom: 0.5rem;">
                                <span style="color: #6b7280;">Tugas Selesai</span>
                                <span>{{ $completedTasks ?? 0 }} / {{ $totalTasks ?? 0 }}</span>
                            </div>
                            <div
                                style="height: 0.75rem; background-color: #e5e7eb; border-radius: 9999px; overflow: hidden;">
                                <div
                                    style="height: 100%; background-color: #10b981; border-radius: 9999px; transition: all 0.7s; width: {{ $totalTasks > 0 ? ($completedTasks / $totalTasks) * 100 : 0 }}%;">
                                </div>
                            </div>
                        </div>
                        <div>
                            <div style="display: flex; justify-content: space-between; margin-bottom: 0.5rem;">
                                <span style="color: #6b7280;">Dalam Proses</span>
                                <span>{{ $inProgressTasks ?? 0 }} / {{ $totalTasks ?? 0 }}</span>
                            </div>
                            <div
                                style="height: 0.75rem; background-color: #e5e7eb; border-radius: 9999px; overflow: hidden;">
                                <div
                                    style="height: 100%; background-color: #f59e0b; border-radius: 9999px; transition: all 0.7s; width: {{ $totalTasks > 0 ? ($inProgressTasks / $totalTasks) * 100 : 0 }}%;">
                                </div>
                            </div>
                        </div>
                        <div>
                            <div style="display: flex; justify-content: space-between; margin-bottom: 0.5rem;">
                                <span style="color: #6b7280;">Terlambat</span>
                                <span>{{ $overdueTasks ?? 0 }} / {{ $totalTasks ?? 0 }}</span>
                            </div>
                            <div
                                style="height: 0.75rem; background-color: #e5e7eb; border-radius: 9999px; overflow: hidden;">
                                <div
                                    style="height: 100%; background-color: #ef4444; border-radius: 9999px; transition: all 0.7s; width: {{ $totalTasks > 0 ? ($overdueTasks / $totalTasks) * 100 : 0 }}%;">
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Upcoming Deadlines -->
                <div
                    style="background-color: white; border-radius: 1rem; box-shadow: 0 4px 6px -1px rgba(0,0,0,0.1), 0 2px 4px -1px rgba(0,0,0,0.06); padding: 1.75rem; border: 1px solid #e5e7eb;">
                    <h2 style="font-size: 1.5rem; font-weight: bold; margin-bottom: 1.5rem; color: #1f2937;">Deadline
                        Mendatang</h2>
                    <div style="space-y: 1.25rem;">
                        @forelse($upcomingTasks as $task)
                            <div
                                style="padding: 1.25rem; border-radius: 0.75rem; background-color: #f9fafb; border: 1px solid #e5e7eb;">
                                <div style="display: flex; align-items: center; gap: 1rem;">
                                    <div
                                        style="width: 2.5rem; height: 2.5rem; border-radius: 9999px; background-color: #fee2e2; display: flex; align-items: center; justify-content: center;">
                                        <i class="ph ph-clock" style="color: #ef4444; font-size: 1.5rem;"></i>
                                    </div>
                                    <div style="flex: 1;">
                                        <p style="font-size: 1rem; color: #1f2937;">
                                            {{ $task->deskripsi ?? 'Tanpa deskripsi' }}</p>
                                        <p style="font-size: 0.875rem; color: #6b7280;">
                                            {{ $task->due_date ? \Carbon\Carbon::parse($task->due_date)->diffForHumans() : 'Tanpa tenggat' }}
                                        </p>
                                    </div>
                                </div>
                            </div>
                        @empty
                            <div style="text-align: center; padding-top: 2.5rem; padding-bottom: 2.5rem; color: #6b7280;">
                                <i class="ph ph-smiley" style="font-size: 2.5rem; margin-bottom: 0.5rem;"></i>
                                <p>Tidak ada deadline mendatang</p>
                            </div>
                        @endforelse
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Full Calendar Modal dengan Tugas -->
    <div id="calendarModal"
        style="position: fixed; inset: 0; background-color: rgba(0,0,0,0.5); backdrop-filter: blur(0.25rem); z-index: 50; display: none; align-items: center; justify-content: center; padding: 1rem;">
        <div
            style="background-color: white; border-radius: 1rem; box-shadow: 0 10px 15px -3px rgba(0,0,0,0.1), 0 4px 6px -2px rgba(0,0,0,0.05); max-width: 60rem; width: 100%; max-height: 90vh; overflow: hidden; border: 1px solid #e5e7eb;">
            <div
                style="display: flex; align-items: center; justify-content: space-between; padding: 1.5rem; border-bottom: 1px solid #e5e7eb;">
                <h3 style="font-size: 1.25rem; font-weight: 600; color: #1f2937;">Kalender Tugas - Overview</h3>
                <button onclick="hideCalendar()"
                    style="padding: 0.5rem; border-radius: 0.5rem; background: transparent; border: none; color: #6b7280; cursor: pointer; transition: all 0.2s; hover:background-color: #f3f4f6; hover:color: #1f2937;">
                    <i class="ph ph-x"></i>
                </button>
            </div>
            <div style="padding: 1.5rem; overflow: auto;">
                <div style="display: grid; grid-template-columns: 1fr 300px; gap: 2rem;">
                    <!-- Calendar View -->
                    <div>
                        <div
                            style="display: flex; align-items: center; justify-content: space-between; margin-bottom: 1.5rem;">
                            <h4 style="font-size: 1.125rem; font-weight: 600; color: #1f2937;" id="calendarTitle">Kalender
                            </h4>
                            <div style="display: flex; gap: 0.5rem;">
                                <button onclick="prevMonth()"
                                    style="padding: 0.5rem; border-radius: 0.375rem; background-color: #f3f4f6; color: #374151; border: 1px solid #e5e7eb; transition: all 0.2s; hover:background-color: #3b82f6; hover:color: white; cursor: pointer;">
                                    <i class="ph ph-caret-left"></i>
                                </button>
                                <button onclick="nextMonth()"
                                    style="padding: 0.5rem; border-radius: 0.375rem; background-color: #f3f4f6; color: #374151; border: 1px solid #e5e7eb; transition: all 0.2s; hover:background-color: #3b82f6; hover:color: white; cursor: pointer;">
                                    <i class="ph ph-caret-right"></i>
                                </button>
                            </div>
                        </div>
                        <div id="full-calendar" style="border: 1px solid #e5e7eb; border-radius: 0.5rem; padding: 1rem;">
                        </div>
                    </div>

                    <!-- Tasks List for Selected Date -->
                    <div>
                        <h4 style="font-size: 1.125rem; font-weight: 600; color: #1f2937; margin-bottom: 1rem;">Tugas <span
                                id="selectedDateText">Hari Ini</span></h4>
                        <div id="dateTasks" style="max-height: 400px; overflow-y: auto;">
                            <div style="text-align: center; padding: 2rem; color: #6b7280;">
                                <i class="ph ph-calendar-blank" style="font-size: 2rem; margin-bottom: 0.5rem;"></i>
                                <p>Pilih tanggal untuk melihat tugas</p>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Quick Stats -->
                <div style="margin-top: 2rem; padding-top: 1.5rem; border-top: 1px solid #e5e7eb;">
                    <h4 style="font-size: 1.125rem; font-weight: 600; color: #1f2937; margin-bottom: 1rem;">Statistik Bulan
                        Ini</h4>
                    <div style="display: grid; grid-template-columns: repeat(3, 1fr); gap: 1rem;">
                        <div style="text-align: center; padding: 1rem; background-color: #f0f9ff; border-radius: 0.5rem;">
                            <div style="font-size: 1.5rem; font-weight: bold; color: #0369a1;" id="monthCompleted">0</div>
                            <div style="font-size: 0.875rem; color: #6b7280;">Selesai</div>
                        </div>
                        <div style="text-align: center; padding: 1rem; background-color: #fef3c7; border-radius: 0.5rem;">
                            <div style="font-size: 1.5rem; font-weight: bold; color: #92400e;" id="monthPending">0</div>
                            <div style="font-size: 0.875rem; color: #6b7280;">Dalam Proses</div>
                        </div>
                        <div style="text-align: center; padding: 1rem; background-color: #fef2f2; border-radius: 0.5rem;">
                            <div style="font-size: 1.5rem; font-weight: bold; color: #dc2626;" id="monthOverdue">0</div>
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
            const pending = monthTasks.filter(task => !task.is_completed && new Date(task.due_date) >= new Date()).length;
            const overdue = monthTasks.filter(task => !task.is_completed && new Date(task.due_date) < new Date()).length;

            document.getElementById('monthCompleted').textContent = completed;
            document.getElementById('monthPending').textContent = pending;
            document.getElementById('monthOverdue').textContent = overdue;

            let html = `
            <div style="display: grid; grid-template-columns: repeat(7, minmax(0, 1fr)); gap: 0.5rem; text-align: center; font-weight: 500; color: #6b7280; margin-bottom: 1rem;">
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
                    ${isToday ? 'background-color: #3b82f6; color: white; font-weight: bold;' : 'color: #374151; border: 1px solid #e5e7eb;'} 
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


        // Event listeners
        document.addEventListener('DOMContentLoaded', function() {
            document.addEventListener('click', e => {
                if (e.target.id === 'calendarModal') hideCalendar();
            });
        });
    </script>
@endsection
