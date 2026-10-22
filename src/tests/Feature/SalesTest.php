<?php

namespace Tests\Feature;

use App\Models\Payment;
use App\Models\Product;
use App\Models\Sales;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\CreatesUsers;
use Tests\TestCase;

class SalesTest extends TestCase
{
    use CreatesUsers, RefreshDatabase;

    public function test_authenticated_user_can_view_sales(): void
    {
        $this->actingAs($this->createUser())
            ->get('/sales')
            ->assertOk()
            ->assertSee('Nueva venta');
    }

    public function test_guest_cannot_view_sales(): void
    {
        $this->get('/sales')->assertRedirect('/login');
    }

    public function test_user_can_view_create_sale_form(): void
    {
        Product::create([
            'name' => 'Producto form',
            'description' => 'Desc',
            'price' => 100,
            'stock' => 5,
            'status' => 'active',
        ]);

        $this->actingAs($this->createUser())
            ->get('/sales/create')
            ->assertOk()
            ->assertSee('Producto form');
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
        $this->assertEquals(3, $product->fresh()->stock);
    }

    public function test_sale_fails_when_stock_is_insufficient(): void
    {
        $user = $this->createUser();
        $product = Product::create([
            'name' => 'Sin stock',
            'description' => 'Desc',
            'price' => 100,
            'stock' => 1,
            'status' => 'active',
        ]);

        $this->actingAs($user)
            ->from('/sales/create')
            ->post('/sales', [
                'products' => [$product->id => 5],
            ])
            ->assertRedirect('/sales/create')
            ->assertSessionHasErrors('products');

        $this->assertDatabaseCount('sales', 0);
        $this->assertEquals(1, $product->fresh()->stock);
    }

    public function test_admin_can_update_sale_status(): void
    {
        $admin = $this->createAdmin();
        $user = $this->createUser();
        $sale = Sales::create([
            'user_id' => $user->id,
            'status' => 'pending',
            'total_amount' => 500,
        ]);

        $this->actingAs($admin)
            ->put("/sales/{$sale->id}", ['status' => 'processing'])
            ->assertRedirect();

        $this->assertEquals('processing', $sale->fresh()->status);
    }

    public function test_regular_user_cannot_update_sale_status(): void
    {
        $user = $this->createUser();
        $sale = Sales::create([
            'user_id' => $user->id,
            'status' => 'pending',
            'total_amount' => 500,
        ]);

        $this->actingAs($user)
            ->put("/sales/{$sale->id}", ['status' => 'completed'])
            ->assertForbidden();
    }

    public function test_approved_payment_moves_sale_to_processing(): void
    {
        $user = $this->createUser();
        $sale = Sales::create([
            'user_id' => $user->id,
            'status' => 'pending',
            'total_amount' => 500,
        ]);

        $payment = Payment::create([
            'user_id' => $user->id,
            'sale_id' => $sale->id,
            'method' => 'mercadopago',
            'status' => 'active',
            'amount' => 500,
            'currency' => 'ARS',
            'payment_status' => 'pending',
        ]);

        $payment->markAsApproved();

        $this->assertEquals('approved', $payment->fresh()->payment_status);
        $this->assertEquals('processing', $sale->fresh()->status);
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

    public function test_owner_can_delete_pending_sale_and_stock_is_restored(): void
    {
        $user = $this->createUser();
        $product = Product::create([
            'name' => 'Item',
            'description' => 'Desc',
            'price' => 100,
            'stock' => 5,
            'status' => 'active',
        ]);

        $this->actingAs($user)->post('/sales', ['products' => [$product->id => 2]]);
        $sale = Sales::firstOrFail();
        $this->assertEquals(3, $product->fresh()->stock);

        $this->actingAs($user)
            ->deleteJson("/sales/{$sale->id}")
            ->assertOk();

        $this->assertDatabaseMissing('sales', ['id' => $sale->id]);
        $this->assertEquals(5, $product->fresh()->stock);
    }

    public function test_owner_cannot_delete_processing_sale(): void
    {
        $user = $this->createUser();
        $sale = Sales::create([
            'user_id' => $user->id,
            'status' => 'processing',
            'total_amount' => 500,
        ]);

        $this->actingAs($user)
            ->deleteJson("/sales/{$sale->id}")
            ->assertForbidden();
    }

    public function test_sale_with_approved_payment_cannot_be_deleted(): void
    {
        $admin = $this->createAdmin();
        $sale = Sales::create([
            'user_id' => $admin->id,
            'status' => 'pending',
            'total_amount' => 500,
        ]);
        Payment::create([
            'user_id' => $admin->id,
            'sale_id' => $sale->id,
            'method' => 'mercadopago',
            'status' => 'active',
            'amount' => 500,
            'currency' => 'ARS',
            'payment_status' => 'approved',
        ]);

        $this->actingAs($admin)
            ->deleteJson("/sales/{$sale->id}")
            ->assertStatus(422);

        $this->assertDatabaseHas('sales', ['id' => $sale->id]);
    }

    public function test_release_expired_command_frees_stock_of_old_pending_sales(): void
    {
        $user = $this->createUser();
        $product = Product::create([
            'name' => 'Item',
            'description' => 'Desc',
            'price' => 100,
            'stock' => 5,
            'status' => 'active',
        ]);

        $this->actingAs($user)->post('/sales', ['products' => [$product->id => 2]]);
        $this->actingAs($user)->post('/sales', ['products' => [$product->id => 1]]);
        [$old, $recent] = Sales::orderBy('id')->get()->all();
        $old->forceFill(['created_at' => now()->subHours(72)])->save();

        $this->artisan('sales:release-expired', ['--hours' => 48])->assertSuccessful();

        $this->assertDatabaseMissing('sales', ['id' => $old->id]);
        $this->assertDatabaseHas('sales', ['id' => $recent->id]);
        $this->assertEquals(4, $product->fresh()->stock);
    }
}
