<?php

namespace Database\Seeders;

use App\Models\lists; // Import Model List Anda (sesuaikan namanya)
use App\Models\User; // Import Model List Anda (sesuaikan namanya)
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ListSeed extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $firstUser = User::first();

        $userId = $firstUser->id;

        // 2. Menggunakan Model Eloquent untuk mengisi data tabel 'list'
        lists::create([
            'user_id' => $userId,
            'title'   => 'Daftar Belanja Mingguan',
        ]);

        lists::create([
            'user_id' => $userId,
            'title'   => 'Proyek Laravel 11',
        ]);

        // Anda bisa membuat user lain dan menambahkan list untuk user tersebut juga:
        $secondUser = User::skip(1)->first(); // Mengambil user kedua
        if ($secondUser) {
            Lists::create([
                'user_id' => $secondUser->id,
                'title'   => 'Rencana Liburan',
            ]);
        }
    }
}
