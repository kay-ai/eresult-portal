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
        Schema::create('gpas', function (Blueprint $table) {
            $table->id();
            $table->string('mat_num', 25);
            $table->decimal('gpa', 8);
            $table->integer('level_id');
            $table->integer('department_id');
            $table->string('semester', 10);
            $table->string('academic_session', 25);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('gpas');
    }
};
