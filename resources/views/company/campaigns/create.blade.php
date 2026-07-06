@extends('layouts.dashboard')
@section('title', 'New Campaign - Company')
@section('page_title', 'Create Campaign')

@section('content')
<div class="mb-6"><a href="{{ route('company.campaigns.index') }}" class="text-sm text-primary-600 hover:text-primary-700">&larr; Back to Campaigns</a></div>
<div class="dash-card bg-white rounded-xl border border-gray-100 p-6 max-w-2xl">
    <form method="POST" action="{{ route('company.campaigns.store') }}">@csrf
        <div class="space-y-4">
            <div><label class="block text-sm font-medium text-gray-700 dash-text-strong mb-1">Name</label><input type="text" name="name" value="{{ old('name') }}" class="w-full px-3 py-2 border border-gray-200 dash-border rounded-lg dash-input text-sm" required></div>
            <div><label class="block text-sm font-medium text-gray-700 dash-text-strong mb-1">Description</label><textarea name="description" rows="2" class="w-full px-3 py-2 border border-gray-200 dash-border rounded-lg dash-input text-sm">{{ old('description') }}</textarea></div>
            <div class="grid grid-cols-2 gap-4">
                <div><label class="block text-sm font-medium text-gray-700 dash-text-strong mb-1">Type</label><select name="type" class="w-full px-3 py-2 border border-gray-200 dash-border rounded-lg dash-input text-sm"><option value="sales">Sales</option><option value="survey">Survey</option><option value="collection">Collection</option></select></div>
            </div>
            <div><label class="block text-sm font-medium text-gray-700 dash-text-strong mb-1">Script</label><textarea name="script" rows="4" class="w-full px-3 py-2 border border-gray-200 dash-border rounded-lg dash-input text-sm" placeholder="Agent script...">{{ old('script') }}</textarea></div>
            <div class="grid grid-cols-2 gap-4">
                <div><label class="block text-sm font-medium text-gray-700 dash-text-strong mb-1">Start Date</label><input type="datetime-local" name="starts_at" value="{{ old('starts_at') }}" class="w-full px-3 py-2 border border-gray-200 dash-border rounded-lg dash-input text-sm"></div>
                <div><label class="block text-sm font-medium text-gray-700 dash-text-strong mb-1">End Date</label><input type="datetime-local" name="ends_at" value="{{ old('ends_at') }}" class="w-full px-3 py-2 border border-gray-200 dash-border rounded-lg dash-input text-sm"></div>
            </div>
        </div>
        <div class="mt-6"><button type="submit" class="px-6 py-2 bg-primary-600 hover:bg-primary-700 text-white text-sm font-medium rounded-lg transition-colors">Create Campaign</button></div>
    </form>
</div>
@endsection
