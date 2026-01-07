<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        // Rename bio to bio_html and content to body_html
        if (Schema::hasColumn('keynotes', 'bio')) {
            DB::statement('ALTER TABLE keynotes RENAME COLUMN bio TO bio_html');
        }
        if (Schema::hasColumn('keynotes', 'content')) {
            DB::statement('ALTER TABLE keynotes RENAME COLUMN content TO body_html');
        }
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        // Rename back to original column names
        if (Schema::hasColumn('keynotes', 'bio_html')) {
            DB::statement('ALTER TABLE keynotes RENAME COLUMN bio_html TO bio');
        }
        if (Schema::hasColumn('keynotes', 'body_html')) {
            DB::statement('ALTER TABLE keynotes RENAME COLUMN body_html TO content');
        }
    }
};
