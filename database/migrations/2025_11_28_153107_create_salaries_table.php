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
        Schema::create('salaries', function (Blueprint $table) {
        $table->id();
        $table->foreignId('labour_id')->constrained()->cascadeOnDelete();
        $table->unsignedTinyInteger('month');
        $table->unsignedSmallInteger('year');
        $table->integer('attendance_days')->default(0);
        $table->decimal('total_load_income', 12, 2)->default(0);
        $table->decimal('total_extra_income', 12, 2)->default(0);
        $table->decimal('total_advances', 12, 2)->default(0);
        $table->decimal('gross_salary', 12, 2)->default(0);
        $table->decimal('net_salary', 12, 2)->default(0);
        $table->timestamps();
    });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('salaries');
    }
};
