<?php
// Create this file: database/migrations/2025_08_05_000001_add_was_answered_to_attempt_answers_table.php

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
        Schema::table('attempt_answers', function (Blueprint $table) {
            // Add the missing was_answered field
            $table->boolean('was_answered')->default(true)->after('auto_mark')
                  ->comment('Whether user actually answered this question (vs auto-submitted)');

            // Add index for better query performance
            $table->index(['user_id', 'lesson_id', 'was_answered']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('attempt_answers', function (Blueprint $table) {
            // Drop index first
            $table->dropIndex(['user_id', 'lesson_id', 'was_answered']);

            // Drop column
            $table->dropColumn('was_answered');
        });
    }
};
