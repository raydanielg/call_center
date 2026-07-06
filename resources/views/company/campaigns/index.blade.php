@extends('layouts.dashboard')
@section('title', 'Campaigns - Company')
@section('page_title', 'Campaigns')

@section('content')
<div class="flex items-center justify-between mb-6">
    <h2 class="text-lg font-bold text-gray-900 dark:text-white">Campaigns</h2>
    <a href="{{ route('company.campaigns.create') }}" class="inline-flex items-center gap-2 px-4 py-2 bg-primary-600 hover:bg-primary-700 text-white text-sm font-medium rounded-lg transition-colors">
        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"/></svg>
        New Campaign
    </a>
</div>
<div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-4">
    @forelse($campaigns as $campaign)
    <div class="dash-card bg-white rounded-xl border border-gray-100 p-5">
        <div class="flex items-start justify-between mb-3">
            <div><h3 class="text-sm font-bold text-gray-900 dark:text-white">{{ $campaign->name }}</h3><p class="text-xs text-gray-400">{{ ucfirst($campaign->type) }}</p></div>
            <form method="POST" action="{{ route('company.campaigns.status', $campaign) }}">@csrf @method('PUT')
                <select name="status" onchange="this.form.submit()" class="text-xs border border-gray-200 dash-border rounded-lg px-2 py-1 dash-input">
                    <option value="draft" {{ $campaign->status === 'draft' ? 'selected' : '' }}>Draft</option>
                    <option value="active" {{ $campaign->status === 'active' ? 'selected' : '' }}>Active</option>
                    <option value="paused" {{ $campaign->status === 'paused' ? 'selected' : '' }}>Paused</option>
                    <option value="completed" {{ $campaign->status === 'completed' ? 'selected' : '' }}>Completed</option>
                </select>
            </form>
        </div>
        <p class="text-sm text-gray-500 dash-text mb-3">{{ $campaign->description ?? 'No description' }}</p>
        <div class="text-xs text-gray-400 space-y-1">
            <p>Starts: {{ $campaign->starts_at?->format('M d, Y') ?? 'N/A' }}</p>
            <p>Ends: {{ $campaign->ends_at?->format('M d, Y') ?? 'N/A' }}</p>
        </div>
        <div class="flex gap-2 mt-4">
            <a href="{{ route('company.campaigns.show', $campaign) }}" class="flex-1 text-center px-3 py-1.5 text-xs font-medium border border-gray-200 dash-border rounded-lg hover:bg-gray-50 dash-hover text-gray-600 dash-text-strong">View</a>
            <form method="POST" action="{{ route('company.campaigns.destroy', $campaign) }}" class="inline" onsubmit="return confirm('Delete campaign?')">@csrf @method('DELETE')<button class="px-3 py-1.5 text-xs font-medium border border-red-200 text-red-600 rounded-lg hover:bg-red-50">Delete</button></form>
        </div>
    </div>
    @empty
    <div class="col-span-full text-center py-12 text-gray-400">No campaigns yet.</div>
    @endforelse
</div>
{{ $campaigns->withQueryString()->links() }}
@endsection
