<?php

namespace Tests\Feature;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class AdminPagesTest extends TestCase
{
    use RefreshDatabase;

    public function test_authenticated_users_can_open_dashboard_and_catalog_pages(): void
    {
        $user = User::factory()->create(['role' => 'user']);

        $this->actingAs($user)->get('/dashboard')->assertOk();
        $this->actingAs($user)->get('/products')->assertOk();
        $this->actingAs($user)->get('/sales')->assertOk();
    }

    public function test_users_index_is_available_for_authenticated_users(): void
    {
        $admin = User::factory()->create(['role' => 'admin']);

        $this->actingAs($admin)->get('/users')->assertOk();
    }

    public function test_guest_cannot_access_admin_pages(): void
    {
        $this->get('/dashboard')->assertRedirect(route('login', absolute: false));
        $this->get('/products')->assertRedirect(route('login', absolute: false));
        $this->get('/sales')->assertRedirect(route('login', absolute: false));
        $this->get('/users')->assertRedirect(route('login', absolute: false));
    }
}
