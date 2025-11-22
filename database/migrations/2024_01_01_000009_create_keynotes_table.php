<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('keynotes', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->text('description')->nullable();
            $table->text('biography')->nullable();
            $table->string('speaker_name');
            $table->string('speaker_affiliation');
            $table->string('photo_path')->nullable();
            $table->date('scheduled_date');
            $table->time('scheduled_time_start');
            $table->time('scheduled_time_end');
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('keynotes');
    }
};

