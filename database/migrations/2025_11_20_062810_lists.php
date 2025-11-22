<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        //
        Schema::create('lists', function (Blueprint $table){
            $table -> id();

            // relasi ke tabel user, dan jika user_id dihapus maka data yang ada di dalam user ikut kehapus
            $table -> unsignedBigInteger('user_id');
            $table -> string('title');
            $table -> timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        //
        Schema::dropIfExists('lists');
    }
};
