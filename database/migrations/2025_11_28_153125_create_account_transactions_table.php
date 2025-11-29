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
        Schema::create('account_transactions', function (Blueprint $table) {
        $table->id();
        $table->date('date');
        $table->string('type'); // revenue, expense, salary, maintenance, payment_in, payment_out
        $table->text('description')->nullable();
        $table->decimal('amount', 12, 2);
        $table->foreignId('company_id')->nullable()->constrained()->nullOnDelete();
        $table->foreignId('labour_id')->nullable()->constrained()->nullOnDelete();
        $table->foreignId('vehicle_id')->nullable()->constrained()->nullOnDelete();
        $table->foreignId('load_id')->nullable()->constrained()->nullOnDelete();
        $table->timestamps();
    });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('account_transactions');
    }
};
