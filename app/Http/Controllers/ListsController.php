<?php

namespace App\Http\Controllers;

use App\Models\lists;
use App\Models\task; // (Meskipun kita pakai DB, ini good practice)
use App\Models\User;
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
        return redirect()->route('lists.index')
            ->with('success', 'List baru berhasil dibuat!');
    }

    public function show(lists $list) // <-- KUNCI AJAIBNYA DI SINI
    {
        // '$list' sekarang DIJAMIN sebuah OBJEK, bukan 'true'
        // (Laravel yang mencarinya untuk kita, ini disebut Route Model Binding)

        $tasks = DB::table('task')
            ->leftJoin('user', 'task.assigned_user_id', '=', 'user.id')
            ->where('task.lists_id', $list->id)
            ->select('task.*', 'user.name as assigned_user_name')
            ->get();

        $users = DB::table('user')->get();

        return view('lists.show', compact('list', 'tasks', 'users'));
    }

    /**
     * Menampilkan formulir untuk mengedit list.
     * (Keamanan dihapus, semua user boleh)
     */
    public function edit(lists $list)
    {
        // Langsung tampilkan view, tidak perlu cek keamanan
        return view('lists.edit', compact('list'));
    }

    // ... (fungsi edit() Anda) ...

    /**
     * Menyimpan perubahan (update) dari list yang diedit.
     */
    /**
     * Menyimpan perubahan (update) dari list yang diedit.
     * (Keamanan dihapus, semua user boleh)
     */
    public function update(Request $request, lists $list)
    {
        // 1. --- VALIDASI INPUT ---
        $validated = $request->validate([
            'title' => ['required', 'string', 'max:255'],
        ]);

        // 2. --- UPDATE DATABASE ---
        DB::table('lists')
            ->where('id', $list->id)
            ->update([
                'title' => $validated['title'],
                'updated_at' => now(),
            ]);

        // 3. --- REDIRECT ---
        return redirect()->route('lists.index')
            ->with('success', 'List berhasil diperbarui!');
    }

    /**
     * Menghapus list dari database.
     */
    // Kita gunakan Route Model Binding (lists $list)
    /**
     * Menghapus list dari database.
     * (Keamanan dihapus, semua user boleh)
     */
    public function destroy(lists $list)
    {
        // Langsung hapus, tidak perlu cek keamanan
        DB::table('lists')->where('id', $list->id)->delete();

        // Kembali ke halaman index dengan pesan sukses
        return redirect()->route('lists.index')
            ->with('success', 'List berhasil dihapus.');
    }
}
