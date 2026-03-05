<?php

namespace Database\Seeders;

use App\Models\Settings;
use Illuminate\Database\Seeder;

class PillarPageSeeder extends Seeder
{
    public function run(): void
    {
        $content = <<<'HTML'
<p>Blue Draft is a leading construction company serving New York City and the greater metropolitan area. With over 15 years of experience, we deliver premium residential and commercial construction services across Manhattan, Brooklyn, Queens, the Bronx, and Staten Island.</p>

<h2>Why Choose Blue Draft for Construction in New York?</h2>
<p>New York City presents unique challenges: tight spaces, strict building codes, and diverse neighborhood requirements. Our team specializes in navigating NYC permits, working with co-op and condo boards, and delivering projects on time and within budget.</p>

<h2>Our Service Areas Across NYC</h2>
<h3>Manhattan</h3>
<p>From luxury high-rise renovations to brownstone restorations, we bring precision and quality to Manhattan construction projects. Our commercial construction team has completed offices, retail spaces, and restaurants throughout Midtown, Downtown, and Upper Manhattan.</p>

<h3>Brooklyn</h3>
<p>Brooklyn's diverse architecture—from brownstones to modern lofts—requires adaptable expertise. We excel at kitchen remodeling in Park Slope, bathroom renovations in Williamsburg, and full renovations across Brooklyn Heights, DUMBO, and Prospect Heights.</p>

<h3>Queens</h3>
<p>Queens homeowners and business owners trust us for residential construction, commercial build-outs, and renovation projects. We serve Astoria, Long Island City, Flushing, and surrounding neighborhoods.</p>

<h3>The Bronx & Staten Island</h3>
<p>We extend our construction services to the Bronx and Staten Island, delivering the same quality and professionalism that has made us a trusted name across the five boroughs.</p>

<h2>Construction Services We Offer</h2>
<p>Our comprehensive services include kitchen remodeling, bathroom renovation, commercial construction, and full home renovations. Each project is tailored to NYC's unique requirements and your specific vision.</p>

<h2>Get Your Free Estimate</h2>
<p>Ready to start your New York construction project? Contact Blue Draft today for a free, no-obligation estimate. We typically respond within 24 hours and are happy to discuss your project in Manhattan, Brooklyn, Queens, or anywhere in the NYC metro area.</p>
HTML;

        $settings = [
            ['key' => 'pillar_nyc_title', 'value' => 'Construction Company New York | Blue Draft', 'type' => 'text', 'group' => 'pillar_nyc'],
            ['key' => 'pillar_nyc_meta_description', 'value' => 'Blue Draft: Premier construction company in New York City. Kitchen remodeling, bathroom renovation, commercial construction. Serving Manhattan, Brooklyn, Queens. Free estimates.', 'type' => 'text', 'group' => 'pillar_nyc'],
            ['key' => 'pillar_nyc_hero_title', 'value' => 'Construction Company New York', 'type' => 'text', 'group' => 'pillar_nyc'],
            ['key' => 'pillar_nyc_hero_subtitle', 'value' => 'Premium Construction Services Across Manhattan, Brooklyn, Queens & All Five Boroughs', 'type' => 'text', 'group' => 'pillar_nyc'],
            ['key' => 'pillar_nyc_content', 'value' => $content, 'type' => 'textarea', 'group' => 'pillar_nyc'],
        ];

        foreach ($settings as $s) {
            Settings::updateOrCreate(['key' => $s['key']], $s);
        }

        $this->command->info('Pillar page settings seeded.');
    }
}
