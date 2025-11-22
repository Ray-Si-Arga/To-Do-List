<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Auth;
use App\Models\task;
use App\Models\lists;

class TaskController extends Controller
{
    /**
     * Menyimpan tugas (task) baru ke database.
     */
    public function store(Request $request)
    {
        // 1. Validasi input
        $validator = Validator::make($request->all(), [
            // 'deskripsi' harus ada dan berupa teks
            'deskripsi'        => ['required', 'string'],

            // 'assigned_user_id' harus ada, angka, dan ADA di tabel 'user'
            'assigned_user_id' => ['required', 'integer', 'exists:user,id'],

            // 'due_date' harus ada dan formatnya tanggal
            'due_date'         => ['required', 'date'],

            // 'lists_id' harus ada, angka, dan ADA di tabel 'lists'
            'lists_id'         => ['required', 'integer', 'exists:lists,id'],
        ]);

        // 2. Jika validasi gagal, kembali ke halaman form dengan error
        if ($validator->fails()) {
            return redirect()->back() // Kembali ke halaman 'show'
                ->withErrors($validator) // Bawa pesan error-nya
                ->withInput(); // Bawa data lama (agar form tidak kosong lagi)
        }

        // 3. Ambil data yang sudah tervalidasi
        $validated = $validator->validated();

        // 4. Simpan ke database menggunakan DB Builder (sesuai gaya Anda)
        DB::table('task')->insert([ // Pastikan nama tabel 'task' Anda benar
            'lists_id'         => $validated['lists_id'],
            'deskripsi'        => $validated['deskripsi'],
            'assigned_user_id' => $validated['assigned_user_id'],
            'due_date'         => $validated['due_date'],
            'is_completed'     => false, // Default saat dibuat: Belum Selesai
            'created_at'       => now(),
            'updated_at'       => now(),
        ]);

        // 5. Kembali ke halaman sebelumnya (halaman detail list)
        return redirect()->back()->with('success', 'Tugas baru berhasil ditambahkan!');
    }

    public function toggleComplete(task $task)
    {
        // 1. Balikkan status boolean-nya
        // (Jika true -> jadi false, Jika false -> jadi true)
        $newStatus = !$task->is_completed;

        // 2. Update database menggunakan DB::table() (sesuai gaya Anda)
        DB::table('task')
            ->where('id', $task->id)
            ->update([
                'is_completed' => $newStatus,
                'updated_at' => now(),
            ]);

        // 3. Kembali ke halaman sebelumnya
        return redirect()->back()->with('success', 'Status tugas berhasil diperbarui!');
    }

    /**
     * Menghapus sebuah tugas (task).
     */
    /**
     * Menghapus sebuah tugas (task).
     * (Keamanan dihapus, semua user boleh)
     */
    public function destroy(task $task)
    {
        // 1. --- HAPUS DARI DATABASE ---
        // (Logika keamanan dihapus)
        DB::table('task')->where('id', $task->id)->delete();

        // 2. --- REDIRECT ---
        return redirect()->back()->with('success', 'Tugas berhasil dihapus.');
    }
}
