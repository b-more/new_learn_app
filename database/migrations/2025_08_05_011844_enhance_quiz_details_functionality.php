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
        // Add missing columns to attempt_answers table
        Schema::table('attempt_answers', function (Blueprint $table) {
            if (!Schema::hasColumn('attempt_answers', 'was_answered')) {
                $table->boolean('was_answered')->default(true)->after('user_answer');
            }
            if (!Schema::hasColumn('attempt_answers', 'correct_answer')) {
                $table->string('correct_answer')->nullable()->after('user_answer');
            }
        });

        // Add explanation field to quizzes table (if it doesn't exist)
        if (Schema::hasTable('quizzs')) {
            Schema::table('quizzs', function (Blueprint $table) {
                if (!Schema::hasColumn('quizzs', 'explanation')) {
                    $table->text('explanation')->nullable()->after('correct_answer');
                }
            });
        }

        // Update attempt_status enum values if needed
        Schema::table('attempt_answers', function (Blueprint $table) {
            // Drop the existing enum constraint and recreate with new values
            $table->dropColumn('attempt_status');
        });

        Schema::table('attempt_answers', function (Blueprint $table) {
            $table->enum('attempt_status', [
                'started',
                'in_progress',
                'completed',
                'timed_out',
                'expired',
                'abandoned'
            ])->default('started')->after('auto_mark');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('attempt_answers', function (Blueprint $table) {
            $table->dropColumn(['was_answered']);
        });

        if (Schema::hasTable('quizzs')) {
            Schema::table('quizzs', function (Blueprint $table) {
                $table->dropColumn(['explanation']);
            });
        }

        // Revert attempt_status enum
        Schema::table('attempt_answers', function (Blueprint $table) {
            $table->dropColumn('attempt_status');
        });

        Schema::table('attempt_answers', function (Blueprint $table) {
            $table->enum('attempt_status', [
                'in_progress',
                'completed',
                'expired',
                'abandoned'
            ])->default('in_progress')->after('auto_mark');
        });
    }
};
