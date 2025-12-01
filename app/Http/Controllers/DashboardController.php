<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\task; 
use App\Models\TaskList;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    public function index()
    {
        try {
            $currentUser = Auth::user(); // Dapatkan data user yang login

            // 1. Buat Query Dasar
            // tambahkan filter ke query ini berdasarkan role
            $tasksQuery = task::query();

            // 2. Terapkan Filter Role
            if ($currentUser->role == 'admin') {
                // Admin: Tidak perlu filter, melihat semua tugas
            } else {
                // User biasa: HANYA melihat tugas yang di-assign padanya
                $tasksQuery->where('assigned_user_id', $currentUser->id);
            }

            // 3. Hitung Statistik menggunakan query yang sudah difilter
            // 'clone' query agar filter tidak tumpang tindih

            $totalTasks = $tasksQuery->clone()->count();

            $completedTasks = $tasksQuery->clone()
                ->where('is_completed', true)
                ->count();

            $inProgressTasks = $tasksQuery->clone()
                ->where('is_completed', false)
                ->count();

            $overdueTasks = $tasksQuery->clone()
                ->where('is_completed', false)
                ->where('due_date', '<', now())
                ->count();

            // 4. Dapatkan daftar tugas (recent & upcoming) menggunakan query yang sudah difilter

            $recentTasks = $tasksQuery->clone()->with('list')
                ->orderBy('created_at', 'desc')
                ->take(5)
                ->get()
                ->map(function ($task) {
                    if ($task->due_date && !$task->due_date instanceof Carbon) {
                        $task->due_date = Carbon::parse($task->due_date);
                    }
                    return $task;
                });

            $upcomingTasks = $tasksQuery->clone()->with('list')
                ->where('is_completed', false)
                ->orderBy('due_date', 'asc')
                ->take(3)
                ->get()
                ->map(function ($task) {
                    if ($task->due_date && !$task->due_date instanceof Carbon) {
                        $task->due_date = Carbon::parse($task->due_date);
                    }
                    return $task;
                });

            // 5. Kirim data ke view
            return view('dashboard.dashboard', compact(
                'totalTasks',
                'completedTasks',
                'inProgressTasks',
                'overdueTasks',
                'recentTasks',
                'upcomingTasks'
            ));
        } catch (\Exception $e) {
            // Fallback data jika ada error
            return view('dashboard.dashboard', [
                'totalTasks' => 0,
                'completedTasks' => 0,
                'inProgressTasks' => 0,
                'overdueTasks' => 0,
                'recentTasks' => collect(),
                'upcomingTasks' => collect()
            ]);
        }
    }
}
