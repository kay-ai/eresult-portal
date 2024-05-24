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
        Schema::create('carryovers', function (Blueprint $table) {
            $table->id();
            $table->string('mat_num', 25)->nullable();
            $table->integer('level_id');
            $table->integer('department_id');
            $table->string('semester', 10)->nullable();
            $table->integer('academic_session_id');
            $table->string('cc');
            $table->enum('type', ['internal', 'external'])->default('internal');
            $table->enum('status', ['pass', 'fail'])->default('fail');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('carryovers');
    }
};
