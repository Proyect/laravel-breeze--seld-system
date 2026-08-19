<?php

namespace Tests\Feature;

use App\Models\Inquiry;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Mail;
use Tests\TestCase;

class ContactTest extends TestCase
{
    use RefreshDatabase;

    public function test_contact_form_stores_inquiry(): void
    {
        Mail::fake();

        $this->from('/')
            ->post('/contacto', [
                'name' => 'Juan Pérez',
                'email' => 'juan@example.com',
                'message' => 'Quiero más información sobre sus servicios.',
            ])
            ->assertRedirect();

        $this->assertDatabaseHas('inquiries', [
            'name' => 'Juan Pérez',
            'email' => 'juan@example.com',
            'status' => 'pending',
        ]);
    }

    public function test_contact_form_requires_valid_data(): void
    {
        $this->from('/')
            ->post('/contacto', [])
            ->assertSessionHasErrors(['name', 'email', 'message']);

        $this->assertDatabaseCount('inquiries', 0);
    }
}
