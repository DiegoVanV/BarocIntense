<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('machines', function (Blueprint $table) {
            $table->id();
            $table->string('naam');
            $table->string('type');
            $table->string('serienummer')->unique();
            $table->enum('status', ['operationeel', 'storing', 'gepland_onderhoud'])->default('operationeel');
            $table->text('specificaties')->nullable();
            $table->timestamps();
        });
    }
    public function down(): void
    {
        Schema::dropIfExists('machines');
    }
};
