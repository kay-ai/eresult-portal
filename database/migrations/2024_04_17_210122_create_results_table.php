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
        Schema::create('results', function (Blueprint $table) {
            $table->id();
            $table->string('mat_num', 25)->nullable();
            $table->integer('level_id');
            $table->string('semester', 10)->nullable();
            $table->integer('academic_session_id');
            $table->string('cc1', 25)->nullable();
            $table->integer('cu1')->nullable();
            $table->string('score1', 11)->nullable();
            $table->string('grade1', 5)->nullable();
            $table->string('rmk1', 25)->nullable();
            $table->string('cc2', 25)->nullable();
            $table->integer('cu2')->nullable();
            $table->string('score2', 11)->nullable();
            $table->string('grade2', 5)->nullable();
            $table->string('rmk2', 25)->nullable();
            $table->string('cc3', 25)->nullable();
            $table->integer('cu3')->nullable();
            $table->string('score3', 11)->nullable();
            $table->string('grade3', 5)->nullable();
            $table->string('rmk3', 25)->nullable();
            $table->string('cc4', 25)->nullable();
            $table->integer('cu4')->nullable();
            $table->string('score4', 11)->nullable();
            $table->string('grade4', 5)->nullable();
            $table->string('rmk4', 25)->nullable();
            $table->string('cc5', 15)->nullable();
            $table->integer('cu5')->nullable();
            $table->string('score5', 11)->nullable();
            $table->string('grade5', 5)->nullable();
            $table->string('rmk5', 25)->nullable();
            $table->string('cc6', 15)->nullable();
            $table->integer('cu6')->nullable();
            $table->string('score6', 11)->nullable();
            $table->string('grade6', 5)->nullable();
            $table->string('rmk6', 25)->nullable();
            $table->string('cc7', 15)->nullable();
            $table->integer('cu7')->nullable();
            $table->string('score7', 11)->nullable();
            $table->string('grade7', 5)->nullable();
            $table->string('rmk7', 25)->nullable();
            $table->string('cc8', 15)->nullable();
            $table->integer('cu8')->nullable();
            $table->string('score8', 11)->nullable();
            $table->string('grade8', 5)->nullable();
            $table->string('rmk8', 25)->nullable();
            $table->string('cc9', 15)->nullable();
            $table->integer('cu9')->nullable();
            $table->string('score9', 11)->nullable();
            $table->string('grade9', 5)->nullable();
            $table->string('rmk9', 25)->nullable();
            $table->string('cc10', 15)->nullable();
            $table->integer('cu10')->nullable();
            $table->string('score10', 11)->nullable();
            $table->string('grade10', 5)->nullable();
            $table->string('rmk10', 25)->nullable();
            $table->string('cc11', 15)->nullable();
            $table->integer('cu11')->nullable();
            $table->string('score11', 11)->nullable();
            $table->string('grade11', 5)->nullable();
            $table->string('rmk11', 25)->nullable();
            $table->string('cc12', 15)->nullable();
            $table->integer('cu12')->nullable();
            $table->string('score12', 11)->nullable();
            $table->string('grade12', 5)->nullable();
            $table->string('rmk12', 25)->nullable();
            $table->string('dept', 25)->nullable();
            $table->string('tgp', 11)->nullable();
            $table->integer('tcu')->nullable();
            $table->string('tce', 11)->nullable();
            $table->string('gpa', 11)->nullable();
            $table->string('remarks', 225)->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('results');
    }
};
