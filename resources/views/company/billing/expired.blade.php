@extends('layouts.dashboard')
@section('title', 'Subscription Expired')
@section('page_title', 'Subscription Expired')

@section('content')
<div class="flex items-center justify-center min-h-[60vh]">
    <div class="text-center max-w-md">
        <div class="w-16 h-16 mx-auto bg-amber-100 dark:bg-amber-900/30 rounded-full flex items-center justify-center mb-4">
            <svg class="w-8 h-8 text-amber-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
        </div>
        <h2 class="text-xl font-bold text-gray-900 dark:text-white mb-2">Subscription Expired</h2>
        <p class="text-sm text-gray-500 dash-text mb-6">Your subscription has expired. Please renew to continue using the platform.</p>
        <a href="{{ route('company.billing.index') }}" class="inline-block px-6 py-2 bg-primary-600 hover:bg-primary-700 text-white text-sm font-medium rounded-lg transition-colors">Renew Now</a>
    </div>
</div>
@endsection
