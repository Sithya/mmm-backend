<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('visa_support_letters', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->onDelete('cascade');
            $table->foreignId('registration_id')->constrained()->onDelete('cascade');
            $table->string('full_name');
            $table->date('date_of_birth');
            $table->string('place_of_birth');
            $table->string('nationality');
            $table->string('passport_number');
            $table->date('passport_expiry');
            $table->foreignId('paper_id')->nullable()->constrained()->onDelete('set null');
            $table->enum('status', ['pending', 'approved', 'sent'])->default('pending');
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('visa_support_letters');
    }
};

