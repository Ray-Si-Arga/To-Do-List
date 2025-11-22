<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;


class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
    // userModel::factory(10)->create();
        $this->call([
            UserSeed::class, // Panggil UserSeeder dulu
            ListSeed::class, // Baru panggil ListSeeder
            TaskSeed::class,
        ]);
    }
}
