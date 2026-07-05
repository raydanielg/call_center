<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>@yield('title', config('app.name', 'Laravel'))</title>

    <link rel="dns-prefetch" href="//fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=Nunito:400,500,600,700,800,900&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.min.css">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.all.min.js"></script>
    <script src="https://cdn.tailwindcss.com"></script>
    <meta http-equiv="Cache-Control" content="no-store, no-cache, must-revalidate, max-age=0">
    <meta http-equiv="Pragma" content="no-cache">
    <meta http-equiv="Expires" content="0">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="referrer" content="strict-origin-when-cross-origin">

    <style>
        @keyframes simpleFadeIn { from { opacity:0; transform:translateY(12px); } to { opacity:1; transform:translateY(0); } }
        @keyframes scaleIn { from { opacity:0; transform:scale(0.8); } to { opacity:1; transform:scale(1); } }
        @keyframes checkDraw { from { stroke-dashoffset:30; } to { stroke-dashoffset:0; } }
        @keyframes ajaxProgress { 0% { background-position: 100% 0; } 100% { background-position: -100% 0; } }
        @keyframes btnSpin { to { transform: rotate(360deg); } }
        .ajax-loader { position:fixed; top:0; left:0; right:0; height:3px; background: linear-gradient(90deg, #024938, #f9ac00, #024938); background-size: 200% 100%; animation: ajaxProgress 1s linear infinite; z-index:9999; display:none; }
        .btn-spinner { display:inline-block; width:18px; height:18px; border:2.5px solid rgba(255,255,255,0.4); border-top-color:#fff; border-radius:50%; animation: btnSpin 0.6s linear infinite; }
        .btn-spinner-dark { display:inline-block; width:18px; height:18px; border:2.5px solid rgba(0,0,0,0.2); border-top-color:#1f2937; border-radius:50%; animation: btnSpin 0.6s linear infinite; }
        .btn-loading { pointer-events:none; opacity:0.75; }

        .swal2-toast-custom {
            font-family: 'Nunito', sans-serif !important;
            border-radius: 12px !important;
            box-shadow: 0 10px 40px rgba(0,0,0,0.08), 0 2px 10px rgba(0,0,0,0.04) !important;
            border: 1px solid #f0f0f0 !important;
            padding: 14px 18px !important;
            margin: 10px !important;
            min-width: 300px !important;
        }
        .swal2-toast-custom .swal2-title {
            font-size: 14px !important;
            font-weight: 700 !important;
            color: #1f2937 !important;
            margin: 0 0 2px 0 !important;
        }
        .swal2-toast-custom .swal2-html-container {
            font-size: 13px !important;
            color: #6b7280 !important;
            margin: 0 !important;
        }
        .swal2-toast-custom .swal2-icon {
            margin: 0 12px 0 0 !important;
        }
        .swal2-toast-custom .swal2-timer-progress-bar {
            background: linear-gradient(90deg, #047857, #f9ac00) !important;
            height: 3px !important;
        }
        .swal2-container {
            z-index: 99999 !important;
        }

        .theme-toggle {
            position: fixed;
            top: 20px;
            right: 20px;
            z-index: 50;
            width: 48px;
            height: 48px;
            border-radius: 14px;
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
        .theme-toggle:hover {
            transform: scale(1.08);
            box-shadow: 0 4px 20px rgba(0,0,0,0.1);
        }
        .theme-toggle:active { transform: scale(0.95); }
        .theme-toggle .sun-icon, .theme-toggle .moon-icon {
            transition: all 0.3s cubic-bezier(0.16,1,0.3,1);
        }
        html.dark .theme-toggle {
            background: rgba(30,41,59,0.8);
            border-color: #334155;
        }
        .theme-toggle .sun-icon { display: none; }
        .theme-toggle .moon-icon { display: block; }
        html.dark .theme-toggle .sun-icon { display: block; }
        html.dark .theme-toggle .moon-icon { display: none; }

        html.dark .auth-bg {
            background: linear-gradient(to bottom right, #0f172a, #1e293b, #0f172a) !important;
        }
        html.dark .auth-bg .auth-dot {
            background-image: radial-gradient(rgba(255,255,255,0.04) 2px, transparent 2.5px) !important;
        }
        html.dark .auth-bg .auth-blob-1 {
            background-color: rgba(4,73,56,0.3) !important;
        }
        html.dark .auth-bg .auth-blob-2 {
            background-color: rgba(249,172,0,0.15) !important;
        }

        .auth-image-col {
            position: relative;
            overflow: hidden;
        }
        .auth-image-col .auth-img-bg {
            position: absolute;
            inset: 0;
            background-size: cover;
            background-position: center;
            transition: transform 0.5s ease;
        }
        .auth-image-col:hover .auth-img-bg {
            transform: scale(1.05);
        }
        .auth-image-col .auth-img-overlay {
            position: absolute;
            inset: 0;
            background: linear-gradient(135deg, rgba(2,73,56,0.85), rgba(4,120,87,0.7), rgba(6,95,70,0.85));
        }
        .auth-image-col .auth-img-content {
            position: relative;
            z-index: 2;
        }
        .auth-image-col .auth-floating-shape {
            position: absolute;
            border-radius: 50%;
            backdrop-filter: blur(10px);
            animation: floatShape 6s ease-in-out infinite;
        }
        @keyframes floatShape {
            0%, 100% { transform: translateY(0) rotate(0deg); }
            50% { transform: translateY(-20px) rotate(5deg); }
        }
        html.dark .auth-image-col .auth-img-overlay {
            background: linear-gradient(135deg, rgba(15,23,42,0.9), rgba(30,41,59,0.8), rgba(15,23,42,0.9)) !important;
        }
        html.dark .auth-image-col .auth-img-content h2 { color: #f1f5f9 !important; }
        html.dark .auth-image-col .auth-img-content p { color: #94a3b8 !important; }
        html.dark .auth-image-col .auth-feature-card {
            background-color: rgba(30,41,59,0.6) !important;
            border-color: rgba(51,65,85,0.5) !important;
        }
        html.dark .auth-image-col .auth-feature-card span { color: #cbd5e1 !important; }
        html.dark .auth-image-col .auth-feature-card svg { color: #34d399 !important; }
        html.dark .auth-image-col .auth-stat-number { color: #f9ac00 !important; }
        html.dark .auth-image-col .auth-stat-label { color: #64748b !important; }

        html.dark .auth-card {
            background-color: #1e293b !important;
            border-color: #334155 !important;
        }
        html.dark .auth-card h2 { color: #f1f5f9 !important; }
        html.dark .auth-card p { color: #94a3b8 !important; }
        html.dark .auth-card label { color: #cbd5e1 !important; }
        html.dark .auth-card input {
            background-color: #0f172a !important;
            border-color: #334155 !important;
            color: #e2e8f0 !important;
        }
        html.dark .auth-card input::placeholder { color: #475569 !important; }
        html.dark .auth-card input:focus {
            border-color: #024938 !important;
            box-shadow: 0 0 0 2px rgba(4,73,56,0.3) !important;
        }
        html.dark .auth-card .auth-divider { border-color: #334155 !important; }
        html.dark .auth-card .auth-divider span { background-color: #1e293b !important; color: #475569 !important; }
        html.dark .auth-card a { color: #34d399 !important; }
        html.dark .auth-card .auth-link { color: #64748b !important; }
        html.dark .auth-card .auth-link:hover { color: #34d399 !important; }
        html.dark .auth-card .auth-footer { color: #334155 !important; }
        html.dark .auth-card .auth-status-success {
            background-color: rgba(4,73,56,0.15) !important;
            border-color: rgba(4,73,56,0.3) !important;
            color: #34d399 !important;
        }
        html.dark .auth-card .auth-status-error {
            background-color: rgba(127,29,29,0.15) !important;
            border-color: rgba(127,29,29,0.3) !important;
            color: #fca5a5 !important;
        }
        html.dark .auth-card .auth-icon { color: #475569 !important; }
        html.dark .auth-card svg { color: #475569 !important; }
        html.dark .auth-card .auth-checkbox { background-color: #0f172a !important; border-color: #334155 !important; }
        html.dark .auth-card .auth-code-input {
            background-color: #0f172a !important;
            border-color: #334155 !important;
            color: #e2e8f0 !important;
        }
        html.dark .auth-card .auth-code-input:focus {
            border-color: #024938 !important;
            box-shadow: 0 0 0 2px rgba(4,73,56,0.3) !important;
        }
        html.dark .auth-card .auth-email-badge {
            background-color: #0f172a !important;
            border-color: #334155 !important;
        }
        html.dark .auth-card .auth-email-badge span { color: #94a3b8 !important; }
        html.dark .auth-card .auth-secondary-btn {
            background-color: #0f172a !important;
            border-color: #334155 !important;
            color: #94a3b8 !important;
        }
        html.dark .auth-card .auth-secondary-btn:hover {
            background-color: #1e293b !important;
        }
        html.dark .auth-card .auth-step {
            background-color: rgba(4,73,56,0.15) !important;
            color: #34d399 !important;
        }
        html.dark .auth-card .auth-decor-1 { background-color: rgba(4,73,56,0.2) !important; }
        html.dark .auth-card .auth-decor-2 { background-color: rgba(4,73,56,0.1) !important; }
        html.dark .auth-card .auth-decor-3 { background-color: rgba(249,172,0,0.15) !important; }
        html.dark .auth-card .auth-decor-4 { background-color: rgba(249,172,0,0.1) !important; }
        html.dark .auth-card .auth-text-muted { color: #64748b !important; }
        html.dark .auth-card .auth-text-body { color: #94a3b8 !important; }
        html.dark .auth-card .text-gray-500 { color: #64748b !important; }
        html.dark .auth-card .text-gray-600 { color: #94a3b8 !important; }
        html.dark .auth-card .text-gray-700 { color: #cbd5e1 !important; }
        html.dark .auth-card .bg-gray-50 { background-color: #0f172a !important; }
        html.dark .auth-card .border-gray-100 { border-color: #1e293b !important; }
        html.dark .auth-card .border-gray-200 { border-color: #334155 !important; }

        html.dark .auth-navbar {
            background-color: rgba(15,23,42,0.8) !important;
            border-color: #1e293b !important;
        }
        html.dark .auth-navbar span { color: #94a3b8 !important; }
        html.dark .auth-navbar a { color: #94a3b8 !important; }
        html.dark .auth-navbar a:hover { color: #fca5a5 !important; }

        html.dark .swal2-toast-custom {
            background-color: #1e293b !important;
            border-color: #334155 !important;
            box-shadow: 0 10px 40px rgba(0,0,0,0.3) !important;
        }
        html.dark .swal2-toast-custom .swal2-title { color: #f1f5f9 !important; }
        html.dark .swal2-toast-custom .swal2-html-container { color: #94a3b8 !important; }
    </style>
    <script>
        tailwind.config = {
            darkMode: 'class',
            theme: {
                extend: {
                    colors: {
                        emerald: { 50:'#e6f5f1',100:'#b3e0d4',200:'#80cbc0',300:'#4db5a8',400:'#1a9f8e',500:'#024938',600:'#023d30',700:'#013028',800:'#01241f',900:'#001816' },
                        gold: { 50:'#fff5e0',100:'#ffe6b3',200:'#ffd680',300:'#ffc64d',400:'#ffb71a',500:'#f9ac00',600:'#d49700',700:'#b07c00',800:'#8c6100',900:'#684600' }
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
</head>
<body class="font-['Nunito',sans-serif] antialiased text-slate-800 min-h-screen">

    {{-- Theme Toggle --}}
    <div class="theme-toggle" onclick="toggleTheme()">
        <svg class="moon-icon" width="22" height="22" viewBox="0 0 24 24" fill="none" stroke="#1f2937" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M21 12.79A9 9 0 1 1 11.21 3 7 7 0 0 0 21 12.79z"/></svg>
        <svg class="sun-icon" width="22" height="22" viewBox="0 0 24 24" fill="none" stroke="#f9ac00" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><circle cx="12" cy="12" r="5"/><line x1="12" y1="1" x2="12" y2="3"/><line x1="12" y1="21" x2="12" y2="23"/><line x1="4.22" y1="4.22" x2="5.64" y2="5.64"/><line x1="18.36" y1="18.36" x2="19.78" y2="19.78"/><line x1="1" y1="12" x2="3" y2="12"/><line x1="21" y1="12" x2="23" y2="12"/><line x1="4.22" y1="19.78" x2="5.64" y2="18.36"/><line x1="18.36" y1="5.64" x2="19.78" y2="4.22"/></svg>
    </div>
    <script>
    function toggleTheme() {
        const isDark = document.documentElement.classList.toggle('dark');
        localStorage.setItem('theme', isDark ? 'dark' : 'light');
    }
    </script>

    {{-- Auth Background --}}
    <div class="auth-bg fixed inset-0 z-0 bg-gradient-to-br from-gray-50 via-white to-emerald-50">
        <div class="auth-dot absolute inset-0" style="background-image: radial-gradient(rgba(2,73,56,0.07) 2px, transparent 2.5px); background-size: 18px 18px;"></div>
        <div class="auth-blob-1 absolute top-[-10%] left-[-5%] w-[500px] h-[500px] bg-emerald-200/40 rounded-full blur-3xl"></div>
        <div class="auth-blob-2 absolute bottom-[-10%] right-[-5%] w-[500px] h-[500px] bg-gold-200/40 rounded-full blur-3xl"></div>
    </div>

    {{-- AJAX Progress Bar --}}
    <div id="ajaxLoader" class="ajax-loader"></div>

    {{-- Navbar (only for authenticated users) --}}
    @auth
    <nav class="auth-navbar relative z-20 bg-white/80 backdrop-blur-md border-b border-gray-100 shadow-sm">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex items-center justify-between h-16">
                <a href="{{ url('/') }}" class="flex items-center gap-2 text-emerald-700 font-bold text-lg">
                    <img src="{{ asset('logo.png') }}" alt="Logo" class="h-8 w-auto">
                </a>
                <div class="flex items-center gap-4">
                    <span class="text-gray-600 text-sm font-medium">{{ Auth::user()->name }}</span>
                    <a href="{{ route('logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();" class="text-gray-500 hover:text-red-500 text-sm font-medium flex items-center gap-1.5 transition-colors">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1"/></svg>
                        Logout
                    </a>
                    <form id="logout-form" action="{{ route('logout') }}" method="POST" class="hidden">
                        @csrf
                    </form>
                </div>
            </div>
        </div>
    </nav>
    @endauth

    <main id="authMain" class="relative z-10 min-h-screen flex">
        <div class="flex w-full min-h-screen">
            {{-- Left Column: Image / Branding --}}
            <div class="auth-image-col hidden lg:flex lg:w-1/2 relative">
                @yield('auth-image')
            </div>
            {{-- Right Column: Form Card --}}
            <div class="auth-form-col flex w-full lg:w-1/2 items-center justify-center py-12 px-4 sm:px-6 lg:px-8">
                @yield('content')
            </div>
        </div>
    </main>

    {{-- SweetAlert2 Toast + AJAX Navigation --}}
    <script>
    (function() {
        const main = document.getElementById('authMain');
        const loader = document.getElementById('ajaxLoader');
        let isNavigating = false;

        const Toast = Swal.mixin({
            toast: true,
            position: 'top-end',
            showConfirmButton: false,
            timer: 5000,
            timerProgressBar: true,
            didOpen: (toast) => {
                toast.addEventListener('mouseenter', Swal.stopTimer);
                toast.addEventListener('mouseleave', Swal.resumeTimer);
            },
            customClass: {
                popup: 'swal2-toast-custom'
            }
        });

        function showToast(type, title, message) {
            const iconMap = { success: 'success', error: 'error', warning: 'warning', info: 'info' };
            Toast.fire({
                icon: iconMap[type] || 'info',
                title: title,
                text: message || '',
            });
        }

        window.showToast = showToast;

        function showLoader() { loader.style.display = 'block'; }
        function hideLoader() { loader.style.display = 'none'; }

        function fadeOut(el, cb) {
            el.style.transition = 'opacity 0.15s ease-out, transform 0.15s ease-out';
            el.style.opacity = '0';
            el.style.transform = 'translateY(-8px)';
            setTimeout(cb, 150);
        }

        function fadeIn(el) {
            el.style.opacity = '0';
            el.style.transform = 'translateY(12px)';
            el.style.transition = 'opacity 0.35s cubic-bezier(0.16,1,0.3,1), transform 0.35s cubic-bezier(0.16,1,0.3,1)';
            requestAnimationFrame(() => {
                el.style.opacity = '1';
                el.style.transform = 'translateY(0)';
            });
        }

        function executeScripts(container) {
            const scripts = container.querySelectorAll('script');
            scripts.forEach(oldScript => {
                const newScript = document.createElement('script');
                if (oldScript.src) {
                    newScript.src = oldScript.src;
                } else {
                    newScript.textContent = oldScript.textContent;
                }
                newScript.type = oldScript.type || 'text/javascript';
                oldScript.parentNode.replaceChild(newScript, oldScript);
            });
        }

        function processResponse(html, url, pushState) {
            const parser = new DOMParser();
            const doc = parser.parseFromString(html, 'text/html');

            const newMain = doc.getElementById('authMain');
            const newTitle = doc.querySelector('title') ? doc.querySelector('title').textContent : document.title;

            if (!newMain) {
                window.location.href = url;
                return;
            }

            fadeOut(main, () => {
                main.innerHTML = newMain.innerHTML;
                document.title = newTitle;

                if (pushState !== false) {
                    history.pushState({ ajaxUrl: url }, '', url);
                }

                executeScripts(main);
                fadeIn(main);
                hideLoader();
                isNavigating = false;

                processSessionToasts(doc);

                window.scrollTo({ top: 0, behavior: 'smooth' });
            });
        }

        function processSessionToasts(doc) {
            const swalContainers = doc.querySelectorAll('.swal2-container');
            swalContainers.forEach(c => c.remove());

            const scripts = doc.querySelectorAll('script');
            scripts.forEach(script => {
                const content = script.textContent || '';
                const matches = content.matchAll(/showToast\('(success|error|warning|info)',\s*'([^']+)',\s*'([^']+)'\)/g);
                for (const match of matches) {
                    showToast(match[1], match[2], match[3]);
                }
            });
        }

        function loadPage(url, pushState) {
            if (isNavigating) return;
            isNavigating = true;
            showLoader();

            fetch(url, {
                headers: { 'X-Requested-With': 'XMLHttpRequest' },
                credentials: 'same-origin',
                redirect: 'follow'
            })
            .then(res => {
                const finalUrl = res.url || url;
                return res.text().then(html => ({ html, finalUrl }));
            })
            .then(({ html, finalUrl }) => {
                processResponse(html, finalUrl, pushState);
            })
            .catch(() => {
                hideLoader();
                isNavigating = false;
                showToast('error', 'Navigation Error', 'Failed to load page. Reloading...');
                setTimeout(() => { window.location.href = url; }, 800);
            });
        }

        function submitFormAjax(form, btn) {
            if (isNavigating) return;
            isNavigating = true;
            showLoader();

            const btnText = btn.innerHTML;
            btn.classList.add('btn-loading');
            btn.innerHTML = '<span class="btn-spinner-dark"></span>';

            const formData = new FormData(form);
            const action = form.getAttribute('action') || window.location.href;
            const method = (form.getAttribute('method') || 'POST').toUpperCase();

            const headers = { 'X-Requested-With': 'XMLHttpRequest' };
            if (method !== 'GET') headers['X-HTTP-Method-Override'] = method;

            fetch(action, {
                method: 'POST',
                headers: headers,
                body: formData,
                credentials: 'same-origin',
                redirect: 'follow'
            })
            .then(res => {
                const finalUrl = res.url || action;
                return res.text().then(html => ({ html, finalUrl }));
            })
            .then(({ html, finalUrl }) => {
                const parser = new DOMParser();
                const doc = parser.parseFromString(html, 'text/html');
                const newMain = doc.getElementById('authMain');

                if (!newMain) {
                    window.location.href = finalUrl;
                    return;
                }

                fadeOut(main, () => {
                    main.innerHTML = newMain.innerHTML;
                    document.title = doc.querySelector('title') ? doc.querySelector('title').textContent : document.title;

                    if (finalUrl !== window.location.href) {
                        history.pushState({ ajaxUrl: finalUrl }, '', finalUrl);
                    }

                    executeScripts(main);
                    fadeIn(main);
                    hideLoader();
                    isNavigating = false;

                    processSessionToasts(doc);
                    window.scrollTo({ top: 0, behavior: 'smooth' });
                });
            })
            .catch(() => {
                hideLoader();
                isNavigating = false;
                btn.classList.remove('btn-loading');
                btn.innerHTML = btnText;
                showToast('error', 'Error', 'Something went wrong. Please try again.');
            });
        }

        document.addEventListener('submit', function(e) {
            const form = e.target;
            if (!form || form.id === 'logout-form') return;
            if (form.getAttribute('method') && form.getAttribute('method').toLowerCase() === 'get') return;

            e.preventDefault();
            const btn = form.querySelector('button[type="submit"]');
            if (btn) submitFormAjax(form, btn);
        });

        function shouldIntercept(el) {
            if (!el || el.tagName !== 'A') return false;
            const href = el.getAttribute('href');
            if (!href || href.startsWith('#') || href.startsWith('javascript:') || href.startsWith('http')) return false;
            if (el.hasAttribute('download')) return false;
            if (el.target === '_blank') return false;
            const url = new URL(href, window.location.origin);
            if (url.origin !== window.location.origin) return false;
            return true;
        }

        document.addEventListener('click', function(e) {
            const link = e.target.closest('a');
            if (!shouldIntercept(link)) return;

            if (link.getAttribute('href') === '{{ route("logout") }}') return;

            e.preventDefault();
            loadPage(link.getAttribute('href'), true);
        });

        window.addEventListener('popstate', function(e) {
            const url = window.location.pathname + window.location.search;
            loadPage(url, false);
        });

        @if(session('status'))
            showToast('success', 'Success', @json(session('status')));
        @endif
        @if(session('error'))
            showToast('error', 'Error', @json(session('error')));
        @endif
        @if(session('warning'))
            showToast('warning', 'Warning', @json(session('warning')));
        @endif
        @if(session('info'))
            showToast('info', 'Info', @json(session('info')));
        @endif

        @if($errors->any())
            @foreach($errors->all() as $error)
                showToast('error', 'Validation Error', @json($error));
            @endforeach
        @endif
    })();
    </script>

</body>
</html>
