<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('papers', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->text('abstract');
            $table->enum('paper_type', ['regular', 'special_session', 'demo', 'vbs']);
            $table->string('submission_type')->nullable();
            $table->enum('status', ['submitted', 'under_review', 'accepted', 'rejected'])->default('submitted');
            $table->string('file_path')->nullable();
            $table->string('source_zip_path')->nullable();
            $table->string('copyright_form_path')->nullable();
            $table->foreignId('special_session_id')->nullable()->constrained()->onDelete('set null');
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('papers');
    }
};

