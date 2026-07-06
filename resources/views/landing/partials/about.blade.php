{{-- About Section --}}
<section id="about" class="py-20 lg:py-28 bg-gray-50 dark:bg-gray-800/50">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="grid lg:grid-cols-2 gap-12 lg:gap-16 items-center">
            {{-- Image Side --}}
            <div class="relative section-fade">
                <div class="relative rounded-2xl overflow-hidden shadow-xl">
                    <img src="{{ asset('images/callcenter/happy-call-center-worker-working-reduce-clients-complaints_482257-117934.jpg') }}"
                         alt="About Zerixa" class="w-full h-[400px] lg:h-[480px] object-cover">
                    <div class="absolute inset-0 bg-gradient-to-t from-primary-900/30 to-transparent"></div>
                </div>
                {{-- Floating badge --}}
                <div class="absolute -bottom-5 -right-5 lg:-right-6 bg-white dark:bg-gray-800 rounded-xl p-5 shadow-lg border border-gray-100 dark:border-gray-700">
                    <div class="flex items-center gap-3">
                        <div class="w-12 h-12 rounded-xl bg-primary-600 flex items-center justify-center">
                            <i class="fas fa-cloud text-white text-xl"></i>
                        </div>
                        <div>
                            <p class="text-2xl font-black text-gray-900 dark:text-white">100%</p>
                            <p class="text-gray-500 dark:text-gray-400 text-xs font-medium">Cloud-Based</p>
                        </div>
                    </div>
                </div>
                {{-- Decorative element --}}
                <div class="absolute -top-3 -left-3 w-20 h-20 bg-primary-200/40 rounded-2xl blur-2xl"></div>
            </div>

            {{-- Content Side --}}
            <div class="section-fade">
                <span class="inline-block px-3 py-1 rounded-full bg-primary-100 dark:bg-primary-900/30 text-primary-600 dark:text-primary-400 text-xs font-semibold mb-4">
                    About Us
                </span>
                <h2 class="text-3xl lg:text-4xl font-extrabold text-gray-900 dark:text-white mb-5 leading-tight">
                    Modern Call Center,<br>
                    <span class="text-primary-600">Built for Every Business</span>
                </h2>
                <p class="text-gray-600 dark:text-gray-300 text-base lg:text-lg leading-relaxed mb-6">
                    Zerixa Call Center is a modern cloud-based Call Center system delivered as Software as a Service (SaaS). It enables companies and organizations of any size to launch and run a fully functional customer service center without expensive hardware or dedicated IT staff.
                </p>
                <p class="text-gray-500 dark:text-gray-400 text-sm lg:text-base leading-relaxed mb-8">
                    A company simply signs up, selects a subscription plan that fits its needs, and within minutes has a complete, ready-to-use call center running online.
                </p>

                {{-- Feature list --}}
                <div class="space-y-3 mb-8">
                    <div class="flex items-center gap-3">
                        <div class="flex-shrink-0 w-8 h-8 rounded-lg bg-primary-100 dark:bg-primary-900/30 flex items-center justify-center">
                            <i class="fas fa-check text-primary-600 dark:text-primary-400 text-sm"></i>
                        </div>
                        <p class="text-gray-700 dark:text-gray-200 text-sm font-medium">No hardware costs — everything runs in the cloud</p>
                    </div>
                    <div class="flex items-center gap-3">
                        <div class="flex-shrink-0 w-8 h-8 rounded-lg bg-primary-100 dark:bg-primary-900/30 flex items-center justify-center">
                            <i class="fas fa-check text-primary-600 dark:text-primary-400 text-sm"></i>
                        </div>
                        <p class="text-gray-700 dark:text-gray-200 text-sm font-medium">Pay-as-you-grow pricing for any business size</p>
                    </div>
                    <div class="flex items-center gap-3">
                        <div class="flex-shrink-0 w-8 h-8 rounded-lg bg-primary-100 dark:bg-primary-900/30 flex items-center justify-center">
                            <i class="fas fa-check text-primary-600 dark:text-primary-400 text-sm"></i>
                        </div>
                        <p class="text-gray-700 dark:text-gray-200 text-sm font-medium">Complete data isolation and security for every company</p>
                    </div>
                    <div class="flex items-center gap-3">
                        <div class="flex-shrink-0 w-8 h-8 rounded-lg bg-primary-100 dark:bg-primary-900/30 flex items-center justify-center">
                            <i class="fas fa-check text-primary-600 dark:text-primary-400 text-sm"></i>
                        </div>
                        <p class="text-gray-700 dark:text-gray-200 text-sm font-medium">Instant setup — start serving customers in minutes</p>
                    </div>
                </div>

                <a href="{{ route('register') }}" class="inline-flex items-center gap-2 px-6 py-3 text-sm font-semibold text-white bg-primary-600 hover:bg-primary-700 rounded-lg transition-all">
                    Get Started Today
                    <i class="fas fa-arrow-right text-xs"></i>
                </a>
            </div>
        </div>
    </div>
</section>
