@extends('layouts.app')

@section('title', 'Blue Draft — Project Proposal')
@section('meta_description', 'Blue Draft: Digital system to generate and convert construction clients in New York. Lead capture, automated follow-up, and commercial pipeline.')

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
                Digital system to generate and convert construction clients in New York
            </p>
            <p class="text-sm text-gray-500 dark:text-gray-500 mt-2">February 2026</p>
        </header>

        <!-- ========== PROJECT PROPOSAL SECTION ========== -->
        <section id="proposal" class="scroll-mt-28" x-intersect:enter="activeSection = 'proposal'">
            <div class="prose prose-lg dark:prose-invert max-w-none">
                <!-- 1. Executive Summary -->
                <div class="bg-white dark:bg-gray-800 rounded-2xl p-8 md:p-10 shadow-lg border border-gray-100 dark:border-gray-700 mb-12">
                    <h2 class="text-2xl font-serif font-bold text-[#003366] dark:text-white mb-6 flex items-center gap-2">
                        <span class="w-8 h-8 rounded-full bg-[#003366] text-white flex items-center justify-center text-sm font-sans">1</span>
                        Executive Summary
                    </h2>
                    <p class="text-gray-700 dark:text-gray-300 leading-relaxed mb-4">
                        <strong>Blue Draft</strong> is a digital system designed to help a construction company in New York attract more clients, organize commercial opportunities, and convert visitors into real projects.
                    </p>
                    <p class="text-gray-700 dark:text-gray-300 leading-relaxed mb-4">
                        The system works 24/7 to:
                    </p>
                    <ul class="list-disc list-inside space-y-2 text-gray-700 dark:text-gray-300 mb-4">
                        <li>attract people searching for renovations on Google</li>
                        <li>convert visitors into interested contacts</li>
                        <li>automatically follow up on every opportunity</li>
                        <li>remind the team when to contact a client</li>
                        <li>increase the chances of closing projects</li>
                    </ul>
                    <p class="text-gray-700 dark:text-gray-300 leading-relaxed">
                        Instead of being just an informational website, Blue Draft works as a complete commercial system that accompanies the client from their first visit until the project is contracted.
                    </p>
                    <p class="text-gray-700 dark:text-gray-300 leading-relaxed mt-4">
                        The result is a more organized process, fewer lost opportunities, and more projects closed.
                    </p>
                </div>

                <!-- 2. Client Problem -->
                <div class="bg-white dark:bg-gray-800 rounded-2xl p-8 md:p-10 shadow-lg border border-gray-100 dark:border-gray-700 mb-12">
                    <h2 class="text-2xl font-serif font-bold text-[#003366] dark:text-white mb-6 flex items-center gap-2">
                        <span class="w-8 h-8 rounded-full bg-[#003366] text-white flex items-center justify-center text-sm font-sans">2</span>
                        The Client's Problem
                    </h2>
                    <p class="text-gray-700 dark:text-gray-300 leading-relaxed mb-4">
                        Many construction companies have an online presence, but that presence does not generate clients consistently.
                    </p>
                    <p class="text-gray-700 dark:text-gray-300 leading-relaxed mb-4">
                        The most common problems are:
                    </p>
                    <ol class="list-decimal list-inside space-y-3 text-gray-700 dark:text-gray-300 mb-6">
                        <li><strong>Few contact opportunities</strong> — Websites only show information, but are not designed to convert visitors into potential clients.</li>
                        <li><strong>Lost opportunities</strong> — When someone requests a quote, there is often no clear follow-up system and the contact goes cold.</li>
                        <li><strong>Lack of commercial organization</strong> — Contacts arrive by email, WhatsApp, or phone and become difficult to manage.</li>
                        <li><strong>Dependence on referrals</strong> — Many companies rely solely on word of mouth and do not take advantage of the searches that already exist on Google.</li>
                        <li><strong>Lack of follow-up</strong> — If a client does not respond or takes time to decide, there are usually no automatic reminders to contact them again.</li>
                    </ol>
                    <p class="text-gray-700 dark:text-gray-300 leading-relaxed">
                        All of this causes many potential projects to never become real contracts.
                    </p>
                </div>

                <!-- 3. Solution Implemented -->
                <div class="bg-white dark:bg-gray-800 rounded-2xl p-8 md:p-10 shadow-lg border border-gray-100 dark:border-gray-700 mb-12">
                    <h2 class="text-2xl font-serif font-bold text-[#003366] dark:text-white mb-6 flex items-center gap-2">
                        <span class="w-8 h-8 rounded-full bg-[#003366] text-white flex items-center justify-center text-sm font-sans">3</span>
                        Solution Implemented
                    </h2>
                    <p class="text-gray-700 dark:text-gray-300 leading-relaxed mb-6">
                        Blue Draft solves these problems through a system designed specifically for the construction sector.
                    </p>

                    <div class="space-y-6">
                        <div class="border-l-4 border-[#003366] pl-6 py-2">
                            <h3 class="font-semibold text-[#003366] dark:text-white mb-2">1. Constant lead generation</h3>
                            <p class="text-gray-700 dark:text-gray-300 text-sm">The site is designed to attract people searching for renovation services in New York. Each service has its own page optimized to appear in searches like: <em>kitchen renovation NYC</em>, <em>bathroom remodeling Manhattan</em>, <em>construction company New York</em>. This captures people who are already looking to hire these services.</p>
                        </div>

                        <div class="border-l-4 border-[#003366] pl-6 py-2">
                            <h3 class="font-semibold text-[#003366] dark:text-white mb-2">2. Simplified quote request</h3>
                            <p class="text-gray-700 dark:text-gray-300 text-sm">Visitors can request a quote in a few steps. During the process they can indicate: project type, estimated budget, location, and photos of the space. This allows receiving much more qualified contacts.</p>
                        </div>

                        <div class="border-l-4 border-[#003366] pl-6 py-2">
                            <h3 class="font-semibold text-[#003366] dark:text-white mb-2">3. Automatic follow-up system</h3>
                            <p class="text-gray-700 dark:text-gray-300 text-sm">Once someone requests information, the system sends a series of follow-up messages to: thank them for the contact, remind them of the request, and keep the conversation active. This significantly increases the chances that the client will end up contracting.</p>
                        </div>

                        <div class="border-l-4 border-[#003366] pl-6 py-2">
                            <h3 class="font-semibold text-[#003366] dark:text-white mb-2">4. Clear opportunity organization</h3>
                            <p class="text-gray-700 dark:text-gray-300 text-sm">All contacts are saved in an internal panel where the team can see: new prospects, contacted clients, projects in proposal, and projects won or lost. This provides a clear view of the commercial process.</p>
                        </div>

                        <div class="border-l-4 border-[#003366] pl-6 py-2">
                            <h3 class="font-semibold text-[#003366] dark:text-white mb-2">5. Automatic reminders</h3>
                            <p class="text-gray-700 dark:text-gray-300 text-sm">The system alerts the team when: a client has not been contacted, a proposal needs follow-up, or an opportunity has been inactive for too long. This avoids lost opportunities due to lack of follow-up.</p>
                        </div>

                        <div class="border-l-4 border-[#003366] pl-6 py-2">
                            <h3 class="font-semibold text-[#003366] dark:text-white mb-2">6. Trust building</h3>
                            <p class="text-gray-700 dark:text-gray-300 text-sm">The site also includes: completed projects, client testimonials, and clear explanations of the work process. This helps visitors trust the company more quickly.</p>
                        </div>
                    </div>
                </div>

                <!-- 4. Expected Results -->
                <div class="bg-white dark:bg-gray-800 rounded-2xl p-8 md:p-10 shadow-lg border border-gray-100 dark:border-gray-700 mb-12">
                    <h2 class="text-2xl font-serif font-bold text-[#003366] dark:text-white mb-6 flex items-center gap-2">
                        <span class="w-8 h-8 rounded-full bg-[#003366] text-white flex items-center justify-center text-sm font-sans">4</span>
                        Expected Results
                    </h2>
                    <p class="text-gray-700 dark:text-gray-300 leading-relaxed mb-4">
                        With this system, the company can:
                    </p>
                    <ul class="list-disc list-inside space-y-2 text-gray-700 dark:text-gray-300 mb-4">
                        <li>increase the number of quote requests</li>
                        <li>respond to clients more quickly</li>
                        <li>better organize the commercial process</li>
                        <li>improve the conversion of contacts into projects</li>
                        <li>generate opportunities consistently from the internet</li>
                    </ul>
                    <p class="text-gray-700 dark:text-gray-300 leading-relaxed">
                        In other words, the goal is for the web to work as a stable source of new projects.
                    </p>
                </div>

                <!-- 5. Main System Components -->
                <div class="bg-white dark:bg-gray-800 rounded-2xl p-8 md:p-10 shadow-lg border border-gray-100 dark:border-gray-700 mb-12">
                    <h2 class="text-2xl font-serif font-bold text-[#003366] dark:text-white mb-6 flex items-center gap-2">
                        <span class="w-8 h-8 rounded-full bg-[#003366] text-white flex items-center justify-center text-sm font-sans">5</span>
                        Main System Components
                    </h2>
                    <p class="text-gray-700 dark:text-gray-300 leading-relaxed mb-6">
                        The system includes:
                    </p>
                    <div class="space-y-6">
                        <div>
                            <h3 class="font-semibold text-[#003366] dark:text-white mb-2">Commercial website</h3>
                            <ul class="list-disc list-inside space-y-1 text-gray-700 dark:text-gray-300 text-sm">
                                <li>Main page optimized for conversions</li>
                                <li>Specific pages for each service</li>
                                <li>Completed projects with before/after images</li>
                                <li>Client testimonials</li>
                                <li>Blog with useful information for property owners</li>
                            </ul>
                        </div>
                        <div>
                            <h3 class="font-semibold text-[#003366] dark:text-white mb-2">Lead management system</h3>
                            <ul class="list-disc list-inside space-y-1 text-gray-700 dark:text-gray-300 text-sm">
                                <li>Automatic registration of each request</li>
                                <li>Opportunity classification</li>
                                <li>Status tracking for each project</li>
                                <li>Internal control panel</li>
                            </ul>
                        </div>
                        <div>
                            <h3 class="font-semibold text-[#003366] dark:text-white mb-2">Follow-up automation</h3>
                            <ul class="list-disc list-inside space-y-1 text-gray-700 dark:text-gray-300 text-sm">
                                <li>Automatic follow-up messages</li>
                                <li>Reminders for the team</li>
                                <li>System to avoid forgotten opportunities</li>
                            </ul>
                        </div>
                        <div>
                            <h3 class="font-semibold text-[#003366] dark:text-white mb-2">Additional lead capture</h3>
                            <p class="text-gray-700 dark:text-gray-300 text-sm mb-2">In addition to the quote form, the system includes:</p>
                            <ul class="list-disc list-inside space-y-1 text-gray-700 dark:text-gray-300 text-sm">
                                <li>a free guide for property owners planning renovations</li>
                                <li>a cost calculator for approximate project estimates</li>
                            </ul>
                            <p class="text-gray-700 dark:text-gray-300 text-sm mt-2">These tools help convert visitors who are still researching.</p>
                        </div>
                    </div>
                </div>

                <!-- 6. Value for Business -->
                <div class="bg-white dark:bg-gray-800 rounded-2xl p-8 md:p-10 shadow-lg border border-gray-100 dark:border-gray-700 mb-12">
                    <h2 class="text-2xl font-serif font-bold text-[#003366] dark:text-white mb-6 flex items-center gap-2">
                        <span class="w-8 h-8 rounded-full bg-[#003366] text-white flex items-center justify-center text-sm font-sans">6</span>
                        Value for the Business
                    </h2>
                    <p class="text-gray-700 dark:text-gray-300 leading-relaxed mb-4">
                        Blue Draft transforms a traditional website into an active commercial tool.
                    </p>
                    <p class="text-gray-700 dark:text-gray-300 leading-relaxed mb-4">
                        Main benefits:
                    </p>
                    <ul class="list-disc list-inside space-y-2 text-gray-700 dark:text-gray-300 mb-4">
                        <li>more project opportunities</li>
                        <li>better organization of the sales process</li>
                        <li>fewer lost opportunities</li>
                        <li>greater visibility on Google</li>
                        <li>automatic client follow-up</li>
                    </ul>
                    <p class="text-gray-700 dark:text-gray-300 leading-relaxed">
                        This allows the team to focus on executing projects, while the system handles attracting and organizing new opportunities.
                    </p>
                </div>

                <!-- 7. Project Status -->
                <div class="bg-white dark:bg-gray-800 rounded-2xl p-8 md:p-10 shadow-lg border border-gray-100 dark:border-gray-700 mb-12">
                    <h2 class="text-2xl font-serif font-bold text-[#003366] dark:text-white mb-6 flex items-center gap-2">
                        <span class="w-8 h-8 rounded-full bg-[#003366] text-white flex items-center justify-center text-sm font-sans">7</span>
                        Project Status
                    </h2>
                    <p class="text-gray-700 dark:text-gray-300 leading-relaxed mb-4">
                        The system is fully implemented and ready to operate.
                    </p>
                    <p class="text-gray-700 dark:text-gray-300 leading-relaxed mb-4">
                        The next stages focus on:
                    </p>
                    <ul class="list-disc list-inside space-y-2 text-gray-700 dark:text-gray-300">
                        <li>increasing traffic from Google</li>
                        <li>strengthening the site's authority</li>
                        <li>optimizing the conversion of visitors into clients</li>
                    </ul>
                </div>

                <!-- Key Message -->
                <div class="bg-gradient-to-br from-[#003366] to-[#336699] rounded-2xl p-8 md:p-10 text-white mb-12">
                    <h2 class="text-2xl font-serif font-bold mb-6">The Message</h2>
                    <p class="text-white/90 leading-relaxed mb-4">
                        This proposal focuses on what matters to the business:
                    </p>
                    <ul class="space-y-2 text-white/90 mb-4">
                        <li class="flex items-center gap-2"><span class="text-green-300">✓</span> More clients</li>
                        <li class="flex items-center gap-2"><span class="text-green-300">✓</span> More projects</li>
                        <li class="flex items-center gap-2"><span class="text-green-300">✓</span> Fewer lost opportunities</li>
                        <li class="flex items-center gap-2"><span class="text-green-300">✓</span> Organized system</li>
                    </ul>
                    <p class="text-white/80 text-sm">
                        Blue Draft is not just a website — it's a commercial system that works 24/7 to generate and convert opportunities.
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

                    <div class="bg-white dark:bg-gray-800 rounded-2xl p-8 shadow-lg border border-gray-100 dark:border-gray-700">
                        <h3 class="text-xl font-semibold text-[#003366] dark:text-white mb-4">2. Admin Panel Essentials</h3>
                        <ul class="space-y-2 text-gray-700 dark:text-gray-300">
                            <li><strong>Site Settings</strong> — Hero, About, Contact, Footer, Testimonials: customize all content from Filament.</li>
                            <li><strong>Quotes</strong> — Use the pipeline view. Update stages (contacted, qualified, proposal_sent, won/lost).</li>
                            <li><strong>Dashboard</strong> — Monitor funnel metrics and alerts.</li>
                            <li><strong>Services & Projects</strong> — Add case studies, FAQs, and related content.</li>
                            <li><strong>Posts</strong> — Publish strategic articles and link to pillar pages.</li>
                        </ul>
                    </div>

                    <div class="bg-white dark:bg-gray-800 rounded-2xl p-8 shadow-lg border border-gray-100 dark:border-gray-700">
                        <h3 class="text-xl font-semibold text-[#003366] dark:text-white mb-4">3. Activate Traffic & Conversion</h3>
                        <p class="text-gray-700 dark:text-gray-300 mb-4">The system is ready — it needs traffic to perform. Priority actions:</p>
                        <ol class="list-decimal list-inside space-y-2 text-gray-700 dark:text-gray-300">
                            <li><strong>Google Ads</strong> — Launch campaigns for "construction company new york", "home renovation NYC", "general contractor Manhattan".</li>
                            <li><strong>Tracking</strong> — Set GTM_ID, GA4_MEASUREMENT_ID, META_PIXEL_ID in .env.</li>
                            <li><strong>Email</strong> — Configure SMTP and Brevo for the automated sequence.</li>
                        </ol>
                    </div>
                </div>
            </div>
        </section>

        <!-- Footer CTA -->
        <footer class="mt-20 text-center py-12 border-t border-gray-200 dark:border-gray-700">
            <p class="text-gray-500 dark:text-gray-500 text-sm">
                Blue Draft — More clients. More projects. Fewer lost opportunities.
            </p>
            <a href="{{ route('home') }}" class="inline-block mt-4 px-6 py-2 bg-[#003366] text-white rounded-lg hover:bg-[#004080] transition-colors font-medium">
                Back to Site
            </a>
        </footer>
    </main>
</div>
@endsection
