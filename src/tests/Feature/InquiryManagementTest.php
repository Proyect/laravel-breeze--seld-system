<?php

namespace Tests\Feature;

use App\Models\Inquiry;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\CreatesUsers;
use Tests\TestCase;

class InquiryManagementTest extends TestCase
{
    use CreatesUsers, RefreshDatabase;

    public function test_admin_can_view_inquiries_page(): void
    {
        $this->actingAs($this->createAdmin())
            ->get('/inquiries')
            ->assertOk();
    }

    public function test_regular_user_cannot_access_inquiries(): void
    {
        $this->actingAs($this->createUser())
            ->get('/inquiries')
            ->assertForbidden();
    }

    public function test_admin_can_list_inquiries_as_json(): void
    {
        Inquiry::create([
            'name' => 'Test User',
            'email' => 'test@example.com',
            'message' => 'Hola',
            'status' => 'pending',
        ]);

        $this->actingAs($this->createAdmin())
            ->getJson('/inquiries/list/data')
            ->assertOk()
            ->assertJsonFragment(['email' => 'test@example.com']);
    }

    public function test_admin_can_update_inquiry_status(): void
    {
        $inquiry = Inquiry::create([
            'name' => 'Test',
            'email' => 'a@b.com',
            'message' => 'Msg',
            'status' => 'pending',
        ]);

        $this->actingAs($this->createAdmin())
            ->putJson("/inquiries/{$inquiry->id}", ['status' => 'read'])
            ->assertOk()
            ->assertJson(['result' => true]);

        $this->assertDatabaseHas('inquiries', ['id' => $inquiry->id, 'status' => 'read']);
    }

    public function test_admin_can_delete_inquiry(): void
    {
        $inquiry = Inquiry::create([
            'name' => 'Test',
            'email' => 'a@b.com',
            'message' => 'Msg',
            'status' => 'pending',
        ]);

        $this->actingAs($this->createAdmin())
            ->deleteJson("/inquiries/{$inquiry->id}")
            ->assertOk();

        $this->assertDatabaseMissing('inquiries', ['id' => $inquiry->id]);
    }
}
