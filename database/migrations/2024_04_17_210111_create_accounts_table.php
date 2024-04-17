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
        Schema::create('accounts', function (Blueprint $table) {
            $table->id();
            $table->string('school');
            $table->string('motto');
            $table->string('logo');
            $table->string('state');
            $table->string('pob');
            $table->string('department');
            $table->string('exam_officer');
            $table->string('email');
            $table->string('password');
            $table->string('reset_token');
            $table->string('security_question');
            $table->string('security_question_ans');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('accounts');
    }
};
