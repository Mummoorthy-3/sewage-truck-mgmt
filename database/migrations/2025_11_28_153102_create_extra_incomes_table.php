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
         Schema::create('extra_incomes', function (Blueprint $table) {
        $table->id();
        $table->foreignId('labour_id')->nullable()->constrained()->nullOnDelete();
        $table->foreignId('vehicle_id')->nullable()->constrained()->nullOnDelete();
        $table->string('type'); // tip, pipe_work, block_removal
        $table->text('description')->nullable();
        $table->decimal('amount', 12, 2);
        $table->date('date');
        $table->timestamps();
    });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('extra_incomes');
    }
};
