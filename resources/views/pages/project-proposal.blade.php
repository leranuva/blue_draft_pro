@extends('layouts.app')

@section('title', 'Blue Draft — Project Proposal & Usage Guide')
@section('meta_description', 'Professional project proposal for Blue Draft: conversion-optimized construction website with lead automation, SEO, and full commercial pipeline.')

@push('meta')
    <meta name="robots" content="noindex, nofollow">
@endpush

@section('content')
<div class="min-h-screen bg-gray-50 dark:bg-gray-900" x-data="{ activeSection: 'proposal' }">
    <!-- Sticky Navigation -->
    <nav class="sticky top-20 z-40 bg-white/95 dark:bg-gray-900/95 backdrop-blur border-b border-gray-200 dark:border-gray-700 shadow-sm">
        <div class="max-w-5xl mx-auto px-4 sm:px-6 lg:px-8 py-3">
            <div class="flex gap-4">
                <button @@click="activeSection = 'proposal'; document.getElementById('proposal').scrollIntoView({ behavior: 'smooth' })"
                        :class="activeSection === 'proposal' ? 'bg-[#003366] text-white' : 'bg-gray-100 dark:bg-gray-800 text-gray-700 dark:text-gray-300 hover:bg-gray-200 dark:hover:bg-gray-700'"
                        class="px-4 py-2 rounded-lg font-medium text-sm transition-colors">
                    Project Proposal
                </button>
                <button @@click="activeSection = 'guide'; document.getElementById('guide').scrollIntoView({ behavior: 'smooth' })"
                        :class="activeSection === 'guide' ? 'bg-[#003366] text-white' : 'bg-gray-100 dark:bg-gray-800 text-gray-700 dark:text-gray-300 hover:bg-gray-200 dark:hover:bg-gray-700'"
                        class="px-4 py-2 rounded-lg font-medium text-sm transition-colors">
                    Usage Guide
                </button>
            </div>
        </div>
    </nav>

    <main class="max-w-5xl mx-auto px-4 sm:px-6 lg:px-8 py-12 lg:py-20">
        <!-- Hero -->
        <header class="text-center mb-16">
            <p class="text-[#336699] dark:text-[#4a90e2] font-semibold uppercase tracking-wider text-sm mb-2">Project Proposal</p>
            <h1 class="text-4xl md:text-5xl font-serif font-bold text-[#003366] dark:text-white mb-4">
                Blue Draft 
            </h1>
            <p class="text-xl text-gray-600 dark:text-gray-400 max-w-2xl mx-auto">
                Conversion-Optimized Construction Website with Full Lead Automation & Local SEO
            </p>
            <p class="text-sm text-gray-500 dark:text-gray-500 mt-2">Version 1.2.0 — February 2026</p>
        </header>

        <!-- ========== PROJECT PROPOSAL SECTION ========== -->
        <section id="proposal" class="scroll-mt-28" x-intersect:enter="activeSection = 'proposal'">
            <div class="prose prose-lg dark:prose-invert max-w-none">
                <!-- Executive Summary -->
                <div class="bg-white dark:bg-gray-800 rounded-2xl p-8 md:p-10 shadow-lg border border-gray-100 dark:border-gray-700 mb-12">
                    <h2 class="text-2xl font-serif font-bold text-[#003366] dark:text-white mb-6 flex items-center gap-2">
                        <span class="w-8 h-8 rounded-full bg-[#003366] text-white flex items-center justify-center text-sm font-sans">1</span>
                        Executive Summary
                    </h2>
                    <p class="text-gray-700 dark:text-gray-300 leading-relaxed mb-4">
                        <strong>Blue Draft</strong> is a production-ready web application for a New York City construction company. Built on Laravel 12 and Filament 4, it delivers a complete commercial pipeline: from first visitor touch to automated lead nurturing, conversion tracking, and local SEO dominance.
                    </p>
                    <div class="grid sm:grid-cols-2 gap-4 mt-6">
                        <div class="flex items-start gap-3 p-4 rounded-xl bg-green-50 dark:bg-green-900/20 border border-green-200 dark:border-green-800">
                            <span class="text-green-600 dark:text-green-400 text-xl">✓</span>
                            <span class="text-gray-700 dark:text-gray-300"><strong>Technically solid</strong> — Modern stack, clean architecture</span>
                        </div>
                        <div class="flex items-start gap-3 p-4 rounded-xl bg-green-50 dark:bg-green-900/20 border border-green-200 dark:border-green-800">
                            <span class="text-green-600 dark:text-green-400 text-xl">✓</span>
                            <span class="text-gray-700 dark:text-gray-300"><strong>Commercially automated</strong> — 6-email sequence, reminders</span>
                        </div>
                        <div class="flex items-start gap-3 p-4 rounded-xl bg-green-50 dark:bg-green-900/20 border border-green-200 dark:border-green-800">
                            <span class="text-green-600 dark:text-green-400 text-xl">✓</span>
                            <span class="text-gray-700 dark:text-gray-300"><strong>Paid traffic ready</strong> — GTM, GA4, Meta Pixel</span>
                        </div>
                        <div class="flex items-start gap-3 p-4 rounded-xl bg-green-50 dark:bg-green-900/20 border border-green-200 dark:border-green-800">
                            <span class="text-green-600 dark:text-green-400 text-xl">✓</span>
                            <span class="text-gray-700 dark:text-gray-300"><strong>Local SEO ready</strong> — Pillar pages, Schema, sitemap</span>
                        </div>
                    </div>
                    <p class="mt-6 text-amber-700 dark:text-amber-400 bg-amber-50 dark:bg-amber-900/20 p-4 rounded-xl border border-amber-200 dark:border-amber-800">
                        <strong>Status:</strong> Advanced MVP ready to scale traffic. The system is 100% implemented — the next phase is optimization, acquisition, and authority building.
                    </p>
                </div>

                <!-- What This Project Does -->
                <div class="bg-white dark:bg-gray-800 rounded-2xl p-8 md:p-10 shadow-lg border border-gray-100 dark:border-gray-700 mb-12">
                    <h2 class="text-2xl font-serif font-bold text-[#003366] dark:text-white mb-6 flex items-center gap-2">
                        <span class="w-8 h-8 rounded-full bg-[#003366] text-white flex items-center justify-center text-sm font-sans">2</span>
                        What This Project Does
                    </h2>
                    <p class="text-gray-700 dark:text-gray-300 leading-relaxed mb-4">
                        <strong>Blue Draft</strong> is a <strong>lead generation and conversion system</strong> for a construction company. Its purpose is to:
                    </p>
                    <ul class="list-disc list-inside space-y-2 text-gray-700 dark:text-gray-300 mb-6">
                        <li><strong>Attract</strong> potential customers (homeowners, property managers) searching for renovation services in NYC</li>
                        <li><strong>Capture</strong> their contact information through multiple entry points (quote form, lead magnet, cost calculator)</li>
                        <li><strong>Qualify</strong> leads automatically with scoring (Cold/Warm/Hot) and UTM tracking</li>
                        <li><strong>Nurture</strong> them with a 6-email automated sequence until they convert or request a proposal</li>
                        <li><strong>Alert</strong> the sales team when leads need attention (24h without contact, proposals pending follow-up)</li>
                        <li><strong>Convert</strong> visitors into booked projects through a clear pipeline from first touch to closed deal</li>
                    </ul>
                    <p class="text-gray-700 dark:text-gray-300 leading-relaxed">
                        It is <em>not</em> a simple brochure site. It is a <strong>commercial machine</strong> that works 24/7 to capture, score, and nurture leads with minimal manual intervention — while the business focuses on delivering projects and closing deals.
                    </p>
                </div>

                <!-- Lead Generation by Phase -->
                <div class="bg-white dark:bg-gray-800 rounded-2xl p-8 md:p-10 shadow-lg border border-gray-100 dark:border-gray-700 mb-12">
                    <h2 class="text-2xl font-serif font-bold text-[#003366] dark:text-white mb-6 flex items-center gap-2">
                        <span class="w-8 h-8 rounded-full bg-[#003366] text-white flex items-center justify-center text-sm font-sans">3</span>
                        How Leads Are Captured — By Phase
                    </h2>
                    <p class="text-gray-700 dark:text-gray-300 mb-6">
                        Leads enter the system through different touchpoints. Each phase of the implementation adds new capture methods and automates the follow-up. Here is the complete flow:
                    </p>

                    <div class="space-y-6">
                        <!-- Phase 1 -->
                        <div class="border-l-4 border-[#003366] pl-6 py-2">
                            <h3 class="font-semibold text-[#003366] dark:text-white mb-2">Phase 1 — Conversion Foundation</h3>
                            <p class="text-gray-700 dark:text-gray-300 text-sm mb-2"><strong>Lead capture:</strong></p>
                            <ul class="text-gray-600 dark:text-gray-400 text-sm space-y-1">
                                <li>• <strong>Quote form (2 steps)</strong> — Visitor fills Step 1 (name, email, service) → partial lead saved. Completes Step 2 → full lead with phone, address, budget, photos.</li>
                                <li>• <strong>Contact form</strong> — General inquiries captured and notified to admin.</li>
                                <li>• <strong>Sticky CTAs</strong> — "Get Free Quote" and WhatsApp buttons drive clicks to the form or direct contact.</li>
                            </ul>
                        </div>

                        <!-- Phase 2 -->
                        <div class="border-l-4 border-[#003366] pl-6 py-2">
                            <h3 class="font-semibold text-[#003366] dark:text-white mb-2">Phase 2 — SEO & Structure</h3>
                            <p class="text-gray-700 dark:text-gray-300 text-sm mb-2"><strong>Lead capture:</strong></p>
                            <ul class="text-gray-600 dark:text-gray-400 text-sm space-y-1">
                                <li>• <strong>Service landing pages</strong> — Each service (kitchen, bathroom, etc.) has its own page with CTA to quote form. Organic traffic from Google lands here.</li>
                                <li>• <strong>NYC pillar page</strong> — /construction-company-new-york ranks for "construction company NYC" and funnels visitors to services and quote form.</li>
                                <li>• <strong>Project pages</strong> — Case studies with before/after build trust and link to quote form.</li>
                            </ul>
                        </div>

                        <!-- Phase 3 -->
                        <div class="border-l-4 border-[#003366] pl-6 py-2">
                            <h3 class="font-semibold text-[#003366] dark:text-white mb-2">Phase 3 — Automation</h3>
                            <p class="text-gray-700 dark:text-gray-300 text-sm mb-2"><strong>Lead capture:</strong></p>
                            <ul class="text-gray-600 dark:text-gray-400 text-sm space-y-1">
                                <li>• Same capture points as above, but now <strong>every completed quote</strong> triggers the 6-email sequence automatically.</li>
                                <li>• UTM parameters (source, medium, campaign) are saved with each lead for attribution.</li>
                                <li>• <strong>Internal alerts:</strong> If a lead is not contacted within 24h → admin gets email. If a proposal is sent and 5 days pass without follow-up → admin gets reminder.</li>
                            </ul>
                        </div>

                        <!-- Phase 4 -->
                        <div class="border-l-4 border-[#003366] pl-6 py-2">
                            <h3 class="font-semibold text-[#003366] dark:text-white mb-2">Phase 4 — Tracking</h3>
                            <p class="text-gray-700 dark:text-gray-300 text-sm mb-2"><strong>Lead capture:</strong></p>
                            <ul class="text-gray-600 dark:text-gray-400 text-sm space-y-1">
                                <li>• No new capture points — tracking <strong>measures</strong> what works: form submits, phone clicks, scroll depth, time on page, service views.</li>
                                <li>• GA4 and Meta Pixel build remarketing audiences from visitors who didn't convert. These audiences can be retargeted with paid ads.</li>
                            </ul>
                        </div>

                        <!-- Phase 5 -->
                        <div class="border-l-4 border-[#003366] pl-6 py-2">
                            <h3 class="font-semibold text-[#003366] dark:text-white mb-2">Phase 5 — Optimization & Remarketing</h3>
                            <p class="text-gray-700 dark:text-gray-300 text-sm mb-2"><strong>Lead capture:</strong></p>
                            <ul class="text-gray-600 dark:text-gray-400 text-sm space-y-1">
                                <li>• <strong>Lead magnet</strong> — /free-renovation-guide captures emails in exchange for a free guide. Subscribers enter the email sequence.</li>
                                <li>• <strong>Cost calculator</strong> — /cost-calculator lets visitors get an estimate. "Lock This Estimate" pre-fills the quote form with budget and service → higher-intent lead (+3 lead score).</li>
                                <li>• ViewContent events on these pages feed remarketing audiences for Meta Ads.</li>
                            </ul>
                        </div>

                        <!-- Phase 6 -->
                        <div class="border-l-4 border-[#003366] pl-6 py-2">
                            <h3 class="font-semibold text-[#003366] dark:text-white mb-2">Phase 6 — Local Dominance</h3>
                            <p class="text-gray-700 dark:text-gray-300 text-sm mb-2"><strong>Lead capture:</strong></p>
                            <ul class="text-gray-600 dark:text-gray-400 text-sm space-y-1">
                                <li>• <strong>Blog</strong> — Strategic articles (e.g. "How much does a renovation cost in NYC?") rank in Google and link to pillar + quote form.</li>
                                <li>• More organic traffic → more leads from the same capture points (quote form, lead magnet, calculator).</li>
                                <li>• CDN and compression improve speed → better conversion rates.</li>
                            </ul>
                        </div>
                    </div>

                    <div class="mt-8 p-4 rounded-xl bg-[#003366]/5 dark:bg-[#336699]/10 border border-[#003366]/20 dark:border-[#336699]/30">
                        <p class="text-gray-700 dark:text-gray-300 text-sm">
                            <strong>Summary:</strong> Leads are captured via <strong>quote form</strong>, <strong>lead magnet</strong>, and <strong>cost calculator</strong>. Traffic comes from <strong>organic SEO</strong> (pillar, services, blog) and <strong>paid ads</strong> (Google, Meta). Once captured, the system nurtures them automatically and alerts the team when human follow-up is needed.
                        </p>
                    </div>
                </div>

                <!-- Implementation Phases -->
                <div class="bg-white dark:bg-gray-800 rounded-2xl p-8 md:p-10 shadow-lg border border-gray-100 dark:border-gray-700 mb-12">
                    <h2 class="text-2xl font-serif font-bold text-[#003366] dark:text-white mb-6 flex items-center gap-2">
                        <span class="w-8 h-8 rounded-full bg-[#003366] text-white flex items-center justify-center text-sm font-sans">4</span>
                        Implementation Phases (All Complete)
                    </h2>
                    <div class="overflow-x-auto">
                        <table class="w-full text-sm">
                            <thead>
                                <tr class="border-b border-gray-200 dark:border-gray-600">
                                    <th class="text-left py-3 font-semibold text-[#003366] dark:text-white">Phase</th>
                                    <th class="text-left py-3 font-semibold text-[#003366] dark:text-white">Focus</th>
                                    <th class="text-left py-3 font-semibold text-[#003366] dark:text-white">Status</th>
                                </tr>
                            </thead>
                            <tbody class="text-gray-700 dark:text-gray-300">
                                <tr class="border-b border-gray-100 dark:border-gray-700"><td class="py-3">1</td><td>Conversion Foundation — 2-step form, CTAs, lazy loading</td><td><span class="text-green-600 font-medium">✓ 100%</span></td></tr>
                                <tr class="border-b border-gray-100 dark:border-gray-700"><td class="py-3">2</td><td>SEO & Scalable Structure — Services, projects, pillar pages, Schema</td><td><span class="text-green-600 font-medium">✓ 100%</span></td></tr>
                                <tr class="border-b border-gray-100 dark:border-gray-700"><td class="py-3">3</td><td>Commercial Automation — Email sequence, Brevo, follow-ups</td><td><span class="text-green-600 font-medium">✓ 100%</span></td></tr>
                                <tr class="border-b border-gray-100 dark:border-gray-700"><td class="py-3">4</td><td>Tracking & Data — GTM, GA4, Meta Pixel, custom events</td><td><span class="text-green-600 font-medium">✓ 100%</span></td></tr>
                                <tr class="border-b border-gray-100 dark:border-gray-700"><td class="py-3">5</td><td>Optimization & Remarketing — Lead magnet, cost calculator</td><td><span class="text-green-600 font-medium">✓ 100%</span></td></tr>
                                <tr><td class="py-3">6</td><td>Local Dominance — NYC pillar, blog, CDN, compression</td><td><span class="text-green-600 font-medium">✓ 100%</span></td></tr>
                            </tbody>
                        </table>
                    </div>
                </div>

                <!-- Key Features -->
                <div class="bg-white dark:bg-gray-800 rounded-2xl p-8 md:p-10 shadow-lg border border-gray-100 dark:border-gray-700 mb-12">
                    <h2 class="text-2xl font-serif font-bold text-[#003366] dark:text-white mb-6 flex items-center gap-2">
                        <span class="w-8 h-8 rounded-full bg-[#003366] text-white flex items-center justify-center text-sm font-sans">5</span>
                        Key Features
                    </h2>
                    <div class="grid md:grid-cols-2 gap-6">
                        <div>
                            <h3 class="font-semibold text-[#003366] dark:text-white mb-2">Public Site</h3>
                            <ul class="space-y-1 text-gray-600 dark:text-gray-400 text-sm">
                                <li>• Landing page with Hero, About, Projects, Services, Process, Testimonials</li>
                                <li>• 2-step quote form with partial save & prefill from calculator</li>
                                <li>• Service landing pages (kitchen-remodeling-new-york, etc.)</li>
                                <li>• NYC pillar page: /construction-company-new-york</li>
                                <li>• Blog with Markdown & RichEditor</li>
                                <li>• Lead magnet: Free Renovation Guide</li>
                                <li>• Cost calculator with estimate lock CTA</li>
                                <li>• Dynamic sitemap.xml</li>
                            </ul>
                        </div>
                        <div>
                            <h3 class="font-semibold text-[#003366] dark:text-white mb-2">Admin & Automation</h3>
                            <ul class="space-y-1 text-gray-600 dark:text-gray-400 text-sm">
                                <li>• Filament 4 dashboard with conversion funnel metrics</li>
                                <li>• Quote pipeline: new → contacted → qualified → proposal_sent → won/lost</li>
                                <li>• Lead scoring (Cold/Warm/Hot) & UTM tracking</li>
                                <li>• 6-email sequence (0h, 24h, 3d, 7d, 10d, 14d)</li>
                                <li>• Brevo integration (contacts + SMTP)</li>
                                <li>• 24h lead-not-contacted alert</li>
                                <li>• 5-day proposal follow-up reminder</li>
                                <li>• Abandoned quote detection (cron)</li>
                            </ul>
                        </div>
                    </div>
                </div>

                <!-- Tech Stack -->
                <div class="bg-white dark:bg-gray-800 rounded-2xl p-8 md:p-10 shadow-lg border border-gray-100 dark:border-gray-700 mb-12">
                    <h2 class="text-2xl font-serif font-bold text-[#003366] dark:text-white mb-6 flex items-center gap-2">
                        <span class="w-8 h-8 rounded-full bg-[#003366] text-white flex items-center justify-center text-sm font-sans">6</span>
                        Technology Stack
                    </h2>
                    <div class="flex flex-wrap gap-3">
                        <span class="px-4 py-2 bg-[#003366]/10 dark:bg-[#336699]/20 text-[#003366] dark:text-[#4a90e2] rounded-lg font-medium">Laravel 12</span>
                        <span class="px-4 py-2 bg-[#003366]/10 dark:bg-[#336699]/20 text-[#003366] dark:text-[#4a90e2] rounded-lg font-medium">Filament 4</span>
                        <span class="px-4 py-2 bg-[#003366]/10 dark:bg-[#336699]/20 text-[#003366] dark:text-[#4a90e2] rounded-lg font-medium">PostgreSQL</span>
                        <span class="px-4 py-2 bg-[#003366]/10 dark:bg-[#336699]/20 text-[#003366] dark:text-[#4a90e2] rounded-lg font-medium">Tailwind CSS 4</span>
                        <span class="px-4 py-2 bg-[#003366]/10 dark:bg-[#336699]/20 text-[#003366] dark:text-[#4a90e2] rounded-lg font-medium">Alpine.js</span>
                        <span class="px-4 py-2 bg-[#003366]/10 dark:bg-[#336699]/20 text-[#003366] dark:text-[#4a90e2] rounded-lg font-medium">Vite 7</span>
                        <span class="px-4 py-2 bg-[#003366]/10 dark:bg-[#336699]/20 text-[#003366] dark:text-[#4a90e2] rounded-lg font-medium">Brevo</span>
                        <span class="px-4 py-2 bg-[#003366]/10 dark:bg-[#336699]/20 text-[#003366] dark:text-[#4a90e2] rounded-lg font-medium">GTM / GA4 / Meta Pixel</span>
                    </div>
                </div>

                <!-- Value Proposition -->
                <div class="bg-gradient-to-br from-[#003366] to-[#336699] rounded-2xl p-8 md:p-10 text-white mb-12">
                    <h2 class="text-2xl font-serif font-bold mb-6">Value Proposition</h2>
                    <p class="text-white/90 leading-relaxed mb-4">
                        This is not a brochure website. It's a <strong>lead generation and nurturing machine</strong> designed to capture, qualify, and convert visitors into customers — with minimal manual intervention. Every touchpoint is tracked, every lead is scored, and every opportunity is followed up automatically.
                    </p>
                    <p class="text-white/80 text-sm">
                        The project is in <strong>business phase</strong>, not development phase. The focus shifts to traffic, authority, optimization, and real data.
                    </p>
                </div>
            </div>
        </section>

        <!-- ========== USAGE GUIDE SECTION ========== -->
        <section id="guide" class="scroll-mt-28 mt-20" x-intersect:enter="activeSection = 'guide'">
            <div class="border-t border-gray-200 dark:border-gray-700 pt-16">
                <h2 class="text-3xl font-serif font-bold text-[#003366] dark:text-white mb-2">Usage Guide</h2>
                <p class="text-gray-600 dark:text-gray-400 mb-10">How to get the maximum value from Blue Draft</p>

                <div class="space-y-12">
                    <!-- Quick Start -->
                    <div class="bg-white dark:bg-gray-800 rounded-2xl p-8 shadow-lg border border-gray-100 dark:border-gray-700">
                        <h3 class="text-xl font-semibold text-[#003366] dark:text-white mb-4">1. Quick Start</h3>
                        <div class="space-y-3 text-gray-700 dark:text-gray-300">
                            <p><strong>Development:</strong></p>
                            <pre class="bg-gray-100 dark:bg-gray-900 p-4 rounded-lg overflow-x-auto text-sm"><code>php artisan serve
