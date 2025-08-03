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
        Schema::create('attempt_answers', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger("user_id")->nullable();
            $table->unsignedBigInteger("module_id")->nullable();
            $table->unsignedBigInteger("lesson_id")->nullable();
            $table->text("user_answer")->nullable();
            $table->boolean("auto_mark")->nullable();
            $table->unsignedBigInteger('quiz_id')->nullable();
            $table->timestamp('attempt_started_at')->nullable();
            $table->timestamp('attempt_completed_at')->nullable();
            $table->timestamp('timer_expires_at')->nullable();
            $table->json('timer_settings')->nullable();
            $table->integer('time_taken_seconds')->nullable();
            $table->integer('total_questions')->nullable();
            $table->integer('correct_answers')->nullable();
            $table->decimal('score_percentage', 5, 2)->nullable();
            $table->enum('attempt_status', [
                'in_progress',
                'completed',
                'expired',
                'abandoned'
            ])->default('in_progress')->change();
            $table->json('detailed_answers')->nullable();
            $table->timestamps();

            $table->index(['user_id', 'module_id', 'attempt_completed_at']);

            // Add indexes for better query performance
           // $table->index(['user_id', 'lesson_id', 'attempt_status']);
            $table->index(['timer_expires_at']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('attempt_answers');
    }
};
