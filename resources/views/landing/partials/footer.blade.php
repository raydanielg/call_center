{{-- Footer --}}
<footer class="landing-bg-light bg-slate-900 text-white pt-16 pb-8">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-8 lg:gap-12 mb-12">
            {{-- Brand --}}
            <div class="lg:col-span-1">
                <div class="flex items-center gap-3 mb-4">
                    <img src="{{ asset('images/logo/logo.png') }}" alt="Logo" class="h-10 w-auto" style="filter: brightness(0) invert(1);">
                    <span class="font-extrabold text-lg">
                        Zerixa <span class="text-primary-400">Call Center</span>
                    </span>
                </div>
                <p class="text-slate-400 text-sm leading-relaxed mb-6">
                    The comprehensive platform for modern call center operations. Manage calls, track performance, and deliver exceptional customer service.
                </p>
                <div class="flex items-center gap-3">
                    <a href="#" class="w-10 h-10 rounded-xl bg-white/5 hover:bg-primary-600 flex items-center justify-center transition-all">
                        <i class="fab fa-facebook-f text-sm"></i>
                    </a>
                    <a href="#" class="w-10 h-10 rounded-xl bg-white/5 hover:bg-primary-600 flex items-center justify-center transition-all">
                        <i class="fab fa-twitter text-sm"></i>
                    </a>
                    <a href="#" class="w-10 h-10 rounded-xl bg-white/5 hover:bg-primary-600 flex items-center justify-center transition-all">
                        <i class="fab fa-linkedin-in text-sm"></i>
                    </a>
                    <a href="#" class="w-10 h-10 rounded-xl bg-white/5 hover:bg-primary-600 flex items-center justify-center transition-all">
                        <i class="fab fa-instagram text-sm"></i>
                    </a>
                </div>
            </div>

            {{-- Quick Links --}}
            <div>
                <h4 class="font-bold text-white mb-5 text-sm uppercase tracking-wider">Quick Links</h4>
                <ul class="space-y-3">
                    <li><a href="#home" class="text-slate-400 hover:text-primary-400 text-sm transition-colors">Home</a></li>
                    <li><a href="#features" class="text-slate-400 hover:text-primary-400 text-sm transition-colors">Features</a></li>
                    <li><a href="#about" class="text-slate-400 hover:text-primary-400 text-sm transition-colors">About Us</a></li>
                    <li><a href="#services" class="text-slate-400 hover:text-primary-400 text-sm transition-colors">Services</a></li>
                    <li><a href="#stats" class="text-slate-400 hover:text-primary-400 text-sm transition-colors">Statistics</a></li>
                </ul>
            </div>

            {{-- Resources --}}
            <div>
                <h4 class="font-bold text-white mb-5 text-sm uppercase tracking-wider">Resources</h4>
                <ul class="space-y-3">
                    <li><a href="{{ route('login') }}" class="text-slate-400 hover:text-primary-400 text-sm transition-colors">Sign In</a></li>
                    <li><a href="{{ route('register') }}" class="text-slate-400 hover:text-primary-400 text-sm transition-colors">Create Account</a></li>
                    <li><a href="{{ route('password.request') }}" class="text-slate-400 hover:text-primary-400 text-sm transition-colors">Reset Password</a></li>
                    <li><a href="#" class="text-slate-400 hover:text-primary-400 text-sm transition-colors">Documentation</a></li>
                    <li><a href="#" class="text-slate-400 hover:text-primary-400 text-sm transition-colors">Help Center</a></li>
                </ul>
            </div>

            {{-- Contact --}}
            <div>
                <h4 class="font-bold text-white mb-5 text-sm uppercase tracking-wider">Get in Touch</h4>
                <ul class="space-y-4">
                    <li class="flex items-start gap-3">
                        <i class="fas fa-map-marker-alt text-primary-400 mt-1"></i>
                        <span class="text-slate-400 text-sm">Dar es Salaam, Tanzania</span>
                    </li>
                    <li class="flex items-start gap-3">
                        <i class="fas fa-envelope text-primary-400 mt-1"></i>
                        <span class="text-slate-400 text-sm">support@zerixa.co.tz</span>
                    </li>
                    <li class="flex items-start gap-3">
                        <i class="fas fa-phone text-primary-400 mt-1"></i>
                        <span class="text-slate-400 text-sm">+255 700 000 000</span>
                    </li>
                    <li class="flex items-start gap-3">
                        <i class="fas fa-clock text-primary-400 mt-1"></i>
                        <span class="text-slate-400 text-sm">24/7 Support Available</span>
                    </li>
                </ul>
            </div>
        </div>

        {{-- Bottom bar --}}
        <div class="pt-8 border-t border-white/10 flex flex-col md:flex-row items-center justify-between gap-4">
            <p class="text-slate-500 text-sm">
                &copy; {{ date('Y') }} Zerixa Call Center - For Business. All rights reserved.
            </p>
            <div class="flex items-center gap-6">
                <a href="#" class="text-slate-500 hover:text-primary-400 text-sm transition-colors">Privacy Policy</a>
                <a href="#" class="text-slate-500 hover:text-primary-400 text-sm transition-colors">Terms of Service</a>
            </div>
        </div>
    </div>
</footer>
