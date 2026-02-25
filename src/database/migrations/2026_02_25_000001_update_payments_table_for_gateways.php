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
        Schema::table('payments', function (Blueprint $table) {
            $table->foreignId('sale_id')->nullable()->after('id');
            $table->decimal('amount', 10, 2)->nullable()->after('status');
            $table->string('currency', 3)->nullable()->after('amount');
            $table->string('provider')->nullable()->after('currency');
            $table->string('provider_payment_id')->nullable()->after('provider');
            $table->enum('payment_status', ['pending', 'approved', 'rejected', 'refunded'])->default('pending')->after('provider_payment_id');
            $table->json('metadata')->nullable()->after('payment_status');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('payments', function (Blueprint $table) {
            $table->dropColumn([
                'sale_id',
                'amount',
                'currency',
                'provider',
                'provider_payment_id',
                'payment_status',
                'metadata',
            ]);
        });
    }
};
