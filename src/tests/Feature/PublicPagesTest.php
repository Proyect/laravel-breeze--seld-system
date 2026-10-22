<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Mail;
use Tests\TestCase;

class PublicPagesTest extends TestCase
{
    use RefreshDatabase;

    public function test_home_page_loads(): void
    {
        $this->get('/')->assertOk();
    }

    public function test_servicios_index_loads(): void
    {
        $this->get('/servicios')
            ->assertOk()
            ->assertSee('Nuestros Servicios');
    }

    public function test_servicio_detail_loads(): void
    {
        $this->get('/servicios/desarrollo-software')
            ->assertOk()
            ->assertSee('Desarrollo de Software');
    }

    public function test_invalid_servicio_returns_404(): void
    {
        $this->get('/servicios/no-existe')->assertNotFound();
    }

    public function test_register_page_loads(): void
    {
        $this->get('/register')->assertOk();
    }

    public function test_search_endpoint_accepts_query(): void
    {
        $this->post('/search', ['q' => 'hosting'])
            ->assertOk();
    }

    public function test_search_finds_servicios_and_blog(): void
    {
        $this->get('/search?q=Laravel')
            ->assertOk()
            ->assertSee('Laravel');
    }

    public function test_blog_index_loads(): void
    {
        $this->get('/blog')
            ->assertOk()
            ->assertSee('Últimas publicaciones');
    }

    public function test_blog_article_loads(): void
    {
        $this->get('/blog/laravel-proximo-proyecto-web')
            ->assertOk()
            ->assertSee('Por qué elegir Laravel');
    }

    public function test_invalid_blog_article_returns_404(): void
    {
        $this->get('/blog/no-existe')->assertNotFound();
    }

    public function test_relevamiento_stores_inquiry(): void
    {
        Mail::fake();

        $this->from('/servicios/desarrollo-software')
            ->post('/servicios/desarrollo-software/relevamiento', [
                'name' => 'Laura',
                'email' => 'laura@example.com',
                'mensaje' => 'Necesito un sistema a medida.',
            ])
            ->assertRedirect('/servicios/desarrollo-software');

        $this->assertDatabaseHas('inquiries', ['email' => 'laura@example.com']);
    }

    public function test_relevamiento_for_unknown_service_returns_404(): void
    {
        $this->post('/servicios/no-existe/relevamiento', [
            'name' => 'Laura',
            'email' => 'laura@example.com',
            'mensaje' => 'Hola',
        ])->assertNotFound();
    }

    public function test_security_headers_are_present(): void
    {
        $this->get('/')
            ->assertHeader('X-Content-Type-Options', 'nosniff')
            ->assertHeader('X-Frame-Options', 'SAMEORIGIN');
    }
}
