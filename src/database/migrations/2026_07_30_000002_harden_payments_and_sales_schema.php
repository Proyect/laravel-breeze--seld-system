<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('payments', function (Blueprint $table) {
            $table->index('provider_payment_id');
            $table->index('payment_status');
            $table->foreign('sale_id')->references('id')->on('sales')->nullOnDelete();
        });

        if (! Schema::hasTable('product_sales')) {
            Schema::create('product_sales', function (Blueprint $table) {
                $table->id();
                $table->foreignId('sales_id')->constrained('sales')->cascadeOnDelete();
                $table->foreignId('product_id')->constrained('products')->cascadeOnDelete();
                $table->unsignedInteger('quantity')->default(1);
                $table->timestamps();
            });
        }

        Schema::table('sales_details', function (Blueprint $table) {
            if (! Schema::hasColumn('sales_details', 'sale_id')) {
                $table->foreignId('sale_id')->nullable()->constrained('sales')->nullOnDelete();
            }
            if (! Schema::hasColumn('sales_details', 'product_id')) {
                $table->foreignId('product_id')->nullable()->constrained('products')->nullOnDelete();
            }
            if (! Schema::hasColumn('sales_details', 'quantity')) {
                $table->unsignedInteger('quantity')->default(1);
            }
            if (! Schema::hasColumn('sales_details', 'unit_price')) {
                $table->decimal('unit_price', 10, 2)->nullable();
            }
        });
    }

    public function down(): void
    {
        Schema::table('payments', function (Blueprint $table) {
            $table->dropForeign(['sale_id']);
            $table->dropIndex(['provider_payment_id']);
            $table->dropIndex(['payment_status']);
        });

        Schema::dropIfExists('product_sales');

        Schema::table('sales_details', function (Blueprint $table) {
            if (Schema::hasColumn('sales_details', 'sale_id')) {
                $table->dropConstrainedForeignId('sale_id');
            }
            if (Schema::hasColumn('sales_details', 'product_id')) {
                $table->dropConstrainedForeignId('product_id');
            }
            if (Schema::hasColumn('sales_details', 'quantity')) {
                $table->dropColumn('quantity');
            }
            if (Schema::hasColumn('sales_details', 'unit_price')) {
                $table->dropColumn('unit_price');
            }
        });
    }
};
