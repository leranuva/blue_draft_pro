<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    
    <title>@yield('title', 'Blue Draft - Expert Construction Solutions')</title>
    <meta name="description" content="@yield('meta_description', 'Expert Construction Solutions You Can Trust. Reliable construction services for your dream projects.')">
    @stack('meta')
    <link rel="sitemap" type="application/xml" href="{{ route('sitemap') }}">
    
    <!-- Favicon -->
    <link rel="icon" type="image/x-icon" href="{{ asset('favicon.ico') }}">
    <link rel="apple-touch-icon" sizes="180x180" href="{{ asset('apple-touch-icon.png') }}">
    <link rel="icon" type="image/png" sizes="32x32" href="{{ asset('favicon.ico') }}">
    <link rel="icon" type="image/png" sizes="16x16" href="{{ asset('favicon.ico') }}">
    
    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=inter:400,500,600,700&family=playfair-display:400,500,600,700" rel="stylesheet" />
    
    <!-- Script para aplicar tema del sistema antes de que se cargue la página (evita flash) -->
    <script>
        (function() {
            const prefersDark = window.matchMedia('(prefers-color-scheme: dark)').matches;
            const html = document.documentElement;
            if (prefersDark) {
                html.classList.add('dark');
            } else {
                html.classList.remove('dark');
            }
        })();
    </script>
    
    <!-- Styles & Scripts: production build o Vite dev -->
    @php
        $manifestPath = public_path('build/manifest.json');
        $useProductionAssets = file_exists($manifestPath);
    @endphp
    @if($useProductionAssets)
        @php
            $manifest = json_decode(file_get_contents($manifestPath), true);
        @endphp
        @if(isset($manifest['resources/css/app.css']['file']))
            <link rel="stylesheet" href="{{ asset('build/' . $manifest['resources/css/app.css']['file']) }}">
        @endif
        @if(isset($manifest['resources/js/app.js']['file']))
            <script type="module" src="{{ asset('build/' . $manifest['resources/js/app.js']['file']) }}"></script>
        @endif
    @else
        @vite(['resources/css/app.css', 'resources/js/app.js'])
    @endif
    
    @stack('styles')
    @stack('tracking_data')
    @include('components.tracking')
    @includeWhen(isset($contact), 'components.schema-local-business')
    @stack('schema')
    
    <!-- Google reCAPTCHA -->
    @if(config('services.recaptcha.site_key'))
    <script src="https://www.google.com/recaptcha/api.js" async defer></script>
    @endif
