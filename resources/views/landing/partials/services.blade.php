{{-- Services Section --}}
<section id="services" class="py-20 lg:py-28 landing-bg-white bg-white">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        {{-- Section Header --}}
        <div class="text-center max-w-3xl mx-auto mb-16 section-fade">
            <span class="inline-block px-4 py-1.5 rounded-full bg-primary-50 text-primary-600 text-sm font-bold mb-4">
                <i class="fas fa-cogs mr-1"></i> Services
            </span>
            <h2 class="text-3xl lg:text-4xl xl:text-5xl font-black text-slate-800 mb-4">
                Solutions for <span class="text-primary-600">Every Need</span>
            </h2>
            <p class="text-lg landing-text-muted text-slate-500 leading-relaxed">
                Comprehensive services designed to optimize your call center operations at every level.
            </p>
        </div>

        {{-- Services Grid --}}
        <div class="grid grid-cols-1 md:grid-cols-2 gap-6 lg:gap-8">
            {{-- Service 1 --}}
            <div class="feature-card landing-card bg-white rounded-2xl overflow-hidden border border-gray-100 shadow-sm section-fade">
                <div class="flex flex-col sm:flex-row">
                    <div class="sm:w-2/5 relative overflow-hidden">
                        <img src="{{ asset('images/callcenter/call-center-agent-listening-customer-needs-providing-step-by-step-guidance_482257-126192.jpg') }}"
                             alt="Inbound Calls" class="w-full h-48 sm:h-full object-cover">
                        <div class="absolute inset-0 bg-gradient-to-r from-primary-600/30 to-transparent"></div>
                    </div>
                    <div class="sm:w-3/5 p-6 lg:p-8">
                        <div class="w-12 h-12 rounded-xl bg-primary-100 flex items-center justify-center mb-4">
                            <i class="fas fa-phone-alt text-primary-600 text-xl"></i>
                        </div>
                        <h3 class="text-xl font-bold text-slate-800 mb-3">Inbound Call Handling</h3>
                        <p class="landing-text-muted text-slate-500 text-sm leading-relaxed">
                            Manage customer inquiries with intelligent routing, queue management, and real-time agent availability tracking.
                        </p>
                    </div>
                </div>
            </div>

            {{-- Service 2 --}}
            <div class="feature-card landing-card bg-white rounded-2xl overflow-hidden border border-gray-100 shadow-sm section-fade">
                <div class="flex flex-col sm:flex-row">
                    <div class="sm:w-2/5 relative overflow-hidden">
                        <img src="{{ asset('images/callcenter/jolly-call-center-professional-typing-pc-keyboard-assisting-customers_482257-125196.jpg') }}"
                             alt="Outbound Calls" class="w-full h-48 sm:h-full object-cover">
                        <div class="absolute inset-0 bg-gradient-to-r from-primary-600/30 to-transparent"></div>
                    </div>
                    <div class="sm:w-3/5 p-6 lg:p-8">
                        <div class="w-12 h-12 rounded-xl bg-primary-100 flex items-center justify-center mb-4">
                            <i class="fas fa-bullhorn text-primary-600 text-xl"></i>
                        </div>
                        <h3 class="text-xl font-bold text-slate-800 mb-3">Outbound Campaigns</h3>
                        <p class="landing-text-muted text-slate-500 text-sm leading-relaxed">
                            Run telemarketing and follow-up campaigns with automated dialing, scripts, and performance tracking.
                        </p>
                    </div>
                </div>
            </div>

            {{-- Service 3 --}}
            <div class="feature-card landing-card bg-white rounded-2xl overflow-hidden border border-gray-100 shadow-sm section-fade">
                <div class="flex flex-col sm:flex-row">
                    <div class="sm:w-2/5 relative overflow-hidden">
                        <img src="{{ asset('images/callcenter/call-center-agent-tracking-shipments-office-looking-pc-screen_482257-117862.jpg') }}"
                             alt="Analytics" class="w-full h-48 sm:h-full object-cover">
                        <div class="absolute inset-0 bg-gradient-to-r from-primary-600/30 to-transparent"></div>
                    </div>
                    <div class="sm:w-3/5 p-6 lg:p-8">
                        <div class="w-12 h-12 rounded-xl bg-primary-100 flex items-center justify-center mb-4">
                            <i class="fas fa-chart-pie text-primary-600 text-xl"></i>
                        </div>
                        <h3 class="text-xl font-bold text-slate-800 mb-3">Real-Time Analytics</h3>
                        <p class="landing-text-muted text-slate-500 text-sm leading-relaxed">
                            Monitor call volumes, agent performance, and customer satisfaction with live dashboards and custom reports.
                        </p>
                    </div>
                </div>
            </div>

            {{-- Service 4 --}}
            <div class="feature-card landing-card bg-white rounded-2xl overflow-hidden border border-gray-100 shadow-sm section-fade">
                <div class="flex flex-col sm:flex-row">
                    <div class="sm:w-2/5 relative overflow-hidden">
                        <img src="{{ asset('images/callcenter/medium-shot-woman-working-call-center_23-2150454162.jpg') }}"
                             alt="Training" class="w-full h-48 sm:h-full object-cover">
                        <div class="absolute inset-0 bg-gradient-to-r from-primary-600/30 to-transparent"></div>
                    </div>
                    <div class="sm:w-3/5 p-6 lg:p-8">
                        <div class="w-12 h-12 rounded-xl bg-primary-100 flex items-center justify-center mb-4">
                            <i class="fas fa-graduation-cap text-primary-600 text-xl"></i>
                        </div>
                        <h3 class="text-xl font-bold text-slate-800 mb-3">Agent Training</h3>
                        <p class="landing-text-muted text-slate-500 text-sm leading-relaxed">
                            Onboard and train new agents with built-in learning modules, call recording reviews, and performance feedback.
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
