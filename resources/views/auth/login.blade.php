@extends('layouts.app')

@section('title', 'Login - ' . config('app.name', 'Zerixa Call Center - For Business'))

@section('auth-image')
<div class="auth-img-bg" style="background-image: url('{{ asset('images/callcenter/young-friendly-operator-woman-agent-with-headsets-beautiful-business-woman-wearing-microphone-headset-working-office-as-telemarketing-customer-service-agent-call-center-job-concept_657921-1733.jpg') }}');"></div>
<div class="auth-img-overlay"></div>

<div class="auth-img-content flex flex-col justify-center items-center h-full p-12 xl:p-16 text-center">
    <h1 class="text-3xl xl:text-4xl font-black text-white mb-6 animate__animated animate__fadeInDown">{{ config('app.name', 'Zerixa Call Center') }}</h1>
    <h2 class="text-4xl xl:text-5xl font-black text-white leading-tight mb-4 animate__animated animate__fadeInUp animate__delay-1s">
        Welcome Back
    </h2>
    <p class="text-white/80 text-lg max-w-md leading-relaxed animate__animated animate__fadeInUp animate__delay-1s">
        Sign in to access your dashboard, manage calls, and track performance.
    </p>
</div>
@endsection

@section('content')
<div class="w-full max-w-md animate__animated animate__fadeInLeft animate__faster">
    <div class="auth-card bg-white rounded-2xl shadow-xl border border-gray-100 overflow-hidden">
        {{-- Header --}}
        <div class="px-8 pt-8 pb-2 text-center">
            <img src="{{ asset('images/logo/logo.png') }}" alt="Logo" class="h-20 w-auto mx-auto mb-4 animate__animated animate__zoomIn">
            <h2 class="text-2xl font-extrabold text-gray-800">Welcome Back</h2>
            <p class="text-gray-400 text-sm mt-1">Sign in to your account</p>
        </div>

        {{-- Form --}}
        <div class="p-8 pt-6">
            @if (session('status'))
                <div class="auth-status-success mb-5 p-4 rounded-lg bg-blue-50 border border-blue-200 text-sm text-blue-700 flex items-center gap-2">
                    <svg class="w-5 h-5 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                    {{ session('status') }}
                </div>
            @endif

            <form method="POST" action="{{ route('login') }}" class="space-y-5">
                @csrf

                {{-- Email --}}
                <div>
                    <label for="email" class="block text-sm font-semibold text-gray-700 mb-1.5">Email Address</label>
                    <div class="relative">
                        <div class="absolute inset-y-0 left-0 pl-3.5 flex items-center pointer-events-none">
                            <svg class="w-5 h-5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 12a4 4 0 10-8 0 4 4 0 008 0zm0 0v1.5a2.5 2.5 0 005 0V12a9 9 0 10-9 9m4.5-1.206a8.959 8.959 0 01-4.5 1.207"/></svg>
                        </div>
                        <input id="email" type="email" name="email" value="{{ old('email') }}" required autocomplete="email" autofocus
                            class="w-full pl-11 pr-4 py-2.5 rounded-lg border @error('email') border-red-300 ring-2 ring-red-100 @else border-gray-200 @enderror focus:border-blue-500 focus:ring-2 focus:ring-blue-200 outline-none transition-all text-sm"
                            placeholder="you@example.com">
                    </div>
                    @error('email')
                        <p class="mt-1.5 text-sm text-red-600 flex items-center gap-1"><svg class="w-4 h-4 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>{{ $message }}</p>
                    @enderror
                </div>

                {{-- Password --}}
                <div>
                    <label for="password" class="block text-sm font-semibold text-gray-700 mb-1.5">Password</label>
                    <div class="relative">
                        <div class="absolute inset-y-0 left-0 pl-3.5 flex items-center pointer-events-none">
                            <svg class="w-5 h-5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z"/></svg>
                        </div>
                        <input id="password" type="password" name="password" required autocomplete="current-password"
                            class="w-full pl-11 pr-4 py-2.5 rounded-lg border @error('password') border-red-300 ring-2 ring-red-100 @else border-gray-200 @enderror focus:border-blue-500 focus:ring-2 focus:ring-blue-200 outline-none transition-all text-sm"
                            placeholder="Enter your password">
                    </div>
                    @error('password')
                        <p class="mt-1.5 text-sm text-red-600 flex items-center gap-1"><svg class="w-4 h-4 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>{{ $message }}</p>
                    @enderror
                </div>

                {{-- Remember + Forgot --}}
                <div class="flex items-center justify-between">
                    <label class="flex items-center gap-2 cursor-pointer">
                        <input type="checkbox" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }}
                            class="w-4 h-4 rounded border-gray-300 text-blue-600 focus:ring-blue-500">
                        <span class="text-sm text-gray-600">Remember me</span>
                    </label>
                    @if (Route::has('password.request'))
                        <a href="{{ route('password.request') }}" class="text-sm font-medium text-blue-600 hover:text-blue-700 transition-colors">Forgot password?</a>
                    @endif
                </div>

                {{-- Submit --}}
                <button type="submit" id="loginBtn" class="w-full py-3 text-sm font-bold text-gray-900 bg-gradient-to-r from-blue-500 to-blue-600 hover:from-blue-600 hover:to-blue-700 rounded-lg shadow-md hover:shadow-lg transition-all flex items-center justify-center gap-2">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 16l-4-4m0 0l4-4m-4 4h14m-5 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h7a3 3 0 013 3v1"/></svg>
                    <span id="loginBtnText">Sign In</span>
                </button>
            </form>

            @if (Route::has('register'))
                <div class="auth-divider relative my-6">
                    <div class="absolute inset-0 flex items-center"><div class="w-full border-t border-gray-200"></div></div>
                    <div class="relative flex justify-center text-sm"><span class="px-3 bg-white text-gray-400">or</span></div>
                </div>

                <p class="text-center text-sm text-gray-500">
                    Don't have an account?
                    <a href="{{ route('register') }}" class="font-semibold text-blue-600 hover:text-blue-700 transition-colors">Create one</a>
                </p>
            @endif
        </div>
    </div>

    <p class="auth-footer mt-6 text-center text-xs text-gray-300">&copy; {{ date('Y') }} {{ config('app.name', 'Zerixa Call Center - For Business') }}</p>
</div>
@endsection
