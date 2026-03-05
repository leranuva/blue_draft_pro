@extends('layouts.app')

@section('title', 'Our Services | Blue Draft')
@section('meta_description', 'Construction services: kitchen remodel, bathroom renovation, commercial construction. Free estimates.')

@section('content')
    <section class="pt-32 pb-24 bg-gradient-to-br from-[#003366] to-[#336699]">
        <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8 text-center">
            <h1 class="text-4xl md:text-5xl font-serif font-bold text-white mb-4">Our Services</h1>
            <p class="text-xl text-white/90">Expert construction and renovation services for your home or business.</p>
        </div>
    </section>

    <section class="py-24 bg-white dark:bg-gray-900">
        <div class="max-w-6xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
                @foreach($services as $service)
                <a href="{{ route('services.show', $service->slug) }}" class="group block bg-white dark:bg-gray-800 rounded-xl overflow-hidden shadow-lg hover:shadow-2xl transition-all border border-gray-100 dark:border-gray-700">
                    <div class="p-8">
                        <h2 class="text-2xl font-serif font-bold text-[#003366] dark:text-white mb-2 group-hover:text-[#336699]">{{ $service->title }}</h2>
                        @if($service->hero_subtitle)
                        <p class="text-gray-600 dark:text-gray-300">{{ $service->hero_subtitle }}</p>
                        @endif
                        <span class="inline-flex items-center mt-4 text-[#336699] font-medium group-hover:underline">
                            Learn more →
                        </span>
                    </div>
                </a>
                @endforeach
            </div>
        </div>
    </section>
@endsection
