{{-- Hero Section --}}
<section id="home" class="relative min-h-screen flex items-center pt-24 sm:pt-28 lg:pt-20 overflow-hidden">
    {{-- Background Image with zoom animation --}}
    <div class="absolute inset-0 overflow-hidden">
        <img src="{{ asset('images/callcenter/young-friendly-operator-woman-agent-with-headsets-beautiful-business-woman-wearing-microphone-headset-working-office-as-telemarketing-customer-service-agent-call-center-job-concept_657921-1733.jpg') }}"
             alt="Call Center" class="hero-bg-img w-full h-full object-cover">
        <div class="absolute inset-0 hero-overlay"></div>
    </div>

    {{-- Decorative blobs --}}
    <div class="absolute top-20 right-5 sm:right-10 w-48 h-48 sm:w-72 sm:h-72 bg-primary-400/20 rounded-full blur-3xl hero-float"></div>
    <div class="absolute bottom-10 left-5 sm:left-10 w-64 h-64 sm:w-96 sm:h-96 bg-primary-600/15 rounded-full blur-3xl hero-float" style="animation-delay:1.5s;"></div>

    {{-- Content --}}
    <div class="relative z-10 max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 w-full py-8 lg:py-12">
        <div class="max-w-3xl mx-auto text-center">

            {{-- Badge --}}
            <a href="#features" class="inline-flex justify-between items-center py-1 px-1 pr-3 sm:pr-4 mb-6 sm:mb-7 text-sm text-gray-200 bg-white/10 backdrop-blur-md rounded-full border border-white/20 hover:bg-white/20 transition-all animate__animated animate__fadeInDown" role="alert">
                <span class="text-xs bg-primary-600 rounded-full text-white px-3 sm:px-4 py-1.5 mr-2 sm:mr-3 font-bold">New</span>
                <span class="text-xs sm:text-sm font-medium text-white/90">Zerixa v2.0 is here! See what's new</span>
                <svg class="ml-2 w-4 h-4 sm:w-5 sm:h-5 text-white/70" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" d="M7.293 14.707a1 1 0 010-1.414L10.586 10 7.293 6.707a1 1 0 011.414-1.414l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414 0z" clip-rule="evenodd"></path></svg>
            </a>

            {{-- Heading --}}
            <h1 class="mb-4 text-3xl sm:text-4xl md:text-5xl lg:text-6xl xl:text-7xl font-extrabold tracking-tight leading-tight text-white animate__animated animate__fadeInUp animate__delay-1s">
                We invest in the world's <span class="text-primary-300">potential</span>
            </h1>

            {{-- Description --}}
            <p class="mb-8 text-base sm:text-lg lg:text-xl font-normal text-white/80 leading-relaxed sm:px-12 xl:px-48 animate__animated animate__fadeInUp animate__delay-1s">
                Here at Zerixa Call Center we focus on markets where technology, innovation, and capital can unlock long-term value and drive economic growth.
            </p>

            {{-- CTA Buttons --}}
            <div class="flex flex-col mb-10 sm:mb-12 lg:mb-16 space-y-3 sm:space-y-0 sm:flex-row sm:justify-center sm:space-x-4 animate__animated animate__fadeInUp animate__delay-2s">
                <a href="{{ route('register') }}" class="inline-flex justify-center items-center py-3 px-5 sm:px-6 text-sm sm:text-base font-semibold text-center text-white rounded-xl bg-primary-600 hover:bg-primary-700 focus:ring-4 focus:ring-primary-300 shadow-lg shadow-primary-600/30 hover:shadow-xl hover:shadow-primary-600/40 transition-all">
                    Learn more
                    <svg class="ml-2 -mr-1 w-4 h-4 sm:w-5 sm:h-5" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" d="M10.293 3.293a1 1 0 011.414 0l6 6a1 1 0 010 1.414l-6 6a1 1 0 01-1.414-1.414L14.586 11H3a1 1 0 110-2h11.586l-4.293-4.293a1 1 0 010-1.414z" clip-rule="evenodd"></path></svg>
                </a>
                <a href="#features" class="inline-flex justify-center items-center py-3 px-5 sm:px-6 text-sm sm:text-base font-semibold text-center text-white rounded-xl border border-white/25 backdrop-blur-md bg-white/5 hover:bg-white/15 focus:ring-4 focus:ring-white/20 transition-all">
                    <svg class="mr-2 -ml-1 w-4 h-4 sm:w-5 sm:h-5" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path d="M2 6a2 2 0 012-2h6a2 2 0 012 2v8a2 2 0 01-2 2H4a2 2 0 01-2-2V6zM14.553 7.106A1 1 0 0014 8v4a1 1 0 00.553.894l2 1A1 1 0 0018 13V7a1 1 0 00-1.447-.894l-2 1z"></path></svg>
                    Watch video
                </a>
            </div>

            {{-- Featured In --}}
            <div class="px-4 mx-auto text-center max-w-3xl animate__animated animate__fadeIn animate__delay-2s">
                <span class="font-semibold text-white/40 uppercase tracking-wider text-xs sm:text-sm">Featured In</span>
                <div class="flex flex-wrap justify-center items-center gap-4 sm:gap-8 mt-6">
                    <a href="#" class="featured-logo text-white/60 hover:text-white">
                        <span class="text-lg sm:text-2xl font-black tracking-tighter italic">Forbes</span>
                    </a>
                    <a href="#" class="featured-logo text-white/60 hover:text-white">
                        <span class="text-lg sm:text-2xl font-black tracking-tight">TechCrunch</span>
                    </a>
                    <a href="#" class="featured-logo text-white/60 hover:text-white">
                        <span class="text-lg sm:text-2xl font-black tracking-tight">Wired</span>
                    </a>
                    <a href="#" class="featured-logo text-white/60 hover:text-white">
                        <span class="text-lg sm:text-2xl font-black tracking-tight">Bloomberg</span>
                    </a>
                    <a href="#" class="featured-logo text-white/60 hover:text-white">
                        <span class="text-lg sm:text-2xl font-black tracking-tight">Reuters</span>
                    </a>
                </div>
            </div>
        </div>
    </div>

    {{-- Scroll indicator --}}
    <div class="absolute bottom-6 left-1/2 -translate-x-1/2 animate__animated animate__fadeIn animate__delay-3s hidden sm:flex">
        <div class="flex flex-col items-center gap-2">
            <span class="text-white/50 text-xs font-medium uppercase tracking-wider">Scroll</span>
            <div class="w-6 h-10 rounded-full border-2 border-white/30 flex items-start justify-center p-1.5">
                <div class="w-1.5 h-3 rounded-full bg-white/60 animate-bounce"></div>
            </div>
        </div>
    </div>
</section>
