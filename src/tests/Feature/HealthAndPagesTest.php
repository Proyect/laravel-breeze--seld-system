<?php

namespace Tests\Feature;

use Tests\TestCase;

class HealthAndPagesTest extends TestCase
{
    public function test_health_endpoint_is_ok(): void
    {
        $this->get('/up')->assertOk();
    }

    public function test_home_page_renders(): void
    {
        $this->get('/')->assertOk();
    }

    public function test_site_and_servicios_pages_render(): void
    {
        $this->get('/site')->assertOk();
        $this->get('/servicios')->assertOk();
        $this->get('/servicios/data-science')->assertOk();
        $this->get('/servicios/no-existe')->assertNotFound();
    }

    public function test_tecnologias_api_returns_json(): void
    {
        $this->getJson('/api/tecnologias/backend')
            ->assertOk()
            ->assertJsonStructure(['categoria', 'tecnologias']);
    }

    public function test_site_search_endpoint_validates_and_responds(): void
    {
        $this->postJson('/search', ['q' => 'laravel'])
            ->assertOk()
            ->assertJson([
                'query' => 'laravel',
                'results' => [],
            ]);
    }
}
