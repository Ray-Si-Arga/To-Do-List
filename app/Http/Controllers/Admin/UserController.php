<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\Rule;
use App\Models\User;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;
use App\Mail\UserInvitationMail;

class UserController extends Controller
{
    /**
     * Menampilkan semua data user
     */
    public function index()
    {
        // PERUBAHAN: Menggunakan DB::table()
        $users = DB::table('user')->get();
        return view('admin.users.index', compact('users'));
    }

    /**
     * Menampilkan formulir tambah user
     */
    public function create()
    {
        return view('admin.users.create');
    }

    /**
     * Menyimpan user baru ke database.
     */
    public function store(Request $request)
    {
        // 1. Validasi (Tetap sama)
        $validated = $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:user'],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
            'role' => ['required', 'in:admin,user'],
        ]);

        // 2. PERUBAHAN: Menggunakan DB::table('users')->insert()
        DB::table('user')->insert([
            'name' => $validated['name'],
            'email' => $validated['email'],
            'role' => $validated['role'],
            'password' => Hash::make($validated['password']), // Tetap di-Hash!

            // WAJIB: Tambahkan timestamp manual
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        // 3. Arahkan kembali (Tetap sama)
        return redirect()->route('admin.users.index')
            ->with('success', 'User baru berhasil ditambahkan');
    }

    /**
     * Menampilkan formulir edit user
     * (Tidak ada perubahan di sini, $user didapat dari Route Model Binding)
     */
    public function edit(User $user)
    {
        if ($user->email == 'admin@example.com') { // Sesuaikan email admin utama
            return redirect()->route('admin.users.index')
                ->with('error', 'Admin utama tidak boleh diedit.');
        }
        return view('admin.users.edit', compact('user'));
    }

    /**
     * Mengupdate data user di database.
     */
    public function update(Request $request, User $user)
    {
        // 1. Validasi (Tetap sama)
        $validated = $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => [
                'required',
                'string',
                'email',
                'max:255',
                Rule::unique('user')->ignore($user->id),
            ],
            'password' => ['nullable', 'string', 'min:8', 'confirmed'],
            'role' => ['required', 'in:admin,user'],
        ]);

        // 2. Siapkan data update (Tetap sama)
        $updateData = [
            'name' => $validated['name'],
            'email' => $validated['email'],
            'role' => $validated['role'],
            'updated_at' => now(), // WAJIB: Tambahkan timestamp manual
        ];

        // 3. Cek password (Tetap sama)
        if (!empty($validated['password'])) {
            $updateData['password'] = Hash::make($validated['password']);
        }

        // 4. PERUBAHAN: Gunakan DB::table()->where()->update()
        DB::table('user')
            ->where('id', $user->id)
            ->update($updateData);

        // 5. Kembalikan (Tetap sama)
        return redirect()->route('admin.users.index')
            ->with('success', 'Data user berhasil diupdate.');
    }

    /**
     * Menghapus user
     */
    public function destroy(User $user) // Asumsi Anda pakai Route Model Binding
    {
        $userId = $user->id;

        // --- PENTING: JANGAN HAPUS ADMIN UTAMA ---
        // (Anda bisa sesuaikan 'arga@example.com' dengan email admin utama Anda)
        if ($user->email == 'admin@example.com') {
            return redirect()->route('admin.users.index')
                ->with('error', 'Admin utama tidak boleh dihapus!');
        }

        // 1. Dapatkan semua ID List yang DIBUAT OLEH user ini
        $listIds = DB::table('lists')->where('user_id', $userId)->pluck('id');

        // 2. Jika user ini punya list, hapus semua TUGAS di dalam list tersebut
        if ($listIds->isNotEmpty()) {
            DB::table('task')->whereIn('lists_id', $listIds)->delete();
        }

        // 3. Hapus LIST-nya sendiri
        DB::table('lists')->where('user_id', $userId)->delete();

        // 4. Hapus TUGAS LAIN yang DITUGASKAN ke user ini (di list milik user lain)
        DB::table('task')->where('assigned_user_id', $userId)->delete();

        // 5. Setelah semua bersih, HAPUS USER-nya
        DB::table('user')->where('id', $userId)->delete();

        // --- SELESAI PEMBERSIHAN ---

        return redirect()->route('admin.users.index')
            ->with('success', 'User dan semua data terkait berhasil dihapus.');
    }
}
