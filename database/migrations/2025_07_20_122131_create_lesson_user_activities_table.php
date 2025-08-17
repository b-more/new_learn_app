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
        Schema::create('lesson_user_activities', function (Blueprint $table) {
            $table->id();
            $table->UnsignedBigInteger('user_id')->nullable();
            $table->UnsignedBigInteger('lesson_id')->nullable();
            $table->UnsignedBigInteger('module_id')->nullable();
            $table->timestamp('first_accessed_at')->nullable();
            $table->timestamp('last_accessed_at')->nullable();
            $table->integer('access_count')->default(0);
            $table->integer('video_play_count')->default(0);
            $table->decimal('video_progress_percentage', 5, 2)->default(0.00);
            $table->integer('video_watch_time_seconds')->default(0);
            $table->boolean('video_completed')->default(false);
            $table->json('document_downloads')->nullable();
            $table->boolean('lesson_completed')->default(false);
            $table->timestamps();

            $table->unique(['user_id', 'lesson_id']);
            $table->index(['user_id', 'module_id']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('lesson_user_activities');
    }
};
