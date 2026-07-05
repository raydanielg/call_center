@extends('layouts.app')

@section('title', 'Activation Code - ' . config('app.name', 'Laravel'))

@section('auth-image')
<div class="auth-img-bg" style="background-image: url('{{ asset('images/callcenter/call-center-agent-tracking-shipments-office-looking-pc-screen_482257-117862.jpg') }}');"></div>
<div class="auth-img-overlay"></div>

<div class="auth-img-content flex flex-col justify-center items-center h-full p-12 xl:p-16 text-center">
    <h1 class="text-3xl xl:text-4xl font-black text-white mb-6 animate__animated animate__fadeInDown">{{ config('app.name', 'CallCenter') }}</h1>
    <h2 class="text-4xl xl:text-5xl font-black text-white leading-tight mb-4 animate__animated animate__fadeInUp animate__delay-1s">
        Enter The Code
    </h2>
    <p class="text-white/80 text-lg max-w-md leading-relaxed animate__animated animate__fadeInUp animate__delay-1s">
        We've sent a 6-digit activation code to your email. Enter it below to continue.
    </p>
</div>
@endsection

@section('content')
<div class="w-full max-w-md animate__animated animate__fadeInLeft animate__faster">
    <div class="auth-card bg-white rounded-2xl shadow-xl border border-gray-100 overflow-hidden">
        {{-- Header --}}
        <div class="px-8 pt-8 pb-2 text-center">
            <img src="{{ asset('logo.png') }}" alt="Logo" class="h-20 w-auto mx-auto mb-4 animate__animated animate__zoomIn">
            <h2 class="text-2xl font-extrabold text-gray-800">Enter Activation Code</h2>
            <p class="text-gray-400 text-sm mt-1">We sent a 6-digit code to your email</p>
        </div>

        {{-- Form --}}
        <div class="p-8 pt-6">
            @if (session('status'))
                <div class="auth-status-success mb-5 p-4 rounded-lg bg-emerald-50 border border-emerald-200 text-sm text-emerald-700 flex items-center gap-2">
                    <svg class="w-5 h-5 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                    {{ session('status') }}
                </div>
            @endif

            @if (session('error'))
                <div class="auth-status-error mb-5 p-4 rounded-lg bg-red-50 border border-red-200 text-sm text-red-700 flex items-center gap-2">
                    <svg class="w-5 h-5 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                    {{ session('error') }}
                </div>
            @endif

            @if ($errors->any())
                <div class="auth-status-error mb-5 p-4 rounded-lg bg-red-50 border border-red-200 text-sm text-red-700 flex items-center gap-2">
                    <svg class="w-5 h-5 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                    @foreach ($errors->all() as $error){{ $error }} @endforeach
                </div>
            @endif

            <div class="text-center mb-6">
                <p class="text-sm text-gray-500">Code sent to</p>
                <p class="text-sm font-bold text-gray-700">{{ $email }}</p>
            </div>

            <form method="POST" action="{{ route('password.code.verify') }}" class="space-y-5" id="codeForm">
                @csrf
                <input type="hidden" name="email" value="{{ $email }}">

                {{-- Code Input --}}
                <div>
                    <label class="block text-sm font-semibold text-gray-700 mb-2 text-center">6-Digit Activation Code</label>
                    <div class="flex justify-center gap-2" id="codeInputs">
                        <input type="text" maxlength="1" inputmode="numeric" data-index="0"
                            class="auth-code-input code-input w-12 h-14 text-center text-xl font-bold rounded-lg border border-gray-200 focus:border-emerald-500 focus:ring-2 focus:ring-emerald-200 outline-none transition-all">
                        <input type="text" maxlength="1" inputmode="numeric" data-index="1"
                            class="auth-code-input code-input w-12 h-14 text-center text-xl font-bold rounded-lg border border-gray-200 focus:border-emerald-500 focus:ring-2 focus:ring-emerald-200 outline-none transition-all">
                        <input type="text" maxlength="1" inputmode="numeric" data-index="2"
                            class="auth-code-input code-input w-12 h-14 text-center text-xl font-bold rounded-lg border border-gray-200 focus:border-emerald-500 focus:ring-2 focus:ring-emerald-200 outline-none transition-all">
                        <input type="text" maxlength="1" inputmode="numeric" data-index="3"
                            class="auth-code-input code-input w-12 h-14 text-center text-xl font-bold rounded-lg border border-gray-200 focus:border-emerald-500 focus:ring-2 focus:ring-emerald-200 outline-none transition-all">
                        <input type="text" maxlength="1" inputmode="numeric" data-index="4"
                            class="auth-code-input code-input w-12 h-14 text-center text-xl font-bold rounded-lg border border-gray-200 focus:border-emerald-500 focus:ring-2 focus:ring-emerald-200 outline-none transition-all">
                        <input type="text" maxlength="1" inputmode="numeric" data-index="5"
                            class="auth-code-input code-input w-12 h-14 text-center text-xl font-bold rounded-lg border border-gray-200 focus:border-emerald-500 focus:ring-2 focus:ring-emerald-200 outline-none transition-all">
                    </div>
                    <input type="hidden" name="code" id="code-hidden">
                </div>

                <button type="submit" class="w-full py-3 text-sm font-bold text-gray-900 bg-gradient-to-r from-gold-300 to-gold-400 hover:from-gold-400 hover:to-gold-500 rounded-lg shadow-md hover:shadow-lg transition-all flex items-center justify-center gap-2">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/></svg>
                    Verify Code
                </button>
            </form>

            {{-- Resend --}}
            <div class="mt-6 text-center">
                <p class="text-sm text-gray-500 mb-2">Didn't receive the code?</p>
                <form method="POST" action="{{ route('password.resend') }}" id="resendForm">
                    @csrf
                    <input type="hidden" name="email" value="{{ $email }}">
                    <button type="submit" class="text-sm font-semibold text-emerald-600 hover:text-emerald-700 transition-colors">
                        Resend Code
                    </button>
                </form>
            </div>

            <div class="auth-divider relative my-6">
                <div class="absolute inset-0 flex items-center"><div class="w-full border-t border-gray-200"></div></div>
                <div class="relative flex justify-center text-sm"><span class="px-3 bg-white text-gray-400">or</span></div>
            </div>

            <a href="{{ route('password.request') }}" class="block text-center text-sm font-medium text-gray-500 hover:text-emerald-600 transition-colors">Use a different email</a>
        </div>
    </div>

    <p class="auth-footer mt-6 text-center text-xs text-gray-300">&copy; {{ date('Y') }} {{ config('app.name', 'Laravel') }}</p>
