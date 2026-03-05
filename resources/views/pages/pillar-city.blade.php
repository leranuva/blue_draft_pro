@extends('layouts.app')

@section('title', $title)
@section('meta_description', $metaDescription)

@push('meta')
    <link rel="canonical" href="{{ route('pillar.city', $city) }}">
    <meta property="og:title" content="{{ $title }}">
    <meta property="og:description" content="{{ Str::limit($metaDescription, 160) }}">
    <meta property="og:url" content="{{ route('pillar.city', $city) }}">
    <meta property="og:image" content="{{ asset('images/logo-original.png') }}">
    <meta property="og:type" content="website">
@endpush

@push('schema')
<x-schema-breadcrumb :items="[
    ['name' => 'Home', 'url' => route('home')],
    ['name' => "Renovation Contractor {$cityName}", 'url' => route('pillar.city', $city)],
]" />
@if(!empty($faqs) && count($faqs) > 0)
<x-schema-faq :faqs="$faqs" />
@endif
@endpush

@section('content')
    {{-- Hero --}}
    <section class="relative py-32 bg-gradient-to-br from-[#003366] to-[#336699]">
        <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8 text-center pt-20">
            <nav class="text-sm text-white/80 mb-6" aria-label="Breadcrumb">
                <a href="{{ route('home') }}" class="hover:text-white">Home</a>
                <span class="mx-2">/</span>
                <span>Renovation Contractor {{ $cityName }}</span>
            </nav>
            <h1 class="text-4xl md:text-5xl lg:text-6xl font-serif font-bold text-white mb-4">
                {{ $heroTitle }}
            </h1>
            <p class="text-xl text-white/90 mb-8">{{ $heroSubtitle }}</p>
            <div class="flex flex-col sm:flex-row gap-4 justify-center">
                <a href="{{ route('home') }}#quote" class="inline-flex items-center justify-center bg-white text-[#003366] px-8 py-4 rounded-lg hover:bg-[#CCCC99] transition-all font-medium text-lg shadow-lg">
                    {{ $hero['cta_text'] }}
                    <svg class="ml-2 w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 7l5 5m0 0l-5 5m5-5H6"></path></svg>
                </a>
                <a href="{{ $calculatorUrl ?? route('cost-calculator') }}" class="inline-flex items-center justify-center bg-white/20 text-white border-2 border-white px-8 py-4 rounded-lg hover:bg-white/30 transition-all font-medium text-lg">
                    Try Cost Calculator
                </a>
            </div>
        </div>
    </section>

    {{-- SEO Intro Content --}}
    <section class="py-24 bg-white dark:bg-gray-900">
        <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="prose prose-lg dark:prose-invert max-w-none prose-headings:text-[#003366] dark:prose-headings:text-white prose-p:text-gray-600 dark:prose-p:text-gray-300 prose-a:text-[#336699]">
                {!! $content !!}
            </div>
        </div>
    </section>

    {{-- Services in [Borough] --}}
    <section class="py-16 bg-gray-50 dark:bg-gray-800/50">
        <div class="max-w-6xl mx-auto px-4 sm:px-6 lg:px-8">
            <h2 class="text-2xl font-serif font-bold text-[#003366] dark:text-white mb-8 text-center">Services in {{ $cityName }}</h2>
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

    {{-- Typical Renovation Costs --}}
    @if(!empty($typicalCosts))
    <section class="py-16 bg-white dark:bg-gray-900">
        <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8">
            <h2 class="text-2xl font-serif font-bold text-[#003366] dark:text-white mb-6 text-center">Typical Renovation Costs in {{ $cityName }}</h2>
            <div class="overflow-x-auto">
                <table class="w-full border border-gray-200 dark:border-gray-700 rounded-lg overflow-hidden">
                    <thead class="bg-[#003366]/10 dark:bg-[#336699]/20">
                        <tr>
                            <th class="text-left px-4 py-3 text-[#003366] dark:text-white font-medium">Renovation Type</th>
                            <th class="text-right px-4 py-3 text-[#003366] dark:text-white font-medium">Typical Cost</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-gray-200 dark:divide-gray-700">
                        @foreach($typicalCosts as $row)
                        <tr>
                            <td class="px-4 py-3 text-gray-700 dark:text-gray-300">{{ $row['label'] }}</td>
                            <td class="px-4 py-3 text-right font-medium text-[#003366] dark:text-white">${{ number_format($row['min'] / 1000) }}k – ${{ number_format($row['max'] / 1000) }}k</td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
            <p class="mt-6 text-center">
                <a href="{{ $calculatorUrl ?? route('cost-calculator') }}" class="inline-flex items-center text-[#336699] hover:underline font-medium">
                    Use our NYC Renovation Cost Calculator →
                </a>
            </p>
        </div>
    </section>
    @endif

    {{-- Building Regulations --}}
    @if(!empty($buildingRegulations))
    <section class="py-16 bg-gray-50 dark:bg-gray-800/50">
        <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8">
            <h2 class="text-2xl font-serif font-bold text-[#003366] dark:text-white mb-6 text-center">Building Regulations in {{ $cityName }}</h2>
            <p class="text-gray-600 dark:text-gray-300 mb-6">
                Many {{ $cityName }} buildings require renovation permits and approvals before work begins. Our team manages:
            </p>
            <ul class="space-y-2">
                @foreach($buildingRegulations as $item)
                <li class="flex items-start gap-2 text-gray-700 dark:text-gray-300">
                    <span class="text-green-600 dark:text-green-400 mt-0.5">✔</span>
                    <span>{{ $item }}</span>
                </li>
                @endforeach
            </ul>
        </div>
    </section>
    @endif

    {{-- Projects --}}
    @if($projects->isNotEmpty())
    <section class="py-16 bg-white dark:bg-gray-900">
        <div class="max-w-6xl mx-auto px-4 sm:px-6 lg:px-8">
            <h2 class="text-2xl font-serif font-bold text-[#003366] dark:text-white mb-8 text-center">Recent Projects</h2>
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                @foreach($projects->take(6) as $project)
                <a href="{{ route('projects.show', $project->slug) }}" class="block group">
                    @if($project->image_after)
                    <div class="aspect-[4/3] rounded-lg overflow-hidden mb-3">
                        <img src="{{ $project->after_image_url }}" alt="{{ $project->title }}" class="w-full h-full object-cover group-hover:scale-105 transition-transform" loading="lazy">
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

    {{-- Borough Insights --}}
    @if(!empty($boroughInsight))
    <section class="py-16 bg-[#003366]/5 dark:bg-[#336699]/10">
        <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8">
            <h2 class="text-2xl font-serif font-bold text-[#003366] dark:text-white mb-6 text-center">Renovation Trends in {{ $cityName }}</h2>
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6 p-6 bg-white dark:bg-gray-800 rounded-xl border border-[#336699]/20">
                <div>
                    <p class="text-sm text-gray-500 dark:text-gray-400 uppercase tracking-wider mb-1">Average kitchen renovation</p>
                    <p class="text-xl font-bold text-[#003366] dark:text-white">${{ number_format($boroughInsight['avg_kitchen'] / 1000) }}k</p>
                </div>
                <div>
                    <p class="text-sm text-gray-500 dark:text-gray-400 uppercase tracking-wider mb-1">Average project size</p>
                    <p class="text-xl font-bold text-[#003366] dark:text-white">{{ number_format($boroughInsight['avg_sqft']) }} sq ft</p>
                </div>
                <div>
                    <p class="text-sm text-gray-500 dark:text-gray-400 uppercase tracking-wider mb-1">Most popular finish</p>
                    <p class="text-xl font-bold text-[#003366] dark:text-white">{{ ucfirst($boroughInsight['popular_finish'] ?? 'Standard') }}</p>
                </div>
                <div>
                    <p class="text-sm text-gray-500 dark:text-gray-400 uppercase tracking-wider mb-1">Typical timeline</p>
                    <p class="text-xl font-bold text-[#003366] dark:text-white">{{ $boroughInsight['avg_timeline'] ?? '6 weeks' }}</p>
                </div>
            </div>
        </div>
    </section>
    @endif

    {{-- FAQs --}}
    @if(!empty($faqs) && count($faqs) > 0)
    <section class="py-16 bg-white dark:bg-gray-900">
        <div class="max-w-3xl mx-auto px-4 sm:px-6 lg:px-8">
            <h2 class="text-2xl font-serif font-bold text-[#003366] dark:text-white mb-8 text-center">Frequently Asked Questions</h2>
            <div class="space-y-6">
                @foreach($faqs as $faq)
                <div class="border-b border-gray-200 dark:border-gray-700 pb-6 last:border-0">
                    <h3 class="font-semibold text-[#003366] dark:text-white mb-2">{{ $faq['question'] ?? '' }}</h3>
                    <p class="text-gray-600 dark:text-gray-300">{{ $faq['answer'] ?? '' }}</p>
                </div>
                @endforeach
            </div>
        </div>
    </section>
    @endif

    {{-- CTA Final --}}
    <section class="py-24 bg-[#003366] dark:bg-[#1e3a5f]">
        <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8 text-center">
            <h2 class="text-3xl font-serif font-bold text-white mb-4">Get a Free {{ $cityName }} Renovation Quote</h2>
            <p class="text-white/90 mb-8">Free estimates. We respond within 24 hours.</p>
            <div class="flex flex-col sm:flex-row gap-4 justify-center">
                <a href="{{ route('home') }}#quote" class="inline-flex items-center justify-center bg-white text-[#003366] px-8 py-4 rounded-lg hover:bg-[#CCCC99] transition-all font-medium text-lg">
                    {{ $hero['cta_text'] }}
                </a>
                <a href="{{ $calculatorUrl ?? route('cost-calculator') }}" class="inline-flex items-center justify-center bg-white/20 text-white border-2 border-white px-8 py-4 rounded-lg hover:bg-white/30 transition-all font-medium text-lg">
                    Calculate Your Renovation Cost
                </a>
            </div>
        </div>
    </section>
@endsection
