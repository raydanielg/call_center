{{-- CTA Section --}}
<section class="py-20 lg:py-28 landing-bg-white bg-white">
    <div class="max-w-5xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="relative rounded-3xl overflow-hidden section-fade">
            {{-- Background --}}
            <div class="absolute inset-0">
                <img src="{{ asset('images/callcenter/call-center-operators-carrying-communication-icons_53876-64653.jpg') }}"
                     alt="CTA" class="w-full h-full object-cover">
                <div class="absolute inset-0 hero-overlay"></div>
            </div>

            {{-- Content --}}
            <div class="relative z-10 px-6 py-16 lg:px-16 lg:py-20 text-center">
                <h2 class="text-3xl lg:text-4xl xl:text-5xl font-black text-white mb-6 leading-tight">
                    Ready to Transform Your<br>
                    <span class="text-primary-300">Call Center Experience?</span>
                </h2>
                <p class="text-lg text-white/80 leading-relaxed mb-8 max-w-2xl mx-auto">
                    Join hundreds of businesses already using Zerixa Call Center to deliver exceptional customer service. Get started in minutes — no credit card required.
                </p>
                <div class="flex flex-col sm:flex-row gap-4 justify-center">
                    <a href="{{ route('register') }}" class="inline-flex items-center justify-center gap-2 px-8 py-4 text-base font-bold text-primary-600 bg-white hover:bg-gray-50 rounded-2xl shadow-xl hover:shadow-2xl transition-all">
                        Create Free Account
                        <i class="fas fa-arrow-right text-sm"></i>
                    </a>
                    <a href="{{ route('login') }}" class="inline-flex items-center justify-center gap-2 px-8 py-4 text-base font-bold text-white bg-white/10 backdrop-blur-md border border-white/20 hover:bg-white/20 rounded-2xl transition-all">
                        Sign In
                        <i class="fas fa-sign-in-alt text-sm"></i>
                    </a>
                </div>

                {{-- Trust badges --}}
                <div class="flex flex-wrap items-center justify-center gap-6 mt-10">
                    <div class="flex items-center gap-2">
                        <i class="fas fa-check-circle text-green-400"></i>
                        <span class="text-white/70 text-sm font-medium">Free to start</span>
                    </div>
                    <div class="flex items-center gap-2">
                        <i class="fas fa-check-circle text-green-400"></i>
                        <span class="text-white/70 text-sm font-medium">No credit card</span>
                    </div>
                    <div class="flex items-center gap-2">
                        <i class="fas fa-check-circle text-green-400"></i>
                        <span class="text-white/70 text-sm font-medium">Cancel anytime</span>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
