<?php

namespace Tests\Feature;

use App\Models\Product;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\CreatesUsers;
use Tests\TestCase;

class ProductTest extends TestCase
{
    use RefreshDatabase, CreatesUsers;

    public function test_admin_can_view_products_page(): void
    {
        $this->actingAs($this->createAdmin())
            ->get('/products')
            ->assertOk();
    }

    public function test_regular_user_cannot_access_products(): void
    {
        $this->actingAs($this->createUser())
            ->get('/products')
            ->assertForbidden();
    }

    public function test_admin_can_create_product(): void
    {
        $this->actingAs($this->createAdmin())
            ->postJson('/products', [
                'name' => 'Test Product',
                'description' => 'Descripción de prueba',
                'price' => 100.50,
                'stock' => 10,
                'status' => 'active',
            ])
            ->assertOk()
            ->assertJson(['result' => true]);

        $this->assertDatabaseHas('products', ['name' => 'Test Product']);
    }

    public function test_admin_can_update_product(): void
    {
        $product = Product::create([
            'name' => 'Original',
            'description' => 'Desc',
            'price' => 50,
            'stock' => 5,
            'status' => 'active',
        ]);

        $this->actingAs($this->createAdmin())
            ->putJson("/products/{$product->id}", [
                'name' => 'Actualizado',
                'description' => 'Nueva desc',
                'price' => 75,
                'stock' => 8,
                'status' => 'inactive',
            ])
            ->assertOk()
            ->assertJson(['result' => true]);

        $this->assertDatabaseHas('products', ['name' => 'Actualizado', 'status' => 'inactive']);
    }

    public function test_admin_can_delete_product(): void
    {
        $product = Product::create([
            'name' => 'Eliminar',
            'description' => 'Desc',
            'price' => 10,
            'stock' => 1,
            'status' => 'active',
        ]);

        $this->actingAs($this->createAdmin())
            ->deleteJson("/products/{$product->id}")
            ->assertOk();

        $this->assertDatabaseMissing('products', ['id' => $product->id]);
    }

    public function test_admin_can_list_products_as_json(): void
    {
        Product::create([
            'name' => 'JSON Product',
            'description' => 'Desc',
            'price' => 99,
            'stock' => 3,
            'status' => 'active',
        ]);

        $this->actingAs($this->createAdmin())
            ->getJson('/products/create')
            ->assertOk()
            ->assertJsonFragment(['name' => 'JSON Product']);
    }

    public function test_admin_can_create_product_with_image(): void
    {
        \Illuminate\Support\Facades\Storage::fake('public');

        $this->actingAs($this->createAdmin())
            ->post('/products', [
                'name' => 'Producto con imagen',
                'description' => 'Descripción',
                'price' => 100,
                'stock' => 5,
                'status' => 'active',
                'image' => \Illuminate\Http\UploadedFile::fake()->create('product.jpg', 100, 'image/jpeg'),
            ])
            ->assertOk()
            ->assertJson(['result' => true]);

        $product = Product::where('name', 'Producto con imagen')->first();
        $this->assertNotNull($product);
        $this->assertNotEmpty($product->images);
    }
}
