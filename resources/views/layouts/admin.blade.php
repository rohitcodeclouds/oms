<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" x-data="{ 
        sidebarOpen: window.innerWidth > 1024, 
        darkMode: localStorage.getItem('theme') === 'light' ? false : true,
        profileOpen: false,
        notificationsOpen: false,
        toggleTheme() {
            this.darkMode = !this.darkMode;
            localStorage.setItem('theme', this.darkMode ? 'dark' : 'light');
        }
      }" :class="{ 'dark': darkMode }">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>@yield('title', 'Admin Dashboard') | {{ config('app.name', 'OMS') }}</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <!-- Toastr CSS -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css">

    <!-- Alpine.js -->
    <script defer src="https://unpkg.com/alpinejs@3.x.x/dist/cdn.min.js"></script>

    <script src="https://cdn.tailwindcss.com"></script>
    
    <script>
        tailwind.config = {
            darkMode: 'class',
            theme: {
                extend: {
                    fontFamily: { sans: ['Inter', 'sans-serif'] },
                    colors: {
                        primary: {
                            50: '#eff6ff',
                            100: '#dbeafe',
                            500: '#3c50e0',
                            600: '#2563eb',
                            700: '#1d4ed8',
                        },
                        neutral: {
                            800: '#1c2434',
                            900: '#1c2434',
                            850: '#1f1f1f',
                            950: '#0a0a0a'
                        },
                        body: '#f1f5f9'
                    }
                }
            }
        }
    </script>

    <style>
        body {
            font-family: 'Inter', sans-serif;
            scrollbar-width: thin;
            scrollbar-color: #d1d5db transparent;
        }

        .dark body {
            scrollbar-color: #333 transparent;
        }

        .glass {
            background: rgba(255, 255, 255, 1);
            backdrop-filter: blur(16px);
            border: 1px solid #e2e8f0;
            box-shadow: 0 4px 6px -1px rgb(0 0 0 / 0.1);
        }

        .dark .glass {
            background: rgba(255, 255, 255, 0.02);
            border-color: rgba(255, 255, 255, 0.05);
            box-shadow: none;
        }

        .sidebar-glass {
            background: #1c2434;
            backdrop-filter: none;
            border-right: 1px solid rgba(255, 255, 255, 0.05);
        }

        .dark .sidebar-glass {
            background: #1c2434;
        }

        @keyframes float {

            0%,
            100% {
                transform: translateY(0) rotate(0deg);
            }

            50% {
                transform: translateY(-20px) rotate(5deg);
            }
        }

        @keyframes float-delayed {

            0%,
            100% {
                transform: translateY(0) rotate(0deg);
            }

            50% {
                transform: translateY(25px) rotate(-5deg);
            }
        }

        .animate-float {
            animation: float 10s ease-in-out infinite;
        }

        .animate-float-delayed {
            animation: float-delayed 12s ease-in-out infinite;
        }

        [x-cloak] {
            display: none !important;
        }

        /* Custom Logo CSS */
        .oms-logo-icon {
            position: relative;
            width: 34px;
            height: 34px;
            background: linear-gradient(135deg, #3c50e0 0%, #2563eb 100%);
            border-radius: 10px;
            box-shadow: 0 4px 12px rgba(60, 80, 224, 0.2);
            display: flex;
            align-items: center;
            justify-content: center;
            overflow: hidden;
        }

        .dark .oms-logo-icon {
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.3);
        }

        .oms-logo-icon::after {
            content: '';
            position: absolute;
            width: 14px;
            height: 14px;
            border: 2px solid rgba(255, 255, 255, 0.8);
            border-radius: 2px;
            transform: rotate(45deg);
        }
    </style>
</head>

