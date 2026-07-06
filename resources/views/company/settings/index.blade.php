@extends('layouts.dashboard')
@section('title', 'Settings - Company')
@section('page_title', 'Settings')

@section('content')
<div class="grid grid-cols-1 lg:grid-cols-2 gap-4 sm:gap-6">
    <div class="dash-card bg-white rounded-xl border border-gray-100 p-6">
        <h3 class="text-sm font-semibold text-gray-900 dark:text-white mb-4">General Settings</h3>
        <form method="POST" action="{{ route('company.settings.update') }}">@csrf @method('PUT')
            <div class="space-y-4">
                <div><label class="block text-sm font-medium text-gray-700 dash-text-strong mb-1">Company Name</label><input type="text" name="company_name" value="{{ $settings['company_name'] ?? '' }}" class="w-full px-3 py-2 border border-gray-200 dash-border rounded-lg dash-input text-sm"></div>
                <div><label class="block text-sm font-medium text-gray-700 dash-text-strong mb-1">Timezone</label><input type="text" name="timezone" value="{{ $settings['timezone'] ?? 'Africa/Dar_es_Salaam' }}" class="w-full px-3 py-2 border border-gray-200 dash-border rounded-lg dash-input text-sm"></div>
                <div><label class="block text-sm font-medium text-gray-700 dash-text-strong mb-1">SLA Hours (Default)</label><input type="number" name="default_sla_hours" value="{{ $settings['default_sla_hours'] ?? 24 }}" class="w-full px-3 py-2 border border-gray-200 dash-border rounded-lg dash-input text-sm"></div>
            </div>
            <div class="mt-6"><button type="submit" class="px-6 py-2 bg-primary-600 hover:bg-primary-700 text-white text-sm font-medium rounded-lg transition-colors">Save Settings</button></div>
        </form>
    </div>
    <div class="dash-card bg-white rounded-xl border border-gray-100 p-6">
        <h3 class="text-sm font-semibold text-gray-900 dark:text-white mb-4">Call Dispositions</h3>
        <form method="POST" action="{{ route('company.settings.dispositions.store') }}" class="flex gap-2 mb-4">@csrf
            <input type="text" name="name" placeholder="Disposition name" class="flex-1 px-3 py-2 border border-gray-200 dash-border rounded-lg dash-input text-sm" required>
            <input type="color" name="color" value="#6b7280" class="w-10 h-10 rounded-lg border border-gray-200 dash-border">
            <button type="submit" class="px-4 py-2 bg-primary-600 hover:bg-primary-700 text-white text-sm font-medium rounded-lg">Add</button>
        </form>
        <div class="space-y-2">
            @forelse($dispositions as $disposition)
            <div class="flex items-center justify-between">
                <div class="flex items-center gap-2"><span class="w-3 h-3 rounded-full" style="background: {{ $disposition->color }}"></span><span class="text-sm text-gray-700 dash-text-strong">{{ $disposition->name }}</span></div>
                <form method="POST" action="{{ route('company.settings.dispositions.destroy', $disposition) }}" class="inline">@csrf @method('DELETE')<button class="text-xs text-red-600 hover:text-red-700">Remove</button></form>
            </div>
            @empty
            <p class="text-sm text-gray-400">No dispositions configured.</p>
            @endforelse
        </div>
    </div>
</div>
@endsection
