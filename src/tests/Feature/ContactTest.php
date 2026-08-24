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

    public function test_contact_form_stores_optional_phone(): void
    {
        Mail::fake();

        $this->from('/')
            ->post('/contacto', [
                'name' => 'Ana',
                'email' => 'ana@example.com',
                'phone' => '+54 9 387 555-0000',
                'company' => 'PyME SA',
                'service' => 'desarrollo',
                'message' => 'Necesito un presupuesto.',
            ])
            ->assertRedirect();

        $this->assertDatabaseHas('inquiries', [
            'email' => 'ana@example.com',
            'phone' => '+54 9 387 555-0000',
        ]);

        $this->assertDatabaseHas('inquiries', [
            'email' => 'ana@example.com',
        ]);

        $inquiry = Inquiry::where('email', 'ana@example.com')->first();
        $this->assertStringContainsString('Empresa: PyME SA', $inquiry->message);
        $this->assertStringContainsString('Servicio: desarrollo', $inquiry->message);
    }

    public function test_contact_form_requires_valid_data(): void
    {
        $this->from('/')
            ->post('/contacto', [])
            ->assertSessionHasErrors(['name', 'email', 'message']);

        $this->assertDatabaseCount('inquiries', 0);
    }
}
