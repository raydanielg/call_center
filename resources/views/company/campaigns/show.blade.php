@extends('layouts.dashboard')
@section('title', $campaign->name)
@section('page_title', $campaign->name)

@section('content')
<div class="mb-6"><a href="{{ route('company.campaigns.index') }}" class="text-sm text-primary-600 hover:text-primary-700">&larr; Back to Campaigns</a></div>
<div class="grid grid-cols-1 lg:grid-cols-3 gap-4 sm:gap-6">
    <div class="dash-card lg:col-span-2 bg-white rounded-xl border border-gray-100 p-6">
        <h3 class="text-sm font-semibold text-gray-900 dark:text-white mb-4">Campaign Details</h3>
        <div class="space-y-3 text-sm">
            <div><p class="text-xs text-gray-400">Name</p><p class="font-medium text-gray-900 dark:text-white">{{ $campaign->name }}</p></div>
            <div><p class="text-xs text-gray-400">Type</p><p class="font-medium text-gray-900 dark:text-white">{{ ucfirst($campaign->type) }}</p></div>
            <div><p class="text-xs text-gray-400">Description</p><p class="text-gray-600 dash-text">{{ $campaign->description ?? 'N/A' }}</p></div>
            @if($campaign->script)<div><p class="text-xs text-gray-400">Script</p><pre class="text-gray-600 dash-text whitespace-pre-wrap text-sm">{{ $campaign->script }}</pre></div>@endif
        </div>
    </div>
    <div class="dash-card bg-white rounded-xl border border-gray-100 p-5">
        <h3 class="text-sm font-semibold text-gray-900 dark:text-white mb-4">Contacts ({{ $campaign->contacts->count() }})</h3>
        @if($campaign->contacts->isEmpty())
        <p class="text-sm text-gray-400">No contacts in this campaign.</p>
        @else
        <div class="space-y-2 max-h-64 overflow-y-auto">
            @foreach($campaign->contacts as $cc)
            <div class="flex items-center justify-between text-sm">
                <span class="text-gray-900 dark:text-white">{{ $cc->contact->name }}</span>
                <span class="text-xs px-2 py-0.5 rounded-full {{ $cc->status === 'completed' ? 'bg-green-100 text-green-700' : ($cc->status === 'called' ? 'bg-amber-100 text-amber-700' : 'bg-gray-100 text-gray-500') }}">{{ ucfirst($cc->status) }}</span>
            </div>
            @endforeach
        </div>
        @endif
    </div>
</div>
@endsection
