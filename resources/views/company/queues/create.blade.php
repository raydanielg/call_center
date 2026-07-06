@extends('layouts.dashboard')
@section('title', 'New Queue - Company')
@section('page_title', 'Create Queue')

@section('content')
<div class="mb-6"><a href="{{ route('company.queues.index') }}" class="text-sm text-primary-600 hover:text-primary-700">&larr; Back to Queues</a></div>
<div class="dash-card bg-white rounded-xl border border-gray-100 p-6 max-w-2xl">
    <form method="POST" action="{{ route('company.queues.store') }}">@csrf
        <div class="space-y-4">
            <div><label class="block text-sm font-medium text-gray-700 dash-text-strong mb-1">Name</label><input type="text" name="name" value="{{ old('name') }}" class="w-full px-3 py-2 border border-gray-200 dash-border rounded-lg dash-input text-sm" required></div>
            <div><label class="block text-sm font-medium text-gray-700 dash-text-strong mb-1">Description</label><textarea name="description" rows="2" class="w-full px-3 py-2 border border-gray-200 dash-border rounded-lg dash-input text-sm">{{ old('description') }}</textarea></div>
            <div class="grid grid-cols-2 gap-4">
                <div><label class="block text-sm font-medium text-gray-700 dash-text-strong mb-1">Strategy</label><select name="strategy" class="w-full px-3 py-2 border border-gray-200 dash-border rounded-lg dash-input text-sm"><option value="round_robin">Round Robin</option><option value="longest_idle">Longest Idle</option></select></div>
                <div><label class="block text-sm font-medium text-gray-700 dash-text-strong mb-1">Max Wait (seconds)</label><input type="number" name="max_wait_time" value="{{ old('max_wait_time', 300) }}" class="w-full px-3 py-2 border border-gray-200 dash-border rounded-lg dash-input text-sm" required></div>
            </div>
            <div>
                <label class="block text-sm font-medium text-gray-700 dash-text-strong mb-2">Agents</label>
                <div class="space-y-2 max-h-48 overflow-y-auto">
                    @foreach($agents as $agent)
                    <label class="flex items-center gap-2"><input type="checkbox" name="agents[]" value="{{ $agent->id }}" class="rounded"> <span class="text-sm text-gray-700 dash-text-strong">{{ $agent->name }}</span></label>
                    @endforeach
                </div>
            </div>
        </div>
        <div class="mt-6"><button type="submit" class="px-6 py-2 bg-primary-600 hover:bg-primary-700 text-white text-sm font-medium rounded-lg transition-colors">Create Queue</button></div>
    </form>
</div>
@endsection
