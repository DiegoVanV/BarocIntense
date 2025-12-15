<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('maintenance_logs', function (Blueprint $table) {
            $table->id();
            $table->foreignId('machine_id')->constrained('machines')->onDelete('cascade');
            $table->foreignId('maintenance_order_id')->nullable()->constrained('maintenance_orders')->onDelete('set null');
            $table->string('gebruiker');
            $table->text('omschrijving');
            $table->timestamp('toegevoegd_op')->useCurrent();
            $table->timestamps();
        });
    }
    public function down(): void
    {
        Schema::dropIfExists('maintenance_logs');
    }
};
