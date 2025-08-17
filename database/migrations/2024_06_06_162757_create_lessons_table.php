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
        Schema::create('lessons', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger("module_id")->nullable();
            $table->string("title")->nullable();
            $table->text("description")->nullable();
            $table->string("video_url")->nullable();
            $table->integer('order')->default(1);
            $table->string("video_length")->nullable();
            $table->string("video_thumbnail")->nullable();
            $table->json('documents')->nullable(); // Store multiple document paths
             $table->boolean('quiz_timer_enabled')->default(true);
            $table->integer('quiz_timer_minutes')->default(30);
            $table->boolean('show_timer_warning')->default(true);
            $table->integer('warning_time_minutes')->default(5);
            $table->boolean('auto_submit_on_timeout')->default(true);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('lessons');
    }
};
