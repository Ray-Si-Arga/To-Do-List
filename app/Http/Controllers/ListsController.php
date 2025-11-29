<?php

namespace App\Http\Controllers;

use App\Models\lists;
use App\Models\task;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class ListsController extends Controller
{
    /**
     * Menampilkan halaman "Semua List".
     */
    public function index()
    {
        $lists = lists::with('user')->get();
        return view('lists.index', compact('lists'));
    }

    public function create()
    {
        return view('lists.create');
    }

    /**
     * Menyimpan list baru ke database.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'title' => ['required', 'string', 'max:255'],
        ]);

        DB::table('lists')->insert([
            'title' => $validated['title'],
            'user_id' => Auth::id(),
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        return redirect()->route('lists.index')
            ->with('success', 'List baru berhasil dibuat!');
    }

    public function show(lists $list)
    {
        $tasks = DB::table('task')
            ->leftJoin('user', 'task.assigned_user_id', '=', 'user.id')
            ->where('task.lists_id', $list->id)
            ->select('task.*', 'user.name as assigned_user_name')
            ->get()
            ->map(function ($task) {
                // Tambahkan status terlambat
                $task->is_overdue = false;
                if (!$task->is_completed && $task->due_date) {
                    $task->is_overdue = Carbon::parse($task->due_date)->isPast();
                }
                return $task;
            });

        $users = DB::table('user')->get();

        return view('lists.show', compact('list', 'tasks', 'users'));
    }

    /**
     * Menampilkan formulir untuk mengedit list.
     */
    public function edit(lists $list)
    {
        return view('lists.edit', compact('list'));
    }

    /**
     * Menyimpan perubahan (update) dari list yang diedit.
     */
    public function update(Request $request, lists $list)
    {
        $validated = $request->validate([
            'title' => ['required', 'string', 'max:255'],
        ]);

        DB::table('lists')
            ->where('id', $list->id)
            ->update([
                'title' => $validated['title'],
                'updated_at' => now(),
            ]);

        return redirect()->route('lists.index')
            ->with('success', 'List berhasil diperbarui!');
    }

    /**
     * Menghapus list dari database.
     */
    public function destroy(lists $list)
    {
        DB::table('lists')->where('id', $list->id)->delete();

        return redirect()->route('lists.index')
            ->with('success', 'List berhasil dihapus.');
    }
}