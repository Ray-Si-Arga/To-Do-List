<?php

namespace App\Http\Controllers;

use App\Models\lists;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class ListsController extends Controller
{
    /**
     * Menampilkan halaman "Semua List".
     */
    public function index()
    {
        $lists = lists::with('user')->get();

        // Kirim data 'lists' ke view (yang akan kita buat di Langkah 5)
        return view('lists.index', compact('lists'));
    }

    public function create()
    {
        return view('lists.create');
    }

    // ... (setelah fungsi create() )

    /**
     * Menyimpan list baru ke database.
     */
    public function store(Request $request)
    {
        // 1. Validasi input (Pastikan judul tidak kosong)
        $validated = $request->validate([
            'title' => ['required', 'string', 'max:255'],
        ]);

        // 2. Simpan ke database menggunakan DB Builder
        DB::table('lists')->insert([
            'title' => $validated['title'],

            // INI PENTING: Ambil ID user yang sedang login
            'user_id' => Auth::id(),

            // Timestamp manual (karena kita pakai DB Builder)
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        // 3. Arahkan kembali ke halaman daftar list
        return redirect()->route('admin.lists.index')
            ->with('success', 'List baru berhasil dibuat!');
    }

    /**
     * Menampilkan halaman detail dari sebuah list.
     * (Termasuk semua task dan siapa yg ditugaskan)
     */
    public function show(lists $list)
    {
        $tasks = DB::table('task') // <-- Nama tabel Anda
            ->leftJoin('user', 'task.assigned_user_id', '=', 'user.id')
            ->where('task.lists_id', $list->id) // <-- Kolom foreign key Anda
            ->select('task.*', 'user.name as assigned_user_name')
            ->get();

       
        return view('lists.show', compact('list', 'tasks'));
    }
}
