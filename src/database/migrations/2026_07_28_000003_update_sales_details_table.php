<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('sales_details', function (Blueprint $table) {
            $table->foreignId('sales_id')->after('id')->constrained('sales')->cascadeOnDelete();
            $table->foreignId('product_id')->after('sales_id')->constrained()->cascadeOnDelete();
            $table->unsignedInteger('quantity')->default(1)->after('product_id');
            $table->decimal('unit_price', 10, 2)->after('quantity');
            $table->decimal('subtotal', 10, 2)->after('unit_price');
        });
    }

    public function down(): void
    {
        Schema::table('sales_details', function (Blueprint $table) {
            $table->dropForeign(['sales_id']);
            $table->dropForeign(['product_id']);
            $table->dropColumn(['sales_id', 'product_id', 'quantity', 'unit_price', 'subtotal']);
        });
    }
};
