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
        // is_completed', 'due_date'

        Schema::create('task', function (Blueprint $tabel){
            $tabel -> id();
            $tabel -> foreignId('lists_id')->constrained('lists')->onDelete('cascade');
            $tabel -> text('deskripsi');
            $tabel -> boolean('is_completed') -> default(false);
            $tabel -> date('due_date');
            $tabel -> timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        //

        schema::dropIfExists('task');
    }
};
