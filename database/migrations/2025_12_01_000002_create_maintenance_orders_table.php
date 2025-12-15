<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('maintenance_orders', function (Blueprint $table) {
            $table->id();
            $table->foreignId('machine_id')->constrained('machines')->onDelete('cascade');
            $table->string('titel');
            $table->text('beschrijving')->nullable();
            $table->enum('status', ['ingepland', 'bezig', 'afgerond'])->default('ingepland');
            $table->date('gepland_op')->nullable();
            $table->date('uitgevoerd_op')->nullable();
            $table->timestamps();
        });
    }
    public function down(): void
    {
        Schema::dropIfExists('maintenance_orders');
    }
};