<!-- Animated Background -->
<div class="fixed top-0 left-0 w-full h-full overflow-hidden -z-10 bg-[#f1f5f9] dark:bg-[#0f172a]"
    id="background-container">
    <div
        class="absolute inset-0 bg-[radial-gradient(circle_at_top_right,rgba(60,80,224,0.08),transparent_40%),radial-gradient(circle_at_bottom_left,rgba(60,80,224,0.05),transparent_40%)]">
    </div>

    <div class="parallax-layer absolute inset-0 pointer-events-none opacity-40 dark:opacity-50" data-speed="0.04">
        <img src="{{ asset('images/cube-3d.png') }}"
            class="absolute top-[10%] left-[5%] w-24 mix-blend-multiply dark:mix-blend-screen animate-float blur-[1px] opacity-20 dark:opacity-40">
        <img src="{{ asset('images/sphere-3d.png') }}"
            class="absolute top-[60%] left-[15%] w-32 mix-blend-multiply dark:mix-blend-screen animate-float-delayed opacity-20 dark:opacity-40">
        <img src="{{ asset('images/pyramid-3d.png') }}"
            class="absolute top-[20%] right-[10%] w-28 mix-blend-multiply dark:mix-blend-screen animate-float opacity-20 dark:opacity-40">
        <img src="{{ asset('images/torus-3d.png') }}"
            class="absolute bottom-[10%] left-[40%] w-40 mix-blend-multiply dark:mix-blend-screen animate-float-delayed opacity-10 dark:opacity-30">
        <img src="{{ asset('images/octahedron-3d.png') }}"
            class="absolute bottom-[20%] right-[30%] w-24 mix-blend-multiply dark:mix-blend-screen animate-float opacity-20 dark:opacity-40">
    </div>

    <div class="absolute inset-0 opacity-[0.03] pointer-events-none"
        style="background-image: url('data:image/svg+xml,%3Csvg viewBox=%220 0 200 200%22 xmlns=%22http://www.w3.org/2000/svg%22%3E%3Cfilter id=%22noise%22%3E%3CfeTurbulence type=%22fractalNoise%22 baseFrequency=%220.65%22 numOctaves=%223%22 stitchTiles=%22stitch%22/%3E%3C/filter%3E%3Crect width=%22100%25%22 height=%22100%25%22 filter=%22url(%23noise)%22 opacity=%220.5%22/%3E%3C/svg%3E');">
    </div>
</div>

