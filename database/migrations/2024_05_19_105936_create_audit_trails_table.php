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
        Schema::create('audit_trails', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('user_id')->nullable();
            $table->string('module')->nullable();
            $table->text('activity')->nullable();
            $table->string('ip_address')->nullable();
            $table->string('action_type')->nullable(); // e.g., 'video_play', 'document_download', 'quiz_attempt'
            $table->unsignedBigInteger('resource_id')->nullable(); // ID of the resource (lesson_id, document_id, etc.)
            $table->string('resource_type')->nullable(); // Type of resource (lesson, document, quiz)
            $table->json('activity_data')->nullable(); // Store additional data as JSON
            $table->timestamp('activity_timestamp')->default(now());
            $table->string('user_agent')->nullable();
            $table->string('session_id')->nullable();
            $table->decimal('progress_percentage', 5, 2)->nullable(); // For video progress, quiz completion, etc.


            $table->index(['user_id', 'action_type']);
            $table->index(['user_id', 'resource_type', 'resource_id']);
            $table->index('activity_timestamp');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('audit_trails');
    }
};
