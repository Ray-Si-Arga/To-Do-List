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
        Schema::table('task', function (Blueprint $table) {
            // Kolom untuk tahu siapa yang ditugaskan
            $table->foreignId('assigned_user_id')
                ->nullable()
                ->constrained('user')
                ->onDelete('set null');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('tasks', function (Blueprint $table) {
            // Ini untuk 'rollback' (menghapus kolom jika kita salah)
            $table->dropForeign(['assigned_user_id']);
            $table->dropColumn('assigned_user_id');
            $table->dropColumn('is_completed');
        });
    }
};
