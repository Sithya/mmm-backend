<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('committee_members', function (Blueprint $table) {
            $table->id();
            $table->string('first_name');
            $table->string('last_name');
            $table->string('affiliation');
            $table->enum('role', [
                'honorary_chair',
                'general_chair',
                'program_chair',
                'program_coordinator',
                'technical_program_chair',
                'video_browser_showdown_chair',
                'web_chair',
                'publication_chair',
                'financial_chair',
                'registration_chair',
                'local_arrangement_chair'
            ]);
            $table->string('photo_path')->nullable();
            $table->text('bio')->nullable();
            $table->integer('display_order')->default(0);
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('committee_members');
    }
};

