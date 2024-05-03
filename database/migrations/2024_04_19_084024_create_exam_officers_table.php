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
        Schema::create('exam_officers', function (Blueprint $table) {
            $table->id();
            $table->foreignId('department_id');
            $table->foreignId('user_id');
            $table->enum('status', ['active', 'deleted', 'blocked']);
            $table->string('reset_token')->nullable();
            $table->string('security_question')->nullable();
            $table->string('security_question_ans')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('exam_officers');
    }
};
