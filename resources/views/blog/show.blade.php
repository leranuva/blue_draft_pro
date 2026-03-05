@extends('layouts.app')

@section('title', ($post->meta_title ?: $post->title) . ' | Blue Draft')
@section('meta_description', $post->meta_description ?: Str::limit($post->excerpt ?? $post->content, 160))

@push('meta')
    <link rel="canonical" href="{{ route('blog.show', $post->slug) }}">
    <meta property="og:title" content="{{ $post->meta_title ?: $post->title . ' | Blue Draft' }}">
    <meta property="og:description" content="{{ Str::limit($post->meta_description ?? $post->excerpt ?? strip_tags($post->content), 160) }}">
    <meta property="og:url" content="{{ route('blog.show', $post->slug) }}">
    <meta property="og:image" content="{{ $post->featured_image_url ?? asset('images/logo-original.png') }}">
    <meta property="og:type" content="article">
    <meta property="article:published_time" content="{{ $post->published_at?->toIso8601String() ?? $post->created_at->toIso8601String() }}">
@endpush

@push('schema')
<x-schema-breadcrumb :items="[
    ['name' => 'Home', 'url' => route('home')],
    ['name' => 'Blog', 'url' => route('blog.index')],
    ['name' => $post->title, 'url' => route('blog.show', $post->slug)],
]" />
@endpush

@section('content')
    <!-- Hero -->
    <section class="relative py-24 bg-gradient-to-br from-[#003366] to-[#336699]">
        <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8 pt-20">
            <nav class="text-sm text-white/80 mb-6" aria-label="Breadcrumb">
                <a href="{{ route('home') }}" class="hover:text-white">Home</a>
                <span class="mx-2">/</span>
                <a href="{{ route('blog.index') }}" class="hover:text-white">Blog</a>
                <span class="mx-2">/</span>
                <span>{{ $post->title }}</span>
            </nav>
            <time class="text-white/80 text-sm">{{ $post->published_at?->format('F j, Y') ?? $post->created_at->format('F j, Y') }}</time>
            <h1 class="text-4xl md:text-5xl font-serif font-bold text-white mt-2 mb-6">{{ $post->title }}</h1>
            @if($post->excerpt)
            <p class="text-xl text-white/90">{{ $post->excerpt }}</p>
            @endif
        </div>
    </section>

    <!-- Content -->
    <section class="py-24 bg-white dark:bg-gray-900">
        <div class="max-w-3xl mx-auto px-4 sm:px-6 lg:px-8">
            @if($post->featured_image)
            <div class="mb-12 rounded-xl overflow-hidden">
                <img src="{{ $post->featured_image_url }}" alt="{{ $post->title }}" class="w-full h-auto" loading="eager">
            </div>
            @endif
            <div class="prose prose-lg dark:prose-invert max-w-none
                prose-headings:font-serif prose-headings:text-[#003366] dark:prose-headings:text-white prose-headings:font-bold
                prose-h2:text-2xl prose-h2:mt-10 prose-h2:mb-4 prose-h2:pb-2 prose-h2:border-b prose-h2:border-[#336699]/20
                prose-h3:text-xl prose-h3:mt-8 prose-h3:mb-3
                prose-h4:text-lg prose-h4:mt-6 prose-h4:mb-2
                prose-p:text-gray-600 dark:prose-p:text-gray-300 prose-p:leading-relaxed prose-p:mb-4
                prose-a:text-[#336699] dark:prose-a:text-[#4a90e2] prose-a:no-underline hover:prose-a:underline prose-a:font-medium
                prose-blockquote:border-l-[#336699] prose-blockquote:bg-[#003366]/5 dark:prose-blockquote:bg-[#336699]/10 prose-blockquote:py-2 prose-blockquote:px-4 prose-blockquote:italic prose-blockquote:text-gray-700 dark:prose-blockquote:text-gray-300
                prose-ul:my-4 prose-ol:my-4 prose-li:my-1
                prose-img:rounded-lg prose-img:shadow-md prose-img:w-full
                prose-strong:text-[#003366] dark:prose-strong:text-white">
                {!! $post->rendered_content !!}
            </div>
        </div>
    </section>

    <!-- CTA -->
    <section class="py-16 bg-gray-50 dark:bg-gray-800/50">
        <div class="max-w-3xl mx-auto px-4 sm:px-6 lg:px-8 text-center">
            <h2 class="text-2xl font-serif font-bold text-[#003366] dark:text-white mb-4">Ready to Start Your Project?</h2>
            <a href="{{ route('home') }}#quote" class="inline-flex items-center bg-[#003366] text-white px-8 py-4 rounded-lg hover:bg-[#336699] transition-all font-medium">
                {{ $hero['cta_text'] }}
            </a>
        </div>
    </section>

    <!-- Related Posts -->
    @if($relatedPosts->isNotEmpty())
    <section class="py-24 bg-white dark:bg-gray-900">
        <div class="max-w-6xl mx-auto px-4 sm:px-6 lg:px-8">
            <h2 class="text-2xl font-serif font-bold text-[#003366] dark:text-white mb-8">Related Articles</h2>
            <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                @foreach($relatedPosts as $related)
                <a href="{{ route('blog.show', $related->slug) }}" class="block group">
                    @if($related->featured_image)
                    <div class="aspect-[16/9] rounded-lg overflow-hidden mb-3">
                        <img src="{{ $related->featured_image_url }}" alt="{{ $related->title }}" class="w-full h-full object-cover group-hover:scale-105 transition-transform" loading="lazy">
                    </div>
                    @endif
                    <h3 class="font-serif font-bold text-[#003366] dark:text-white group-hover:text-[#336699]">{{ $related->title }}</h3>
                    <time class="text-sm text-gray-500">{{ $related->published_at?->format('M j, Y') ?? $related->created_at->format('M j, Y') }}</time>
                </a>
                @endforeach
            </div>
        </div>
    </section>
    @endif
@endsection
