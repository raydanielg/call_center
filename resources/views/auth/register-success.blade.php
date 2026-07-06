@extends('layouts.app')

@section('title', 'Registration Successful - ' . config('app.name', 'Zerixa Call Center - For Business'))

@section('auth-image')
<div class="auth-img-bg" style="background-image: url('{{ asset('images/callcenter/jolly-call-center-professional-typing-pc-keyboard-assisting-customers_482257-125196.jpg') }}');"></div>
<div class="auth-img-overlay"></div>

<div class="auth-img-content flex flex-col justify-center items-center h-full p-12 xl:p-16 text-center">
    <h1 class="text-3xl xl:text-4xl font-black text-white mb-6 animate__animated animate__fadeInDown">{{ config('app.name', 'Zerixa Call Center') }}</h1>
    <h2 class="text-4xl xl:text-5xl font-black text-white leading-tight mb-4 animate__animated animate__fadeInUp animate__delay-1s">
        You're All Set!
    </h2>
    <p class="text-white/80 text-lg max-w-md leading-relaxed animate__animated animate__fadeInUp animate__delay-1s">
        Your account has been created successfully. Log in to start exploring.
    </p>
</div>
@endsection

@section('content')
<div class="w-full max-w-md animate__animated animate__fadeInLeft animate__faster">
    <div class="auth-card bg-white rounded-2xl shadow-xl border border-gray-100 overflow-hidden text-center">
        {{-- Success Header --}}
        <div class="px-8 pt-8 pb-2 text-center relative overflow-hidden">
            <div class="auth-decor-1 absolute top-2 left-4 w-2 h-2 rounded-full bg-blue-100"></div>
            <div class="auth-decor-2 absolute top-6 right-8 w-3 h-3 rounded-full bg-blue-50"></div>
            <div class="auth-decor-3 absolute bottom-4 left-10 w-2 h-2 rounded-full bg-blue-100"></div>
            <div class="auth-decor-4 absolute top-10 right-4 w-1.5 h-1.5 rounded-full bg-blue-50"></div>

            <img src="{{ asset('images/logo/logo.png') }}" alt="Logo" class="h-20 w-auto mx-auto mb-4 animate__animated animate__zoomIn">
            <h2 class="text-2xl font-extrabold text-gray-800">Account Created!</h2>
            <p class="text-gray-400 text-sm mt-1">Welcome to {{ config('app.name', 'Zerixa Call Center - For Business') }}</p>
        </div>

        {{-- Body --}}
        <div class="p-8 pt-6">
            <div class="space-y-4">
                <p class="text-sm text-gray-600 leading-relaxed">
                    Your account has been successfully created. You can now log in and get started.
                </p>
        @if(session('registered_email'))
                <div class="auth-email-badge inline-flex items-center gap-2 px-4 py-2 bg-gray-50 rounded-lg border border-gray-100">
                    <svg class="w-4 h-4 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"/></svg>
                    <span class="text-xs text-gray-600 font-medium">{{ session('registered_email') }}</span>
                </div>
        @endif

                {{-- Steps indicator --}}
                <div class="flex items-center justify-center gap-3 py-2">
                    <div class="flex flex-col items-center gap-1">
                        <div class="auth-step w-8 h-8 rounded-full bg-blue-100 flex items-center justify-center">
                            <svg class="w-4 h-4 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/></svg>
                        </div>
                        <span class="text-[10px] text-gray-400">Register</span>
                    </div>
                    <div class="w-8 h-0.5 bg-blue-200 rounded-full"></div>
                    <div class="flex flex-col items-center gap-1">
                        <div class="w-8 h-8 rounded-full bg-amber-100 flex items-center justify-center">
                            <svg class="w-4 h-4 text-amber-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 16l-4-4m0 0l4-4m-4 4h14m-5 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h7a3 3 0 013 3v1"/></svg>
                        </div>
                        <span class="text-[10px] text-gray-500 font-medium">Log In</span>
                    </div>
                    <div class="w-8 h-0.5 bg-gray-200 rounded-full"></div>
                    <div class="flex flex-col items-center gap-1">
                        <div class="w-8 h-8 rounded-full bg-gray-100 flex items-center justify-center">
                            <svg class="w-4 h-4 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z"/></svg>
                        </div>
                        <span class="text-[10px] text-gray-400">Start</span>
                    </div>
                </div>
            </div>

            {{-- Login Button --}}
            <div class="mt-8 space-y-3">
                <a href="{{ route('login') }}" class="w-full py-3 text-sm font-bold text-white bg-gradient-to-r from-blue-500 to-blue-600 hover:from-blue-600 hover:to-blue-700 rounded-xl shadow-lg hover:shadow-xl transition-all flex items-center justify-center gap-2">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 16l-4-4m0 0l4-4m-4 4h14m-5 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h7a3 3 0 013 3v1"/></svg>
                    Go to Login
                </a>

                <a href="{{ url('/') }}" class="auth-secondary-btn w-full py-2.5 text-sm font-medium text-gray-600 bg-gray-50 hover:bg-gray-100 border border-gray-200 rounded-xl transition-all flex items-center justify-center gap-2">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6"/></svg>
                    Back to Home
                </a>
            </div>
        </div>
    </div>

    <p class="auth-footer mt-6 text-center text-xs text-gray-300">&copy; {{ date('Y') }} {{ config('app.name', 'Zerixa Call Center - For Business') }}</p>
</div>
@endsection
