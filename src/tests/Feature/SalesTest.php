<?php

namespace Tests\Feature;

use App\Models\Product;
use App\Models\Sales;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\CreatesUsers;
use Tests\TestCase;

class SalesTest extends TestCase
{
    use RefreshDatabase, CreatesUsers;

    public function test_authenticated_user_can_view_sales(): void
    {
        $this->actingAs($this->createUser())
            ->get('/sales')
            ->assertOk();
    }

    public function test_guest_cannot_view_sales(): void
    {
        $this->get('/sales')->assertRedirect('/login');
    }

    public function test_user_can_create_sale_with_products(): void
    {
        $user = $this->createUser();
        $product = Product::create([
            'name' => 'Item Venta',
            'description' => 'Desc',
            'price' => 1000,
            'stock' => 5,
            'status' => 'active',
        ]);

        $this->actingAs($user)
            ->post('/sales', [
                'products' => [$product->id => 2],
            ])
            ->assertRedirect();

        $sale = Sales::first();
        $this->assertNotNull($sale);
        $this->assertEquals($user->id, $sale->user_id);
        $this->assertEquals('pending', $sale->status);
        $this->assertEquals(2000, (float) $sale->total_amount);
        $this->assertDatabaseHas('product_sales', [
            'product_id' => $product->id,
            'sales_id' => $sale->id,
            'quantity' => 2,
        ]);
    }

    public function test_user_can_view_own_sale(): void
    {
        $user = $this->createUser();
        $sale = Sales::create([
            'user_id' => $user->id,
            'status' => 'pending',
            'total_amount' => 500,
        ]);

        $this->actingAs($user)
            ->get("/sales/{$sale->id}")
            ->assertOk();
    }

    public function test_user_cannot_view_other_users_sale(): void
    {
        $owner = $this->createUser();
        $other = User::factory()->create(['role' => 'user']);
        $sale = Sales::create([
            'user_id' => $owner->id,
            'status' => 'pending',
            'total_amount' => 500,
        ]);

        $this->actingAs($other)
            ->get("/sales/{$sale->id}")
            ->assertForbidden();
    }
}
