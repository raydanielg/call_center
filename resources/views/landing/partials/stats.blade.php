{{-- Stats Section --}}
<section id="stats" class="relative py-20 lg:py-28 overflow-hidden">
    {{-- Background --}}
    <div class="absolute inset-0">
        <img src="{{ asset('images/callcenter/medium-shot-woman-working-call-center_23-2150454140.jpg') }}"
             alt="Stats Background" class="w-full h-full object-cover">
        <div class="absolute inset-0 hero-overlay"></div>
    </div>

    {{-- Content --}}
    <div class="relative z-10 max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="text-center max-w-3xl mx-auto mb-14 section-fade">
            <h2 class="text-3xl lg:text-4xl xl:text-5xl font-black text-white mb-4">
                Numbers That <span class="text-primary-300">Speak</span>
            </h2>
            <p class="text-lg text-white/80 leading-relaxed">
                Our platform trusted by businesses worldwide to deliver exceptional customer service.
            </p>
        </div>

        <div class="grid grid-cols-2 lg:grid-cols-4 gap-6 lg:gap-8">
            {{-- Stat 1 --}}
            <div class="text-center section-fade">
                <div class="w-16 h-16 mx-auto rounded-2xl bg-white/10 backdrop-blur-md border border-white/20 flex items-center justify-center mb-4">
                    <i class="fas fa-users text-primary-300 text-2xl"></i>
                </div>
                <p class="text-4xl lg:text-5xl font-black text-white stat-counter" data-target="500">0</p>
                <p class="text-white/60 text-sm font-medium uppercase tracking-wider mt-2">Active Agents</p>
            </div>

            {{-- Stat 2 --}}
            <div class="text-center section-fade">
                <div class="w-16 h-16 mx-auto rounded-2xl bg-white/10 backdrop-blur-md border border-white/20 flex items-center justify-center mb-4">
                    <i class="fas fa-phone text-primary-300 text-2xl"></i>
                </div>
                <p class="text-4xl lg:text-5xl font-black text-white stat-counter" data-target="1200000">0</p>
                <p class="text-white/60 text-sm font-medium uppercase tracking-wider mt-2">Calls Handled</p>
            </div>

            {{-- Stat 3 --}}
            <div class="text-center section-fade">
                <div class="w-16 h-16 mx-auto rounded-2xl bg-white/10 backdrop-blur-md border border-white/20 flex items-center justify-center mb-4">
                    <i class="fas fa-smile text-primary-300 text-2xl"></i>
                </div>
                <p class="text-4xl lg:text-5xl font-black text-white stat-counter" data-target="98">0</p>
                <p class="text-white/60 text-sm font-medium uppercase tracking-wider mt-2">% Satisfaction</p>
            </div>

            {{-- Stat 4 --}}
            <div class="text-center section-fade">
                <div class="w-16 h-16 mx-auto rounded-2xl bg-white/10 backdrop-blur-md border border-white/20 flex items-center justify-center mb-4">
                    <i class="fas fa-globe text-primary-300 text-2xl"></i>
                </div>
                <p class="text-4xl lg:text-5xl font-black text-white stat-counter" data-target="25">0</p>
                <p class="text-white/60 text-sm font-medium uppercase tracking-wider mt-2">Countries</p>
            </div>
        </div>
    </div>
</section>

<script>
(function() {
    const counters = document.querySelectorAll('.stat-counter');
    let animated = false;

    function animateCounters() {
        if (animated) return;
        animated = true;
        counters.forEach(counter => {
            const target = parseInt(counter.getAttribute('data-target'));
            const duration = 2000;
            const start = performance.now();

            function update(now) {
                const elapsed = now - start;
                const progress = Math.min(elapsed / duration, 1);
                const eased = 1 - Math.pow(1 - progress, 3);
                const value = Math.floor(eased * target);
                counter.textContent = value >= 1000 ? value.toLocaleString() : value + (counter.getAttribute('data-target') === '98' ? '%' : '');
                if (progress < 1) requestAnimationFrame(update);
                else counter.textContent = target >= 1000 ? target.toLocaleString() : target + (counter.getAttribute('data-target') === '98' ? '%' : '');
            }
            requestAnimationFrame(update);
        });
    }

    const statsSection = document.getElementById('stats');
    if (statsSection) {
        const observer = new IntersectionObserver((entries) => {
            entries.forEach(entry => {
                if (entry.isIntersecting) animateCounters();
            });
        }, { threshold: 0.3 });
        observer.observe(statsSection);
    }
})();
</script>
