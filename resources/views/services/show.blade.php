@extends('layouts.app')

@section('title', $service->seo_title ?: $service->title . ' | Blue Draft')
@section('meta_description', $service->seo_description)

@push('tracking_data')
<script>window.__trackingData = { service_slug: '{{ $service->slug }}', service_title: '{{ addslashes($service->title) }}' };</script>
@endpush

@push('meta')
    <link rel="canonical" href="{{ route('services.show', $service->slug) }}">
    <meta property="og:title" content="{{ $service->seo_title ?: $service->title . ' | Blue Draft' }}">
    <meta property="og:description" content="{{ Str::limit($service->seo_description ?? $service->hero_subtitle ?? $service->title, 160) }}">
    <meta property="og:url" content="{{ route('services.show', $service->slug) }}">
    <meta property="og:image" content="{{ asset('images/logo-original.png') }}">
    <meta property="og:type" content="website">
@endpush

@push('schema')
<x-schema-breadcrumb :items="[
    ['name' => 'Home', 'url' => route('home')],
    ['name' => 'Services', 'url' => route('home') . '#services'],
    ['name' => $service->title, 'url' => route('services.show', $service->slug)],
]" />
<x-schema-service :service="$service" />
@if(!empty($service->faq_json) && count($service->faq_json) > 0)
<x-schema-faq :faqs="$service->faq_json" />
@endif
@endpush

