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
        Schema::create('quizzs', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger("lesson_id");
            $table->text("question")->nullable();
            $table->string("question_image")->nullable();
            $table->string("correct_answer")->nullable();
            $table->text("answer_option_a")->nullable();
            $table->text("answer_option_b")->nullable();
            $table->text("answer_option_c")->nullable();
            $table->text("answer_option_d")->nullable();
            $table->string("duration")->nullable();
            $table->integer('question_duration_seconds')->default(60);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('quizzs');
    }
};
