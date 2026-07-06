@extends('layouts.app')

@section('title', 'Verify Email - ' . config('app.name', 'Zerixa Call Center - For Business'))

@section('auth-image')
<div class="auth-img-bg" style="background-image: url('{{ asset('images/callcenter/call-center-agent-listening-customer-needs-providing-step-by-step-guidance_482257-126192.jpg') }}');"></div>
<div class="auth-img-overlay"></div>

<div class="auth-img-content flex flex-col justify-center items-center h-full p-12 xl:p-16 text-center">
    <h1 class="text-3xl xl:text-4xl font-black text-white mb-6 animate__animated animate__fadeInDown">{{ config('app.name', 'Zerixa Call Center') }}</h1>
    <h2 class="text-4xl xl:text-5xl font-black text-white leading-tight mb-4 animate__animated animate__fadeInUp animate__delay-1s">
        Verify Your Email
    </h2>
    <p class="text-white/80 text-lg max-w-md leading-relaxed animate__animated animate__fadeInUp animate__delay-1s">
        Check your inbox for a verification link to confirm your email address.
    </p>
</div>
@endsection

@section('content')
<div class="w-full max-w-md animate__animated animate__fadeInLeft animate__faster">
    <div class="auth-card bg-white rounded-2xl shadow-xl border border-gray-100 overflow-hidden">
        <div class="px-8 pt-8 pb-2 text-center">
            <img src="{{ asset('images/logo/logo.png') }}" alt="Logo" class="h-20 w-auto mx-auto mb-4 animate__animated animate__zoomIn">
            <h2 class="text-2xl font-extrabold text-gray-800">Verify Your Email</h2>
            <p class="text-gray-400 text-sm mt-1">Check your inbox for a verification link</p>
        </div>

        <div class="p-8 pt-6 text-center">
            @if (session('resent'))
                <div class="auth-status-success mb-5 p-4 rounded-lg bg-blue-50 border border-blue-200 text-sm text-blue-700 flex items-center gap-2">
                    <svg class="w-5 h-5 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                    A fresh verification link has been sent to your email address.
                </div>
            @endif

            <p class="text-sm text-gray-600 leading-relaxed mb-6">
                Before proceeding, please check your email for a verification link. If you did not receive the email, click below to request another.
            </p>

            <form method="POST" action="{{ route('verification.resend') }}">
                @csrf
                <button type="submit" class="w-full py-3 text-sm font-bold text-gray-900 bg-gradient-to-r from-blue-500 to-blue-600 hover:from-blue-600 hover:to-blue-700 rounded-lg shadow-md hover:shadow-lg transition-all flex items-center justify-center gap-2">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 4v5h.582m15.356 2A8.001 8.001 0 004.582 9m0 0H9m11 11v-5h-.581m0 0a8.003 8.003 0 01-15.357-2m15.357 2H15"/></svg>
                    Resend Verification Email
                </button>
            </form>

            <div class="auth-divider relative my-6">
                <div class="absolute inset-0 flex items-center"><div class="w-full border-t border-gray-200"></div></div>
                <div class="relative flex justify-center text-sm"><span class="px-3 bg-white text-gray-400">or</span></div>
            </div>

            <a href="{{ route('logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();" class="text-sm font-medium text-gray-500 hover:text-red-500 transition-colors">Logout</a>
            <form id="logout-form" action="{{ route('logout') }}" method="POST" class="hidden">@csrf</form>
        </div>
    </div>
    <p class="auth-footer mt-6 text-center text-xs text-gray-300">&copy; {{ date('Y') }} {{ config('app.name', 'Zerixa Call Center - For Business') }}</p>
</div>
@endsection
