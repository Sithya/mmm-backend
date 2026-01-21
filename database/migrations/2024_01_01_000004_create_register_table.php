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
        Schema::create('registers', function (Blueprint $table) {
            $table->id();

            // Registration info
            $table->string('registration_type'); // student | standard | early_bird

            // Personal info
            $table->string('first_name');
            $table->string('last_name');
            $table->string('email')->index();

            // Optional info
            $table->string('affiliation')->nullable();
            $table->string('country');

            // Optional dietary requirements
            $table->text('dietary_restrictions')->nullable();

            // Terms agreement
            $table->boolean('agreed_to_terms');

            // Timestamps
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('registers');
    }
};
