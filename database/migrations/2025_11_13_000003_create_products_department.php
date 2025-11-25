<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use App\Models\Department;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        // Create Products department if it doesn't exist
        Department::firstOrCreate(
            ['name' => 'Products'],
            ['slug' => 'products']
        );
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Department::where('name', 'Products')->delete();
    }
};
