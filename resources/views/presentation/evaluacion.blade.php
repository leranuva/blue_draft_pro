@extends('layouts.presentation')

@section('title', 'Project Evaluation — Blue Draft')

@section('content')
<div class="max-w-6xl mx-auto px-4 sm:px-6 lg:px-8" x-data="{ activeTab: 'summary' }">
    {{-- Hero / Cover --}}
    <section class="relative py-24 mb-16 overflow-hidden rounded-2xl bg-gradient-to-br from-[#003366] via-[#003366] to-[#336699]">
        <div class="absolute inset-0 opacity-10">
            <div class="absolute top-10 right-10 w-64 h-64 bg-[#CCCC99] rounded-full blur-3xl"></div>
            <div class="absolute bottom-10 left-10 w-96 h-96 bg-white rounded-full blur-3xl"></div>
        </div>
        <div class="relative z-10 text-center">
            <span class="inline-block text-sm font-medium text-[#CCCC99] uppercase tracking-widest mb-4">Executive Evaluation</span>
            <h1 class="font-serif text-4xl sm:text-5xl lg:text-6xl font-bold text-white mb-6">Blue Draft</h1>
            <p class="text-xl text-white/90 max-w-2xl mx-auto mb-4">Lead capture, CRM, and automation system for construction company in NYC</p>
            <div class="w-20 h-0.5 bg-[#CCCC99] mx-auto mb-6"></div>
            <p class="text-sm text-white/70">Confidential document — February 2026</p>
        </div>
    </section>

    {{-- Executive Summary --}}
    <section id="summary" class="presentation-section py-16 bg-white dark:bg-gray-900">
        <div class="text-center mb-12">
            <span class="text-sm font-medium text-[#336699] dark:text-[#4a90e2] uppercase tracking-wider mb-4 block">Overview</span>
            <h2 class="font-serif text-3xl sm:text-4xl font-bold text-[#003366] dark:text-white mb-4">Executive Summary</h2>
            <div class="w-20 h-0.5 bg-[#CCCC99] dark:bg-[#4a90e2] mx-auto"></div>
        </div>
        <div class="prose prose-lg max-w-none text-gray-600 dark:text-gray-300">
            <p class="text-lg leading-relaxed text-center max-w-3xl mx-auto mb-10">
                Blue Draft is no longer a simple website with a form. It is an <strong class="text-[#003366] dark:text-white">integrated lead capture, scoring, and automation system</strong>
                that positions the company in the <strong class="text-[#003366] dark:text-white">top 5–10% technically</strong> among contractors in NYC.
            </p>
            <div class="grid sm:grid-cols-2 gap-6 mt-10">
                <div class="bg-[#CCCC99]/10 dark:bg-gray-800/50 rounded-xl p-6 border border-[#CCCC99]/30 dark:border-gray-700/50 shadow-sm">
                    <h3 class="font-semibold text-[#003366] dark:text-white mb-4 flex items-center gap-2">
                        <span class="w-1 h-6 bg-[#336699] rounded-full"></span>
                        What It Includes
                    </h3>
                    <ul class="space-y-2 text-gray-600 dark:text-gray-300">
                        <li class="flex items-start gap-2"><span class="text-[#336699] mt-0.5">✓</span> Multi-channel lead capture</li>
                        <li class="flex items-start gap-2"><span class="text-[#336699] mt-0.5">✓</span> Automatic lead scoring</li>
                        <li class="flex items-start gap-2"><span class="text-[#336699] mt-0.5">✓</span> Nurturing sequence (6 emails)</li>
                        <li class="flex items-start gap-2"><span class="text-[#336699] mt-0.5">✓</span> Operational mini-CRM</li>
                        <li class="flex items-start gap-2"><span class="text-[#336699] mt-0.5">✓</span> Scalable local SEO architecture</li>
                    </ul>
                </div>
                <div class="bg-[#CCCC99]/10 dark:bg-gray-800/50 rounded-xl p-6 border border-[#CCCC99]/30 dark:border-gray-700/50 shadow-sm">
                    <h3 class="font-semibold text-[#003366] dark:text-white mb-4 flex items-center gap-2">
                        <span class="w-1 h-6 bg-[#336699] rounded-full"></span>
                        Current Status
                    </h3>
                    <ul class="space-y-2 text-gray-600 dark:text-gray-300">
                        <li class="flex items-start gap-2"><span class="text-[#336699] mt-0.5">✓</span> Technically solid</li>
                        <li class="flex items-start gap-2"><span class="text-[#336699] mt-0.5">✓</span> Commercially structured</li>
                        <li class="flex items-start gap-2"><span class="text-[#336699] mt-0.5">✓</span> SEO-ready</li>
                        <li class="flex items-start gap-2"><span class="text-[#336699] mt-0.5">✓</span> Automated</li>
                    </ul>
                </div>
            </div>
        </div>
    </section>

    {{-- Modules and Features --}}
    <section id="modules" class="presentation-section py-16 bg-[#CCCC99]/10 dark:bg-gray-800/30">
        <div class="text-center mb-12">
            <span class="text-sm font-medium text-[#336699] dark:text-[#4a90e2] uppercase tracking-wider mb-4 block">Capabilities</span>
            <h2 class="font-serif text-3xl sm:text-4xl font-bold text-[#003366] dark:text-white mb-4">Modules & Features</h2>
            <div class="w-20 h-0.5 bg-[#CCCC99] dark:bg-[#4a90e2] mx-auto"></div>
        </div>
        <div class="space-y-4" x-data="{ expanded: null }">
            @php
                $modules = [
                    [
                        'title' => 'Lead Capture',
                        'items' => [
                            '2-step quote form (partial save + completion)',
                            'Lead magnet (free guide in exchange for email)',
                            'Cost calculator (estimate by borough and finish level)',
                            'Contact form',
                            'Automatic UTM, gclid, fbclid, borough tracking',
                        ],
                    ],
                    [
                        'title' => 'Admin Panel (Filament)',
                        'items' => [
                            'Executive dashboard with KPIs',
                            'Quote management (pipeline, stages, lead score)',
                            'Projects, services, blog',
                            'Settings: Hero, About, Contact, Footer, Pillar pages',
                        ],
                    ],
                    [
                        'title' => 'Local SEO',
                        'items' => [
                            'Pillar NYC + 5 boroughs (Manhattan, Brooklyn, Queens, Bronx, NJ)',
                            'Individual service pages',
                            'Blog with SEO meta',
                            'Dynamic sitemap',
                        ],
                    ],
                    [
                        'title' => 'Automation',
                        'items' => [
                            '6-email nurturing sequence',
                            '24h lead-not-contacted notification',
                            '5-day proposal follow-up',
                            'Abandoned quote marking',
                        ],
                    ],
                ];
            @endphp
            @foreach($modules as $i => $mod)
            <div class="bg-white dark:bg-gray-800/50 rounded-xl overflow-hidden border border-[#CCCC99]/30 dark:border-gray-700/50 shadow-sm hover:shadow-md transition-shadow">
                <button @click="expanded = expanded === {{ $i }} ? null : {{ $i }}"
                        class="group w-full px-6 py-4 flex justify-between items-center bg-gray-50 dark:bg-gray-800 hover:bg-gray-100 dark:hover:bg-gray-600 transition-colors text-left">
                    <span class="font-semibold text-gray-900 dark:text-white group-hover:text-[#003366] dark:group-hover:text-white">{{ $mod['title'] }}</span>
                    <svg class="w-5 h-5 text-[#336699] dark:text-[#4a90e2] transition-transform flex-shrink-0" :class="expanded === {{ $i }} ? 'rotate-180' : ''" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"/>
                    </svg>
                </button>
                <div x-show="expanded === {{ $i }}"
                     x-transition:enter="transition ease-out duration-200"
                     x-transition:enter-start="opacity-0 -translate-y-2"
                     x-transition:enter-end="opacity-100 translate-y-0"
                     x-transition:leave="transition ease-in duration-150"
                     x-transition:leave-start="opacity-100 translate-y-0"
                     x-transition:leave-end="opacity-0 -translate-y-2"
                     x-cloak
                     class="px-6 py-4 border-t border-[#CCCC99]/30 dark:border-gray-700/50 bg-gray-100 dark:bg-gray-800">
                    <ul class="space-y-2">
                        @foreach($mod['items'] as $item)
                        <li class="flex items-start gap-2 text-[#003366] dark:text-gray-200">
                            <span class="text-[#336699] dark:text-[#4a90e2] mt-0.5 flex-shrink-0">✓</span>
                            <span>{{ $item }}</span>
                        </li>
                        @endforeach
                    </ul>
                </div>
            </div>
            @endforeach
        </div>
    </section>

    {{-- Metrics & KPIs --}}
    <section id="metrics" class="presentation-section py-16 bg-white dark:bg-gray-900">
        <div class="text-center mb-12">
            <span class="text-sm font-medium text-[#336699] dark:text-[#4a90e2] uppercase tracking-wider mb-4 block">Analytics</span>
            <h2 class="font-serif text-3xl sm:text-4xl font-bold text-[#003366] dark:text-white mb-4">Executive Metrics System</h2>
            <div class="w-20 h-0.5 bg-[#CCCC99] dark:bg-[#4a90e2] mx-auto"></div>
        </div>
        <div class="grid sm:grid-cols-2 lg:grid-cols-3 gap-6">
            <div class="bg-gradient-to-br from-[#003366] to-[#336699] text-white rounded-xl p-6 shadow-lg hover:shadow-xl transition-shadow">
                <h3 class="font-semibold text-white/95 text-sm uppercase tracking-wider mb-3">Marketing</h3>
                <p class="text-sm text-white/90 leading-relaxed">Total leads, by source (UTM), borough, service, revenue by source</p>
            </div>
            <div class="bg-gradient-to-br from-[#003366] to-[#336699] text-white rounded-xl p-6 shadow-lg hover:shadow-xl transition-shadow">
                <h3 class="font-semibold text-white/95 text-sm uppercase tracking-wider mb-3">Sales</h3>
                <p class="text-sm text-white/90 leading-relaxed">Contacted &lt;24h (%), proposals, close rate, time to close, revenue, pipeline, sales velocity</p>
            </div>
            <div class="bg-gradient-to-br from-[#003366] to-[#336699] text-white rounded-xl p-6 shadow-lg hover:shadow-xl transition-shadow sm:col-span-2 lg:col-span-1">
                <h3 class="font-semibold text-white/95 text-sm uppercase tracking-wider mb-3">Advanced</h3>
                <p class="text-sm text-white/90 leading-relaxed">Score vs Close Rate, predictive forecast, borough deep-dive (close rate, ticket, days)</p>
            </div>
        </div>
        <div class="mt-8 bg-[#CCCC99]/15 dark:bg-gray-800/50 rounded-xl p-6 border border-[#CCCC99]/30 dark:border-gray-700/50">
            <h4 class="font-semibold text-[#003366] dark:text-white mb-3 flex items-center gap-2">
                <span class="w-1 h-5 bg-[#336699] rounded-full"></span>
                Monthly Automated Report
            </h4>
            <p class="text-gray-600 dark:text-gray-300 text-sm leading-relaxed">Command <code class="bg-white dark:bg-gray-700 px-2 py-0.5 rounded text-[#003366] dark:text-gray-200">php artisan report:monthly --email</code> generates a PDF with executive summary, dominant borough, dominant service, and breakdown. Scheduled for the 1st of each month.</p>
        </div>
    </section>

    {{-- Strategic Evaluation --}}
    <section id="evaluation" class="presentation-section py-16 bg-[#CCCC99]/10 dark:bg-gray-800/30">
        <div class="text-center mb-12">
            <span class="text-sm font-medium text-[#336699] dark:text-[#4a90e2] uppercase tracking-wider mb-4 block">Assessment</span>
            <h2 class="font-serif text-3xl sm:text-4xl font-bold text-[#003366] dark:text-white mb-4">Strategic Evaluation</h2>
            <div class="w-20 h-0.5 bg-[#CCCC99] dark:bg-[#4a90e2] mx-auto"></div>
        </div>
        <div class="overflow-x-auto rounded-xl border border-[#CCCC99]/30 dark:border-gray-700/50 shadow-sm">
            <table class="w-full border-collapse">
                <thead>
                    <tr class="bg-[#003366] dark:bg-gray-800 text-white">
                        <th class="text-left px-5 py-4 font-semibold">Area</th>
                        <th class="text-center px-5 py-4 font-semibold w-24">Score</th>
                        <th class="text-left px-5 py-4 font-semibold">Notes</th>
                    </tr>
                </thead>
                <tbody class="bg-gray-100 dark:bg-gray-800">
                    <tr class="border-b border-[#CCCC99]/30 dark:border-gray-700/50 hover:bg-gray-200 dark:hover:bg-gray-700/50 transition-colors">
                        <td class="px-5 py-4 font-medium text-[#003366] dark:text-white">Technical Architecture</td>
                        <td class="px-5 py-4 text-center"><span class="inline-flex items-center justify-center w-12 h-12 rounded-full bg-green-100 dark:bg-green-900/30 text-green-800 dark:text-green-400 font-bold">9.2</span></td>
                        <td class="px-5 py-4 text-gray-800 dark:text-gray-200">Robust, modular, scalable system</td>
                    </tr>
                    <tr class="border-b border-[#CCCC99]/30 dark:border-gray-700/50 hover:bg-gray-200 dark:hover:bg-gray-700/50 transition-colors">
                        <td class="px-5 py-4 font-medium text-[#003366] dark:text-white">Security</td>
                        <td class="px-5 py-4 text-center"><span class="inline-flex items-center justify-center w-12 h-12 rounded-full bg-green-100 dark:bg-green-900/30 text-green-800 dark:text-green-400 font-bold">8.5</span></td>
                        <td class="px-5 py-4 text-gray-800 dark:text-gray-200">CSRF, reCAPTCHA, rate limiting, validation</td>
                    </tr>
                    <tr class="border-b border-[#CCCC99]/30 dark:border-gray-700/50 hover:bg-gray-200 dark:hover:bg-gray-700/50 transition-colors">
                        <td class="px-5 py-4 font-medium text-[#003366] dark:text-white">Automation</td>
                        <td class="px-5 py-4 text-center"><span class="inline-flex items-center justify-center w-12 h-12 rounded-full bg-green-100 dark:bg-green-900/30 text-green-800 dark:text-green-400 font-bold">9.0</span></td>
                        <td class="px-5 py-4 text-gray-800 dark:text-gray-200">Email sequence, jobs, follow-ups</td>
                    </tr>
                    <tr class="border-b border-[#CCCC99]/30 dark:border-gray-700/50 hover:bg-gray-200 dark:hover:bg-gray-700/50 transition-colors">
                        <td class="px-5 py-4 font-medium text-[#003366] dark:text-white">Structural SEO</td>
                        <td class="px-5 py-4 text-center"><span class="inline-flex items-center justify-center w-12 h-12 rounded-full bg-green-100 dark:bg-green-900/30 text-green-800 dark:text-green-400 font-bold">8.5</span></td>
                        <td class="px-5 py-4 text-gray-800 dark:text-gray-200">Pillar pages, sitemap, optimized slugs</td>
                    </tr>
                    <tr class="border-b border-[#CCCC99]/30 dark:border-gray-700/50 hover:bg-gray-200 dark:hover:bg-gray-700/50 transition-colors">
                        <td class="px-5 py-4 font-medium text-[#003366] dark:text-white">Cost Calculator</td>
                        <td class="px-5 py-4 text-center"><span class="inline-flex items-center justify-center w-12 h-12 rounded-full bg-green-100 dark:bg-green-900/30 text-green-800 dark:text-green-400 font-bold">9.6</span></td>
                        <td class="px-5 py-4 text-gray-800 dark:text-gray-200">Formula by borough/finish, lock estimate, prefill quote</td>
                    </tr>
                    <tr class="border-b border-[#CCCC99]/30 dark:border-gray-700/50 hover:bg-gray-200 dark:hover:bg-gray-700/50 transition-colors">
                        <td class="px-5 py-4 font-medium text-[#003366] dark:text-white">Scalability (current hosting)</td>
                        <td class="px-5 py-4 text-center"><span class="inline-flex items-center justify-center w-12 h-12 rounded-full bg-amber-100 dark:bg-amber-900/30 text-amber-800 dark:text-amber-400 font-bold">6.0</span></td>
                        <td class="px-5 py-4 text-gray-800 dark:text-gray-200">Queue sync; VPS migration recommended</td>
                    </tr>
                    <tr class="hover:bg-gray-200 dark:hover:bg-gray-700/50 transition-colors">
                        <td class="px-5 py-4 font-medium text-[#003366] dark:text-white">Scalability with VPS</td>
                        <td class="px-5 py-4 text-center"><span class="inline-flex items-center justify-center w-12 h-12 rounded-full bg-green-100 dark:bg-green-900/30 text-green-800 dark:text-green-400 font-bold">9.0</span></td>
                        <td class="px-5 py-4 text-gray-800 dark:text-gray-200">With queue worker + Supervisor</td>
                    </tr>
                </tbody>
            </table>
        </div>
    </section>

    {{-- Conclusion & Next Steps --}}
    <section id="conclusion" class="presentation-section py-16 bg-white dark:bg-gray-900">
        <div class="text-center mb-12">
            <span class="text-sm font-medium text-[#336699] dark:text-[#4a90e2] uppercase tracking-wider mb-4 block">Outlook</span>
            <h2 class="font-serif text-3xl sm:text-4xl font-bold text-[#003366] dark:text-white mb-4">Conclusion & Next Steps</h2>
            <div class="w-20 h-0.5 bg-[#CCCC99] dark:bg-[#4a90e2] mx-auto"></div>
        </div>
        <div class="space-y-8">
            <div class="bg-[#003366]/5 dark:bg-gray-800/50 rounded-xl p-8 border-l-4 border-[#336699] shadow-sm">
                <h3 class="font-semibold text-[#003366] dark:text-white mb-5 text-lg">Final Diagnosis</h3>
                <p class="text-gray-600 dark:text-gray-300 leading-relaxed">
                    Blue Draft is not a website.<br>
                    It is an <strong class="text-[#003366] dark:text-white">integrated lead capture, scoring, and automation system</strong> designed to operate with data-driven logic in the NYC construction market.
                </p>
                <p class="text-gray-600 dark:text-gray-300 mt-5 font-medium">The system:</p>
                <ul class="mt-2 space-y-1.5 text-gray-600 dark:text-gray-300">
                    <li class="flex items-start gap-2"><span class="text-[#336699] mt-0.5">•</span> Captures leads from multiple channels</li>
                    <li class="flex items-start gap-2"><span class="text-[#336699] mt-0.5">•</span> Scores them automatically</li>
                    <li class="flex items-start gap-2"><span class="text-[#336699] mt-0.5">•</span> Estimates potential margin</li>
                    <li class="flex items-start gap-2"><span class="text-[#336699] mt-0.5">•</span> Feeds pipeline and forecast</li>
                    <li class="flex items-start gap-2"><span class="text-[#336699] mt-0.5">•</span> Automates nurturing</li>
                    <li class="flex items-start gap-2"><span class="text-[#336699] mt-0.5">•</span> Generates monthly executive reports</li>
                </ul>
                <p class="text-gray-600 dark:text-gray-300 mt-5">It is not currently limited by technical development.</p>
                <p class="text-gray-600 dark:text-gray-300 mt-2 font-medium">It is limited by:</p>
                <ul class="mt-2 space-y-1.5 text-gray-600 dark:text-gray-300">
                    <li class="flex items-start gap-2"><span class="text-[#336699] mt-0.5">•</span> Hosting infrastructure</li>
                    <li class="flex items-start gap-2"><span class="text-[#336699] mt-0.5">•</span> Domain authority</li>
                    <li class="flex items-start gap-2"><span class="text-[#336699] mt-0.5">•</span> Traffic volume</li>
                    <li class="flex items-start gap-2"><span class="text-[#336699] mt-0.5">•</span> Internal sales discipline</li>
                </ul>
            </div>
            <div class="grid sm:grid-cols-2 gap-6">
                <div class="border border-[#CCCC99]/40 dark:border-gray-700/50 rounded-xl p-6 bg-[#CCCC99]/5 dark:bg-gray-800/30 shadow-sm">
                    <h4 class="font-semibold text-[#003366] dark:text-white mb-4 flex items-center gap-2">
                        <span class="w-1 h-5 bg-[#336699] rounded-full"></span>
                        Priority Recommendations
                    </h4>
                    <ol class="list-decimal list-inside space-y-2 text-gray-600 dark:text-gray-300 text-sm">
                        <li>Migrate to VPS and enable queue worker</li>
                        <li>Measure real Core Web Vitals</li>
                        <li>Activate local backlink strategy</li>
                        <li>Define internal sales process</li>
                        <li>Execute aggressive content for 6 months</li>
                    </ol>
                </div>
                <div class="border border-[#CCCC99]/40 dark:border-gray-700/50 rounded-xl p-6 bg-[#CCCC99]/5 dark:bg-gray-800/30 shadow-sm">
                    <h4 class="font-semibold text-[#003366] dark:text-white mb-4 flex items-center gap-2">
                        <span class="w-1 h-5 bg-[#336699] rounded-full"></span>
                        Key Takeaway
                    </h4>
                    <p class="text-gray-600 dark:text-gray-300 text-sm leading-relaxed">
                        No more features are needed. The system is ready to dominate a local niche. The current phase is <strong class="text-[#003366] dark:text-white">expansion and positioning</strong>.
                    </p>
                </div>
            </div>
        </div>
    </section>

    {{-- Final CTA --}}
    <section class="text-center py-16 rounded-2xl overflow-hidden relative bg-gradient-to-r from-[#003366] via-[#003366] to-[#336699] text-white shadow-xl">
        <div class="absolute inset-0 opacity-10">
            <div class="absolute top-0 right-0 w-64 h-64 bg-[#CCCC99] rounded-full blur-3xl"></div>
        </div>
        <div class="relative z-10">
            <h3 class="font-serif text-2xl sm:text-3xl font-bold mb-4">Questions or Clarifications?</h3>
            <p class="text-white/90 mb-8 max-w-md mx-auto">This document serves as the basis for client presentation.</p>
            <a href="{{ route('home') }}#contact" class="inline-flex items-center gap-2 bg-white text-[#003366] px-8 py-4 rounded-lg font-semibold hover:bg-[#CCCC99] transition-all shadow-lg hover:shadow-xl">
                Contact Us
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 8l4 4m0 0l-4 4m4-4H3"/></svg>
            </a>
        </div>
    </section>
</div>

@endsection