<div class="flex min-h-screen">
    <!-- Sidebar -->
    <aside class="sidebar-glass fixed left-0 top-0 h-full transition-all duration-300 z-50 overflow-hidden"
        :class="sidebarOpen ? 'w-64' : 'w-20 lg:w-20 w-0'" x-cloak>
        <div class="flex flex-col h-full">
            <!-- Logo -->
            <div class="flex items-center justify-between px-6 py-8">
                <div class="flex items-center space-x-3 overflow-hidden">
                    <div class="oms-logo-icon shrink-0"></div>
                    <span class="text-xl font-bold tracking-tight text-white whitespace-nowrap" x-show="sidebarOpen"
                        x-transition>OMS <span class="text-neutral-400 font-light">SYSTEM</span></span>
                </div>
            </div>

            <!-- Nav -->
            <nav class="flex-1 px-4 space-y-1 mt-4">
                <a href="{{ route('admin.dashboard') }}"
                    class="flex items-center p-3 rounded-lg transition-all group {{ Route::is('admin.dashboard') ? 'bg-primary-500 text-white' : 'text-neutral-400 hover:bg-neutral-800 hover:text-white' }}"
                    :class="sidebarOpen ? '' : 'justify-center'">
                    <svg class="w-5 h-5 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6" />
                    </svg>
                    <span class="ml-3 font-semibold text-sm" x-show="sidebarOpen" x-transition>Dashboard</span>
                </a>
                <a href="#"
                    class="flex items-center p-3 text-neutral-400 hover:bg-neutral-800 hover:text-white rounded-lg transition-all group"
                    :class="sidebarOpen ? '' : 'justify-center'">
                    <svg class="w-5 h-5 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M16 11V7a4 4 0 00-8 0v4M5 9h14l1 12H4L5 9z" />
                    </svg>
                    <span class="ml-3 font-medium text-sm" x-show="sidebarOpen" x-transition>Orders</span>
                </a>
                <a href="{{route('products.index')}}"
                    class="flex items-center p-3 text-neutral-400 hover:bg-neutral-800 hover:text-white rounded-lg transition-all group"
                    :class="sidebarOpen ? '' : 'justify-center'">
                    <svg class="w-5 h-5 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4" />
                    </svg>
                    <span class="ml-3 font-medium text-sm" x-show="sidebarOpen" x-transition>Products</span>
                </a>
                <a href="#"
                    class="flex items-center p-3 text-neutral-400 hover:bg-neutral-800 hover:text-white rounded-lg transition-all group"
                    :class="sidebarOpen ? '' : 'justify-center'">
                    <svg class="w-5 h-5 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z" />
                    </svg>
                    <span class="ml-3 font-medium text-sm" x-show="sidebarOpen" x-transition>Analytics</span>
                </a>
                <div class="pt-4 mt-4 border-t border-white/5">
                    <a href="#"
                        class="flex items-center p-3 text-neutral-400 hover:bg-neutral-800 hover:text-white rounded-lg transition-all group"
                        :class="sidebarOpen ? '' : 'justify-center'">
                        <svg class="w-5 h-5 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M10.325 4.317c.426-1.756 2.924-1.756 3.35 0a1.724 1.724 0 002.573 1.066c1.543-.94 3.31.826 2.37 2.37a1.724 1.724 0 001.065 2.572c1.756.426 1.756 2.924 0 3.35a1.724 1.724 0 00-1.066 2.573c.94 1.543-.826 3.31-2.37 2.37a1.724 1.724 0 00-2.572 1.065c-.426 1.756-2.924 1.756-3.35 0a1.724 1.724 0 00-2.573-1.066c-1.543.94-3.31-.826-2.37-2.37a1.724 1.724 0 00-1.065-2.572c-1.756-.426-1.756-2.924 0-3.35a1.724 1.724 0 001.066-2.573c-.94-1.543.826-3.31 2.37-2.37.996.608 2.296.07 2.572-1.065z" />
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                        </svg>
                        <span class="ml-3 font-medium text-sm" x-show="sidebarOpen" x-transition>Settings</span>
                    </a>
                </div>
            </nav>

            <!-- Toggle Sidebar -->
            <div class="p-4">
                <button @click="sidebarOpen = !sidebarOpen"
                    class="w-full h-10 flex items-center justify-center text-neutral-400 hover:text-neutral-900 dark:hover:text-white bg-black/5 dark:bg-white/5 rounded-xl transition-all">
                    <svg class="w-5 h-5 transition-transform duration-300" :class="sidebarOpen ? '' : 'rotate-180'"
                        fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M11 19l-7-7 7-7m8 14l-7-7 7-7" />
                    </svg>
                </button>
            </div>
        </div>
    </aside>

    <!-- Main Content Area -->
    <main class="flex-1 transition-all duration-300 min-h-screen" :class="sidebarOpen ? 'lg:ml-64' : 'ml-20 ml-0'">
        <!-- Header -->
        <header
            class="h-16 sm:h-20 glass sticky top-0 z-40 px-4 sm:px-8 flex items-center justify-between mx-4 sm:mx-6 mt-4 rounded-2xl shadow-sm">
            <!-- Left: Burger (Mobile) & Search -->
            <div class="flex items-center flex-1 space-x-4 max-w-xl">
                <button @click="sidebarOpen = !sidebarOpen"
                    class="lg:hidden p-2 text-neutral-500 hover:bg-black/5 dark:hover:bg-white/5 rounded-lg transition-colors">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M4 6h16M4 12h16m-7 6h7" />
                    </svg>
                </button>
                <div class="relative w-full group hidden sm:block">
                    <span
                        class="absolute left-4 top-1/2 -translate-y-1/2 text-neutral-400 group-focus-within:text-primary-500 transition-colors"><svg
                            class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" />
                        </svg></span>
                    <input type="text" placeholder="Search orders, customers..."
                        class="w-full bg-black/5 dark:bg-white/5 border border-transparent rounded-xl py-2 pl-11 pr-4 text-sm focus:outline-none focus:ring-2 focus:ring-primary-500/20 focus:bg-white dark:focus:bg-neutral-900 transition-all">
                </div>
            </div>

            <!-- Right: Theme, Notifications, Profile -->
            <div class="flex items-center space-x-2 sm:space-x-4 lg:space-x-6">
                <!-- Theme Toggle -->
                <button @click="toggleTheme()"
                    class="p-2 text-neutral-500 hover:bg-black/5 dark:hover:bg-white/5 rounded-xl transition-all">
                    <svg x-show="!darkMode" class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M20.354 15.354A9 9 0 018.646 3.646 9.003 9.003 0 0012 21a9.003 9.003 0 008.354-5.646z" />
                    </svg>
                    <svg x-show="darkMode" class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"
                        x-cloak>
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M12 3v1m0 16v1m9-9h-1M4 12H3m15.364-6.364l-.707.707M6.343 17.657l-.707.707m12.728 0l-.707-.707M6.343 6.343l-.707-.707M12 5a7 7 0 100 14 7 7 0 000-14z" />
                    </svg>
                </button>

                <!-- Notifications Dropdown -->
                <div class="relative" @click.away="notificationsOpen = false">
                    <button @click="notificationsOpen = !notificationsOpen"
                        class="relative p-2 text-neutral-500 hover:bg-black/5 dark:hover:bg-white/5 rounded-xl transition-all">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M15 17h5l-1.405-1.405A2.032 2.032 0 0118 14.158V11a6.002 6.002 0 00-4-5.659V5a2 2 0 10-4 0v.341C7.67 6.165 6 8.388 6 11v3.159c0 .538-.214 1.055-.595 1.436L4 17h5m6 0v1a3 3 0 11-6 0v-1m6 0H9" />
                        </svg>
                        <span
                            class="absolute top-1.5 right-1.5 w-2 h-2 bg-neutral-900 dark:bg-white rounded-full"></span>
                    </button>
                    <div x-show="notificationsOpen" x-transition
                        class="absolute right-0 mt-3 w-72 glass rounded-2xl z-50 overflow-hidden py-2 dark:bg-black"
                        x-cloak>
                        <div class="px-4 py-2 border-b border-black/15 dark:border-b-white/15">
                            <h4 class="text-xs font-bold uppercase tracking-widest text-neutral-400">
                                Notifications</h4>
                        </div>
                        <div class="max-h-64 overflow-y-auto">
                            <a href="#"
                                class="block px-4 py-3 hover:bg-black/10 dark:hover:bg-white/15 border-b border-black/5 dark:border-white/5 transition-colors">
                                <p class="text-xs font-semibold dark:text-white">New Order #ORD-25844</p>
                                <p class="text-[10px] text-neutral-500">2 minutes ago</p>
                            </a>
                            <a href="#"
                                class="block px-4 py-3 hover:bg-black/10 dark:hover:bg-white/15 border-b border-black/5 dark:border-white/5 transition-colors">
                                <p class="text-xs font-semibold text-amber-500">Low Stock Alert: Octahedron</p>
                                <p class="text-[10px] text-neutral-500">1 hour ago</p>
                            </a>
                            <a href="#"
                                class="block px-4 py-3 hover:bg-black/10 dark:hover:bg-white/15 transition-colors text-center py-4">
                                <p class="text-[10px] text-neutral-400">No more notifications</p>
                            </a>
                        </div>
                        <div class="px-4 py-2 border-t border-black/10 dark:border-white/15 text-center"><a href="#"
                                class="text-[10px] font-bold text-neutral-400 hover:text-neutral-900 dark:hover:text-white transition-colors uppercase">View
                                All</a></div>
                    </div>
                </div>

                <div class="h-8 w-px bg-black/5 dark:bg-white/10 hidden sm:block"></div>

                <!-- Profile Dropdown -->
                <div class="relative" @click.away="profileOpen = false">
                    <div class="flex items-center space-x-3 cursor-pointer group" @click="profileOpen = !profileOpen">
                        <div class="text-right hidden sm:block">
                            <p class="text-xs font-bold leading-tight">Admin User</p>
                            <p class="text-[10px] text-neutral-500 font-medium uppercase tracking-wider">Super Admin</p>
                        </div>
                        <div
                            class="w-9 h-9 rounded-xl glass p-0.5 group-hover:scale-105 transition-transform border-primary-500/20">
                            <img src="https://ui-avatars.com/api/?name=Admin&background=22c55e&color=fff"
                                class="w-full h-full rounded-[10px]" alt="Avatar">
                        </div>
                    </div>
                    <div x-show="profileOpen" x-transition
                        class="absolute right-0 mt-3 w-48 glass rounded-2xl shadow-xl z-50 overflow-hidden py-2 dark:bg-black"
                        x-cloak>
                        <a href="#"
                            class="flex items-center px-4 py-2.5 text-xs font-medium hover:bg-black/5 dark:hover:bg-white/5 dark:text-white transition-colors"><svg
                                class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" />
                            </svg> Edit Profile</a>
                        <a href="#"
                            class="flex items-center px-4 py-2.5 text-xs font-medium hover:bg-black/5 dark:hover:bg-white/5 dark:text-white transition-colors"><svg
                                class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path
                                    d="M18.364 5.636l-3.536 3.536m0 5.656l3.536 3.536M9.172 9.172L5.636 5.636m3.536 9.192l-3.536 3.536M21 12a9 9 0 11-18 0 9 9 0 0118 0zm-5 0a4 4 0 11-8 0 4 4 0 018 0z" />
                            </svg> Support</a>
                        <div class="border-t border-black/5 dark:border-white/5 my-1"></div>
                        <form method="POST" action="{{ route('logout') }}">
                            @csrf
                            <button type="submit"
                                class="w-full flex items-center px-4 py-2.5 text-xs font-bold text-neutral-500 hover:text-red-500 hover:bg-red-500/5 transition-colors">
                                <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path
                                        d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1" />
                                </svg> Sign Out
                            </button>
                        </form>
                    </div>
                </div>
            </div>
        </header>

        <!-- Breadcrumbs -->
        <div class="px-6 sm:px-10 mt-6 overflow-hidden">
            <nav
                class="flex text-neutral-400 text-[10px] sm:text-xs font-bold uppercase tracking-widest space-x-2 items-center">
                <a href="{{ route('admin.dashboard') }}" class="hover:text-primary-500 transition-colors">Admin</a>
                <svg class="w-3 h-3 text-neutral-300" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7" />
                </svg>
                <span class="text-neutral-800 dark:text-white font-bold">@yield('title', 'Dashboard')</span>
            </nav>
        </div>

        <!-- Page Content -->
        <div class="px-4 sm:px-10 py-6">
            @yield('content')
        </div>
    </main>
