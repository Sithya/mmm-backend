<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('conference_program', function (Blueprint $table) {
            $table->id();
            $table->date('day');
            $table->time('time_start');
            $table->time('time_end');
            $table->string('title');
            $table->text('description')->nullable();
            $table->enum('session_type', ['oral', 'poster', 'break', 'keynote', 'workshop', 'other'])->default('other');
            $table->string('location')->nullable();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('conference_program');
    }
};

