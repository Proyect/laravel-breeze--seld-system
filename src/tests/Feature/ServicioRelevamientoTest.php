<?php

namespace Tests\Feature;

use App\Mail\ServiceSurveyMail;
use Illuminate\Support\Facades\Mail;
use Tests\TestCase;

class ServicioRelevamientoTest extends TestCase
{
    public function test_relevamiento_requires_valid_fields(): void
    {
        $this->from('/servicios/data-science')
            ->post('/servicios/data-science/relevamiento', [])
            ->assertRedirect('/servicios/data-science')
            ->assertSessionHasErrors(['name', 'email', 'mensaje']);
    }

    public function test_relevamiento_sends_mail_on_valid_payload(): void
    {
        Mail::fake();

        $this->from('/servicios/data-science')
            ->post('/servicios/data-science/relevamiento', [
                'name' => 'Cliente',
                'email' => 'cliente@example.com',
                'mensaje' => 'Quiero un relevamiento',
            ])
            ->assertRedirect('/servicios/data-science')
            ->assertSessionHas('success');

        Mail::assertSent(ServiceSurveyMail::class, function (ServiceSurveyMail $mail) {
            return $mail->slug === 'data-science'
                && $mail->email === 'cliente@example.com';
        });
    }
}

