<?php
// app/Http/Controllers/DashboardController.php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Task;
use App\Models\TaskList;
use Carbon\Carbon;

class DashboardController extends Controller
{
    public function index()
    {
        try {
            // Data untuk statistik
            $totalTasks = Task::count();
            $completedTasks = Task::where('is_completed', true)->count();
            $inProgressTasks = Task::where('is_completed', false)->count();
            $overdueTasks = Task::where('is_completed', false)
                                ->where('due_date', '<', now())
                                ->count();

            // Recent tasks dengan handling untuk due_date
            $recentTasks = Task::with('list')
                ->orderBy('created_at', 'desc')
                ->take(5)
                ->get()
                ->map(function($task) {
                    // memastikan due_date adalah Carbon instance
                    if ($task->due_date && !$task->due_date instanceof Carbon) {
                        $task->due_date = Carbon::parse($task->due_date);
                    }
                    return $task;
                });
            
            // Upcoming tasks dengan handling untuk due_date
            $upcomingTasks = Task::with('list')
                ->where('is_completed', false)
                ->orderBy('due_date', 'asc')
                ->take(3)
                ->get()
                ->map(function($task) {
                    // Pastikan due_date adalah Carbon instance
                    if ($task->due_date && !$task->due_date instanceof Carbon) {
                        $task->due_date = Carbon::parse($task->due_date);
                    }
                    return $task;
                });
            
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