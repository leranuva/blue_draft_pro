<?php

namespace Tests\Feature;

use App\Models\Post;
use App\Models\Project;
use App\Models\Service;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class RoutesTest extends TestCase
{
    use RefreshDatabase;

    public function test_home_returns_200(): void
    {
        $response = $this->get('/');
        $response->assertStatus(200);
    }

    public function test_sitemap_returns_valid_xml(): void
    {
        $response = $this->get('/sitemap.xml');
        $response->assertStatus(200);
        $response->assertHeader('Content-Type', 'application/xml');
        $response->assertSee('<?xml', false);
        $response->assertSee('<urlset', false);
    }

    public function test_services_redirects_to_hash(): void
    {
        $response = $this->get('/services');
        $response->assertRedirect('/#services');
        $response->assertStatus(301);
    }

    public function test_blog_index_returns_200(): void
    {
        $response = $this->get('/blog');
        $response->assertStatus(200);
    }

    public function test_lead_magnet_returns_200(): void
    {
        $response = $this->get('/free-renovation-guide');
        $response->assertStatus(200);
    }

    public function test_cost_calculator_returns_200(): void
    {
        $response = $this->get('/cost-calculator');
        $response->assertStatus(200);
    }

    public function test_pillar_nyc_returns_200(): void
    {
        $response = $this->get('/construction-company-new-york');
        $response->assertStatus(200);
    }

    public function test_pillar_district_manhattan_returns_200(): void
    {
        $response = $this->get('/construction-company-manhattan');
        $response->assertStatus(200);
    }

    public function test_pillar_districts_all_return_200(): void
    {
        $districts = ['queens', 'brooklyn', 'bronx', 'new-jersey'];
        foreach ($districts as $district) {
            $response = $this->get("/construction-company-{$district}");
            $response->assertStatus(200, "Pillar {$district} should return 200");
        }
    }

    public function test_service_show_returns_200_when_service_exists(): void
    {
        Service::create([
            'title' => 'Kitchen Remodel',
            'slug' => 'kitchen-remodeling-new-york',
            'is_active' => true,
        ]);

        $response = $this->get('/services/kitchen-remodeling-new-york');
        $response->assertStatus(200);
    }

    public function test_service_show_returns_404_when_not_found(): void
    {
        $response = $this->get('/services/non-existent-service');
        $response->assertStatus(404);
    }

    public function test_project_show_returns_200_when_project_exists(): void
    {
        Project::create([
            'title' => 'Test Project',
            'slug' => 'test-project',
        ]);

        $response = $this->get('/projects/test-project');
        $response->assertStatus(200);
    }

    public function test_project_show_returns_404_when_not_found(): void
    {
        $response = $this->get('/projects/non-existent-project');
        $response->assertStatus(404);
    }

    public function test_blog_show_returns_200_when_post_exists(): void
    {
        Post::create([
            'title' => 'Test Post',
            'slug' => 'test-post',
            'content' => 'Test content',
            'is_published' => true,
        ]);

        $response = $this->get('/blog/test-post');
        $response->assertStatus(200);
    }

    public function test_blog_show_returns_404_when_not_found(): void
    {
        $response = $this->get('/blog/non-existent-post');
        $response->assertStatus(404);
    }

    public function test_project_proposal_returns_200(): void
    {
        $response = $this->get('/project-proposal');
        $response->assertStatus(200);
    }

    public function test_lead_magnet_guide_redirects_without_session(): void
    {
        $response = $this->get('/free-renovation-guide/guide');
        $response->assertRedirect(route('lead-magnet.show'));
    }

    public function test_quote_partial_creates_partial_quote(): void
    {
        $response = $this->post('/quote/partial', [
            'name' => 'Test User',
            'email' => 'test@example.com',
            'service' => 'residential',
        ]);

        $response->assertSuccessful();
        $this->assertDatabaseHas('quotes', [
            'email' => 'test@example.com',
            'is_partial' => true,
        ]);
    }

    public function test_throttle_blocks_excessive_requests(): void
    {
        for ($i = 0; $i < 5; $i++) {
            $this->post('/contact', [
                'name' => 'Test',
                'email' => 'test' . $i . '@example.com',
                'service' => 'residential',
                'message' => 'Hello',
            ]);
        }

        $response = $this->post('/contact', [
            'name' => 'Test',
            'email' => 'test6@example.com',
            'service' => 'residential',
            'message' => 'Hello',
        ]);

        $response->assertStatus(429);
    }
}
