@extends('layouts.dashboard')
@section('title', 'Evaluations - QA')
@section('page_title', 'Evaluations')

@section('content')
<div class="flex items-center justify-between mb-6">
    <h2 class="text-lg font-bold text-gray-900 dark:text-white">Evaluations</h2>
    <a href="{{ route('qa.evaluations.create') }}" class="inline-flex items-center gap-2 px-4 py-2 bg-primary-600 hover:bg-primary-700 text-white text-sm font-medium rounded-lg transition-colors">
        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"/></svg>
        New Evaluation
    </a>
</div>
<div class="dash-card bg-white rounded-xl border border-gray-100 overflow-hidden">
    <div class="overflow-x-auto">
        <table class="w-full text-sm">
            <thead class="bg-gray-50 dash-bg-subtle border-b border-gray-100 dash-border"><tr><th class="text-left px-4 py-3 font-medium text-gray-500 dash-text">Agent</th><th class="text-left px-4 py-3 font-medium text-gray-500 dash-text">Score</th><th class="text-left px-4 py-3 font-medium text-gray-500 dash-text">Evaluator</th><th class="text-left px-4 py-3 font-medium text-gray-500 dash-text">Status</th><th class="text-left px-4 py-3 font-medium text-gray-500 dash-text">Date</th></tr></thead>
            <tbody class="divide-y divide-gray-100 dash-border">
                @forelse($evaluations as $eval)
                <tr class="hover:bg-gray-50 dash-hover"><td class="px-4 py-3 font-medium text-gray-900 dark:text-white">{{ $eval->agent->name ?? 'N/A' }}</td><td class="px-4 py-3"><a href="{{ route('qa.evaluations.show', $eval) }}" class="font-bold text-primary-600">{{ $eval->total_score }}/100</a></td><td class="px-4 py-3 text-gray-500 dash-text">{{ $eval->evaluator->name ?? 'N/A' }}</td><td class="px-4 py-3"><span class="text-xs px-2 py-0.5 rounded-full {{ $eval->status === 'submitted' ? 'bg-green-100 text-green-700' : 'bg-amber-100 text-amber-700' }}">{{ ucfirst($eval->status) }}</span></td><td class="px-4 py-3 text-gray-500 dash-text">{{ $eval->created_at->format('M d, Y') }}</td></tr>
                @empty
                <tr><td colspan="5" class="text-center py-12 text-gray-400">No evaluations found.</td></tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>
{{ $evaluations->withQueryString()->links() }}
@endsection
