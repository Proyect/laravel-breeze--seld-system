<?php

namespace Tests\Feature;

use App\Mail\ContactInquiryMail;
use App\Models\Inquiry;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Mail;
use Tests\TestCase;

class ContactFormTest extends TestCase
{
    use RefreshDatabase;

    public function test_contact_form_persists_inquiry_and_sends_mail(): void
    {
        Mail::fake();

        $response = $this->from('/')
            ->post('/contacto', [
                'name' => 'Ana Tester',
                'email' => 'ana@example.com',
                'message' => 'Necesito un presupuesto',
            ]);

        $response->assertRedirect('/');
        $response->assertSessionHas('success');

        $this->assertDatabaseHas('inquiries', [
            'name' => 'Ana Tester',
            'email' => 'ana@example.com',
            'status' => 'pending',
        ]);

        $this->assertSame(1, Inquiry::query()->count());
        Mail::assertSent(ContactInquiryMail::class, function (ContactInquiryMail $mail) {
            return $mail->inquiry->email === 'ana@example.com';
        });
    }

    public function test_contact_form_requires_valid_fields(): void
    {
        $this->from('/')
            ->post('/contacto', [
                'name' => '',
                'email' => 'not-an-email',
                'message' => '',
            ])
            ->assertRedirect('/')
            ->assertSessionHasErrors(['name', 'email', 'message']);

        $this->assertDatabaseCount('inquiries', 0);
    }
}
