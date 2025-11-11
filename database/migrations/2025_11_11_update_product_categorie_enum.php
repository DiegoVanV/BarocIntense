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
        // SQLite doesn't support ENUM, but we can use check constraint
        // For now, we'll keep it as varchar but document the allowed values
        // If you need stricter validation, consider switching to PostgreSQL or MySQL

        Schema::table('products', function (Blueprint $table) {
            // Change the column to ensure consistency
            // SQLite migration: we need to recreate the table
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        // No changes to reverse
    }
};
