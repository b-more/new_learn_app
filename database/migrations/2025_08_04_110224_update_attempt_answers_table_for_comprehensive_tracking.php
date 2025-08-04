<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('attempt_answers', function (Blueprint $table) {
            if (!Schema::hasColumn('attempt_answers', 'attempt_status')) {
                $table->string('attempt_status')->default('started')->after('auto_mark');
            }
            if (!Schema::hasColumn('attempt_answers', 'timer_expires_at')) {
                $table->timestamp('timer_expires_at')->nullable()->after('attempt_completed_at');
            }
            if (!Schema::hasColumn('attempt_answers', 'timer_settings')) {
                $table->json('timer_settings')->nullable()->after('timer_expires_at');
            }
            if (!Schema::hasColumn('attempt_answers', 'time_taken_seconds')) {
                $table->integer('time_taken_seconds')->nullable()->after('timer_settings');
            }
            if (!Schema::hasColumn('attempt_answers', 'total_questions')) {
                $table->integer('total_questions')->nullable()->after('time_taken_seconds');
            }
            if (!Schema::hasColumn('attempt_answers', 'correct_answers')) {
                $table->integer('correct_answers')->nullable()->after('total_questions');
            }
            if (!Schema::hasColumn('attempt_answers', 'score_percentage')) {
                $table->decimal('score_percentage', 5, 2)->nullable()->after('correct_answers');
            }
            if (!Schema::hasColumn('attempt_answers', 'detailed_answers')) {
                $table->json('detailed_answers')->nullable()->after('score_percentage');
            }
            if (!Schema::hasColumn('attempt_answers', 'correct_answer')) {
                $table->string('correct_answer')->nullable()->after('user_answer');
            }
        });
    }

    public function down(): void
    {
        Schema::table('attempt_answers', function (Blueprint $table) {
            $table->dropColumn(['attempt_status', 'timer_expires_at', 'timer_settings',
                'time_taken_seconds', 'total_questions', 'correct_answers',
                'score_percentage', 'detailed_answers', 'correct_answer']);
        });
    }
};
