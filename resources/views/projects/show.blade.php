@extends('layouts.app')

@section('title', $project->title . ' | Blue Draft')
@section('meta_description', Str::limit($project->description ?? $project->title . ' - Construction project by Blue Draft', 160))

@push('meta')
    <link rel="canonical" href="{{ route('projects.show', $project->slug) }}">
    <meta property="og:title" content="{{ $project->title . ' | Blue Draft' }}">
    <meta property="og:description" content="{{ Str::limit($project->description ?? $project->title, 160) }}">
    <meta property="og:url" content="{{ route('projects.show', $project->slug) }}">
    <meta property="og:image" content="{{ $project->image_after ? url(Storage::disk('public')->url($project->image_after)) : asset('images/logo-original.png') }}">
    <meta property="og:type" content="website">
@endpush

@push('schema')
<x-schema-breadcrumb :items="[
    ['name' => 'Home', 'url' => route('home')],
    ['name' => 'Projects', 'url' => route('home') . '#projects'],
    ['name' => $project->title, 'url' => route('projects.show', $project->slug)],
]" />
@endpush

@section('content')
    <!-- Hero with Before/After -->
    <section class="pt-24 pb-16 bg-white dark:bg-gray-900">
        <div class="max-w-6xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="mb-8">
                <a href="{{ route('home') }}#projects" class="text-[#336699] dark:text-[#4a90e2] text-sm font-medium hover:underline">← Back to Projects</a>
            </div>
            <h1 class="text-4xl md:text-5xl font-serif font-bold text-[#003366] dark:text-white mb-4">{{ $project->title }}</h1>
            <span class="inline-block px-4 py-1 bg-[#003366]/10 dark:bg-[#336699]/20 rounded-full text-sm font-medium text-[#003366] dark:text-[#4a90e2] capitalize">{{ $project->category }}</span>

            @if($project->image_before && $project->image_after)
            <div class="mt-12 relative aspect-[16/10] rounded-2xl overflow-hidden shadow-2xl" x-data="{ sliderPosition: 50 }">
                <div class="absolute inset-0">
                    <img src="{{ Storage::disk('public')->url($project->image_after) }}" alt="{{ $project->title }} - After" class="absolute inset-0 w-full h-full object-cover" loading="lazy">
                    <img src="{{ Storage::disk('public')->url($project->image_before) }}" alt="{{ $project->title }} - Before" 
                         class="absolute inset-0 w-full h-full object-cover" 
                         :style="`clip-path: inset(0 ${100 - sliderPosition}% 0 0);`" loading="lazy">
                </div>
                <div class="absolute inset-0 cursor-ew-resize" 
                     @@mousemove="if ($event.buttons === 1) { sliderPosition = Math.max(0, Math.min(100, ($event.offsetX / $event.currentTarget.offsetWidth) * 100)) }"
                     @@touchmove.prevent="sliderPosition = Math.max(0, Math.min(100, ($event.touches[0].clientX - $event.currentTarget.getBoundingClientRect().left) / $event.currentTarget.offsetWidth * 100))">
                    <div class="absolute top-0 bottom-0 w-1 bg-white shadow-lg" :style="`left: ${sliderPosition}%`">
                        <div class="absolute top-1/2 left-1/2 -translate-x-1/2 -translate-y-1/2 w-12 h-12 bg-white rounded-full shadow-lg flex items-center justify-center">
                            <svg class="w-6 h-6 text-[#003366]" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 9l4-4 4 4m0 6l-4 4-4-4"></path>
                            </svg>
                        </div>
                    </div>
                </div>
                <div class="absolute top-4 left-4 flex gap-2">
                    <span class="bg-white/90 px-3 py-1 rounded text-xs font-medium text-[#003366]">Before</span>
                    <span class="bg-white/90 px-3 py-1 rounded text-xs font-medium text-[#003366]">After</span>
                </div>
            </div>
            @elseif($project->image_after)
            <div class="mt-12 rounded-2xl overflow-hidden shadow-2xl">
                <img src="{{ Storage::disk('public')->url($project->image_after) }}" alt="{{ $project->title }}" class="w-full aspect-video object-cover" loading="lazy">
            </div>
            @endif
        </div>
    </section>

    <!-- Description -->
    @if($project->description)
    <section class="py-16 bg-gray-50 dark:bg-gray-800/50">
        <div class="max-w-3xl mx-auto px-4 sm:px-6 lg:px-8">
            <h2 class="text-2xl font-serif font-bold text-[#003366] dark:text-white mb-6">Project Overview</h2>
            <p class="text-lg text-gray-600 dark:text-gray-300 leading-relaxed">{{ $project->description }}</p>
        </div>
    </section>
    @endif

    <!-- Internal Linking: Related Services, Pillar -->
    @if($relatedServices->isNotEmpty())
    <section class="py-16 bg-gray-50 dark:bg-gray-800/50">
        <div class="max-w-3xl mx-auto px-4 sm:px-6 lg:px-8">
            <h2 class="text-2xl font-serif font-bold text-[#003366] dark:text-white mb-6 text-center">Explore Our Services</h2>
            <ul class="flex flex-wrap justify-center gap-4">
                @foreach($relatedServices as $rs)
                <li><a href="{{ route('services.show', $rs->slug) }}" class="text-[#336699] hover:underline font-medium">{{ $rs->title }}</a></li>
                @endforeach
                <li><a href="{{ route('pillar.nyc') }}" class="text-[#336699] hover:underline font-medium">Construction Company New York</a></li>
            </ul>
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
    @if($related->isNotEmpty())
    <section class="py-24 bg-white dark:bg-gray-900">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <h2 class="text-3xl font-serif font-bold text-[#003366] dark:text-white mb-12 text-center">More {{ ucfirst($project->category) }} Projects</h2>
            <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
                @foreach($related as $p)
                <a href="{{ route('projects.show', $p->slug ?? $p->id) }}" class="group block rounded-xl overflow-hidden shadow-lg hover:shadow-2xl transition-all">
                    @if($p->image_after)
                    <div class="aspect-[4/3] overflow-hidden">
                        <img src="{{ Storage::disk('public')->url($p->image_after) }}" alt="{{ $p->title }}" class="w-full h-full object-cover group-hover:scale-105 transition-transform" loading="lazy">
                    </div>
                    @endif
                    <div class="p-6 bg-white dark:bg-gray-800">
                        <h3 class="font-serif font-bold text-[#003366] dark:text-white group-hover:text-[#336699]">{{ $p->title }}</h3>
                    </div>
                </a>
                @endforeach
            </div>
        </div>
    </section>
    @endif

    <!-- CTA -->
    <section class="py-24 bg-[#003366] dark:bg-[#1e3a5f]">
        <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8 text-center">
            <h2 class="text-3xl font-serif font-bold text-white mb-4">Like What You See?</h2>
            <p class="text-white/90 mb-8">Get a free estimate for your project.</p>
            <a href="{{ route('home') }}#quote" class="inline-flex items-center justify-center bg-white text-[#003366] px-8 py-4 rounded-lg hover:bg-[#CCCC99] transition-all font-medium text-lg">
                {{ $hero['cta_text'] }}
            </a>
        </div>
    </section>
@endsection
