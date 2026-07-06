@extends('layouts.dashboard')
@section('title', 'Profile')
@section('page_title', 'My Profile')

@section('content')
<div class="grid grid-cols-1 lg:grid-cols-2 gap-4 sm:gap-6">
    <div class="dash-card bg-white rounded-xl border border-gray-100 p-6">
        <h3 class="text-sm font-semibold text-gray-900 dark:text-white mb-4">Profile Information</h3>
        <form method="POST" action="{{ route('profile.update') }}">@csrf @method('PUT')
            <div class="space-y-4">
                <div><label class="block text-sm font-medium text-gray-700 dash-text-strong mb-1">Name</label><input type="text" name="name" value="{{ old('name', auth()->user()->name) }}" class="w-full px-3 py-2 border border-gray-200 dash-border rounded-lg dash-input text-sm" required></div>
                <div><label class="block text-sm font-medium text-gray-700 dash-text-strong mb-1">Email</label><input type="email" name="email" value="{{ old('email', auth()->user()->email) }}" class="w-full px-3 py-2 border border-gray-200 dash-border rounded-lg dash-input text-sm" required></div>
                <div><label class="block text-sm font-medium text-gray-700 dash-text-strong mb-1">Phone</label><input type="text" name="phone" value="{{ old('phone', auth()->user()->phone) }}" class="w-full px-3 py-2 border border-gray-200 dash-border rounded-lg dash-input text-sm"></div>
            </div>
            <div class="mt-6"><button type="submit" class="px-6 py-2 bg-primary-600 hover:bg-primary-700 text-white text-sm font-medium rounded-lg transition-colors">Save Changes</button></div>
        </form>
    </div>
    <div class="dash-card bg-white rounded-xl border border-gray-100 p-6">
        <h3 class="text-sm font-semibold text-gray-900 dark:text-white mb-4">Change Password</h3>
        <form method="POST" action="{{ route('profile.password') }}">@csrf @method('PUT')
            <div class="space-y-4">
                <div><label class="block text-sm font-medium text-gray-700 dash-text-strong mb-1">Current Password</label><input type="password" name="current_password" class="w-full px-3 py-2 border border-gray-200 dash-border rounded-lg dash-input text-sm" required></div>
                <div><label class="block text-sm font-medium text-gray-700 dash-text-strong mb-1">New Password</label><input type="password" name="password" class="w-full px-3 py-2 border border-gray-200 dash-border rounded-lg dash-input text-sm" required></div>
                <div><label class="block text-sm font-medium text-gray-700 dash-text-strong mb-1">Confirm Password</label><input type="password" name="password_confirmation" class="w-full px-3 py-2 border border-gray-200 dash-border rounded-lg dash-input text-sm" required></div>
            </div>
            <div class="mt-6"><button type="submit" class="px-6 py-2 bg-primary-600 hover:bg-primary-700 text-white text-sm font-medium rounded-lg transition-colors">Update Password</button></div>
        </form>
    </div>
</div>
@endsection