</head>
<body class="antialiased bg-white dark:bg-gray-900 text-[#003366] dark:text-gray-100 font-sans transition-colors duration-300">
    @if(config('tracking.gtm_id'))
    <!-- Google Tag Manager (noscript) -->
    <noscript><iframe src="https://www.googletagmanager.com/ns.html?id={{ config('tracking.gtm_id') }}" height="0" width="0" style="display:none;visibility:hidden"></iframe></noscript>
    @endif
    <!-- Navigation - Minimalist with Enhanced Glassmorphism -->
    <nav class="fixed top-0 left-0 right-0 z-50 bg-white/80 dark:bg-gray-900/80 backdrop-blur-md border-b border-[#CCCC99]/20 dark:border-gray-700/30 shadow-sm" x-data="{ scrolled: false, mobileMenuOpen: false }" @@scroll.window="scrolled = window.scrollY > 20">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex justify-between items-center h-20">
                <div class="flex items-center">
                    <a href="{{ route('home') }}" class="flex items-center space-x-3 group">
                        <img src="{{ asset('images/logo-original.png') }}" alt="Blue Draft Logo" class="h-12 w-auto group-hover:opacity-80 transition-opacity" onerror="this.onerror=null; this.src='{{ asset('images/logo.svg') }}';">
                    </a>
                </div>
                
                <div class="hidden md:flex items-center space-x-6">
                    <a href="{{ route('home') }}#home" class="text-[#003366] dark:text-gray-200 hover:text-[#336699] dark:hover:text-white transition-colors font-medium text-sm uppercase tracking-wider">Home</a>
                    <a href="{{ route('home') }}#about" class="text-[#003366] dark:text-gray-200 hover:text-[#336699] dark:hover:text-white transition-colors font-medium text-sm uppercase tracking-wider">About</a>
                    <a href="{{ route('home') }}#projects" class="text-[#003366] dark:text-gray-200 hover:text-[#336699] dark:hover:text-white transition-colors font-medium text-sm uppercase tracking-wider">Projects</a>
                    <a href="{{ route('home') }}#services" class="text-[#003366] dark:text-gray-200 hover:text-[#336699] dark:hover:text-white transition-colors font-medium text-sm uppercase tracking-wider">Services</a>
                    <a href="{{ route('home') }}#testimonials" class="text-[#003366] dark:text-gray-200 hover:text-[#336699] dark:hover:text-white transition-colors font-medium text-sm uppercase tracking-wider">Testimonials</a>
                    <a href="{{ route('blog.index') }}" class="text-[#003366] dark:text-gray-200 hover:text-[#336699] dark:hover:text-white transition-colors font-medium text-sm uppercase tracking-wider">Blog</a>
                    <a href="{{ route('home') }}#contact" class="text-[#003366] dark:text-gray-200 hover:text-[#336699] dark:hover:text-white transition-colors font-medium text-sm uppercase tracking-wider">Contact</a>
                    
                    <a href="{{ route('home') }}#quote" class="bg-[#003366] dark:bg-[#336699] text-white px-6 py-2.5 rounded-lg hover:bg-[#004080] dark:hover:bg-[#4a90e2] transition-all font-medium text-sm">
                        Get Free Quote
                    </a>
                </div>
                
                <!-- Mobile menu button -->
                <button @@click="mobileMenuOpen = !mobileMenuOpen" 
                        class="md:hidden relative z-50 w-10 h-10 flex items-center justify-center text-[#003366] dark:text-gray-200 hover:text-[#336699] dark:hover:text-white transition-colors duration-300 focus:outline-none">
                    <!-- Hamburger Icon with Animation -->
                    <div class="relative w-6 h-6">
                        <span class="absolute top-0 left-0 w-full h-0.5 bg-current transform transition-all duration-300 ease-in-out"
                              :class="mobileMenuOpen ? 'rotate-45 translate-y-2.5' : ''"></span>
                        <span class="absolute top-2.5 left-0 w-full h-0.5 bg-current transform transition-all duration-300 ease-in-out"
                              :class="mobileMenuOpen ? 'opacity-0' : 'opacity-100'"></span>
                        <span class="absolute top-5 left-0 w-full h-0.5 bg-current transform transition-all duration-300 ease-in-out"
                              :class="mobileMenuOpen ? '-rotate-45 -translate-y-2.5' : ''"></span>
                    </div>
                </button>
            </div>
        </div>
        
        <!-- Mobile menu overlay -->
        <div x-show="mobileMenuOpen"
             @@click="mobileMenuOpen = false"
             x-transition:enter="transition-opacity ease-linear duration-300"
             x-transition:enter-start="opacity-0"
             x-transition:enter-end="opacity-100"
             x-transition:leave="transition-opacity ease-linear duration-300"
             x-transition:leave-start="opacity-100"
             x-transition:leave-end="opacity-0"
             x-cloak
             class="md:hidden fixed inset-0 bg-black/60 dark:bg-black/80 backdrop-blur-sm z-40"
             style="display: none;">
        </div>
        
        <!-- Mobile menu -->
        <div x-show="mobileMenuOpen"
             x-transition:enter="transition ease-out duration-300"
             x-transition:enter-start="opacity-0 -translate-y-full"
             x-transition:enter-end="opacity-100 translate-y-0"
             x-transition:leave="transition ease-in duration-250"
             x-transition:leave-start="opacity-100 translate-y-0"
             x-transition:leave-end="opacity-0 -translate-y-full"
             x-cloak
             class="md:hidden fixed top-0 left-0 right-0 z-50 bg-white/98 dark:bg-gray-900/98 backdrop-blur-xl border-b border-[#CCCC99]/30 dark:border-gray-700/30 shadow-2xl"
             style="display: none;">
            <div class="px-6 py-8 space-y-1">
                <a href="{{ route('home') }}#home" 
                   @@click="mobileMenuOpen = false"
                   class="mobile-menu-item block px-4 py-3 text-[#003366] dark:text-gray-200 hover:text-[#336699] dark:hover:text-white hover:bg-[#003366]/5 dark:hover:bg-[#336699]/10 rounded-lg transition-all duration-300 font-medium text-sm uppercase tracking-wider transform hover:translate-x-2">
                    <span class="flex items-center">
                        <span class="w-1.5 h-1.5 bg-[#336699] dark:bg-[#4a90e2] rounded-full mr-3 opacity-0 group-hover:opacity-100 transition-opacity"></span>
                        Home
                    </span>
                </a>
                <a href="{{ route('home') }}#about" 
                   @@click="mobileMenuOpen = false"
                   class="mobile-menu-item block px-4 py-3 text-[#003366] dark:text-gray-200 hover:text-[#336699] dark:hover:text-white hover:bg-[#003366]/5 dark:hover:bg-[#336699]/10 rounded-lg transition-all duration-300 font-medium text-sm uppercase tracking-wider transform hover:translate-x-2">
                    <span class="flex items-center">
                        <span class="w-1.5 h-1.5 bg-[#336699] dark:bg-[#4a90e2] rounded-full mr-3 opacity-0 group-hover:opacity-100 transition-opacity"></span>
                        About
                    </span>
                </a>
                <a href="{{ route('home') }}#projects" 
                   @@click="mobileMenuOpen = false"
                   class="mobile-menu-item block px-4 py-3 text-[#003366] dark:text-gray-200 hover:text-[#336699] dark:hover:text-white hover:bg-[#003366]/5 dark:hover:bg-[#336699]/10 rounded-lg transition-all duration-300 font-medium text-sm uppercase tracking-wider transform hover:translate-x-2">
                    <span class="flex items-center">
                        <span class="w-1.5 h-1.5 bg-[#336699] dark:bg-[#4a90e2] rounded-full mr-3 opacity-0 group-hover:opacity-100 transition-opacity"></span>
                        Projects
                    </span>
                </a>
                <a href="{{ route('home') }}#services" 
                   @@click="mobileMenuOpen = false"
                   class="mobile-menu-item block px-4 py-3 text-[#003366] dark:text-gray-200 hover:text-[#336699] dark:hover:text-white hover:bg-[#003366]/5 dark:hover:bg-[#336699]/10 rounded-lg transition-all duration-300 font-medium text-sm uppercase tracking-wider transform hover:translate-x-2">
                    <span class="flex items-center">
                        <span class="w-1.5 h-1.5 bg-[#336699] dark:bg-[#4a90e2] rounded-full mr-3 opacity-0 group-hover:opacity-100 transition-opacity"></span>
                        Services
                    </span>
                </a>
                <a href="{{ route('home') }}#testimonials" 
                   @@click="mobileMenuOpen = false"
                   class="mobile-menu-item block px-4 py-3 text-[#003366] dark:text-gray-200 hover:text-[#336699] dark:hover:text-white hover:bg-[#003366]/5 dark:hover:bg-[#336699]/10 rounded-lg transition-all duration-300 font-medium text-sm uppercase tracking-wider transform hover:translate-x-2">
                    <span class="flex items-center">
                        <span class="w-1.5 h-1.5 bg-[#336699] dark:bg-[#4a90e2] rounded-full mr-3 opacity-0 group-hover:opacity-100 transition-opacity"></span>
                        Testimonials
                    </span>
                </a>
                <a href="{{ route('blog.index') }}" 
                   @@click="mobileMenuOpen = false"
                   class="mobile-menu-item block px-4 py-3 text-[#003366] dark:text-gray-200 hover:text-[#336699] dark:hover:text-white hover:bg-[#003366]/5 dark:hover:bg-[#336699]/10 rounded-lg transition-all duration-300 font-medium text-sm uppercase tracking-wider transform hover:translate-x-2">
                    <span class="flex items-center">
                        <span class="w-1.5 h-1.5 bg-[#336699] dark:bg-[#4a90e2] rounded-full mr-3 opacity-0 group-hover:opacity-100 transition-opacity"></span>
                        Blog
                    </span>
                </a>
                <a href="{{ route('home') }}#contact" 
                   @@click="mobileMenuOpen = false"
                   class="mobile-menu-item block px-4 py-3 text-[#003366] dark:text-gray-200 hover:text-[#336699] dark:hover:text-white hover:bg-[#003366]/5 dark:hover:bg-[#336699]/10 rounded-lg transition-all duration-300 font-medium text-sm uppercase tracking-wider transform hover:translate-x-2">
                    <span class="flex items-center">
                        <span class="w-1.5 h-1.5 bg-[#336699] dark:bg-[#4a90e2] rounded-full mr-3 opacity-0 group-hover:opacity-100 transition-opacity"></span>
                        Contact
                    </span>
                </a>
                
                <div class="pt-4 mt-4 border-t border-[#CCCC99]/30 dark:border-gray-700/30">
                    <a href="{{ route('home') }}#quote" 
                       @@click="mobileMenuOpen = false"
                       class="mobile-menu-item block bg-gradient-to-r from-[#003366] to-[#336699] dark:from-[#336699] dark:to-[#4a90e2] text-white px-6 py-3.5 rounded-lg hover:from-[#004080] hover:to-[#4a90e2] dark:hover:from-[#4a90e2] dark:hover:to-[#5ba0f2] transition-all duration-300 text-center font-medium text-sm shadow-lg hover:shadow-xl transform hover:scale-105">
                        Get Free Quote
                    </a>
                </div>
            </div>
        </div>
    </nav>
    
    <!-- Main Content -->
    <main>
        @yield('content')
    </main>
    
    <!-- JSON-LD Schema Markup for LocalBusiness -->
    <script type="application/ld+json">
    {!! json_encode([
        '@context' => 'https://schema.org',
        '@type' => 'LocalBusiness',
        'name' => 'Blue Draft',
        'image' => asset('images/logo-original.png'),
        '@id' => 'https://bluedraft.org',
        'url' => 'https://bluedraft.org',
        'telephone' => '+1.3476366128',
        'priceRange' => '$$',
        'address' => [
            '@type' => 'PostalAddress',
            'streetAddress' => '358 Amboy St',
            'addressLocality' => 'Brooklyn',
            'addressRegion' => 'NY',
            'postalCode' => '11212',
            'addressCountry' => 'US'
        ],
        'geo' => [
            '@type' => 'GeoCoordinates',
            'latitude' => 40.6614155,
            'longitude' => -73.9128145
        ],
        'openingHoursSpecification' => [
            '@type' => 'OpeningHoursSpecification',
            'dayOfWeek' => [
                'Monday',
                'Tuesday',
                'Wednesday',
                'Thursday',
                'Friday'
            ],
            'opens' => '08:00',
            'closes' => '18:00'
        ],
        'sameAs' => [
            'https://bluedraft.org'
        ],
        'description' => 'Expert Construction Solutions You Can Trust. Reliable construction services for your dream projects.',
        'areaServed' => [
            '@type' => 'City',
            'name' => 'Brooklyn, NY'
        ],
        'serviceType' => 'Construction Services'
    ], JSON_UNESCAPED_SLASHES | JSON_PRETTY_PRINT) !!}
    </script>
    
    <!-- Footer - Elegant -->
    <footer class="bg-[#003366] dark:bg-gray-900 text-[#CCCC99] dark:text-gray-300 transition-colors duration-300">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-16">
            <div class="grid grid-cols-1 md:grid-cols-3 gap-12">
                <div>
                    <img src="{{ asset('images/logo-original.png') }}" alt="Blue Draft" class="h-16 mb-4 opacity-90" onerror="this.onerror=null; this.src='{{ asset('images/logo.svg') }}';">
                    <p class="text-[#CCCC99] leading-relaxed mb-6">{{ $footer['description'] ?? 'Expert Construction Solutions You Can Trust. Reliable construction services for your dream projects.' }}</p>
                    
                    <!-- Social Media Links -->
                    <div class="flex items-center space-x-4">
                        <a href="{{ $footer['linkedin_url'] ?? 'https://www.linkedin.com/company/bluedraft' }}" target="_blank" rel="noopener noreferrer" 
                           class="w-10 h-10 bg-[#336699]/20 hover:bg-[#336699] rounded-lg flex items-center justify-center transition-all group">
                            <svg class="w-5 h-5 text-[#CCCC99] group-hover:text-white transition-colors" fill="currentColor" viewBox="0 0 24 24">
                                <path d="M19 0h-14c-2.761 0-5 2.239-5 5v14c0 2.761 2.239 5 5 5h14c2.762 0 5-2.239 5-5v-14c0-2.761-2.238-5-5-5zm-11 19h-3v-11h3v11zm-1.5-12.268c-.966 0-1.75-.79-1.75-1.764s.784-1.764 1.75-1.764 1.75.79 1.75 1.764-.783 1.764-1.75 1.764zm13.5 12.268h-3v-5.604c0-3.368-4-3.113-4 0v5.604h-3v-11h3v1.765c1.396-2.586 7-2.777 7 2.476v6.759z"/>
                            </svg>
                        </a>
                        <a href="{{ $footer['instagram_url'] ?? 'https://www.instagram.com/bluedraft' }}" target="_blank" rel="noopener noreferrer" 
                           class="w-10 h-10 bg-[#336699]/20 hover:bg-[#336699] rounded-lg flex items-center justify-center transition-all group">
                            <svg class="w-5 h-5 text-[#CCCC99] group-hover:text-white transition-colors" fill="currentColor" viewBox="0 0 24 24">
                                <path d="M12 2.163c3.204 0 3.584.012 4.85.07 3.252.148 4.771 1.691 4.919 4.919.058 1.265.069 1.645.069 4.849 0 3.205-.012 3.584-.069 4.849-.149 3.225-1.664 4.771-4.919 4.919-1.266.058-1.644.07-4.85.07-3.204 0-3.584-.012-4.849-.07-3.26-.149-4.771-1.699-4.919-4.92-.058-1.265-.07-1.644-.07-4.849 0-3.204.013-3.583.07-4.849.149-3.227 1.664-4.771 4.919-4.919 1.266-.057 1.645-.069 4.849-.069zm0-2.163c-3.259 0-3.667.014-4.947.072-4.358.2-6.78 2.618-6.98 6.98-.059 1.281-.073 1.689-.073 4.948 0 3.259.014 3.668.072 4.948.2 4.358 2.618 6.78 6.98 6.98 1.281.058 1.689.072 4.948.072 3.259 0 3.668-.014 4.948-.072 4.354-.2 6.782-2.618 6.979-6.98.059-1.28.073-1.689.073-4.948 0-3.259-.014-3.667-.072-4.947-.196-4.354-2.617-6.78-6.979-6.98-1.281-.059-1.69-.073-4.949-.073zm0 5.838c-3.403 0-6.162 2.759-6.162 6.162s2.759 6.163 6.162 6.163 6.162-2.759 6.162-6.163c0-3.403-2.759-6.162-6.162-6.162zm0 10.162c-2.209 0-4-1.79-4-4 0-2.209 1.791-4 4-4s4 1.791 4 4c0 2.21-1.791 4-4 4zm6.406-11.845c-.796 0-1.441.645-1.441 1.44s.645 1.44 1.441 1.44c.795 0 1.439-.645 1.439-1.44s-.644-1.44-1.439-1.44z"/>
                            </svg>
                        </a>
                        <a href="{{ $footer['facebook_url'] ?? 'https://www.facebook.com/bluedraft' }}" target="_blank" rel="noopener noreferrer" 
                           class="w-10 h-10 bg-[#336699]/20 hover:bg-[#336699] rounded-lg flex items-center justify-center transition-all group">
                            <svg class="w-5 h-5 text-[#CCCC99] group-hover:text-white transition-colors" fill="currentColor" viewBox="0 0 24 24">
                                <path d="M24 12.073c0-6.627-5.373-12-12-12s-12 5.373-12 12c0 5.99 4.388 10.954 10.125 11.854v-8.385h-3.047v-3.47h3.047v-2.646c0-3.007 1.792-4.669 4.533-4.669 1.312 0 2.686.235 2.686.235v2.953h-1.513c-1.491 0-1.956.925-1.956 1.874v2.25h3.328l-.532 3.47h-2.796v8.385c5.737-.9 10.125-5.864 10.125-11.854z"/>
                            </svg>
                        </a>
                    </div>
                </div>
                
                <div>
                    <h4 class="text-white dark:text-gray-200 font-semibold mb-4 uppercase tracking-wider text-sm">Contact</h4>
                    <ul class="space-y-3 text-[#CCCC99] dark:text-gray-400">
                        <li>{{ $footer['address'] ?? '358 Amboy St, Brooklyn, NY 11212, USA' }}</li>
                        <li>
                            <a href="mailto:{{ $footer['email_1'] ?? config('mail.admin_notification_email') }}" class="hover:text-white dark:hover:text-gray-200 transition-colors">{{ $footer['email_1'] ?? config('mail.admin_notification_email') }}</a>
                        </li>
                        <li>
                            <a href="mailto:{{ $footer['email_2'] ?? config('mail.admin_notification_email') }}" class="hover:text-white dark:hover:text-gray-200 transition-colors">{{ $footer['email_2'] ?? config('mail.admin_notification_email') }}</a>
                        </li>
                        <li>
                            <a href="tel:{{ str_replace(['.', ' ', '-'], '', $footer['phone'] ?? '+1.3476366128') }}" class="hover:text-white dark:hover:text-gray-200 transition-colors">{{ $footer['phone'] ?? '+1.3476366128' }}</a>
                        </li>
                    </ul>
                </div>
                
                <div>
                    <h4 class="text-white dark:text-gray-200 font-semibold mb-4 uppercase tracking-wider text-sm">Quick Links</h4>
                    <ul class="space-y-3">
                        <li><a href="{{ route('home') }}#home" class="text-[#CCCC99] dark:text-gray-400 hover:text-white dark:hover:text-gray-200 transition-colors text-sm uppercase tracking-wider">Home</a></li>
                        <li><a href="{{ route('home') }}#about" class="text-[#CCCC99] dark:text-gray-400 hover:text-white dark:hover:text-gray-200 transition-colors text-sm uppercase tracking-wider">About</a></li>
                        <li><a href="{{ route('home') }}#projects" class="text-[#CCCC99] dark:text-gray-400 hover:text-white dark:hover:text-gray-200 transition-colors text-sm uppercase tracking-wider">Projects</a></li>
                        <li><a href="{{ route('home') }}#services" class="text-[#CCCC99] dark:text-gray-400 hover:text-white dark:hover:text-gray-200 transition-colors text-sm uppercase tracking-wider">Services</a></li>
                        <li><a href="{{ route('home') }}#testimonials" class="text-[#CCCC99] dark:text-gray-400 hover:text-white dark:hover:text-gray-200 transition-colors text-sm uppercase tracking-wider">Testimonials</a></li>
                        <li><a href="{{ route('blog.index') }}" class="text-[#CCCC99] dark:text-gray-400 hover:text-white dark:hover:text-gray-200 transition-colors text-sm uppercase tracking-wider">Blog</a></li>
                        <li><a href="{{ route('home') }}#quote" class="text-[#CCCC99] dark:text-gray-400 hover:text-white dark:hover:text-gray-200 transition-colors text-sm uppercase tracking-wider">Get Quote</a></li>
                        <li><a href="{{ route('home') }}#contact" class="text-[#CCCC99] dark:text-gray-400 hover:text-white dark:hover:text-gray-200 transition-colors text-sm uppercase tracking-wider">Contact</a></li>
                        <li><a href="{{ route('pillar.nyc') }}" class="text-[#CCCC99] dark:text-gray-400 hover:text-white dark:hover:text-gray-200 transition-colors text-sm uppercase tracking-wider">Construction Company NYC</a></li>
                        @foreach(config('pillar_cities.cities', []) as $slug => $cityConfig)
                        <li><a href="{{ route('pillar.city', $slug) }}" class="text-[#CCCC99] dark:text-gray-400 hover:text-white dark:hover:text-gray-200 transition-colors text-sm uppercase tracking-wider">Construction Company {{ $cityConfig['name'] ?? ucfirst($slug) }}</a></li>
                        @endforeach
                        <li><a href="{{ route('lead-magnet.show') }}" class="text-[#CCCC99] dark:text-gray-400 hover:text-white dark:hover:text-gray-200 transition-colors text-sm uppercase tracking-wider">Free Renovation Guide</a></li>
                        <li><a href="{{ route('cost-calculator') }}" class="text-[#CCCC99] dark:text-gray-400 hover:text-white dark:hover:text-gray-200 transition-colors text-sm uppercase tracking-wider">Cost Calculator</a></li>
                    </ul>
                </div>
            </div>
            
            @if(!empty($footer['license']) || !empty($footer['insured']) || !empty($footer['certifications']))
            <div class="border-t border-[#336699]/30 dark:border-gray-700/50 mt-12 pt-8 flex flex-wrap justify-center gap-x-6 gap-y-2 text-[#CCCC99] dark:text-gray-400 text-sm">
                @if(!empty($footer['license']))
                <span>License: {{ $footer['license'] }}</span>
                @endif
                @if(!empty($footer['insured']))
                <span>{{ $footer['insured'] }}</span>
                @endif
                @if(!empty($footer['certifications']))
                <span>{{ $footer['certifications'] }}</span>
                @endif
            </div>
            @endif
            <div class="border-t border-[#336699]/30 dark:border-gray-700/50 mt-6 pt-8 text-center text-[#CCCC99] dark:text-gray-400 text-sm">
                <p>&copy; {{ date('Y') }} {{ $footer['copyright'] ?? 'Blue Draft - All Rights Reserved.' }}</p>
            </div>
        </div>
    </footer>
    
    @stack('scripts')
    
    <!-- Fixed CTA: Get Free Estimate (mobile sticky bar) -->
    @php $hero = $hero ?? []; @endphp
    <div class="fixed bottom-0 left-0 right-0 z-[9998] md:hidden bg-[#003366] dark:bg-[#336699] py-3 px-4 shadow-lg">
        <a href="#quote" class="flex items-center justify-center w-full bg-white text-[#003366] py-3 rounded-lg font-semibold text-sm uppercase tracking-wider">
            {{ $hero['cta_text'] ?? 'Get Free Estimate' }}
        </a>
    </div>
    <div class="h-16 md:hidden"></div>
    
    <!-- WhatsApp Floating Button -->
    @php $contact = $contact ?? []; $whatsapp = $contact['whatsapp'] ?? '13476366128'; @endphp
    <a href="https://wa.me/{{ $whatsapp }}" target="_blank" rel="noopener noreferrer" 
       class="fixed bottom-24 right-6 z-[9999] w-14 h-14 bg-green-500 hover:bg-green-600 text-white rounded-full shadow-2xl flex items-center justify-center transition-all hover:scale-110 focus:outline-none focus:ring-2 focus:ring-green-400 focus:ring-offset-2"
       aria-label="Chat on WhatsApp">
        <svg class="w-8 h-8" fill="currentColor" viewBox="0 0 24 24"><path d="M17.472 14.382c-.297-.149-1.758-.867-2.03-.967-.273-.099-.471-.148-.67.15-.197.297-.767.966-.94 1.164-.173.199-.347.223-.644.075-.297-.15-1.255-.463-2.39-1.475-.883-.788-1.48-1.761-1.653-2.059-.173-.297-.018-.458.13-.606.134-.133.298-.347.446-.52.149-.174.198-.298.298-.497.099-.198.05-.371-.025-.52-.075-.149-.669-1.612-.916-2.207-.242-.579-.487-.5-.669-.51-.173-.008-.371-.01-.57-.01-.198 0-.52.074-.792.372-.272.297-1.04 1.016-1.04 2.479 0 1.462 1.065 2.875 1.213 3.074.149.198 2.096 3.2 5.077 4.487.709.306 1.262.489 1.694.625.712.227 1.36.195 1.871.118.571-.085 1.758-.719 2.006-1.413.248-.694.248-1.289.173-1.413-.074-.124-.272-.198-.57-.347m-5.421 7.403h-.004a9.87 9.87 0 01-5.031-1.378l-.361-.214-3.741.982.998-3.648-.235-.374a9.86 9.86 0 01-1.51-5.26c.001-5.45 4.436-9.884 9.888-9.884 2.64 0 5.122 1.03 6.988 2.898a9.825 9.825 0 012.893 6.994c-.003 5.45-4.437 9.884-9.885 9.884m8.413-18.297A11.815 11.815 0 0012.05 0C5.495 0 .16 5.335.157 11.892c0 2.096.547 4.142 1.588 5.945L.057 24l6.305-1.654a11.882 11.882 0 005.683 1.448h.005c6.554 0 11.89-5.335 11.893-11.893a11.821 11.821 0 00-3.48-8.413z"/></svg>
    </a>
    
    <!-- Floating Message Widget / Get Free Estimate -->
    <div class="fixed bottom-6 right-6 z-[9999]" x-data="{ open: false }" style="position: fixed !important; bottom: 24px !important; right: 24px !important; z-index: 99999 !important;">
        <!-- CTA Button - Desktop shows panel -->
        <button type="button" @@click="open = !open" 
                class="relative bg-[#003366] text-white w-16 h-16 rounded-full shadow-2xl hover:bg-[#004080] transition-all duration-300 items-center justify-center group hover:scale-110 focus:outline-none focus:ring-2 focus:ring-[#336699] focus:ring-offset-2 hidden md:flex">
            <!-- Chat Icon (visible when closed) -->
            <svg x-show="!open" 
                 class="w-7 h-7 transition-transform group-hover:scale-110" 
                 fill="none" 
                 stroke="currentColor" 
                 viewBox="0 0 24 24"
                 style="display: block;">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 12h.01M12 12h.01M16 12h.01M21 12c0 4.418-4.03 8-9 8a9.863 9.863 0 01-4.255-.949L3 20l1.395-3.72C3.512 15.042 3 13.574 3 12c0-4.418 4.03-8 9-8s9 3.582 9 8z"></path>
            </svg>
            <!-- Close Icon (visible when open) -->
            <svg x-show="open" 
                 x-cloak
                 class="w-7 h-7 transition-transform" 
                 fill="none" 
                 stroke="currentColor" 
                 viewBox="0 0 24 24"
                 style="display: none;">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
            </svg>
            <!-- Notification Badge -->
            <span class="absolute -top-1 -right-1 w-5 h-5 bg-red-500 rounded-full flex items-center justify-center text-xs font-bold animate-pulse" style="display: flex !important;"></span>
        </button>
        
        <!-- Chat Widget Panel -->
        <div x-show="open" 
             x-transition:enter="transition ease-out duration-300"
             x-transition:enter-start="opacity-0 transform scale-95 translate-y-4"
             x-transition:enter-end="opacity-100 transform scale-100 translate-y-0"
             x-transition:leave="transition ease-in duration-200"
             x-transition:leave-start="opacity-100 transform scale-100 translate-y-0"
             x-transition:leave-end="opacity-0 transform scale-95 translate-y-4"
             x-cloak
             class="absolute bottom-20 right-0 w-80 bg-white rounded-2xl shadow-2xl border border-[#CCCC99]/30 overflow-hidden">
            <!-- Header -->
            <div class="bg-gradient-to-r from-[#003366] to-[#336699] text-white p-4">
                <div class="flex items-center justify-between">
                    <div>
                        <h3 class="font-semibold text-lg">Need Help?</h3>
                        <p class="text-sm text-white/90">We're here to help you</p>
                    </div>
                    <button @@click="open = false" class="text-white/80 hover:text-white transition-colors">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                        </svg>
                    </button>
                </div>
            </div>
            
            <!-- Content -->
            <div class="p-4 space-y-3">
                <p class="text-sm text-gray-600">Hello! 👋 How can we help you today?</p>
                
                <!-- Quick Actions -->
                <div class="space-y-2">
                    <a href="#quote" @@click="open = false" class="block w-full bg-[#003366] text-white px-4 py-3 rounded-lg hover:bg-[#004080] transition-all text-center font-medium text-sm">
                        Request Free Quote
                    </a>
                    <a href="#contact" @@click="open = false" class="block w-full bg-[#CCCC99]/20 text-[#003366] px-4 py-3 rounded-lg hover:bg-[#CCCC99]/30 transition-all text-center font-medium text-sm border border-[#CCCC99]">
                        Send Message
                    </a>
                </div>
                
                <!-- Contact Info -->
                <div class="pt-3 border-t border-gray-200 space-y-2">
                    <a href="tel:+13476366128" class="flex items-center text-sm text-gray-700 hover:text-[#336699] transition-colors">
                        <svg class="w-4 h-4 mr-2 text-[#336699]" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z"></path>
                        </svg>
                        +1.3476366128
                    </a>
                    <a href="mailto:{{ config('mail.admin_notification_email') }}" class="flex items-center text-sm text-gray-700 hover:text-[#336699] transition-colors">
                        <svg class="w-4 h-4 mr-2 text-[#336699]" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"></path>
                        </svg>
                        {{ config('mail.admin_notification_email') }}
                    </a>
                </div>
                
                <!-- Hours -->
                <div class="pt-2 text-xs text-gray-500">
                    <p>🕐 Business Hours:</p>
                    <p>Mon - Fri: 8:00 AM - 6:00 PM</p>
                </div>
            </div>
        </div>
    </div>
</body>
</html>
