{{-- Header / Navbar --}}
<header id="landing-header" class="fixed top-0 left-0 right-0 z-50 transition-all duration-300" style="background: rgba(255,255,255,0.9); backdrop-filter: blur(16px); border-bottom: 1px solid rgba(229,231,235,0.5);">
    <nav class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex items-center justify-between h-16 lg:h-18">
            {{-- Logo --}}
            <a href="{{ url('/') }}" class="flex items-center gap-2.5">
                <img src="{{ asset('images/logo/logo.png') }}" alt="Logo" class="h-8 lg:h-9 w-auto">
                <span class="hidden sm:block font-bold text-sm lg:text-base text-gray-900 dark:text-white tracking-tight">
                    Zerixa Call Center
                </span>
            </a>

            {{-- Desktop Nav --}}
            <div class="hidden lg:flex items-center gap-7">
                <a href="#home" class="text-sm font-medium text-gray-600 dark:text-gray-300 hover:text-primary-600 transition-colors">Home</a>
                <a href="#features" class="text-sm font-medium text-gray-600 dark:text-gray-300 hover:text-primary-600 transition-colors">Features</a>
                <a href="#about" class="text-sm font-medium text-gray-600 dark:text-gray-300 hover:text-primary-600 transition-colors">About</a>
                <a href="#services" class="text-sm font-medium text-gray-600 dark:text-gray-300 hover:text-primary-600 transition-colors">Services</a>
                <a href="#stats" class="text-sm font-medium text-gray-600 dark:text-gray-300 hover:text-primary-600 transition-colors">Stats</a>
            </div>

            {{-- Desktop CTA --}}
            <div class="hidden lg:flex items-center gap-2">
                <a href="{{ route('login') }}" class="px-4 py-2 text-sm font-semibold text-gray-700 dark:text-gray-200 hover:text-primary-600 transition-colors">
                    Sign In
                </a>
                <a href="{{ route('register') }}" class="px-4 py-2 text-sm font-semibold text-white bg-primary-600 hover:bg-primary-700 rounded-lg transition-all">
                    Get Started
                </a>
            </div>

            {{-- Mobile Menu Button --}}
            <button onclick="toggleMobileMenu()" class="lg:hidden flex items-center justify-center w-9 h-9 rounded-lg hover:bg-gray-100 dark:hover:bg-gray-800 transition-colors">
                <svg class="w-5 h-5 text-gray-700 dark:text-gray-200" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"/></svg>
            </button>
        </div>
    </nav>

    {{-- Mobile Menu --}}
    <div id="mobileMenu" class="mobile-menu lg:hidden" style="max-height:0;">
        <div class="px-4 pb-4 space-y-1 bg-white/95 dark:bg-gray-900/95 backdrop-blur-md border-t border-gray-100 dark:border-gray-800">
            <a href="#home" onclick="closeMobileMenu()" class="block px-4 py-2.5 text-sm font-medium text-gray-700 dark:text-gray-200 hover:bg-primary-50 hover:text-primary-600 rounded-lg transition-colors">Home</a>
            <a href="#features" onclick="closeMobileMenu()" class="block px-4 py-2.5 text-sm font-medium text-gray-700 dark:text-gray-200 hover:bg-primary-50 hover:text-primary-600 rounded-lg transition-colors">Features</a>
            <a href="#about" onclick="closeMobileMenu()" class="block px-4 py-2.5 text-sm font-medium text-gray-700 dark:text-gray-200 hover:bg-primary-50 hover:text-primary-600 rounded-lg transition-colors">About</a>
            <a href="#services" onclick="closeMobileMenu()" class="block px-4 py-2.5 text-sm font-medium text-gray-700 dark:text-gray-200 hover:bg-primary-50 hover:text-primary-600 rounded-lg transition-colors">Services</a>
            <a href="#stats" onclick="closeMobileMenu()" class="block px-4 py-2.5 text-sm font-medium text-gray-700 dark:text-gray-200 hover:bg-primary-50 hover:text-primary-600 rounded-lg transition-colors">Stats</a>
            <div class="pt-2 mt-2 border-t border-gray-100 dark:border-gray-800 space-y-2">
                <a href="{{ route('login') }}" class="block px-4 py-2.5 text-sm font-semibold text-primary-600 border border-primary-200 rounded-lg text-center transition-colors hover:bg-primary-50">Sign In</a>
                <a href="{{ route('register') }}" class="block px-4 py-2.5 text-sm font-semibold text-white bg-primary-600 rounded-lg text-center transition-all">Get Started</a>
            </div>
        </div>
    </div>
</header>

<script>
(function() {
    const header = document.getElementById('landing-header');
    window.addEventListener('scroll', () => {
        if (window.scrollY > 20) {
            header.style.boxShadow = '0 4px 20px rgba(0,0,0,0.06)';
            header.style.background = 'rgba(255,255,255,0.95)';
        } else {
            header.style.boxShadow = 'none';
            header.style.background = 'rgba(255,255,255,0.85)';
        }
    });

    // Dark mode header
    const observer = new MutationObserver(() => {
        if (document.documentElement.classList.contains('dark')) {
            header.style.background = 'rgba(17,24,39,0.9)';
            header.style.borderBottom = '1px solid rgba(55,65,81,0.4)';
        } else {
            header.style.background = window.scrollY > 20 ? 'rgba(255,255,255,0.95)' : 'rgba(255,255,255,0.9)';
            header.style.borderBottom = '1px solid rgba(229,231,235,0.5)';
        }
    });
    observer.observe(document.documentElement, { attributes: true, attributeFilter: ['class'] });
})();

function toggleMobileMenu() {
    const menu = document.getElementById('mobileMenu');
    menu.style.maxHeight = menu.style.maxHeight === '0px' || menu.style.maxHeight === '' ? '500px' : '0px';
}
function closeMobileMenu() {
    document.getElementById('mobileMenu').style.maxHeight = '0px';
}
</script>
