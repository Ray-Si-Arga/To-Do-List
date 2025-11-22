<?php

namespace Database\Seeders;

use App\Models\lists; // Sesuaikan dengan nama model List Anda
use App\Models\task; // Sesuaikan dengan nama model Task Anda
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Carbon; // Untuk mengelola tanggal

class TaskSeed extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $firstListId = lists::first()->id ?? null;

        // Jika tidak ada list, hentikan seeder ini (opsional)
        if (!$firstListId) {
            echo "Warning: No List found. Please seed the Lists table first.\n";
            return;
        }

        task::create([
            'lists_id'      => $firstListId,
            'deskripsi'    => 'Menyelesaikan tugas seeder laravel.',
            'is_completed' => false, 
            'due_date'     => Carbon::now()->addDays(2), 
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        task::create([
            'lists_id'      => $firstListId,
            'deskripsi'    => 'Membeli makan siang untuk rapat.',
            'is_completed' => true,
            'due_date'     => '2025-12-01',
            'created_at' => now(),
            'updated_at' => now(),
        ]);
    }
}
