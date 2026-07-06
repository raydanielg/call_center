<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>@yield('title', config('app.name', 'Zerixa Call Center'))</title>
    <link rel="icon" type="image/png" href="{{ asset('images/logo/logo.png') }}">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800;900&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
    <script src="https://cdn.tailwindcss.com"></script>
    <script>
        tailwind.config = {
            darkMode: 'class',
            theme: {
                extend: {
                    colors: {
                        primary: {"50":"#eff6ff","100":"#dbeafe","200":"#bfdbfe","300":"#93c5fd","400":"#60a5fa","500":"#3b82f6","600":"#2563eb","700":"#1d4ed8","800":"#1e40af","900":"#1e3a8a","950":"#172554"}
                    },
                    fontFamily: {
                        'body': ['Inter','ui-sans-serif','system-ui','-apple-system','Segoe UI','Roboto','Helvetica Neue','Arial','sans-serif'],
                        'sans': ['Inter','ui-sans-serif','system-ui','-apple-system','Segoe UI','Roboto','Helvetica Neue','Arial','sans-serif']
                    }
                }
            }
        }
    </script>
    <style>
        body { font-family: 'Inter', ui-sans-serif, system-ui, sans-serif; }
        @keyframes fadeIn { from { opacity:0; transform:translateY(8px); } to { opacity:1; transform:translateY(0); } }
        .animate-fade { animation: fadeIn 0.3s ease-out both; }
        .sidebar-link { transition: all 0.2s ease; }
        .sidebar-link:hover { background: rgba(255,255,255,0.06); }
        .sidebar-link.active { background: rgba(255,255,255,0.1); color: #fff; border-left: 3px solid #3b82f6; }
        .sidebar-submenu { max-height: 0; overflow: hidden; transition: max-height 0.3s ease; }
        .sidebar-submenu.open { max-height: 500px; }
        ::-webkit-scrollbar { width: 5px; }
        ::-webkit-scrollbar-track { background: #1e3a8a; }
        ::-webkit-scrollbar-thumb { background: #2563eb; border-radius: 3px; }
        ::-webkit-scrollbar-thumb:hover { background: #3b82f6; }
        html.dark body { background-color: #111827; color: #e5e7eb; }
        html.dark .dash-card { background-color: #1e293b !important; border-color: #334155 !important; }
        html.dark .dash-header { background-color: rgba(17,24,39,0.9) !important; border-color: #334155 !important; }
        html.dark .dash-input { background-color: #0f172a !important; border-color: #334155 !important; color: #e2e8f0 !important; }
        html.dark .dash-text { color: #94a3b8 !important; }
        html.dark .dash-text-strong { color: #e2e8f0 !important; }
        html.dark .dash-hover:hover { background-color: #1e293b !important; }
        html.dark .dash-border { border-color: #334155 !important; }
        html.dark .dash-bg-subtle { background-color: #0f172a !important; }
        html.dark img[alt="Logo"] { filter: brightness(0) invert(1) !important; opacity: 0.9; }
    </style>
    <script>
        if (localStorage.getItem('theme') === 'dark' || (!localStorage.getItem('theme') && window.matchMedia('(prefers-color-scheme: dark)').matches)) {
            document.documentElement.classList.add('dark');
        }
    </script>
</head>
<body class="antialiased bg-gray-50 text-gray-900 min-h-screen">

    {{-- Mobile Overlay --}}
    <div id="mobileOverlay" class="fixed inset-0 bg-black/50 z-40 hidden lg:hidden" onclick="toggleSidebar()"></div>

    {{-- Sidebar --}}
    <aside id="dashSidebar" class="fixed top-0 left-0 z-50 w-64 h-screen bg-primary-900 transform -translate-x-full lg:translate-x-0 transition-transform duration-300 flex flex-col">
        {{-- Brand --}}
        <div class="h-16 flex items-center px-5 border-b border-primary-800/50 flex-shrink-0">
            <img src="{{ asset('images/logo/logo.png') }}" alt="Logo" class="h-8 w-auto">
            <span class="ml-2.5 text-white font-bold text-sm tracking-tight">Zerixa CC</span>
        </div>

        {{-- Menu (Role-based) --}}
        @role('super_admin')
            @include('layouts.sidebars.super-admin')
        @endrole
        @role('company_admin')
            @include('layouts.sidebars.company-admin')
        @endrole
        @role('supervisor')
            @include('layouts.sidebars.supervisor')
        @endrole
        @role('agent')
            @include('layouts.sidebars.agent')
        @endrole
        @role('qa_analyst')
            @include('layouts.sidebars.qa')
        @endrole

        {{-- Bottom User --}}
        <div class="p-4 border-t border-primary-800/50">
            <div class="flex items-center gap-3">
                <div class="w-9 h-9 rounded-full bg-primary-600 flex items-center justify-center text-white font-bold text-xs">
                    {{ strtoupper(substr(Auth::user()->name ?? Auth::user()->email ?? 'U', 0, 1)) }}
                </div>
                <div class="flex-1 min-w-0">
                    <p class="text-sm font-semibold text-white truncate">{{ Auth::user()->name ?? 'User' }}</p>
                    <p class="text-xs text-primary-300/60">{{ Auth::user()->email ?? '' }}</p>
                </div>
                <a href="{{ route('logout') }}" onclick="event.preventDefault(); document.getElementById('dash-logout').submit();" class="text-primary-300/60 hover:text-white transition-colors">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1"/></svg>
                </a>
                <form id="dash-logout" action="{{ route('logout') }}" method="POST" class="hidden">@csrf</form>
            </div>
        </div>
    </aside>

    {{-- Main Content --}}
    <div class="lg:ml-64 min-h-screen flex flex-col">

        {{-- Header --}}
        <header class="dash-header h-16 bg-white border-b border-gray-100 flex items-center justify-between px-4 sm:px-6 sticky top-0 z-30">
            <div class="flex items-center gap-3">
                <button onclick="toggleSidebar()" class="lg:hidden p-2 rounded-lg hover:bg-gray-100 text-gray-600">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"/></svg>
                </button>
                <h1 class="text-base sm:text-lg font-bold text-gray-900 dark:text-white">@yield('page_title', 'Dashboard')</h1>
            </div>
            <div class="flex items-center gap-2 sm:gap-4">
                {{-- Search --}}
                <div class="hidden md:flex items-center bg-gray-50 dash-bg-subtle rounded-lg px-3 py-1.5 border border-gray-100 dash-border">
                    <svg class="w-4 h-4 text-gray-400 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"/></svg>
                    <input type="text" placeholder="Search..." class="bg-transparent text-sm outline-none w-40 text-gray-600 dash-text-strong placeholder-gray-400">
                </div>

                {{-- Theme Toggle --}}
                <button onclick="toggleTheme()" class="p-2 rounded-lg hover:bg-gray-100 dash-hover text-gray-500 transition-colors">
                    <svg class="w-5 h-5 moon-icon" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 12.79A9 9 0 1 1 11.21 3 7 7 0 0 0 21 12.79z"/></svg>
                    <svg class="w-5 h-5 sun-icon hidden" fill="none" stroke="currentColor" viewBox="0 0 24 24"><circle cx="12" cy="12" r="5"/><line x1="12" y1="1" x2="12" y2="3"/><line x1="12" y1="21" x2="12" y2="23"/><line x1="4.22" y1="4.22" x2="5.64" y2="5.64"/><line x1="18.36" y1="18.36" x2="19.78" y2="19.78"/><line x1="1" y1="12" x2="3" y2="12"/><line x1="21" y1="12" x2="23" y2="12"/><line x1="4.22" y1="19.78" x2="5.64" y2="18.36"/><line x1="18.36" y1="5.64" x2="19.78" y2="4.22"/></svg>
                </button>

                {{-- Notifications --}}
                <button class="relative p-2 rounded-lg hover:bg-gray-100 dash-hover text-gray-500 transition-colors">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 17h5l-1.405-1.405A2.032 2.032 0 0118 14.158V11a6.002 6.002 0 00-4-5.659V5a2 2 0 10-4 0v.341C7.67 6.165 6 8.388 6 11v3.159c0 .538-.214 1.055-.595 1.436L4 17h5m6 0v1a3 3 0 11-6 0v-1m6 0H9"/></svg>
                    <span class="absolute top-1.5 right-1.5 w-2 h-2 bg-red-500 rounded-full"></span>
                </button>
            </div>
        </header>

        {{-- Page Content --}}
        <main class="flex-1 p-4 sm:p-6 animate-fade">
            @yield('content')
        </main>

    </div>

    <script>
        function toggleSidebar() {
            const sidebar = document.getElementById('dashSidebar');
            const overlay = document.getElementById('mobileOverlay');
            sidebar.classList.toggle('-translate-x-full');
            overlay.classList.toggle('hidden');
        }
        function toggleMenu(id) {
            const menu = document.getElementById(id);
            const arrow = document.getElementById('arrow-' + id.replace('menu-', ''));
            menu.classList.toggle('open');
            if (arrow) arrow.classList.toggle('rotate-180');
        }
        function toggleTheme() {
            const isDark = document.documentElement.classList.toggle('dark');
            localStorage.setItem('theme', isDark ? 'dark' : 'light');
            updateThemeIcon();
        }
        function updateThemeIcon() {
            const isDark = document.documentElement.classList.contains('dark');
            const moon = document.querySelector('.moon-icon');
            const sun = document.querySelector('.sun-icon');
            if (isDark) { moon.classList.add('hidden'); sun.classList.remove('hidden'); }
            else { moon.classList.remove('hidden'); sun.classList.add('hidden'); }
        }
        updateThemeIcon();
    </script>
    @stack('scripts')
</body>
</html>
