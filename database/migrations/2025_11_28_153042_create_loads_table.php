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
       Schema::create('loads', function (Blueprint $table) {
        $table->id();
        $table->foreignId('company_id')->constrained()->cascadeOnDelete();
        $table->foreignId('vehicle_id')->constrained()->cascadeOnDelete();
        $table->date('date');
        $table->decimal('rate_per_load', 10, 2);
        $table->integer('load_count');
        $table->decimal('total_amount', 12, 2);
        $table->decimal('amount_paid', 12, 2)->default(0);
        $table->timestamp('locked_at')->nullable(); // editing lock
        $table->timestamps();
    });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('loads');
    }
};