npm run dev</code></pre>
                            <p>Site: <code class="bg-gray-100 dark:bg-gray-700 px-1 rounded">http://localhost:8000</code> — Admin: <code class="bg-gray-100 dark:bg-gray-700 px-1 rounded">/system-bd-access</code></p>
                            <p class="pt-2"><strong>Production:</strong> Configure <code class="bg-gray-100 dark:bg-gray-700 px-1 rounded">.env</code>, run <code class="bg-gray-100 dark:bg-gray-700 px-1 rounded">php artisan queue:work</code>, and add cron: <code class="bg-gray-100 dark:bg-gray-700 px-1 rounded">* * * * * php artisan schedule:run</code></p>
                        </div>
                    </div>

                    <!-- Admin Panel -->
                    <div class="bg-white dark:bg-gray-800 rounded-2xl p-8 shadow-lg border border-gray-100 dark:border-gray-700">
                        <h3 class="text-xl font-semibold text-[#003366] dark:text-white mb-4">2. Admin Panel Essentials</h3>
                        <ul class="space-y-2 text-gray-700 dark:text-gray-300">
                            <li><strong>Site Settings</strong> — Hero, About, Contact, Footer, Testimonials: customize all content from Filament.</li>
                            <li><strong>Quotes</strong> — Use the pipeline view. Update stages (contacted, qualified, proposal_sent, won/lost). Check lead score and UTM data.</li>
                            <li><strong>Dashboard</strong> — Monitor funnel metrics: partial→complete, complete→proposal, proposal→won.</li>
                            <li><strong>Services & Projects</strong> — Add case studies, FAQs, and related content. Each service has its own CTA.</li>
                            <li><strong>Posts</strong> — Publish 2+ strategic articles/month. Link each to the NYC pillar page.</li>
                        </ul>
                    </div>

                    <!-- Traffic & Conversion -->
                    <div class="bg-white dark:bg-gray-800 rounded-2xl p-8 shadow-lg border border-gray-100 dark:border-gray-700">
                        <h3 class="text-xl font-semibold text-[#003366] dark:text-white mb-4">3. Activate Traffic & Conversion</h3>
                        <p class="text-gray-700 dark:text-gray-300 mb-4">The system is ready — it needs traffic to perform. Priority actions:</p>
                        <ol class="list-decimal list-inside space-y-2 text-gray-700 dark:text-gray-300">
                            <li><strong>Google Ads</strong> — Launch campaigns for "construction company new york", "home renovation NYC", "general contractor Manhattan". Use the pillar page as landing.</li>
                            <li><strong>Tracking</strong> — Set <code class="bg-gray-100 dark:bg-gray-700 px-1 rounded">GTM_ID</code>, <code class="bg-gray-100 dark:bg-gray-700 px-1 rounded">GA4_MEASUREMENT_ID</code>, <code class="bg-gray-100 dark:bg-gray-700 px-1 rounded">META_PIXEL_ID</code> in .env.</li>
                            <li><strong>Brevo</strong> — Configure <code class="bg-gray-100 dark:bg-gray-700 px-1 rounded">BREVO_API_KEY</code> and <code class="bg-gray-100 dark:bg-gray-700 px-1 rounded">BREVO_LIST_ID</code> for email sequence and contact sync.</li>
                            <li><strong>reCAPTCHA</strong> — Optional but recommended for production to reduce spam.</li>
                        </ol>
                    </div>

                    <!-- SEO & Authority -->
                    <div class="bg-white dark:bg-gray-800 rounded-2xl p-8 shadow-lg border border-gray-100 dark:border-gray-700">
                        <h3 class="text-xl font-semibold text-[#003366] dark:text-white mb-4">4. SEO & Authority Building</h3>
                        <ul class="space-y-2 text-gray-700 dark:text-gray-300">
                            <li><strong>Content</strong> — Publish strategic articles: "How much does a home renovation cost in NYC in 2026?", "Do I need a permit to renovate in Manhattan?", "Best neighborhoods in NYC for home remodeling". Each must link to the pillar.</li>
                            <li><strong>Backlinks</strong> — NYC directories, Houzz, Yelp, Angi, chambers of commerce, local guest posts.</li>
                            <li><strong>Reviews</strong> — Implement post-project review requests. Add real reviews to Schema.</li>
                            <li><strong>Pillar optimization</strong> — Add 2–3 detailed case studies, a pricing guide section, FAQs from real searches, and at least one video.</li>
                        </ul>
                    </div>

                    <!-- 90-Day Roadmap -->
                    <div class="bg-white dark:bg-gray-800 rounded-2xl p-8 shadow-lg border border-gray-100 dark:border-gray-700">
                        <h3 class="text-xl font-semibold text-[#003366] dark:text-white mb-4">5. 90-Day Scaling Roadmap</h3>
                        <div class="space-y-4">
                            <div class="p-4 rounded-xl bg-blue-50 dark:bg-blue-900/20 border border-blue-200 dark:border-blue-800">
                                <strong>Month 1 — Commercial Validation</strong><br>
                                Launch Google Ads, measure real CPL, optimize pillar landing, publish 2 strategic articles, get 5 backlinks.
                            </div>
                            <div class="p-4 rounded-xl bg-blue-50 dark:bg-blue-900/20 border border-blue-200 dark:border-blue-800">
                                <strong>Month 2 — Authority</strong><br>
                                2 more articles, 10 more backlinks, activate Miami or Boston pillar, optimize Core Web Vitals.
                            </div>
                            <div class="p-4 rounded-xl bg-blue-50 dark:bg-blue-900/20 border border-blue-200 dark:border-blue-800">
                                <strong>Month 3 — Expansion</strong><br>
                                Second active pillar, strong remarketing, real video testimonial, Meta Ads remarketing campaigns.
                            </div>
                        </div>
                    </div>

                    <!-- CRO Enhancements -->
                    <div class="bg-white dark:bg-gray-800 rounded-2xl p-8 shadow-lg border border-gray-100 dark:border-gray-700">
                        <h3 class="text-xl font-semibold text-[#003366] dark:text-white mb-4">6. CRO Enhancements (Double Results Without More Traffic)</h3>
                        <ul class="space-y-2 text-gray-700 dark:text-gray-300">
                            <li>Exit-intent popup with lead magnet offer</li>
                            <li>Real urgency (e.g., limited monthly slots)</li>
                            <li>Social proof above the fold</li>
                            <li>Sticky phone number on mobile</li>
                            <li>WhatsApp CTA if applicable (already configurable in Contact Settings)</li>
                        </ul>
                    </div>

                    <!-- Technical Checklist -->
                    <div class="bg-white dark:bg-gray-800 rounded-2xl p-8 shadow-lg border border-gray-100 dark:border-gray-700">
                        <h3 class="text-xl font-semibold text-[#003366] dark:text-white mb-4">7. Technical Checklist</h3>
                        <ul class="space-y-2 text-gray-700 dark:text-gray-300">
                            <li>✓ Queue worker running (<code class="bg-gray-100 dark:bg-gray-700 px-1 rounded">php artisan queue:work</code> or Supervisor)</li>
                            <li>✓ Cron configured for <code class="bg-gray-100 dark:bg-gray-700 px-1 rounded">schedule:run</code></li>
                            <li>✓ SMTP configured for notifications and email sequence</li>
                            <li>✓ Cloudflare (optional) — see <code class="bg-gray-100 dark:bg-gray-700 px-1 rounded">docs/CLOUDFLARE_SETUP.md</code></li>
                            <li>✓ Consider: rate limiting on forms, SMTP failure logs, Horizon for queue monitoring</li>
                        </ul>
                    </div>
                </div>
            </div>
        </section>

        <!-- Footer CTA -->
        <footer class="mt-20 text-center py-12 border-t border-gray-200 dark:border-gray-700">
            <p class="text-gray-500 dark:text-gray-500 text-sm">
                Blue Draft — Advanced MVP ready to scale. Focus on traffic, authority, and optimization.
            </p>
            <a href="{{ route('home') }}" class="inline-block mt-4 px-6 py-2 bg-[#003366] text-white rounded-lg hover:bg-[#004080] transition-colors font-medium">
                Back to Site
            </a>
        </footer>
    </main>
</div>
@endsection
