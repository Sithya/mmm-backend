<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('paper_authors', function (Blueprint $table) {
            $table->id();
            $table->foreignId('paper_id')->constrained()->onDelete('cascade');
            $table->foreignId('user_id')->constrained()->onDelete('cascade');
            $table->boolean('is_corresponding_author')->default(false);
            $table->integer('author_order')->default(0);
            $table->timestamps();
            
            $table->unique(['paper_id', 'user_id']);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('paper_authors');
    }
};

