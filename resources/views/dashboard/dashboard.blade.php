@extends('layouts.app')
@section('title', 'Dashboard PKL')

@section('content')
<div class="space-y-10">

    <!-- Header: Judul + Tanggal di bawahnya -->
    <div class="text-center" style="margin-bottom: 3rem;">
        <h1 style="font-size: 2.25rem; font-weight: bold; background-image: linear-gradient(to right, #2563eb, #4f46e5); -webkit-background-clip: text; color: transparent;">
            Dashboard PKL
        </h1>
        <div style="margin-top: 0.5rem; display: flex; align-items: center; justify-content: center; gap: 0.5rem; font-size: 1rem; font-weight: 600; color: #6b7280;">
            <i class="ph ph-calendar" style="font-size: 1.125rem;"></i>
            <span>{{ \Carbon\Carbon::now()->translatedFormat('l, d F Y') }}</span>
        </div>
    </div>

    <!-- Statistics Cards -->
    <div style="display: grid; grid-template-columns: repeat(1, minmax(0, 1fr)); gap: 1.5rem; margin-bottom: 3rem; sm:grid-template-columns: repeat(2, minmax(0, 1fr)); lg:grid-template-columns: repeat(4, minmax(0, 1fr));">
        <div style="border-radius: 1rem; padding: 1.5rem; background-image: linear-gradient(to bottom right, #3b82f6, #2563eb); color: white; box-shadow: 0 10px 15px -3px rgba(0,0,0,0.1), 0 4px 6px -2px rgba(0,0,0,0.05); transition: all 0.2s; position: relative; overflow: hidden;">
            <div style="margin-bottom: 1rem;"><i class="ph ph-clipboard-text" style="font-size: 2.5rem; opacity: 0.9;"></i></div>
            <h3 style="font-size: 2.25rem; font-weight: bold;">{{ $totalTasks ?? 0 }}</h3>
            <p style="font-size: 1rem; opacity: 0.9;">Total Tugas</p>
        </div>
        <div style="border-radius: 1rem; padding: 1.5rem; background-image: linear-gradient(to bottom right, #10b981, #059669); color: white; box-shadow: 0 10px 15px -3px rgba(0,0,0,0.1), 0 4px 6px -2px rgba(0,0,0,0.05); transition: all 0.2s; position: relative; overflow: hidden;">
            <div style="margin-bottom: 1rem;"><i class="ph ph-check-circle" style="font-size: 2.5rem; opacity: 0.9;"></i></div>
            <h3 style="font-size: 2.25rem; font-weight: bold;">{{ $completedTasks ?? 0 }}</h3>
            <p style="font-size: 1rem; opacity: 0.9;">Selesai</p>
        </div>
        <div style="border-radius: 1rem; padding: 1.5rem; background-image: linear-gradient(to bottom right, #f59e0b, #d97706); color: white; box-shadow: 0 10px 15px -3px rgba(0,0,0,0.1), 0 4px 6px -2px rgba(0,0,0,0.05); transition: all 0.2s; position: relative; overflow: hidden;">
            <div style="margin-bottom: 1rem;"><i class="ph ph-clock" style="font-size: 2.5rem; opacity: 0.9;"></i></div>
            <h3 style="font-size: 2.25rem; font-weight: bold;">{{ $inProgressTasks ?? 0 }}</h3>
            <p style="font-size: 1rem; opacity: 0.9;">Dalam Proses</p>
        </div>
        <div style="border-radius: 1rem; padding: 1.5rem; background-image: linear-gradient(to bottom right, #a855f7, #7e22ce); color: white; box-shadow: 0 10px 15px -3px rgba(0,0,0,0.1), 0 4px 6px -2px rgba(0,0,0,0.05); transition: all 0.2s; position: relative; overflow: hidden;">
            <div style="margin-bottom: 1rem;"><i class="ph ph-warning" style="font-size: 2.5rem; opacity: 0.9;"></i></div>
            <h3 style="font-size: 2.25rem; font-weight: bold;">{{ $overdueTasks ?? 0 }}</h3>
            <p style="font-size: 1rem; opacity: 0.9;">Terlambat</p>
        </div>
    </div>

    <!-- Main Content -->
    <div style="display: grid; grid-template-columns: repeat(1, minmax(0, 1fr)); gap: 3rem; lg:grid-template-columns: repeat(3, minmax(0, 1fr));">

        <!-- Left Column -->
        <div style="grid-column: span 2 / span 2; space-y: 3rem;">

            <!-- Quick Actions -->
            <div style="background-color: white; border-radius: 1rem; box-shadow: 0 4px 6px -1px rgba(0,0,0,0.1), 0 2px 4px -1px rgba(0,0,0,0.06); padding: 2rem; border: 1px solid #e5e7eb;">
                <div style="display: flex; align-items: center; justify-content: space-between; margin-bottom: 2rem;">
                    <h2 style="font-size: 1.5rem; font-weight: bold; color: #1f2937;">Quick Actions</h2>
                    <i class="ph ph-lightning" style="font-size: 2rem; color: #eab308;"></i>
                </div>
                <div style="display: grid; grid-template-columns: repeat(2, minmax(0, 1fr)); gap: 1.5rem; md:grid-template-columns: repeat(4, minmax(0, 1fr));">
                    <a href="{{ route('lists.create') }}" style="display: flex; flex-direction: column; align-items: center; justify-content: center; gap: 0.75rem; padding: 1.5rem; border-radius: 0.75rem; background-color: #f3f4f6; border: 1px solid #e5e7eb; color: #4b5563; transition: all 0.2s; hover:scale(1.05); hover:border-color: #3b82f6; hover:color: #2563eb;">
                        <i class="ph ph-plus-circle" style="font-size: 2rem;"></i>
                        <span>Buat List</span>
                    </a>
                    <a href="{{ route('lists.index') }}" style="display: flex; flex-direction: column; align-items: center; justify-content: center; gap: 0.75rem; padding: 1.5rem; border-radius: 0.75rem; background-color: #f3f4f6; border: 1px solid #e5e7eb; color: #4b5563; transition: all 0.2s; hover:scale(1.05); hover:border-color: #3b82f6; hover:color: #2563eb;">
                        <i class="ph ph-list-checks" style="font-size: 2rem;"></i>
                        <span>Lihat Semua</span>
                    </a>
                    @if(Auth::user()->role == 'admin')
                    <a href="{{ route('admin.users.index') }}" style="display: flex; flex-direction: column; align-items: center; justify-content: center; gap: 0.75rem; padding: 1.5rem; border-radius: 0.75rem; background-color: #f3f4f6; border: 1px solid #e5e7eb; color: #4b5563; transition: all 0.2s; hover:scale(1.05); hover:border-color: #3b82f6; hover:color: #2563eb;">
                        <i class="ph ph-users" style="font-size: 2rem;"></i>
                        <span>Kelola User</span>
                    </a>
                    @endif
                    <button onclick="showCalendarWithTasks()" style="display: flex; flex-direction: column; align-items: center; justify-content: center; gap: 0.75rem; padding: 1.5rem; border-radius: 0.75rem; background-color: #f3f4f6; border: 1px solid #e5e7eb; color: #4b5563; transition: all 0.2s; hover:scale(1.05); hover:border-color: #3b82f6; hover:color: #2563eb; cursor: pointer;">
                        <i class="ph ph-calendar" style="font-size: 2rem;"></i>
                        <span>Kalender Tugas</span>
                    </button>
                </div>
            </div>

            <!-- Recent Tasks -->
            <div style="background-color: white; border-radius: 1rem; box-shadow: 0 4px 6px -1px rgba(0,0,0,0.1), 0 2px 4px -1px rgba(0,0,0,0.06); padding: 2rem; border: 1px solid #e5e7eb;">
                <div style="display: flex; align-items: center; justify-content: space-between; margin-bottom: 2rem;">
                    <h2 style="font-size: 1.5rem; font-weight: bold; color: #1f2937;">Tugas Terbaru</h2>
                    <a href="{{ route('lists.index') }}" style="color: #3b82f6; hover:text-decoration: underline;">Lihat Semua →</a>
                </div>
                <div style="space-y: 1.5rem;">
                    @forelse($recentTasks as $task)
                        <div style="padding: 1.5rem; border-radius: 0.75rem; background-color: #f9fafb; border: 1px solid #e5e7eb; transition: all 0.2s; hover:border-color: #3b82f6; margin-bottom: 1rem;">
                            <div style="display: flex; align-items: center; gap: 1.25rem;">
                                <div style="width: 0.75rem; height: 0.75rem; border-radius: 9999px; {{ $task->is_completed ? 'background-color: #10b981;' : 'background-color: #f59e0b;' }}"></div>
                                <div style="flex: 1 1 0%; min-width: 0;">
                                    <p style="font-size: 1rem; color: #1f2937; margin-bottom: 0.25rem;">{{ $task->deskripsi ?? 'Tanpa deskripsi' }}</p>
                                    <p style="font-size: 0.875rem; color: #6b7280;">
                                        {{ $task->list->title ?? 'Tanpa list' }} • 
                                        {{ $task->due_date ? \Carbon\Carbon::parse($task->due_date)->diffForHumans() : 'Tanpa tenggat' }}
                                    </p>
                                </div>
                                <span style="padding: 0.5rem 1rem; font-size: 0.75rem; font-weight: 500; border-radius: 9999px; {{ $task->is_completed ? 'background-color: #d1fae5; color: #065f46;' : 'background-color: #fef3c7; color: #92400e;' }}">
                                    {{ $task->is_completed ? 'Selesai' : 'Proses' }}
                                </span>
                            </div>
                        </div>
                    @empty
                        <div style="text-align: center; padding: 3rem 2rem; color: #6b7280;">
                            <i class="ph ph-clipboard-text" style="font-size: 3rem; margin-bottom: 1rem;"></i>
                            <p>Belum ada tugas</p>
                        </div>
                    @endforelse
                </div>
            </div>
        </div>

        <!-- Right Column -->
        <div style="space-y: 3rem;">

            <!-- Progress Chart -->
            <div style="background-color: white; border-radius: 1rem; box-shadow: 0 4px 6px -1px rgba(0,0,0,0.1), 0 2px 4px -1px rgba(0,0,0,0.06); padding: 2rem; border: 1px solid #e5e7eb;">
                <h2 style="font-size: 1.5rem; font-weight: bold; margin-bottom: 2rem; color: #1f2937;">Progress</h2>
                <div style="space-y: 2rem;">
                    <div>
                        <div style="display: flex; justify-content: space-between; margin-bottom: 0.75rem;">
                            <span style="color: #6b7280;">Tugas Selesai</span>
                            <span>{{ $completedTasks ?? 0 }} / {{ $totalTasks ?? 0 }}</span>
                        </div>
                        <div style="height: 0.75rem; background-color: #e5e7eb; border-radius: 9999px; overflow: hidden;">
                            <div style="height: 100%; background-color: #10b981; border-radius: 9999px; transition: all 0.7s; width: {{ $totalTasks > 0 ? ($completedTasks / $totalTasks * 100) : 0 }}%;"></div>
                        </div>
                    </div>
                    <div>
                        <div style="display: flex; justify-content: space-between; margin-bottom: 0.75rem;">
                            <span style="color: #6b7280;">Dalam Proses</span>
                            <span>{{ $inProgressTasks ?? 0 }} / {{ $totalTasks ?? 0 }}</span>
                        </div>
                        <div style="height: 0.75rem; background-color: #e5e7eb; border-radius: 9999px; overflow: hidden;">
                            <div style="height: 100%; background-color: #f59e0b; border-radius: 9999px; transition: all 0.7s; width: {{ $totalTasks > 0 ? ($inProgressTasks / $totalTasks * 100) : 0 }}%;"></div>
                        </div>
                    </div>
                    <div>
                        <div style="display: flex; justify-content: space-between; margin-bottom: 0.75rem;">
                            <span style="color: #6b7280;">Terlambat</span>
                            <span>{{ $overdueTasks ?? 0 }} / {{ $totalTasks ?? 0 }}</span>
                        </div>
                        <div style="height: 0.75rem; background-color: #e5e7eb; border-radius: 9999px; overflow: hidden;">
                            <div style="height: 100%; background-color: #ef4444; border-radius: 9999px; transition: all 0.7s; width: {{ $totalTasks > 0 ? ($overdueTasks / $totalTasks * 100) : 0 }}%;"></div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Upcoming Deadlines -->
            <div style="background-color: white; border-radius: 1rem; box-shadow: 0 4px 6px -1px rgba(0,0,0,0.1), 0 2px 4px -1px rgba(0,0,0,0.06); padding: 2rem; border: 1px solid #e5e7eb;">
                <h2 style="font-size: 1.5rem; font-weight: bold; margin-bottom: 2rem; color: #1f2937;">Deadline Mendatang</h2>
                <div style="space-y: 1.5rem;">
                    @forelse($upcomingTasks as $task)
                        <div style="padding: 1.5rem; border-radius: 0.75rem; background-color: #f9fafb; border: 1px solid #e5e7eb; margin-bottom: 1rem;">
                            <div style="display: flex; align-items: center; gap: 1.25rem;">
                                <div style="width: 2.5rem; height: 2.5rem; border-radius: 9999px; background-color: #fee2e2; display: flex; align-items: center; justify-content: center;">
                                    <i class="ph ph-clock" style="color: #ef4444; font-size: 1.5rem;"></i>
                                </div>
                                <div style="flex: 1;">
                                    <p style="font-size: 1rem; color: #1f2937; margin-bottom: 0.25rem;">{{ $task->deskripsi ?? 'Tanpa deskripsi' }}</p>
                                    <p style="font-size: 0.875rem; color: #6b7280;">
                                        {{ $task->due_date ? \Carbon\Carbon::parse($task->due_date)->diffForHumans() : 'Tanpa tenggat' }}
                                    </p>
                                </div>
                            </div>
                        </div>
                    @empty
                        <div style="text-align: center; padding: 3rem 2rem; color: #6b7280;">
                            <i class="ph ph-smiley" style="font-size: 2.5rem; margin-bottom: 1rem;"></i>
                            <p>Tidak ada deadline mendatang</p>
                        </div>
                    @endforelse
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Full Calendar Modal dengan Tugas -->
<div id="calendarModal" style="position: fixed; inset: 0; background-color: rgba(0,0,0,0.5); backdrop-filter: blur(0.25rem); z-index: 50; display: none; align-items: center; justify-content: center; padding: 2rem;">
    <div style="background-color: white; border-radius: 1rem; box-shadow: 0 10px 15px -3px rgba(0,0,0,0.1), 0 4px 6px -2px rgba(0,0,0,0.05); max-width: 60rem; width: 100%; max-height: 90vh; overflow: hidden; border: 1px solid #e5e7eb;">
        <div style="display: flex; align-items: center; justify-content: space-between; padding: 1.5rem; border-bottom: 1px solid #e5e7eb;">
            <h3 style="font-size: 1.25rem; font-weight: 600; color: #1f2937;">Kalender Tugas - Overview</h3>
            <button onclick="hideCalendar()" style="padding: 0.5rem; border-radius: 0.5rem; background: transparent; border: none; color: #6b7280; cursor: pointer; transition: all 0.2s; hover:background-color: #f3f4f6; hover:color: #1f2937;">
                <i class="ph ph-x"></i>
            </button>
        </div>
        <div style="padding: 2rem; overflow: auto;">
            <div style="display: grid; grid-template-columns: 1fr 300px; gap: 2.5rem; margin-bottom: 2rem;">
                <!-- Calendar View -->
                <div>
                    <div style="display: flex; align-items: center; justify-content: space-between; margin-bottom: 1.5rem;">
                        <h4 style="font-size: 1.125rem; font-weight: 600; color: #1f2937;" id="calendarTitle">Kalender</h4>
                        <div style="display: flex; gap: 0.5rem;">
                            <button onclick="prevMonth()" style="padding: 0.5rem; border-radius: 0.375rem; background-color: #f3f4f6; color: #374151; border: 1px solid #e5e7eb; transition: all 0.2s; hover:background-color: #3b82f6; hover:color: white; cursor: pointer;">
                                <i class="ph ph-caret-left"></i>
                            </button>
                            <button onclick="nextMonth()" style="padding: 0.5rem; border-radius: 0.375rem; background-color: #f3f4f6; color: #374151; border: 1px solid #e5e7eb; transition: all 0.2s; hover:background-color: #3b82f6; hover:color: white; cursor: pointer;">
                                <i class="ph ph-caret-right"></i>
                            </button>
                        </div>
                    </div>
                    <div id="full-calendar" style="border: 1px solid #e5e7eb; border-radius: 0.5rem; padding: 1.5rem;"></div>
                </div>
                
                <!-- Tasks List for Selected Date -->
                <div>
                    <h4 style="font-size: 1.125rem; font-weight: 600; color: #1f2937; margin-bottom: 1.5rem;">Tugas <span id="selectedDateText">Hari Ini</span></h4>
                    <div id="dateTasks" style="max-height: 400px; overflow-y: auto;">
                        <div style="text-align: center; padding: 2rem; color: #6b7280;">
                            <i class="ph ph-calendar-blank" style="font-size: 2rem; margin-bottom: 0.5rem;"></i>
                            <p>Pilih tanggal untuk melihat tugas</p>
                        </div>
                    </div>
                </div>
            </div>
            
            <!-- Quick Stats -->
            <div style="padding-top: 2rem; border-top: 1px solid #e5e7eb;">
                <h4 style="font-size: 1.125rem; font-weight: 600; color: #1f2937; margin-bottom: 1.5rem;">Statistik Bulan Ini</h4>
                <div style="display: grid; grid-template-columns: repeat(3, 1fr); gap: 1.5rem;">
                    <div style="text-align: center; padding: 1.5rem; background-color: #f0f9ff; border-radius: 0.5rem;">
                        <div style="font-size: 1.5rem; font-weight: bold; color: #0369a1;" id="monthCompleted">0</div>
                        <div style="font-size: 0.875rem; color: #6b7280;">Selesai</div>
                    </div>
                    <div style="text-align: center; padding: 1.5rem; background-color: #fef3c7; border-radius: 0.5rem;">
                        <div style="font-size: 1.5rem; font-weight: bold; color: #92400e;" id="monthPending">0</div>
                        <div style="font-size: 0.875rem; color: #6b7280;">Dalam Proses</div>
                    </div>
                    <div style="text-align: center; padding: 1.5rem; background-color: #fef2f2; border-radius: 0.5rem;">
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
        const month = currentDate.toLocaleString('id-ID', { month: 'long' });
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
            <div style="display: grid; grid-template-columns: repeat(7, minmax(0, 1fr)); gap: 0.75rem; text-align: center; font-weight: 500; color: #6b7280; margin-bottom: 1.5rem;">
                <div>Min</div><div>Sen</div><div>Sel</div><div>Rab</div><div>Kam</div><div>Jum</div><div>Sab</div>
            </div>
            <div style="display: grid; grid-template-columns: repeat(7, minmax(0, 1fr)); gap: 0.75rem;">
        `;

        for (let i = 0; i < firstDay; i++) {
            html += `<div style="aspect-ratio: 1 / 1;"></div>`;
        }

        for (let day = 1; day <= daysInMonth; day++) {
            const dateStr = `${year}-${String(currentDate.getMonth() + 1).padStart(2, '0')}-${String(day).padStart(2, '0')}`;
            const isToday = today.getDate() === day && today.getMonth() === currentDate.getMonth() && today.getFullYear() === year;
            
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
                    taskIndicator = '<div style="width: 6px; height: 6px; background-color: #10b981; border-radius: 50%; margin: 2px auto 0;"></div>';
                } else if (pendingTasks > 0) {
                    taskIndicator = '<div style="width: 6px; height: 6px; background-color: #f59e0b; border-radius: 50%; margin: 2px auto 0;"></div>';
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

    function showDateTasks(dateStr) {
        const date = new Date(dateStr);
        const options = { weekday: 'long', year: 'numeric', month: 'long', day: 'numeric' };
        const dateText = date.toLocaleDateString('id-ID', options);
        
        document.getElementById('selectedDateText').textContent = dateText;

        const dayTasks = tasksData.filter(task => {
            if (!task.due_date) return false;
            const taskDate = new Date(task.due_date).toISOString().split('T')[0];
            return taskDate === dateStr;
        });

        const tasksContainer = document.getElementById('dateTasks');
        
        if (dayTasks.length === 0) {
            tasksContainer.innerHTML = `
                <div style="text-align: center; padding: 2rem; color: #6b7280;">
                    <i class="ph ph-smiley" style="font-size: 2rem; margin-bottom: 0.5rem;"></i>
                    <p>Tidak ada tugas untuk tanggal ini</p>
                </div>
            `;
            return;
        }

        let tasksHtml = '<div style="space-y: 1rem;">';
        
        dayTasks.forEach(task => {
            const isOverdue = !task.is_completed && new Date(task.due_date) < new Date();
            tasksHtml += `
                <div style="padding: 1.25rem; border-radius: 0.5rem; background-color: #f9fafb; border: 1px solid #e5e7eb; border-left: 4px solid ${task.is_completed ? '#10b981' : isOverdue ? '#ef4444' : '#f59e0b'}; margin-bottom: 0.75rem;">
                    <div style="font-weight: 500; color: #1f2937; margin-bottom: 0.5rem;">${task.deskripsi || 'Tanpa deskripsi'}</div>
                    <div style="font-size: 0.875rem; color: #6b7280;">
                        ${task.list?.title || 'Tanpa list'} • 
                        ${task.is_completed ? 'Selesai' : isOverdue ? 'Terlambat' : 'Dalam Proses'}
                    </div>
                </div>
            `;
        });

        tasksHtml += '</div>';
        tasksContainer.innerHTML = tasksHtml;
    }

    function showCalendarWithTasks() {
        document.getElementById('calendarModal').style.display = 'flex';
        renderFullCalendar();
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
        document.addEventListener('click', e => {
            if (e.target.id === 'calendarModal') hideCalendar();
        });
    });
</script>
@endsection