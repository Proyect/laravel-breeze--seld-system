<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Schema;
use Tests\TestCase;

class SchemaIntegrityTest extends TestCase
{
    use RefreshDatabase;

    public function test_critical_tables_and_columns_exist(): void
    {
        $this->assertTrue(Schema::hasTable('users'));
        $this->assertTrue(Schema::hasColumn('users', 'role'));

        $this->assertTrue(Schema::hasTable('sales'));
        $this->assertTrue(Schema::hasTable('products'));
        $this->assertTrue(Schema::hasTable('payments'));
        $this->assertTrue(Schema::hasColumns('payments', [
            'sale_id',
            'amount',
            'currency',
            'provider',
            'provider_payment_id',
            'payment_status',
            'metadata',
        ]));

        $this->assertTrue(Schema::hasTable('inquiries'));
        $this->assertTrue(Schema::hasColumns('inquiries', [
            'name',
            'email',
            'message',
            'status',
        ]));

        $this->assertTrue(Schema::hasTable('product_sales'));
        $this->assertTrue(Schema::hasColumns('product_sales', [
            'sales_id',
            'product_id',
            'quantity',
        ]));

        $this->assertTrue(Schema::hasColumns('sales_details', [
            'sale_id',
            'product_id',
            'quantity',
            'unit_price',
        ]));
    }
}