</div>

<script>
(function() {
    const inputs = document.querySelectorAll('.code-input');
    const hidden = document.getElementById('code-hidden');
    const form = document.getElementById('codeForm');

    inputs.forEach((input, idx) => {
        input.addEventListener('input', function() {
            this.value = this.value.replace(/\D/g, '');
            if (this.value && idx < inputs.length - 1) {
                inputs[idx + 1].focus();
            }
            updateHidden();
        });

        input.addEventListener('keydown', function(e) {
            if (e.key === 'Backspace' && !this.value && idx > 0) {
                inputs[idx - 1].focus();
            }
        });

        input.addEventListener('paste', function(e) {
            e.preventDefault();
            const pasted = (e.clipboardData || window.clipboardData).getData('text').replace(/\D/g, '');
            pasted.split('').forEach((char, i) => {
                if (inputs[i]) {
                    inputs[i].value = char;
                }
            });
            if (inputs[pasted.length - 1]) {
                inputs[pasted.length - 1].focus();
            } else if (inputs[inputs.length - 1]) {
                inputs[inputs.length - 1].focus();
            }
            updateHidden();
        });
    });

    function updateHidden() {
        hidden.value = Array.from(inputs).map(i => i.value).join('');
    }

    if (form) {
        form.addEventListener('submit', function(e) {
            updateHidden();
            if (hidden.value.length !== 6) {
                e.preventDefault();
                inputs[0].focus();
            }
        });
    }

    if (inputs[0]) inputs[0].focus();
})();
</script>
@endsection
