@extends('layouts.dashboard')
@section('title', 'Account Suspended')
@section('page_title', 'Account Suspended')

@section('content')
<div class="flex items-center justify-center min-h-[60vh]">
    <div class="text-center max-w-md">
        <div class="w-16 h-16 mx-auto bg-red-100 dark:bg-red-900/30 rounded-full flex items-center justify-center mb-4">
            <svg class="w-8 h-8 text-red-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M18.364 18.364A9 9 0 005.636 5.636m12.728 12.728A9 9 0 015.636 5.636m12.728 12.728L5.636 5.636"/></svg>
        </div>
        <h2 class="text-xl font-bold text-gray-900 dark:text-white mb-2">Account Suspended</h2>
        <p class="text-sm text-gray-500 dash-text mb-6">Your account has been suspended. Please contact support to resolve this issue.</p>
        <a href="mailto:support@zerixacc.com" class="inline-block px-6 py-2 bg-primary-600 hover:bg-primary-700 text-white text-sm font-medium rounded-lg transition-colors">Contact Support</a>
    </div>
</div>
@endsection
