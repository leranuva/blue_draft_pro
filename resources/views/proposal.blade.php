<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    
    <title>Project Proposal - Blue Draft</title>
    
    <!-- Favicon -->
    <link rel="icon" type="image/x-icon" href="{{ asset('favicon.ico') }}">
    
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
    
    <!-- Styles -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    
    <style>
        .proposal-section {
            opacity: 0;
            transform: translateY(30px);
            transition: all 0.6s ease-out;
        }
        .proposal-section.visible {
            opacity: 1;
            transform: translateY(0);
        }
        .proposal-card {
            transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
        }
        .proposal-card:hover {
            transform: translateY(-4px);
            box-shadow: 0 20px 25px -5px rgba(0, 0, 0, 0.1), 0 10px 10px -5px rgba(0, 0, 0, 0.04);
        }
        .phase-badge {
            position: relative;
            overflow: hidden;
        }
        .phase-badge::before {
            content: '';
            position: absolute;
            top: 0;
            left: -100%;
            width: 100%;
            height: 100%;
            background: linear-gradient(90deg, transparent, rgba(255, 255, 255, 0.3), transparent);
            transition: left 0.5s;
        }
        .phase-badge:hover::before {
            left: 100%;
        }
        .timeline-line {
            position: relative;
        }
        .timeline-line::after {
            content: '';
            position: absolute;
            left: 50%;
            top: 0;
            bottom: 0;
            width: 2px;
            background: linear-gradient(to bottom, #336699, #003366);
            transform: translateX(-50%);
        }
        .dark .timeline-line::after {
            background: linear-gradient(to bottom, #4a90e2, #336699);
        }
        .feature-icon {
            transition: all 0.3s ease;
        }
        .feature-item:hover .feature-icon {
            transform: scale(1.1) rotate(5deg);
        }
        .nav-links {
            position: fixed;
            top: 0;
            left: 0;
            right: 0;
            z-index: 1000;
            background: rgba(255, 255, 255, 0.95);
            backdrop-filter: blur(10px);
            border-bottom: 1px solid rgba(0, 51, 102, 0.1);
            padding: 1rem 0;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.05);
        }
        .dark .nav-links {
            background: rgba(17, 24, 39, 0.95);
            border-bottom-color: rgba(255, 255, 255, 0.1);
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.3);
        }
    </style>
