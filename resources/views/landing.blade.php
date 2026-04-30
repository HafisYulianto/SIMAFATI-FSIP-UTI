<!DOCTYPE html>
<html lang="en" class="scroll-smooth">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>SIMAFATI — FSIP Universitas Teknokrat Indonesia</title>
    <link rel="icon" href="{{ asset('images/favicon.png') }}" type="image/png">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">
    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <style>
        .glass-nav {
            background: rgba(255, 255, 255, 0.85);
            backdrop-filter: blur(12px);
            -webkit-backdrop-filter: blur(12px);
            border-bottom: 1px solid rgba(255, 255, 255, 0.3);
        }
        .text-gradient {
            background: linear-gradient(135deg, #10b981 0%, #047857 100%);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
        }
        .bg-hero {
            background: radial-gradient(circle at top right, rgba(16, 185, 129, 0.15), transparent 40%),
                        radial-gradient(circle at bottom left, rgba(4, 120, 87, 0.1), transparent 40%),
                        linear-gradient(to bottom right, #f8fafc, #f1f5f9);
        }
        .card-hover {
            transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
        }
        .card-hover:hover {
            transform: translateY(-5px);
            box-shadow: 0 20px 25px -5px rgba(16, 185, 129, 0.1), 0 10px 10px -5px rgba(16, 185, 129, 0.04);
            border-color: rgba(16, 185, 129, 0.3);
        }
    </style>
</head>
<body class="font-sans antialiased text-gray-800 bg-white" x-data="{ scrolled: false }" @scroll.window="scrolled = (window.pageYOffset > 20)">

    <!-- Navigation -->
    <nav :class="{ 'bg-primary-800 shadow-md': scrolled, 'bg-primary-700': !scrolled }" class="fixed w-full z-50 transition-all duration-300 py-4">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex justify-between items-center">
                <div class="flex items-center gap-4">
                    <img src="{{ asset('images/002-UTI.png') }}" alt="Logo UTI" class="h-20 w-auto object-contain drop-shadow-md">
                    <div>
                        <h1 class="text-2xl font-bold text-white leading-tight">SIMAFATI</h1>
                        <p class="text-sm text-primary-100 font-medium">FSIP Universitas Teknokrat</p>
                    </div>
                </div>
                <div class="hidden md:flex items-center space-x-8">
                    <a href="#about" class="text-sm font-medium text-white hover:text-primary-200 transition-colors">{{ __('landing.nav_about') }}</a>
                    <a href="#vision" class="text-sm font-medium text-white hover:text-primary-200 transition-colors">{{ __('landing.nav_vision') }}</a>
                    <a href="#programs" class="text-sm font-medium text-white hover:text-primary-200 transition-colors">{{ __('landing.nav_programs') }}</a>
                </div>
                <div class="flex items-center gap-4">
                    <!-- Language Switcher -->
                    <div class="relative" x-data="{ open: false }">
                        <button @click="open = !open" @click.away="open = false" class="flex items-center gap-1 text-white hover:text-primary-200 text-sm font-medium focus:outline-none">
                            {{ strtoupper(app()->getLocale()) }}
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path></svg>
                        </button>
                        <div x-show="open" style="display: none;" class="absolute right-0 mt-2 w-24 bg-white rounded-lg shadow-lg border border-gray-100 py-1 z-50">
                            <a href="{{ route('lang.switch', 'id') }}" class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-50 hover:text-primary-600">ID</a>
                            <a href="{{ route('lang.switch', 'en') }}" class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-50 hover:text-primary-600">EN</a>
                        </div>
                    </div>

                    @auth
                        <a href="{{ route('dashboard') }}" class="inline-flex items-center justify-center px-6 py-2.5 text-sm font-medium text-primary-700 transition-all bg-white rounded-full hover:bg-primary-50 shadow-sm hover:shadow-md">
                            {{ __('landing.nav_dashboard') }}
                        </a>
                    @else
                        <a href="{{ route('login') }}" class="inline-flex items-center justify-center px-6 py-2.5 text-sm font-medium text-primary-700 transition-all bg-white rounded-full hover:bg-primary-50 shadow-sm hover:shadow-md">
                            {{ __('landing.nav_login') }}
                        </a>
                    @endauth
                </div>
            </div>
        </div>
    </nav>

    <!-- Hero Section -->
    <section class="relative pt-32 pb-20 lg:pt-48 lg:pb-32 bg-hero overflow-hidden min-h-[90vh] flex items-center">
        <!-- Decorative blobs -->
        <div class="absolute top-1/4 right-0 -mr-32 w-96 h-96 bg-primary-300/30 rounded-full mix-blend-multiply filter blur-3xl opacity-70 animate-blob"></div>
        <div class="absolute bottom-1/4 left-0 -ml-32 w-96 h-96 bg-teal-300/30 rounded-full mix-blend-multiply filter blur-3xl opacity-70 animate-blob animation-delay-2000"></div>

        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 relative z-10">
            <div class="text-center max-w-4xl mx-auto">
                <div class="inline-flex items-center px-4 py-2 rounded-full bg-primary-50 border border-primary-100 text-primary-600 text-sm font-medium mb-8 fade-in">
                    <span class="flex h-2 w-2 rounded-full bg-primary-500 mr-2"></span>
                    {{ __('landing.hero_badge') }}
                </div>
                <h1 class="text-5xl md:text-7xl font-extrabold tracking-tight text-gray-900 mb-8 fade-in" style="animation-delay: 100ms;">
                    {{ __('landing.hero_title_1') }} <br class="hidden md:block">
                    <span class="text-gradient">{{ __('landing.hero_title_2') }}</span>
                </h1>
                <p class="mt-6 text-xl text-gray-600 leading-relaxed mb-10 fade-in max-w-3xl mx-auto" style="animation-delay: 200ms;">
                    {{ __('landing.hero_desc') }}
                </p>
                <div class="flex flex-col sm:flex-row justify-center gap-4 fade-in" style="animation-delay: 300ms;">
                    @auth
                        <a href="{{ route('dashboard') }}" class="px-8 py-4 text-base font-medium text-white bg-primary-600 rounded-full hover:bg-primary-700 transition-all shadow-xl shadow-primary-600/30 hover:scale-105">
                            {{ __('landing.hero_btn_dashboard') }}
                        </a>
                    @else
                        <a href="{{ route('login') }}" class="px-8 py-4 text-base font-medium text-white bg-primary-600 rounded-full hover:bg-primary-700 transition-all shadow-xl shadow-primary-600/30 hover:scale-105">
                            {{ __('landing.hero_btn_login') }}
                        </a>
                    @endauth
                    <a href="#about" class="px-8 py-4 text-base font-medium text-gray-700 bg-white border border-gray-200 rounded-full hover:bg-gray-50 hover:border-gray-300 transition-all">
                        {{ __('landing.hero_btn_learn') }}
                    </a>
                </div>
            </div>
        </div>
    </section>

    <!-- Vision & Mission Section -->
    <section id="vision" class="py-24 bg-white relative">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="text-center mb-16">
                <h2 class="text-sm font-bold text-primary-600 uppercase tracking-widest mb-2">{{ __('landing.vision_badge') }}</h2>
                <h3 class="text-3xl font-bold text-gray-900">{{ __('landing.vision_title') }}</h3>
            </div>

            <div class="grid lg:grid-cols-12 gap-12">
                <!-- Vision -->
                <div class="lg:col-span-4 flex flex-col">
                    <div class="bg-gradient-to-br from-primary-900 to-primary-800 rounded-3xl p-10 text-white shadow-2xl h-full relative overflow-hidden">
                        <!-- Abstract shape -->
                        <div class="absolute -right-10 -top-10 w-40 h-40 bg-white opacity-5 rounded-full blur-2xl"></div>
                        <div class="absolute right-20 bottom-10 w-20 h-20 bg-primary-400 opacity-20 rounded-full blur-xl"></div>
                        
                        <div class="w-14 h-14 bg-white/10 rounded-2xl backdrop-blur-md flex items-center justify-center mb-8 border border-white/20">
                            <svg class="w-7 h-7 text-primary-200" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" />
                            </svg>
                        </div>
                        <h4 class="text-2xl font-bold mb-6">{{ __('landing.vision_heading') }}</h4>
                        <p class="text-primary-100 leading-relaxed font-light text-lg italic">
                            {{ __('landing.vision_text') }}
                        </p>
                    </div>
                </div>

                <!-- Mission -->
                <div class="lg:col-span-8">
                    <div class="bg-gray-50 rounded-3xl p-10 border border-gray-100 h-full">
                        <div class="flex items-center gap-4 mb-8">
                            <div class="w-14 h-14 bg-white rounded-2xl shadow-sm border border-gray-100 flex items-center justify-center">
                                <svg class="w-7 h-7 text-primary-600" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z" />
                                </svg>
                            </div>
                            <h4 class="text-2xl font-bold text-gray-900">{{ __('landing.mission_heading') }}</h4>
                        </div>
                        <ul class="space-y-6">
                            <li class="flex gap-4">
                                <span class="flex-shrink-0 w-8 h-8 rounded-full bg-primary-100 text-primary-600 flex items-center justify-center font-bold text-sm">1</span>
                                <p class="text-gray-600 leading-relaxed">{{ __('landing.mission_1') }}</p>
                            </li>
                            <li class="flex gap-4">
                                <span class="flex-shrink-0 w-8 h-8 rounded-full bg-primary-100 text-primary-600 flex items-center justify-center font-bold text-sm">2</span>
                                <p class="text-gray-600 leading-relaxed">{{ __('landing.mission_2') }}</p>
                            </li>
                            <li class="flex gap-4">
                                <span class="flex-shrink-0 w-8 h-8 rounded-full bg-primary-100 text-primary-600 flex items-center justify-center font-bold text-sm">3</span>
                                <p class="text-gray-600 leading-relaxed">{{ __('landing.mission_3') }}</p>
                            </li>
                            <li class="flex gap-4">
                                <span class="flex-shrink-0 w-8 h-8 rounded-full bg-primary-100 text-primary-600 flex items-center justify-center font-bold text-sm">4</span>
                                <p class="text-gray-600 leading-relaxed">{{ __('landing.mission_4') }}</p>
                            </li>
                            <li class="flex gap-4">
                                <span class="flex-shrink-0 w-8 h-8 rounded-full bg-primary-100 text-primary-600 flex items-center justify-center font-bold text-sm">5</span>
                                <p class="text-gray-600 leading-relaxed">{{ __('landing.mission_5') }}</p>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Faculty Goals -->
    <section class="py-24 bg-slate-50 border-y border-slate-200">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="text-center mb-16">
                <h2 class="text-sm font-bold text-primary-600 uppercase tracking-widest mb-2">{{ __('landing.goals_badge') }}</h2>
                <h3 class="text-3xl font-bold text-gray-900">{{ __('landing.goals_title') }}</h3>
            </div>

            <div class="grid md:grid-cols-2 lg:grid-cols-3 gap-6">
                <!-- Goal 1 -->
                <div class="bg-white rounded-2xl p-8 border border-gray-100 shadow-sm card-hover">
                    <div class="w-12 h-12 bg-primary-50 rounded-xl flex items-center justify-center mb-6">
                        <svg class="w-6 h-6 text-primary-600" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z" />
                        </svg>
                    </div>
                    <p class="text-gray-700 leading-relaxed font-medium">{{ __('landing.goal_1') }}</p>
                </div>
                
                <!-- Goal 2 -->
                <div class="bg-white rounded-2xl p-8 border border-gray-100 shadow-sm card-hover">
                    <div class="w-12 h-12 bg-primary-50 rounded-xl flex items-center justify-center mb-6">
                        <svg class="w-6 h-6 text-primary-600" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19.428 15.428a2 2 0 00-1.022-.547l-2.387-.477a6 6 0 00-3.86.517l-.318.158a6 6 0 01-3.86.517L6.05 15.21a2 2 0 00-1.806.547M8 4h8l-1 1v5.172a2 2 0 00.586 1.414l5 5c1.26 1.26.367 3.414-1.415 3.414H4.828c-1.782 0-2.674-2.154-1.414-3.414l5-5A2 2 0 009 10.172V5L8 4z" />
                        </svg>
                    </div>
                    <p class="text-gray-700 leading-relaxed font-medium">{{ __('landing.goal_2') }}</p>
                </div>

                <!-- Goal 3 -->
                <div class="bg-white rounded-2xl p-8 border border-gray-100 shadow-sm card-hover">
                    <div class="w-12 h-12 bg-primary-50 rounded-xl flex items-center justify-center mb-6">
                        <svg class="w-6 h-6 text-primary-600" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 12a9 9 0 01-9 9m9-9a9 9 0 00-9-9m9 9H3m9 9a9 9 0 01-9-9m9 9c1.657 0 3-4.03 3-9s-1.343-9-3-9m0 18c-1.657 0-3-4.03-3-9s1.343-9 3-9m-9 9a9 9 0 019-9" />
                        </svg>
                    </div>
                    <p class="text-gray-700 leading-relaxed font-medium">{{ __('landing.goal_3') }}</p>
                </div>

                <!-- Goal 4 -->
                <div class="bg-white rounded-2xl p-8 border border-gray-100 shadow-sm card-hover md:col-span-2 lg:col-span-1">
                    <div class="w-12 h-12 bg-primary-50 rounded-xl flex items-center justify-center mb-6">
                        <svg class="w-6 h-6 text-primary-600" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z" />
                        </svg>
                    </div>
                    <p class="text-gray-700 leading-relaxed font-medium">{{ __('landing.goal_4') }}</p>
                </div>

                <!-- Goal 5 -->
                <div class="bg-white rounded-2xl p-8 border border-gray-100 shadow-sm card-hover md:col-span-2 lg:col-span-2">
                    <div class="w-12 h-12 bg-primary-50 rounded-xl flex items-center justify-center mb-6">
                        <svg class="w-6 h-6 text-primary-600" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 3v2m6-2v2M9 19v2m6-2v2M5 9H3m2 6H3m18-6h-2m2 6h-2M7 19h10a2 2 0 002-2V7a2 2 0 00-2-2H7a2 2 0 00-2 2v10a2 2 0 002 2zM9 9h6v6H9V9z" />
                        </svg>
                    </div>
                    <p class="text-gray-700 leading-relaxed font-medium">{{ __('landing.goal_5') }}</p>
                </div>
            </div>
        </div>
    </section>

    <!-- Programs Section -->
    <section id="programs" class="py-24 bg-white">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="text-center mb-16">
                <h2 class="text-sm font-bold text-primary-600 uppercase tracking-widest mb-2">{{ __('landing.programs_badge') }}</h2>
                <h3 class="text-3xl font-bold text-gray-900">{{ __('landing.programs_title') }}</h3>
            </div>

            <div class="grid sm:grid-cols-2 lg:grid-cols-4 gap-6">
                <!-- Sastra Inggris -->
                <div class="group border border-gray-100 rounded-3xl p-8 hover:border-primary-200 hover:shadow-xl transition-all duration-300 hover:-translate-y-1 bg-white relative overflow-hidden">
                    <div class="absolute inset-0 bg-gradient-to-br from-primary-50/50 to-transparent opacity-0 group-hover:opacity-100 transition-opacity duration-300"></div>
                    <div class="w-14 h-14 bg-blue-50 rounded-2xl flex items-center justify-center mb-6 group-hover:bg-primary-600 transition-colors duration-300 relative z-10">
                        <svg class="w-7 h-7 text-blue-600 group-hover:text-white transition-colors duration-300" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253" />
                        </svg>
                    </div>
                    <h4 class="text-xl font-bold text-gray-900 mb-2 relative z-10">{{ __('landing.prog_si_title') }}</h4>
                    <p class="text-gray-500 text-sm relative z-10">{{ __('landing.prog_si_desc') }}</p>
                </div>

                <!-- Pendidikan Bahasa Inggris -->
                <div class="group border border-gray-100 rounded-3xl p-8 hover:border-primary-200 hover:shadow-xl transition-all duration-300 hover:-translate-y-1 bg-white relative overflow-hidden">
                    <div class="absolute inset-0 bg-gradient-to-br from-primary-50/50 to-transparent opacity-0 group-hover:opacity-100 transition-opacity duration-300"></div>
                    <div class="w-14 h-14 bg-emerald-50 rounded-2xl flex items-center justify-center mb-6 group-hover:bg-primary-600 transition-colors duration-300 relative z-10">
                        <svg class="w-7 h-7 text-emerald-600 group-hover:text-white transition-colors duration-300" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 5h12M9 3v2m1.048 9.5A18.022 18.022 0 016.412 9m6.088 9h7M11 21l5-10 5 10M12.751 5C11.783 10.77 8.07 15.61 3 18.129" />
                        </svg>
                    </div>
                    <h4 class="text-xl font-bold text-gray-900 mb-2 relative z-10">{{ __('landing.prog_pbi_title') }}</h4>
                    <p class="text-gray-500 text-sm relative z-10">{{ __('landing.prog_pbi_desc') }}</p>
                </div>

                <!-- Pendidikan Olahraga -->
                <div class="group border border-gray-100 rounded-3xl p-8 hover:border-primary-200 hover:shadow-xl transition-all duration-300 hover:-translate-y-1 bg-white relative overflow-hidden">
                    <div class="absolute inset-0 bg-gradient-to-br from-primary-50/50 to-transparent opacity-0 group-hover:opacity-100 transition-opacity duration-300"></div>
                    <div class="w-14 h-14 bg-orange-50 rounded-2xl flex items-center justify-center mb-6 group-hover:bg-primary-600 transition-colors duration-300 relative z-10">
                        <svg class="w-7 h-7 text-orange-600 group-hover:text-white transition-colors duration-300" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14.752 11.168l-3.197-2.132A1 1 0 0010 9.87v4.263a1 1 0 001.555.832l3.197-2.132a1 1 0 000-1.664z" />
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                        </svg>
                    </div>
                    <h4 class="text-xl font-bold text-gray-900 mb-2 relative z-10">{{ __('landing.prog_por_title') }}</h4>
                    <p class="text-gray-500 text-sm relative z-10">{{ __('landing.prog_por_desc') }}</p>
                </div>

                <!-- Pendidikan Matematika -->
                <div class="group border border-gray-100 rounded-3xl p-8 hover:border-primary-200 hover:shadow-xl transition-all duration-300 hover:-translate-y-1 bg-white relative overflow-hidden">
                    <div class="absolute inset-0 bg-gradient-to-br from-primary-50/50 to-transparent opacity-0 group-hover:opacity-100 transition-opacity duration-300"></div>
                    <div class="w-14 h-14 bg-indigo-50 rounded-2xl flex items-center justify-center mb-6 group-hover:bg-primary-600 transition-colors duration-300 relative z-10">
                        <svg class="w-7 h-7 text-indigo-600 group-hover:text-white transition-colors duration-300" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 7h6m0 10v-3m-3 3h.01M9 17h.01M9 14h.01M12 14h.01M15 11h.01M12 11h.01M9 11h.01M7 21h10a2 2 0 002-2V5a2 2 0 00-2-2H7a2 2 0 00-2 2v14a2 2 0 002 2z" />
                        </svg>
                    </div>
                    <h4 class="text-xl font-bold text-gray-900 mb-2 relative z-10">{{ __('landing.prog_pm_title') }}</h4>
                    <p class="text-gray-500 text-sm relative z-10">{{ __('landing.prog_pm_desc') }}</p>
                </div>
            </div>
        </div>
    </section>

    <!-- Footer -->
    <footer class="bg-gray-900 pt-16 pb-8 border-t border-gray-800 text-white">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex flex-col md:flex-row justify-between items-center gap-6">
                <div class="flex items-center gap-4">
                    <img src="{{ asset('images/002-UTI.png') }}" alt="Logo UTI" class="h-20 w-auto object-contain bg-white rounded-xl p-1">
                    <div>
                        <h2 class="text-2xl font-bold text-white">SIMAFATI</h2>
                        <p class="text-gray-400 text-sm">{{ __('landing.footer_faculty') }}</p>
                    </div>
                </div>
                <div class="text-gray-400 text-sm text-center md:text-right">
                    <p>&copy; {{ date('Y') }} Universitas Teknokrat Indonesia.</p>
                    <p>{{ __('landing.footer_rights') }}</p>
                </div>
            </div>
        </div>
    </footer>

</body>
</html>
