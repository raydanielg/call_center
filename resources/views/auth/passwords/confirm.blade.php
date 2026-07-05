@extends('layouts.app')

@section('title', 'Confirm Password - ' . config('app.name', 'Laravel'))

@section('auth-image')
<div class="auth-img-bg" style="background-image: url('{{ asset('images/callcenter/african-american-woman-works-call-center-operator-customer-service-agent-wearing-microphone-headsets-working-laptop_627829-606.jpg') }}');"></div>
<div class="auth-img-overlay"></div>

<div class="auth-img-content flex flex-col justify-center items-center h-full p-12 xl:p-16 text-center">
    <h1 class="text-3xl xl:text-4xl font-black text-white mb-6 animate__animated animate__fadeInDown">{{ config('app.name', 'CallCenter') }}</h1>
    <h2 class="text-4xl xl:text-5xl font-black text-white leading-tight mb-4 animate__animated animate__fadeInUp animate__delay-1s">
        Confirm Password
    </h2>
    <p class="text-white/80 text-lg max-w-md leading-relaxed animate__animated animate__fadeInUp animate__delay-1s">
        For your security, please confirm your password before continuing.
    </p>
</div>
@endsection

@section('content')
<div class="w-full max-w-md animate__animated animate__fadeInLeft animate__faster">
    <div class="auth-card bg-white rounded-2xl shadow-xl border border-gray-100 overflow-hidden">
        <div class="px-8 pt-8 pb-2 text-center">
            <img src="{{ asset('logo.png') }}" alt="Logo" class="h-20 w-auto mx-auto mb-4 animate__animated animate__zoomIn">
            <h2 class="text-2xl font-extrabold text-gray-800">Confirm Password</h2>
            <p class="text-gray-400 text-sm mt-1">Please confirm your password before continuing</p>
        </div>

        <div class="p-8 pt-6">
            <p class="text-sm text-gray-600 leading-relaxed mb-6">
                For your security, please confirm your password before continuing.
            </p>

            <form method="POST" action="{{ route('password.confirm') }}" class="space-y-5">
                @csrf

                <div>
                    <label for="password" class="block text-sm font-semibold text-gray-700 mb-1.5">Password</label>
                    <div class="relative">
                        <div class="absolute inset-y-0 left-0 pl-3.5 flex items-center pointer-events-none">
                            <svg class="w-5 h-5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z"/></svg>
                        </div>
                        <input id="password" type="password" name="password" required autocomplete="current-password" autofocus
                            class="w-full pl-11 pr-4 py-2.5 rounded-lg border @error('password') border-red-300 ring-2 ring-red-100 @else border-gray-200 @enderror focus:border-emerald-500 focus:ring-2 focus:ring-emerald-200 outline-none transition-all text-sm"
                            placeholder="Enter your password">
                    </div>
                    @error('password')
                        <p class="mt-1.5 text-sm text-red-600 flex items-center gap-1"><svg class="w-4 h-4 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>{{ $message }}</p>
                    @enderror
                </div>

                <button type="submit" class="w-full py-3 text-sm font-bold text-gray-900 bg-gradient-to-r from-gold-300 to-gold-400 hover:from-gold-400 hover:to-gold-500 rounded-lg shadow-md hover:shadow-lg transition-all flex items-center justify-center gap-2">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/></svg>
                    Confirm Password
                </button>
            </form>

            @if (Route::has('password.request'))
                <div class="mt-5 text-center">
                    <a href="{{ route('password.request') }}" class="text-sm font-medium text-emerald-600 hover:text-emerald-700 transition-colors">Forgot your password?</a>
                </div>
            @endif
        </div>
    </div>

    <p class="auth-footer mt-6 text-center text-xs text-gray-300">&copy; {{ date('Y') }} {{ config('app.name', 'Laravel') }}</p>
</div>
@endsection
