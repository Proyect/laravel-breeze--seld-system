<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('payments', function (Blueprint $table) {
            $table->index('user_id');
            $table->index('sale_id');
            $table->index('provider_payment_id');
            $table->foreign('sale_id')->references('id')->on('sales')->nullOnDelete();
        });

        Schema::table('sales', function (Blueprint $table) {
            $table->index('user_id');
            $table->index('status');
        });

        Schema::table('product_sales', function (Blueprint $table) {
            $table->index('product_id');
            $table->index('sales_id');
        });
    }

    public function down(): void
    {
        Schema::table('payments', function (Blueprint $table) {
            $table->dropForeign(['sale_id']);
            $table->dropIndex(['user_id']);
            $table->dropIndex(['sale_id']);
            $table->dropIndex(['provider_payment_id']);
        });

        Schema::table('sales', function (Blueprint $table) {
            $table->dropIndex(['user_id']);
            $table->dropIndex(['status']);
        });

        Schema::table('product_sales', function (Blueprint $table) {
            $table->dropIndex(['product_id']);
            $table->dropIndex(['sales_id']);
        });
    }
};
