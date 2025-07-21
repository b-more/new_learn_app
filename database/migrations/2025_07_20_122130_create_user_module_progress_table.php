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
        Schema::create('user_module_progress', function (Blueprint $table) {
            $table->id();
            $table->UnsignedBigInteger('user_id')->nullable();
            $table->UnsignedBigInteger('module_id')->nullable();
            $table->timestamp('assigned_at')->nullable();
            $table->timestamp('first_accessed_at')->nullable();
            $table->timestamp('last_accessed_at')->nullable();
            $table->integer('total_lessons')->default(0);
            $table->integer('completed_lessons')->default(0);
            $table->integer('total_quizzes')->default(0);
            $table->integer('completed_quizzes')->default(0);
            $table->decimal('overall_progress', 5, 2)->default(0.00);
            $table->enum('status', ['assigned', 'in_progress', 'completed'])->default('assigned');
            $table->timestamps();

            $table->unique(['user_id', 'module_id']);
            $table->index(['user_id', 'status']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('user_module_progress');
    }
};