</head>
<body class="antialiased bg-white dark:bg-gray-900 text-[#003366] dark:text-gray-100 font-sans transition-colors duration-300">
    <!-- Navigation Links -->
    <div class="nav-links">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex justify-between items-center">
                <!-- Logo -->
                <div class="flex items-center">
                    <a href="{{ route('home') }}" class="flex items-center space-x-3 group">
                        <img src="{{ asset('images/logo-original.png') }}" alt="Blue Draft Logo" class="h-10 w-auto group-hover:opacity-80 transition-opacity">
                    </a>
                </div>
                
                <!-- Navigation Buttons -->
                <div class="flex items-center gap-4">
                    <a href="{{ route('home') }}" class="flex items-center gap-2 px-4 py-2 bg-[#003366] dark:bg-[#336699] text-white rounded-lg hover:bg-[#004080] dark:hover:bg-[#4a90e2] transition-all font-medium text-sm">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6"></path>
                        </svg>
                        Go to Website
                    </a>
                    <a href="/system-bd-access" class="flex items-center gap-2 px-4 py-2 bg-[#336699] dark:bg-[#4a90e2] text-white rounded-lg hover:bg-[#4a90e2] dark:hover:bg-[#5ba0f2] transition-all font-medium text-sm">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z"></path>
                        </svg>
                        Admin Dashboard
                    </a>
                </div>
            </div>
        </div>
    </div>

    <div class="pb-12 bg-white dark:bg-gray-900 transition-colors duration-300" style="padding-top: 10rem;">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 space-y-12">
            <!-- Hero Header with Gradient -->
            <div class="proposal-section proposal-card bg-gradient-to-br from-[#003366] via-[#336699] to-[#003366] dark:from-gray-900 dark:via-gray-800 dark:to-gray-900 rounded-2xl shadow-2xl p-8 md:p-12 text-white relative overflow-hidden">
                <div class="absolute inset-0 bg-[url('data:image/svg+xml,%3Csvg width=\"60\" height=\"60\" viewBox=\"0 0 60 60\" xmlns=\"http://www.w3.org/2000/svg\"%3E%3Cg fill=\"none\" fill-rule=\"evenodd\"%3E%3Cg fill=\"%23ffffff\" fill-opacity=\"0.05\"%3E%3Cpath d=\"M36 34v-4h-2v4h-4v2h4v4h2v-4h4v-2h-4zm0-30V0h-2v4h-4v2h4v4h2V6h4V4h-4zM6 34v-4H4v4H0v2h4v4h2v-4h4v-2H6zM6 4V0H4v4H0v2h4v4h2V6h4V4H6z\"/%3E%3C/g%3E%3C/g%3E%3C/svg%3E')] opacity-20"></div>
                <div class="relative z-10">
                    <div class="text-center mb-8">
                        <div class="inline-block px-4 py-2 bg-white/20 backdrop-blur-sm rounded-full text-sm font-semibold mb-4">
                            📋 PROJECT PROPOSAL
                        </div>
                        <h1 class="text-4xl md:text-5xl font-serif font-bold mb-3">
                            Blue Draft Web & CMS
                        </h1>
                        <h2 class="text-2xl md:text-3xl font-light text-blue-100 mb-8">
                            Experience 2026
                        </h2>
                        <div class="grid grid-cols-1 md:grid-cols-3 gap-6 text-sm">
                            <div class="bg-white/10 backdrop-blur-sm rounded-lg p-4">
                                <div class="text-blue-200 mb-1 font-medium">Prepared for</div>
                                <div class="text-white font-semibold">Marcin & Wojtek</div>
                                <div class="text-blue-100 text-xs">Blue Draft Corporation</div>
                            </div>
                            <div class="bg-white/10 backdrop-blur-sm rounded-lg p-4">
                                <div class="text-blue-200 mb-1 font-medium">Prepared by</div>
                                <div class="text-white font-semibold">Ramiro Núñez Valverde</div>
                                <div class="text-blue-100 text-xs">Web Developer</div>
                            </div>
                            <div class="bg-white/10 backdrop-blur-sm rounded-lg p-4">
                                <div class="text-blue-200 mb-1 font-medium">Date</div>
                                <div class="text-white font-semibold">December 26, 2025</div>
                                <div class="text-blue-100 text-xs">Latest Version</div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Executive Summary -->
            <div class="proposal-section proposal-card bg-white dark:bg-gray-800 rounded-xl shadow-lg p-8 border-l-4 border-[#336699] dark:border-[#4a90e2]">
                <div class="flex items-start mb-6">
                    <div class="flex-shrink-0 w-12 h-12 bg-gradient-to-br from-[#336699] to-[#003366] dark:from-[#4a90e2] dark:to-[#336699] rounded-xl flex items-center justify-center text-white font-bold text-xl mr-4 shadow-lg">
                        1
                    </div>
                    <div class="flex-1">
                        <h2 class="text-3xl font-serif font-bold text-[#003366] dark:text-white mb-4">
                            Executive Summary
                        </h2>
                        <div class="h-1 w-20 bg-gradient-to-r from-[#336699] to-[#003366] dark:from-[#4a90e2] dark:to-[#336699] rounded-full mb-6"></div>
                    </div>
                </div>
                <div class="prose prose-lg dark:prose-invert max-w-none">
                    <p class="text-gray-700 dark:text-gray-300 leading-relaxed text-lg">
                        This proposal outlines the delivery of a <strong class="text-[#003366] dark:text-[#4a90e2]">state-of-the-art digital ecosystem</strong> for Blue Draft Corporation. 
                        The solution combines a high-end, responsive front-end with a powerful, private Administrative Control Panel. 
                        This platform is engineered to <strong class="text-[#003366] dark:text-[#4a90e2]">drive conversions</strong>, manage complex project portfolios, and provide the owners 
                        with <span class="inline-block px-3 py-1 bg-gradient-to-r from-green-400 to-green-600 text-white rounded-full text-sm font-bold">100% autonomy</span> over their digital content.
                    </p>
                </div>
            </div>

            <!-- Advanced Administrative Ecosystem -->
            <div class="proposal-section proposal-card bg-gradient-to-br from-white to-gray-50 dark:from-gray-800 dark:to-gray-900 rounded-xl shadow-lg p-8 border border-gray-200 dark:border-gray-700">
                <div class="flex items-start mb-6">
                    <div class="flex-shrink-0 w-12 h-12 bg-gradient-to-br from-[#336699] to-[#003366] dark:from-[#4a90e2] dark:to-[#336699] rounded-xl flex items-center justify-center text-white font-bold text-xl mr-4 shadow-lg">
                        2
                    </div>
                    <div class="flex-1">
                        <h2 class="text-3xl font-serif font-bold text-[#003366] dark:text-white mb-2">
                            Advanced Administrative Ecosystem
                        </h2>
                        <p class="text-gray-600 dark:text-gray-400 text-sm">Filament PHP - Stealth Admin Dashboard</p>
                        <div class="h-1 w-20 bg-gradient-to-r from-[#336699] to-[#003366] dark:from-[#4a90e2] dark:to-[#336699] rounded-full mt-4"></div>
                    </div>
                </div>
                
                <div class="bg-blue-50 dark:bg-blue-900/20 rounded-lg p-6 mb-6 border border-blue-200 dark:border-blue-800">
                    <p class="text-gray-700 dark:text-gray-300 mb-0">
                        Unlike traditional websites, this project includes a <strong class="text-[#003366] dark:text-[#4a90e2]">Stealth Admin Dashboard</strong> 
                        accessible via a private URL: <code class="bg-white dark:bg-gray-800 px-3 py-1 rounded-lg text-sm font-mono text-[#336699] dark:text-[#4a90e2] border border-blue-200 dark:border-blue-700">/system-bd-access</code>
                    </p>
                </div>
                
                <div class="mt-8">
                    <h3 class="text-xl font-bold text-[#003366] dark:text-white mb-6 flex items-center">
                        <div class="w-8 h-8 bg-[#336699] dark:bg-[#4a90e2] text-white rounded-lg flex items-center justify-center mr-3 text-sm font-bold">A</div>
                        Total Site Autonomy
                    </h3>
                    <p class="text-gray-700 dark:text-gray-300 mb-6 text-lg">
                        Through an intuitive interface, the Blue Draft team can manage:
                    </p>
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                        <div class="feature-item bg-white dark:bg-gray-800 rounded-lg p-5 border border-gray-200 dark:border-gray-700 hover:border-[#336699] dark:hover:border-[#4a90e2] transition-all">
                            <div class="flex items-start">
                                <div class="feature-icon w-10 h-10 bg-green-100 dark:bg-green-900/30 rounded-lg flex items-center justify-center mr-4 flex-shrink-0">
                                    <svg class="w-6 h-6 text-green-600 dark:text-green-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                                    </svg>
                                </div>
                                <div>
                                    <h4 class="font-bold text-[#003366] dark:text-white mb-1">Hero & Visual Identity</h4>
                                    <p class="text-sm text-gray-600 dark:text-gray-400">Change background images, adjust text overlays, and update call-to-action buttons in real-time.</p>
                                </div>
                            </div>
                        </div>
                        <div class="feature-item bg-white dark:bg-gray-800 rounded-lg p-5 border border-gray-200 dark:border-gray-700 hover:border-[#336699] dark:hover:border-[#4a90e2] transition-all">
                            <div class="flex items-start">
                                <div class="feature-icon w-10 h-10 bg-blue-100 dark:bg-blue-900/30 rounded-lg flex items-center justify-center mr-4 flex-shrink-0">
                                    <svg class="w-6 h-6 text-blue-600 dark:text-blue-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 11V9a2 2 0 012-2m0 0V5a2 2 0 012-2h6a2 2 0 012 2v2M7 7h10"></path>
                                    </svg>
                                </div>
                                <div>
                                    <h4 class="font-bold text-[#003366] dark:text-white mb-1">Portfolio Management</h4>
                                    <p class="text-sm text-gray-600 dark:text-gray-400">Upload "Before & After" photos. The system automatically handles image optimization.</p>
                                </div>
                            </div>
                        </div>
                        <div class="feature-item bg-white dark:bg-gray-800 rounded-lg p-5 border border-gray-200 dark:border-gray-700 hover:border-[#336699] dark:hover:border-[#4a90e2] transition-all">
                            <div class="flex items-start">
                                <div class="feature-icon w-10 h-10 bg-purple-100 dark:bg-purple-900/30 rounded-lg flex items-center justify-center mr-4 flex-shrink-0">
                                    <svg class="w-6 h-6 text-purple-600 dark:text-purple-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"></path>
                                    </svg>
                                </div>
                                <div>
                                    <h4 class="font-bold text-[#003366] dark:text-white mb-1">Content Sections</h4>
                                    <p class="text-sm text-gray-600 dark:text-gray-400">Edit descriptions for "About Us," "Services," and "Testimonials" without touching code.</p>
                                </div>
                            </div>
                        </div>
                        <div class="feature-item bg-white dark:bg-gray-800 rounded-lg p-5 border border-gray-200 dark:border-gray-700 hover:border-[#336699] dark:hover:border-[#4a90e2] transition-all">
                            <div class="flex items-start">
                                <div class="feature-icon w-10 h-10 bg-orange-100 dark:bg-orange-900/30 rounded-lg flex items-center justify-center mr-4 flex-shrink-0">
                                    <svg class="w-6 h-6 text-orange-600 dark:text-orange-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"></path>
                                    </svg>
                                </div>
                                <div>
                                    <h4 class="font-bold text-[#003366] dark:text-white mb-1">Lead Management</h4>
                                    <p class="text-sm text-gray-600 dark:text-gray-400">Centralized inbox to view every quote request, including high-resolution project photos.</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- High-Performance Frontend Features -->
            <div class="proposal-section proposal-card bg-white dark:bg-gray-800 rounded-xl shadow-lg p-8 border-l-4 border-purple-500 dark:border-purple-400">
                <div class="flex items-start mb-6">
                    <div class="flex-shrink-0 w-12 h-12 bg-gradient-to-br from-purple-500 to-purple-700 dark:from-purple-400 dark:to-purple-600 rounded-xl flex items-center justify-center text-white font-bold text-xl mr-4 shadow-lg">
                        3
                    </div>
                    <div class="flex-1">
                        <h2 class="text-3xl font-serif font-bold text-[#003366] dark:text-white mb-2">
                            High-Performance Frontend Features
                        </h2>
                        <div class="h-1 w-20 bg-gradient-to-r from-purple-500 to-purple-700 dark:from-purple-400 dark:to-purple-600 rounded-full mt-4"></div>
                    </div>
                </div>
                
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-8">
                    <div class="bg-gradient-to-br from-blue-50 to-blue-100 dark:from-blue-900/20 dark:to-blue-800/20 rounded-xl p-6 border border-blue-200 dark:border-blue-800">
                        <h3 class="text-xl font-bold text-[#003366] dark:text-white mb-4 flex items-center">
                            <span class="w-8 h-8 bg-blue-500 text-white rounded-lg flex items-center justify-center mr-3 text-sm font-bold">A</span>
                            Intelligent Conversion Funnel
                        </h3>
                        <ul class="space-y-3">
                            <li class="flex items-start text-gray-700 dark:text-gray-300">
                                <svg class="w-5 h-5 text-blue-500 mr-3 mt-0.5 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                </svg>
                                <span><strong>4-Step Project Wizard:</strong> Pre-qualifies leads by asking for service type, budget ranges, and project descriptions.</span>
                            </li>
                            <li class="flex items-start text-gray-700 dark:text-gray-300">
                                <svg class="w-5 h-5 text-blue-500 mr-3 mt-0.5 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                </svg>
                                <span><strong>Drag & Drop Media:</strong> Clients can upload photos directly from their phones or desktops.</span>
                            </li>
                            <li class="flex items-start text-gray-700 dark:text-gray-300">
                                <svg class="w-5 h-5 text-blue-500 mr-3 mt-0.5 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                </svg>
                                <span><strong>Floating Communication Hub:</strong> Modern messaging widget ensuring the team is always one click away.</span>
                            </li>
                        </ul>
                    </div>
                    
                    <div class="bg-gradient-to-br from-purple-50 to-purple-100 dark:from-purple-900/20 dark:to-purple-800/20 rounded-xl p-6 border border-purple-200 dark:border-purple-800">
                        <h3 class="text-xl font-bold text-[#003366] dark:text-white mb-4 flex items-center">
                            <span class="w-8 h-8 bg-purple-500 text-white rounded-lg flex items-center justify-center mr-3 text-sm font-bold">B</span>
                            Cutting-Edge UX Design
                        </h3>
                        <ul class="space-y-3">
                            <li class="flex items-start text-gray-700 dark:text-gray-300">
                                <svg class="w-5 h-5 text-purple-500 mr-3 mt-0.5 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                </svg>
                                <span><strong>Dynamic Theme Sensing:</strong> Automatically detects user's OS settings to toggle between Light and Dark modes.</span>
                            </li>
                            <li class="flex items-start text-gray-700 dark:text-gray-300">
                                <svg class="w-5 h-5 text-purple-500 mr-3 mt-0.5 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                </svg>
                                <span><strong>Motion One Animations:</strong> Fluid, high-performance visual transitions.</span>
                            </li>
                            <li class="flex items-start text-gray-700 dark:text-gray-300">
                                <svg class="w-5 h-5 text-purple-500 mr-3 mt-0.5 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                </svg>
                                <span><strong>Glassmorphism Aesthetic:</strong> Premium "frosted glass" effects for a luxury 2025 appearance.</span>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>

            <!-- Security & SEO Infrastructure -->
            <div class="proposal-section proposal-card bg-gradient-to-br from-green-50 to-emerald-50 dark:from-green-900/20 dark:to-emerald-900/20 rounded-xl shadow-lg p-8 border-l-4 border-green-500 dark:border-green-400">
                <div class="flex items-start mb-6">
                    <div class="flex-shrink-0 w-12 h-12 bg-gradient-to-br from-green-500 to-emerald-600 dark:from-green-400 dark:to-emerald-500 rounded-xl flex items-center justify-center text-white font-bold text-xl mr-4 shadow-lg">
                        4
                    </div>
                    <div class="flex-1">
                        <h2 class="text-3xl font-serif font-bold text-[#003366] dark:text-white mb-2">
                            Security & SEO Infrastructure
                        </h2>
                        <div class="h-1 w-20 bg-gradient-to-r from-green-500 to-emerald-600 dark:from-green-400 dark:to-emerald-500 rounded-full mt-4"></div>
                    </div>
                </div>
                
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <div class="bg-white dark:bg-gray-800 rounded-lg p-6 border border-green-200 dark:border-green-800">
                        <div class="flex items-center mb-4">
                            <div class="w-12 h-12 bg-green-100 dark:bg-green-900/30 rounded-lg flex items-center justify-center mr-4">
                                <svg class="w-6 h-6 text-green-600 dark:text-green-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 12a9 9 0 01-9 9m9-9a9 9 0 00-9-9m9 9H3m9 9a9 9 0 01-9-9m9 9c1.657 0 3-4.03 3-9s-1.343-9-3-9m0 18c-1.657 0-3-4.03-3-9s1.343-9 3-9m-9 9a9 9 0 019-9"></path>
                                </svg>
                            </div>
                            <h3 class="text-lg font-bold text-[#003366] dark:text-white">Local SEO Dominance</h3>
                        </div>
                        <p class="text-gray-600 dark:text-gray-400">Integrated JSON-LD Schema to ensure Google ranks Blue Draft at the top of Brooklyn local searches.</p>
                    </div>
                    
                    <div class="bg-white dark:bg-gray-800 rounded-lg p-6 border border-green-200 dark:border-green-800">
                        <div class="flex items-center mb-4">
                            <div class="w-12 h-12 bg-green-100 dark:bg-green-900/30 rounded-lg flex items-center justify-center mr-4">
                                <svg class="w-6 h-6 text-green-600 dark:text-green-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z"></path>
                                </svg>
                            </div>
                            <h3 class="text-lg font-bold text-[#003366] dark:text-white">Enterprise-Grade Security</h3>
                        </div>
                        <ul class="space-y-2 text-sm text-gray-600 dark:text-gray-400">
                            <li class="flex items-start">
                                <span class="text-green-500 mr-2">✓</span>
                                <span><strong>Domain-Locked Access:</strong> Only <code class="bg-gray-100 dark:bg-gray-700 px-1 rounded">@bluedraft.org</code> emails</span>
                            </li>
                            <li class="flex items-start">
                                <span class="text-green-500 mr-2">✓</span>
                                <span><strong>Anti-Spam Protection:</strong> Google reCAPTCHA v2 integrated</span>
                            </li>
                            <li class="flex items-start">
                                <span class="text-green-500 mr-2">✓</span>
                                <span><strong>Secure File Handling:</strong> Encrypted uploads and validated file types</span>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>

            <!-- Deployment & Success Roadmap -->
            <div class="proposal-section proposal-card bg-white dark:bg-gray-800 rounded-xl shadow-lg p-8 border-l-4 border-orange-500 dark:border-orange-400">
                <div class="flex items-start mb-8">
                    <div class="flex-shrink-0 w-12 h-12 bg-gradient-to-br from-orange-500 to-red-600 dark:from-orange-400 dark:to-red-500 rounded-xl flex items-center justify-center text-white font-bold text-xl mr-4 shadow-lg">
                        5
                    </div>
                    <div class="flex-1">
                        <h2 class="text-3xl font-serif font-bold text-[#003366] dark:text-white mb-2">
                            Deployment & Success Roadmap
                        </h2>
                        <div class="h-1 w-20 bg-gradient-to-r from-orange-500 to-red-600 dark:from-orange-400 dark:to-red-500 rounded-full mt-4"></div>
                    </div>
                </div>
                
                <!-- Timeline Visual -->
                <div class="relative">
                    <div class="timeline-line hidden md:block absolute left-1/2 transform -translate-x-1/2 w-1 h-full"></div>
                    
                    <div class="space-y-8">
                        <!-- Phase I -->
                        <div class="relative flex flex-col md:flex-row items-center">
                            <div class="w-full md:w-1/2 md:pr-8 md:text-right mb-4 md:mb-0">
                                <div class="phase-badge inline-block bg-gradient-to-br from-blue-500 to-blue-700 dark:from-blue-400 dark:to-blue-600 text-white px-6 py-3 rounded-xl font-bold text-lg shadow-lg mb-3">
                                    Phase I
                                </div>
                                <h3 class="text-xl font-bold text-[#003366] dark:text-white mb-2">Core Engine</h3>
                                <p class="text-gray-600 dark:text-gray-400">Laravel 12 & Database Architecture</p>
                                <div class="mt-2 text-sm text-blue-600 dark:text-blue-400 font-medium">✓ Solid, secure foundation</div>
                            </div>
                            <div class="absolute left-1/2 transform -translate-x-1/2 w-4 h-4 bg-blue-500 dark:bg-blue-400 rounded-full border-4 border-white dark:border-gray-800 z-10 hidden md:block"></div>
                            <div class="w-full md:w-1/2 md:pl-8"></div>
                        </div>
                        
                        <!-- Phase II -->
                        <div class="relative flex flex-col md:flex-row items-center">
                            <div class="w-full md:w-1/2 md:pr-8"></div>
                            <div class="absolute left-1/2 transform -translate-x-1/2 w-4 h-4 bg-green-500 dark:bg-green-400 rounded-full border-4 border-white dark:border-gray-800 z-10 hidden md:block"></div>
                            <div class="w-full md:w-1/2 md:pl-8 md:text-left mb-4 md:mb-0">
                                <div class="phase-badge inline-block bg-gradient-to-br from-green-500 to-green-700 dark:from-green-400 dark:to-green-600 text-white px-6 py-3 rounded-xl font-bold text-lg shadow-lg mb-3">
                                    Phase II
                                </div>
                                <h3 class="text-xl font-bold text-[#003366] dark:text-white mb-2">CMS Setup</h3>
                                <p class="text-gray-600 dark:text-gray-400">Filament Admin & Settings Modules</p>
                                <div class="mt-2 text-sm text-green-600 dark:text-green-400 font-medium">✓ Full control for Marcin & Wojtek</div>
                            </div>
                        </div>
                        
                        <!-- Phase III -->
                        <div class="relative flex flex-col md:flex-row items-center">
                            <div class="w-full md:w-1/2 md:pr-8 md:text-right mb-4 md:mb-0">
                                <div class="phase-badge inline-block bg-gradient-to-br from-yellow-500 to-yellow-700 dark:from-yellow-400 dark:to-yellow-600 text-white px-6 py-3 rounded-xl font-bold text-lg shadow-lg mb-3">
                                    Phase III
                                </div>
                                <h3 class="text-xl font-bold text-[#003366] dark:text-white mb-2">Front-End</h3>
                                <p class="text-gray-600 dark:text-gray-400">Tailwind 4 & Motion One Interactivity</p>
                                <div class="mt-2 text-sm text-yellow-600 dark:text-yellow-400 font-medium">✓ World-class visual experience</div>
                            </div>
                            <div class="absolute left-1/2 transform -translate-x-1/2 w-4 h-4 bg-yellow-500 dark:bg-yellow-400 rounded-full border-4 border-white dark:border-gray-800 z-10 hidden md:block"></div>
                            <div class="w-full md:w-1/2 md:pl-8"></div>
                        </div>
                        
                        <!-- Phase IV -->
                        <div class="relative flex flex-col md:flex-row items-center">
                            <div class="w-full md:w-1/2 md:pr-8"></div>
                            <div class="absolute left-1/2 transform -translate-x-1/2 w-4 h-4 bg-purple-500 dark:bg-purple-400 rounded-full border-4 border-white dark:border-gray-800 z-10 hidden md:block"></div>
                            <div class="w-full md:w-1/2 md:pl-8 md:text-left mb-4 md:mb-0">
                                <div class="phase-badge inline-block bg-gradient-to-br from-purple-500 to-purple-700 dark:from-purple-400 dark:to-purple-600 text-white px-6 py-3 rounded-xl font-bold text-lg shadow-lg mb-3">
                                    Phase IV
                                </div>
                                <h3 class="text-xl font-bold text-[#003366] dark:text-white mb-2">Lead Gen</h3>
                                <p class="text-gray-600 dark:text-gray-400">4-Step Wizard & Email Automation</p>
                                <div class="mt-2 text-sm text-purple-600 dark:text-purple-400 font-medium">✓ Automated sales pipeline</div>
                            </div>
                        </div>
                        
                        <!-- Phase V -->
                        <div class="relative flex flex-col md:flex-row items-center">
                            <div class="w-full md:w-1/2 md:pr-8 md:text-right mb-4 md:mb-0">
                                <div class="phase-badge inline-block bg-gradient-to-br from-red-500 to-red-700 dark:from-red-400 dark:to-red-600 text-white px-6 py-3 rounded-xl font-bold text-lg shadow-lg mb-3">
                                    Phase V
                                </div>
                                <h3 class="text-xl font-bold text-[#003366] dark:text-white mb-2">Launch</h3>
                                <p class="text-gray-600 dark:text-gray-400">SEO Optimization & Server Deployment</p>
                                <div class="mt-2 text-sm text-red-600 dark:text-red-400 font-medium">✓ Live, high-ranking platform</div>
                            </div>
                            <div class="absolute left-1/2 transform -translate-x-1/2 w-4 h-4 bg-red-500 dark:bg-red-400 rounded-full border-4 border-white dark:border-gray-800 z-10 hidden md:block"></div>
                            <div class="w-full md:w-1/2 md:pl-8"></div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Footer CTA -->
            <div class="proposal-section proposal-card bg-gradient-to-r from-[#003366] via-[#336699] to-[#003366] dark:from-gray-900 dark:via-gray-800 dark:to-gray-900 rounded-2xl shadow-2xl p-8 md:p-12 text-white relative overflow-hidden">
                <div class="absolute inset-0 bg-[url('data:image/svg+xml,%3Csvg width=\"60\" height=\"60\" viewBox=\"0 0 60 60\" xmlns=\"http://www.w3.org/2000/svg\"%3E%3Cg fill=\"none\" fill-rule=\"evenodd\"%3E%3Cg fill=\"%23ffffff\" fill-opacity=\"0.05\"%3E%3Cpath d=\"M36 34v-4h-2v4h-4v2h4v4h2v-4h4v-2h-4zm0-30V0h-2v4h-4v2h4v4h2V6h4V4h-4zM6 34v-4H4v4H0v2h4v4h2v-4h4v-2H6zM6 4V0H4v4H0v2h4v4h2V6h4V4H6z\"/%3E%3C/g%3E%3C/g%3E%3C/svg%3E')] opacity-20"></div>
                <div class="relative z-10 text-center">
                    <div class="inline-block px-6 py-3 bg-white/20 backdrop-blur-sm rounded-full text-lg font-semibold mb-6">
                        🚀 Ready to Transform Your Digital Presence?
                    </div>
                    <p class="text-xl md:text-2xl font-light text-blue-100 mb-4 max-w-3xl mx-auto">
                        This proposal represents a complete, production-ready solution designed specifically for 
                        <strong class="text-white">Blue Draft Corporation Company</strong>
                    </p>
                    <div class="mt-8 flex flex-wrap justify-center gap-4">
                        <div class="bg-white/10 backdrop-blur-sm rounded-lg px-6 py-3">
                            <div class="text-blue-200 text-sm">Status</div>
                            <div class="text-white font-bold">✅ Production Ready</div>
                        </div>
                        <div class="bg-white/10 backdrop-blur-sm rounded-lg px-6 py-3">
                            <div class="text-blue-200 text-sm">Version</div>
                            <div class="text-white font-bold">v1.1.0</div>
                        </div>
                        <div class="bg-white/10 backdrop-blur-sm rounded-lg px-6 py-3">
                            <div class="text-blue-200 text-sm">Last Updated</div>
                            <div class="text-white font-bold">December 2025</div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const sections = document.querySelectorAll('.proposal-section');
            
            const observerOptions = {
                threshold: 0.1,
                rootMargin: '0px 0px -50px 0px'
            };
            
            const observer = new IntersectionObserver((entries) => {
                entries.forEach((entry, index) => {
                    if (entry.isIntersecting) {
                        setTimeout(() => {
                            entry.target.classList.add('visible');
                        }, index * 100);
                        observer.unobserve(entry.target);
                    }
                });
            }, observerOptions);
            
            sections.forEach(section => {
                observer.observe(section);
            });
        });
    </script>
</body>
</html>
