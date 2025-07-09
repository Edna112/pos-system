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
        Schema::create('expenses', function (Blueprint $table) {
            $table->id();
            $table->string('expense_number')->unique();
            $table->string('title');
            $table->text('description')->nullable();
            $table->decimal('amount', 10, 2);
            $table->date('expense_date');
            $table->string('category')->nullable();
            $table->string('payment_method')->nullable();
            $table->string('reference_number')->nullable();
            $table->foreignId('user_id')->constrained()->onDelete('cascade');
            $table->string('status')->default('pending'); // pending, approved, rejected
            $table->text('notes')->nullable();
            $table->string('attachment')->nullable(); // for receipt/invoice uploads
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('expenses');
    }
};