</div>

<!-- Mouse Parallax Script -->
<script>
    document.addEventListener('mousemove', (e) => {
        const layers = document.querySelectorAll('.parallax-layer');
        const x = (window.innerWidth - e.pageX * 2) / 100;
        const y = (window.innerHeight - e.pageY * 2) / 100;

        layers.forEach(layer => {
            const speed = layer.getAttribute('data-speed');
            layer.style.transform = `translateX(${x * speed * 80}px) translateY(${y * speed * 80}px)`;
            layer.style.transition = 'transform 0.25s cubic-bezier(0.33, 1, 0.68, 1)';
        });
    });
</script>
 <!-- jQuery (required) -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
<!-- Toastr JS -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>
<!-- Toastr Script -->
<script>
    toastr.options = {
        "closeButton": true,
        "progressBar": true,
        "positionClass": "toast-top-right",
        "timeOut": "3000"
    };
</script>
<script>
    document.addEventListener('DOMContentLoaded', () => {
        @if(session('success'))
            toastr.success(@json(session('success')));
        @endif

        @if(session('error'))
            toastr.error(@json(session('error')));
        @endif

        @if($errors->any())
            @foreach($errors->all() as $error)
                toastr.error(@json($error));
            @endforeach
        @endif

        @if(session('warning'))
            toastr.warning(@json(session('warning')));
        @endif

        @if(session('info'))
            toastr.info(@json(session('info')));
        @endif
    });
</script>

</body>

</html>