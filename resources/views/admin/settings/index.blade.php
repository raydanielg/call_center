@extends('layouts.dashboard')
@section('title', 'System Settings - Admin')
@section('page_title', 'System Settings')

@section('content')
<div class="dash-card bg-white rounded-xl border border-gray-100 p-6 max-w-2xl">
    <form method="POST" action="{{ route('admin.settings.update') }}">
        @csrf @method('PUT')
        @if($settings->isNotEmpty())
        @foreach($settings as $setting)
        <div class="mb-4">
            <label class="block text-sm font-medium text-gray-700 dash-text-strong mb-1">{{ ucwords(str_replace('_', ' ', $setting->key)) }}</label>
            <input type="text" name="{{ $setting->key }}" value="{{ $setting->value }}" class="w-full px-3 py-2 border border-gray-200 dash-border rounded-lg dash-input text-sm">
        </div>
        @endforeach
        @else
        <p class="text-sm text-gray-400 text-center py-8">No system settings configured yet.</p>
        @endif
        <button type="submit" class="px-6 py-2 bg-primary-600 hover:bg-primary-700 text-white text-sm font-medium rounded-lg transition-colors">Save Settings</button>
    </form>
</div>
@endsection
