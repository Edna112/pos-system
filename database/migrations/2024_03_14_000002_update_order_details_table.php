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
        Schema::table('order_details', function (Blueprint $table) {
            if (!Schema::hasColumn('order_details', 'quantity')) {
                $table->integer('quantity')->default(0);
            }
            if (!Schema::hasColumn('order_details', 'unitcost')) {
                $table->decimal('unitcost', 10, 2)->default(0);
            }
            if (!Schema::hasColumn('order_details', 'total')) {
                $table->decimal('total', 10, 2)->default(0);
            }
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('order_details', function (Blueprint $table) {
            $table->dropColumn(['quantity', 'unitcost', 'total']);
        });
    }
}; 