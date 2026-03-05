@extends('layouts.app')

@section('title', $pillar['pillar_nyc_title'] ?? 'Construction Company New York | Blue Draft')
@section('meta_description', $pillar['pillar_nyc_meta_description'] ?? 'Premier construction company in NYC. Kitchen remodeling, bathroom renovation, commercial construction. Manhattan, Brooklyn, Queens.')

@push('meta')
    <link rel="canonical" href="{{ route('pillar.nyc') }}">
    <meta property="og:title" content="{{ $pillar['pillar_nyc_title'] ?? 'Construction Company New York | Blue Draft' }}">
    <meta property="og:description" content="{{ Str::limit($pillar['pillar_nyc_meta_description'] ?? 'Premier construction in NYC.', 160) }}">
    <meta property="og:url" content="{{ route('pillar.nyc') }}">
    <meta property="og:image" content="{{ asset('images/logo-original.png') }}">
    <meta property="og:type" content="website">
@endpush

@push('schema')
<x-schema-breadcrumb :items="[
    ['name' => 'Home', 'url' => route('home')],
    ['name' => 'Construction Company New York', 'url' => route('pillar.nyc')],
]" />
@endpush

@section('content')
    <!-- Hero -->
    <section class="relative py-32 bg-gradient-to-br from-[#003366] to-[#336699]">
        <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8 text-center pt-20">
            <nav class="text-sm text-white/80 mb-6" aria-label="Breadcrumb">
                <a href="{{ route('home') }}" class="hover:text-white">Home</a>
                <span class="mx-2">/</span>
                <span>Construction Company New York</span>
            </nav>
            <h1 class="text-4xl md:text-5xl lg:text-6xl font-serif font-bold text-white mb-4">
                {{ $pillar['pillar_nyc_hero_title'] ?? 'Construction Company New York' }}
            </h1>
            <p class="text-xl text-white/90 mb-8">{{ $pillar['pillar_nyc_hero_subtitle'] ?? 'Premium Construction Across Manhattan, Brooklyn, Queens & All Five Boroughs' }}</p>
            <a href="{{ route('home') }}#quote" class="inline-flex items-center bg-white text-[#003366] px-8 py-4 rounded-lg hover:bg-[#CCCC99] transition-all font-medium text-lg shadow-lg">
                {{ $hero['cta_text'] }}
                <svg class="ml-2 w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 7l5 5m0 0l-5 5m5-5H6"></path></svg>
            </a>
        </div>
    </section>

    <!-- Main Content -->
    <section class="py-24 bg-white dark:bg-gray-900">
        <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="prose prose-lg dark:prose-invert max-w-none prose-headings:text-[#003366] dark:prose-headings:text-white prose-p:text-gray-600 dark:prose-p:text-gray-300 prose-a:text-[#336699]">
                {!! $pillar['pillar_nyc_content'] ?? '<p>Content coming soon.</p>' !!}
            </div>
        </div>
    </section>

    <!-- Internal Links: Services -->
    <section class="py-16 bg-gray-50 dark:bg-gray-800/50">
        <div class="max-w-6xl mx-auto px-4 sm:px-6 lg:px-8">
            <h2 class="text-2xl font-serif font-bold text-[#003366] dark:text-white mb-8 text-center">Our NYC Construction Services</h2>
            <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                @foreach($services as $service)
                <a href="{{ route('services.show', $service->slug) }}" class="block p-6 bg-white dark:bg-gray-800 rounded-xl shadow hover:shadow-lg transition-all border border-gray-100 dark:border-gray-700">
                    <h3 class="font-serif font-bold text-[#003366] dark:text-white mb-2">{{ $service->title }}</h3>
                    <p class="text-sm text-gray-600 dark:text-gray-300">{{ $service->hero_subtitle }}</p>
                    <span class="text-[#336699] text-sm font-medium mt-2 inline-block">Learn more →</span>
                </a>
                @endforeach
            </div>
        </div>
    </section>

    <!-- Internal Links: Projects -->
    @if($projects->isNotEmpty())
    <section class="py-16 bg-white dark:bg-gray-900">
        <div class="max-w-6xl mx-auto px-4 sm:px-6 lg:px-8">
            <h2 class="text-2xl font-serif font-bold text-[#003366] dark:text-white mb-8 text-center">Recent NYC Projects</h2>
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                @foreach($projects->take(6) as $project)
                <a href="{{ route('projects.show', $project->slug) }}" class="block group">
                    @if($project->image_after)
                    <div class="aspect-[4/3] rounded-lg overflow-hidden mb-3">
                        <img src="{{ Storage::disk('public')->url($project->image_after) }}" alt="{{ $project->title }}" class="w-full h-full object-cover group-hover:scale-105 transition-transform" loading="lazy">
                    </div>
                    @endif
                    <h3 class="font-serif font-bold text-[#003366] dark:text-white group-hover:text-[#336699]">{{ $project->title }}</h3>
                    <span class="text-xs text-[#336699] capitalize">{{ $project->category }}</span>
                </a>
                @endforeach
            </div>
        </div>
    </section>
    @endif

    <!-- CTA -->
    <section class="py-24 bg-[#003366] dark:bg-[#1e3a5f]">
        <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8 text-center">
            <h2 class="text-3xl font-serif font-bold text-white mb-4">Ready to Start Your NYC Project?</h2>
            <p class="text-white/90 mb-8">Free estimates. We respond within 24 hours.</p>
            <a href="{{ route('home') }}#quote" class="inline-flex items-center bg-white text-[#003366] px-8 py-4 rounded-lg hover:bg-[#CCCC99] transition-all font-medium text-lg">
                {{ $hero['cta_text'] }}
            </a>
        </div>
    </section>
@endsection