@section('content')
    <!-- Hero -->
    <section class="relative py-32 bg-gradient-to-br from-[#003366] to-[#336699] dark:from-[#003366] dark:to-[#1e3a5f]">
        <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8 text-center pt-20">
            <h1 class="text-4xl md:text-5xl lg:text-6xl font-serif font-bold text-white mb-4">
                {{ $service->hero_title ?: $service->title }}
            </h1>
            @if($service->hero_subtitle)
            <p class="text-xl text-white/90 mb-8">{{ $service->hero_subtitle }}</p>
            @endif
            <a href="{{ route('home') }}#quote" class="inline-flex items-center bg-white text-[#003366] px-8 py-4 rounded-lg hover:bg-[#CCCC99] transition-all font-medium text-lg shadow-lg">
                {{ $hero['cta_text'] }}
                <svg class="ml-2 w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 7l5 5m0 0l-5 5m5-5H6"></path></svg>
            </a>
        </div>
    </section>

    <!-- Content -->
    <section class="py-24 bg-white dark:bg-gray-900">
        <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8">
            @if($service->content)
            <div class="prose prose-lg dark:prose-invert max-w-none prose-headings:text-[#003366] dark:prose-headings:text-white prose-p:text-gray-600 dark:prose-p:text-gray-300">
                {!! nl2br(e($service->content)) !!}
            </div>
            @else
            <p class="text-xl text-gray-600 dark:text-gray-300">Content coming soon. <a href="{{ route('home') }}#quote" class="text-[#336699] hover:underline">Get a free quote</a>.</p>
            @endif
        </div>
    </section>

    <!-- FAQs -->
    @if(!empty($service->faq_json) && count($service->faq_json) > 0)
    <section class="py-24 bg-gray-50 dark:bg-gray-800/50">
        <div class="max-w-3xl mx-auto px-4 sm:px-6 lg:px-8">
            <h2 class="text-3xl font-serif font-bold text-[#003366] dark:text-white mb-12 text-center">Frequently Asked Questions</h2>
            <div class="space-y-6" x-data="{ open: null }">
                @foreach($service->faq_json as $index => $faq)
                <div class="bg-white dark:bg-gray-800 rounded-xl p-6 shadow-sm">
                    <button @@click="open = open === {{ $index }} ? null : {{ $index }}" class="w-full text-left flex justify-between items-center">
                        <span class="font-semibold text-[#003366] dark:text-white">{{ $faq['question'] ?? '' }}</span>
                        <svg class="w-5 h-5 text-[#336699] transition-transform" :class="open === {{ $index }} ? 'rotate-180' : ''" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path>
                        </svg>
                    </button>
                    <div x-show="open === {{ $index }}" x-transition class="mt-4 text-gray-600 dark:text-gray-300">
                        {!! nl2br(e($faq['answer'] ?? '')) !!}
                    </div>
                </div>
                @endforeach
            </div>
        </div>
    </section>
    @endif

    <!-- Internal Linking: Related Services, Projects, Pillar -->
    @if($relatedServices->isNotEmpty() || $relatedProjects->isNotEmpty())
    <section class="py-16 bg-gray-50 dark:bg-gray-800/50">
        <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8">
            <h2 class="text-2xl font-serif font-bold text-[#003366] dark:text-white mb-8 text-center">Explore More</h2>
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                @if($relatedServices->isNotEmpty())
                <div class="space-y-3">
                    <h3 class="font-semibold text-[#003366] dark:text-white">Related Services</h3>
                    <ul class="space-y-2">
                        @foreach($relatedServices as $rs)
                        <li><a href="{{ route('services.show', $rs->slug) }}" class="text-[#336699] hover:underline">{{ $rs->title }}</a></li>
                        @endforeach
                    </ul>
                </div>
                @endif
                @if($relatedProjects->isNotEmpty())
                <div class="space-y-3">
                    <h3 class="font-semibold text-[#003366] dark:text-white">Related Projects</h3>
                    <ul class="space-y-2">
                        @foreach($relatedProjects as $rp)
                        <li><a href="{{ route('projects.show', $rp->slug ?? $rp->id) }}" class="text-[#336699] hover:underline">{{ $rp->title }}</a></li>
                        @endforeach
                    </ul>
                </div>
                @endif
            </div>
            <div class="mt-8 text-center">
                <a href="{{ route('pillar.nyc') }}" class="inline-flex items-center text-[#336699] font-medium hover:underline">
                    Construction Company New York →
                </a>
            </div>
        </div>
    </section>
    @else
    <section class="py-12 bg-gray-50 dark:bg-gray-800/50">
        <div class="max-w-4xl mx-auto px-4 text-center">
            <a href="{{ route('pillar.nyc') }}" class="text-[#336699] font-medium hover:underline">Construction Company New York →</a>
        </div>
    </section>
    @endif

    <!-- Related Projects -->
    @if($projects->isNotEmpty())
    <section class="py-24 bg-white dark:bg-gray-900">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <h2 class="text-3xl font-serif font-bold text-[#003366] dark:text-white mb-12 text-center">Related Projects</h2>
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
                @foreach($projects as $project)
                <a href="{{ route('projects.show', $project->slug ?? $project->id) }}" class="group block bg-white dark:bg-gray-800 rounded-xl overflow-hidden shadow-lg hover:shadow-2xl transition-all">
                    @if($project->image_after)
                    <div class="aspect-[4/3] overflow-hidden">
                        <img src="{{ Storage::disk('public')->url($project->image_after) }}" alt="{{ $project->title }}" class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-300" loading="lazy">
                    </div>
                    @endif
                    <div class="p-6">
                        <span class="text-xs font-medium text-[#336699] uppercase tracking-wider">{{ $project->category }}</span>
                        <h3 class="text-xl font-serif font-bold text-[#003366] dark:text-white mt-2 group-hover:text-[#336699]">{{ $project->title }}</h3>
                        @if($project->description)
                        <p class="text-gray-600 dark:text-gray-300 mt-2 line-clamp-2">{{ Str::limit($project->description, 100) }}</p>
                        @endif
                    </div>
                </a>
                @endforeach
            </div>
            <div class="text-center mt-12">
                <a href="{{ route('home') }}#projects" class="text-[#336699] dark:text-[#4a90e2] font-medium hover:underline">View all projects →</a>
            </div>
        </div>
    </section>
    @endif

    <!-- CTA -->
    <section class="py-24 bg-[#003366] dark:bg-[#1e3a5f]">
        <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8 text-center">
            <h2 class="text-3xl font-serif font-bold text-white mb-4">Ready to Get Started?</h2>
            <p class="text-white/90 mb-8">Get your free estimate today. We usually respond within 24 hours.</p>
            <div class="flex flex-col sm:flex-row gap-4 justify-center">
                <a href="{{ route('home') }}#quote" class="inline-flex items-center justify-center bg-white text-[#003366] px-8 py-4 rounded-lg hover:bg-[#CCCC99] transition-all font-medium text-lg">
                    {{ $hero['cta_text'] }}
                </a>
                <a href="tel:{{ $contact['phone_link'] }}" class="inline-flex items-center justify-center border-2 border-white text-white px-8 py-4 rounded-lg hover:bg-white/10 transition-all font-medium text-lg">
                    Call {{ $contact['phone'] }}
                </a>
            </div>
        </div>
    </section>
@endsection
