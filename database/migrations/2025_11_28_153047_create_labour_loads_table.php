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
         Schema::create('labour_loads', function (Blueprint $table) {
        $table->id();
        $table->foreignId('labour_id')->constrained()->cascadeOnDelete();
        $table->foreignId('load_id')->constrained()->cascadeOnDelete();
        $table->integer('loads_done');
        $table->decimal('rate_per_load', 10, 2);
        $table->decimal('amount', 12, 2);
        $table->timestamps();
    });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('labour_loads');
    }
};
