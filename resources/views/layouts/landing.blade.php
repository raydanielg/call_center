<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>@yield('title', config('app.name', 'Zerixa Call Center - For Business'))</title>

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800;900&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css">
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">

    <script>
        tailwind.config = {
            darkMode: 'class',
            theme: {
                extend: {
                    colors: {
                        primary: {"50":"#eff6ff","100":"#dbeafe","200":"#bfdbfe","300":"#93c5fd","400":"#60a5fa","500":"#3b82f6","600":"#2563eb","700":"#1d4ed8","800":"#1e40af","900":"#1e3a8a","950":"#172554"}
                    },
                    fontFamily: {
                        'body': ['Inter','ui-sans-serif','system-ui','-apple-system','system-ui','Segoe UI','Roboto','Helvetica Neue','Arial','Noto Sans','sans-serif','Apple Color Emoji','Segoe UI Emoji','Segoe UI Symbol','Noto Color Emoji'],
                        'sans': ['Inter','ui-sans-serif','system-ui','-apple-system','system-ui','Segoe UI','Roboto','Helvetica Neue','Arial','Noto Sans','sans-serif','Apple Color Emoji','Segoe UI Emoji','Segoe UI Symbol','Noto Color Emoji']
                    }
                }
            }
        }
    </script>
    <script>
        if (localStorage.getItem('theme') === 'dark' || (!localStorage.getItem('theme') && window.matchMedia('(prefers-color-scheme: dark)').matches)) {
            document.documentElement.classList.add('dark');
        }
    </script>

    <style>
        body { font-family: 'Inter', ui-sans-serif, system-ui, sans-serif; }
        .hero-gradient {
            background: linear-gradient(135deg, #1e3a8a 0%, #1d4ed8 50%, #2563eb 100%);
        }
        .hero-overlay {
            background: linear-gradient(180deg, rgba(15,23,42,0.75) 0%, rgba(29,78,216,0.55) 50%, rgba(15,23,42,0.75) 100%);
        }
        @keyframes heroZoom {
            from { transform: scale(1); }
            to { transform: scale(1.12); }
        }
        .hero-bg-img {
            animation: heroZoom 20s ease-in-out infinite alternate;
        }
        @keyframes floatY {
            0%, 100% { transform: translateY(0); }
            50% { transform: translateY(-12px); }
        }
        .hero-float { animation: floatY 4s ease-in-out infinite; }
        .featured-logo {
            transition: all 0.3s cubic-bezier(0.16,1,0.3,1);
            filter: grayscale(1) opacity(0.5);
        }
        .featured-logo:hover {
            filter: grayscale(0) opacity(1);
            transform: scale(1.05);
        }
        .section-fade {
            opacity: 0;
            transform: translateY(40px);
            transition: opacity 0.7s cubic-bezier(0.16,1,0.3,1), transform 0.7s cubic-bezier(0.16,1,0.3,1);
        }
        .section-fade.visible {
            opacity: 1;
            transform: translateY(0);
        }
        .nav-link {
            position: relative;
        }
        .nav-link::after {
            content: '';
            position: absolute;
            bottom: -2px;
            left: 0;
            width: 0;
            height: 2px;
            background: #2563eb;
            border-radius: 2px;
            transition: width 0.3s cubic-bezier(0.16,1,0.3,1);
        }
        .nav-link:hover::after { width: 100%; }
        .feature-card {
            transition: transform 0.4s cubic-bezier(0.16,1,0.3,1), box-shadow 0.4s ease;
        }
        .feature-card:hover {
            transform: translateY(-8px);
            box-shadow: 0 20px 50px rgba(29,78,216,0.12);
        }
        .stat-counter {
            font-variant-numeric: tabular-nums;
        }
        html.dark body { background-color: #111827; color: #e5e7eb; }
        html.dark .hero-overlay {
            background: linear-gradient(180deg, rgba(17,24,39,0.85) 0%, rgba(29,78,216,0.6) 50%, rgba(17,24,39,0.85) 100%);
        }
        html.dark .landing-card { background-color: #1e293b !important; border-color: #334155 !important; }
        html.dark .landing-text-muted { color: #94a3b8 !important; }
        html.dark .landing-border { border-color: #334155 !important; }
        html.dark .landing-bg-light { background-color: #0f172a !important; }
        html.dark .landing-bg-white { background-color: #1e293b !important; }
        html.dark img[alt="Logo"] { filter: brightness(0) invert(1) !important; opacity: 0.9; }
        .theme-toggle-landing {
            position: fixed;
            top: 20px;
            right: 20px;
            z-index: 60;
            width: 44px;
            height: 44px;
            border-radius: 12px;
            display: flex;
            align-items: center;
            justify-content: center;
            cursor: pointer;
            transition: all 0.3s cubic-bezier(0.16,1,0.3,1);
            border: 1px solid #e5e7eb;
            background: rgba(255,255,255,0.8);
            backdrop-filter: blur(8px);
            box-shadow: 0 2px 12px rgba(0,0,0,0.06);
        }
        html.dark .theme-toggle-landing {
            background: rgba(30,41,59,0.8);
            border-color: #334155;
        }
        .theme-toggle-landing:hover { transform: scale(1.08); }
        .theme-toggle-landing .sun-icon { display: none; }
        .theme-toggle-landing .moon-icon { display: block; }
        html.dark .theme-toggle-landing .sun-icon { display: block; }
        html.dark .theme-toggle-landing .moon-icon { display: none; }
        .mobile-menu { transition: max-height 0.4s cubic-bezier(0.16,1,0.3,1); overflow: hidden; }
    </style>
</head>
<body class="antialiased text-gray-900 min-h-screen bg-white dark:bg-gray-900 dark:text-gray-100">

    {{-- Theme Toggle --}}
    <div class="theme-toggle-landing" onclick="toggleTheme()">
        <svg class="moon-icon" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="#1f2937" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M21 12.79A9 9 0 1 1 11.21 3 7 7 0 0 0 21 12.79z"/></svg>
        <svg class="sun-icon" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="#3b82f6" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><circle cx="12" cy="12" r="5"/><line x1="12" y1="1" x2="12" y2="3"/><line x1="12" y1="21" x2="12" y2="23"/><line x1="4.22" y1="4.22" x2="5.64" y2="5.64"/><line x1="18.36" y1="18.36" x2="19.78" y2="19.78"/><line x1="1" y1="12" x2="3" y2="12"/><line x1="21" y1="12" x2="23" y2="12"/><line x1="4.22" y1="19.78" x2="5.64" y2="18.36"/><line x1="18.36" y1="5.64" x2="19.78" y2="4.22"/></svg>
    </div>
    <script>
    function toggleTheme() {
        const isDark = document.documentElement.classList.toggle('dark');
        localStorage.setItem('theme', isDark ? 'dark' : 'light');
    }
    </script>

    @yield('content')

    <script>
    // Scroll reveal animation
    (function() {
        const observer = new IntersectionObserver((entries) => {
            entries.forEach(entry => {
                if (entry.isIntersecting) {
                    entry.target.classList.add('visible');
                }
            });
        }, { threshold: 0.1 });
        document.querySelectorAll('.section-fade').forEach(el => observer.observe(el));
    })();
    </script>
</body>
</html>
