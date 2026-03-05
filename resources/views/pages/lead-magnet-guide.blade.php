@extends('layouts.app')

@section('title', 'Your NYC Renovation Guide | Blue Draft')
@section('meta_description', 'What homeowners should know before starting a renovation in NYC: budget planning, building rules, permits, contractor selection, timelines, and material choices.')

@push('meta')
    <link rel="canonical" href="{{ route('lead-magnet.guide') }}">
@endpush

@section('content')
<section class="py-16 bg-white dark:bg-gray-900">
    <div class="max-w-3xl mx-auto px-4 sm:px-6 lg:px-8">
        @if(session('success'))
        <div class="mb-8 p-4 bg-green-50 dark:bg-green-900/20 border border-green-200 dark:border-green-800 rounded-lg text-green-800 dark:text-green-200">
            {{ session('success') }}
        </div>
        @endif

        <h1 class="text-3xl md:text-4xl font-serif font-bold text-[#003366] dark:text-white mb-2">
            Your NYC Renovation Guide
        </h1>
        <p class="text-lg text-gray-600 dark:text-gray-400 mb-8">What homeowners should know before starting a renovation in New York City.</p>

        <div class="prose prose-lg dark:prose-invert max-w-none prose-headings:text-[#003366] dark:prose-headings:text-white prose-p:text-gray-600 dark:prose-p:text-gray-300 prose-a:text-[#336699] prose-ul:text-gray-600 dark:prose-ul:text-gray-300">
            <h2>1. Plan Your Budget Early</h2>
            <p>Renovation costs in NYC vary significantly depending on the scope, building type, and finish level.</p>
            <p><strong>Typical ranges include:</strong></p>
            <ul>
                <li>Kitchen Remodel: $25,000 – $90,000+</li>
                <li>Bathroom Renovation: $15,000 – $45,000+</li>
                <li>Full Apartment Renovation: $80 – $200 per sq ft</li>
            </ul>
            <p><strong>Factors that influence cost:</strong></p>
            <ul>
                <li>Building logistics and restrictions</li>
                <li>Permit requirements</li>
                <li>Material quality</li>
                <li>Structural changes</li>
            </ul>
            <p>Before committing to a contractor, it's recommended to get 2–3 detailed quotes and understand what is included in the scope of work.</p>

            <h2>2. Understand Your Building's Rules</h2>
            <p>Many NYC apartments operate under co-op or condo boards, which have strict renovation policies.</p>
            <p><strong>Most buildings require:</strong></p>
            <ul>
                <li>An Alteration Agreement</li>
                <li>Board approval before work begins</li>
                <li>Proof of contractor insurance</li>
                <li>Security deposits for construction</li>
            </ul>
            <p>Failing to follow these rules can delay or even stop your project before it begins.</p>
            <p>An experienced NYC contractor should be familiar with these requirements and help guide you through the approval process.</p>

            <h2>3. Permits and Compliance</h2>
            <p>In many renovations, permits from the NYC Department of Buildings are required.</p>
            <p><strong>Common work that requires permits:</strong></p>
            <ul>
                <li>Electrical upgrades</li>
                <li>Plumbing modifications</li>
                <li>Structural changes</li>
                <li>Wall removal</li>
            </ul>
            <p>Working without permits can lead to fines and complications when selling your property later.</p>
            <p>A licensed contractor should manage the permitting process and ensure all work meets NYC code requirements.</p>

            <h2>4. Choosing the Right Contractor</h2>
            <p>Selecting the right contractor is one of the most important decisions in your renovation.</p>
            <p><strong>Before hiring, verify:</strong></p>
            <ul>
                <li>Licensing and insurance</li>
                <li>Experience with NYC buildings</li>
                <li>Previous project examples</li>
                <li>Client references and reviews</li>
            </ul>
            <p>Contractors familiar with NYC construction logistics can prevent delays related to permits, inspections, and building management requirements.</p>

            <h2>5. Timeline Expectations</h2>
            <p>Renovations in NYC often take longer than expected due to building logistics.</p>
            <p><strong>Common factors that affect timelines include:</strong></p>
            <ul>
                <li>Elevator reservations for materials</li>
                <li>Limited construction hours in residential buildings</li>
                <li>Permit approvals and inspections</li>
                <li>Delivery delays</li>
            </ul>
            <p>For this reason, it's always wise to add a buffer of 15–25% to your expected project timeline.</p>

            <h2>6. Smart Material Selection</h2>
            <p>Material choices affect both cost and durability.</p>
            <p><strong>In NYC homes, it's often recommended to prioritize:</strong></p>
            <ul>
                <li>Durable countertops and flooring</li>
                <li>Moisture-resistant materials in bathrooms</li>
                <li>Easy-to-maintain finishes</li>
            </ul>
            <p>Ordering materials early can also prevent delays caused by supply chain issues.</p>

            <h2>Before You Start Your Renovation</h2>
            <p>Planning ahead can save time, money, and stress during your project.</p>
            <p>If you are considering a renovation in NYC, getting an early estimate can help you better understand the potential scope and budget.</p>
            <p>You can also use our <a href="{{ route('cost-calculator') }}">Renovation Cost Calculator</a> to estimate typical project ranges based on your project size and location.</p>
        </div>

        <div class="mt-12 p-6 bg-[#003366]/5 dark:bg-[#336699]/10 rounded-xl border border-[#336699]/20">
            <h3 class="text-xl font-serif font-bold text-[#003366] dark:text-white mb-4">Ready for a Custom Quote?</h3>
            <p class="text-gray-600 dark:text-gray-300 mb-4">Get a free, no-obligation estimate for your NYC renovation project.</p>
            <a href="{{ route('home') }}#quote" class="inline-flex items-center bg-[#003366] dark:bg-[#336699] text-white px-6 py-3 rounded-lg hover:bg-[#004080] dark:hover:bg-[#4a90e2] transition-all font-medium">
                {{ $hero['cta_text'] ?? 'Get Free Quote' }}
                <svg class="ml-2 w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 7l5 5m0 0l-5 5m5-5H6"></path></svg>
            </a>
        </div>
    </div>
</section>
@endsection
