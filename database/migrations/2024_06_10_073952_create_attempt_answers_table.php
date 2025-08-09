<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('attempt_answers', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger("user_id")->nullable();
            $table->unsignedBigInteger("module_id")->nullable();
            $table->unsignedBigInteger("lesson_id")->nullable();
            $table->unsignedBigInteger('quiz_id')->nullable();

            // Session-based fields
            $table->string('session_id', 36)->nullable();

            // Answer fields
            $table->text("user_answer")->nullable();
            $table->text("correct_answer")->nullable();
            $table->boolean("auto_mark")->nullable();
            $table->boolean("was_answered")->default(true)
                  ->comment('Whether user actually answered this question (vs auto-submitted)');

            // Timing fields
            $table->timestamp('attempt_started_at')->nullable();
            $table->timestamp('attempt_completed_at')->nullable();
            $table->timestamp('timer_expires_at')->nullable();
            $table->json('timer_settings')->nullable();
            $table->integer('time_taken_seconds')->nullable();

            // Session timing
            $table->timestamp('session_started_at')->nullable();
            $table->timestamp('session_completed_at')->nullable();

            // Scoring
            $table->integer('total_questions')->nullable();
            $table->integer('correct_answers')->nullable();
            $table->decimal('score_percentage', 5, 2)->nullable();

            // Status fields
            $table->enum('attempt_status', [
                'in_progress',
                'completed',
                'expired',
                'abandoned',
                'started',
                'timed_out'
            ])->default('in_progress');

            $table->enum('session_status', [
                'in_progress',
                'completed',
                'abandoned',
                'timed_out'
            ])->default('in_progress');

            // Additional data
            $table->json('detailed_answers')->nullable();
            $table->timestamps();

            // Indexes
            $table->index(['user_id', 'module_id', 'attempt_completed_at']);
            $table->index(['timer_expires_at']);
            $table->index('session_id');
            $table->index(['user_id', 'session_id']);
            $table->index(['session_id', 'lesson_id']);
            $table->index(['user_id', 'lesson_id', 'session_status']);
            $table->index(['session_status']);
            $table->index(['user_id', 'lesson_id', 'attempt_status']);
            $table->index(['created_at']);
            $table->index(['was_answered']);
            $table->index(['user_id', 'lesson_id', 'was_answered']); // From Aug 5 migration
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('attempt_answers');
    }
};
