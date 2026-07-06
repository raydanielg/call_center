@extends('layouts.dashboard')
@section('title', 'QA Reports')
@section('page_title', 'QA Reports')

@section('content')
<div class="mb-6"><h2 class="text-lg font-bold text-gray-900 dark:text-white">Quality Assurance Reports</h2></div>
<div class="grid grid-cols-1 lg:grid-cols-2 gap-4 sm:gap-6">
    <div class="dash-card bg-white rounded-xl border border-gray-100 p-5">
        <h3 class="text-sm font-semibold text-gray-900 dark:text-white mb-4">Agent Scores</h3>
        <div class="space-y-3">
            @foreach($agentScores as $agent)
            <div class="flex items-center justify-between">
                <div><p class="text-sm font-medium text-gray-900 dark:text-white">{{ $agent->name }}</p><p class="text-xs text-gray-400">{{ $agent->evaluation_count }} evaluations</p></div>
                <div class="text-right"><p class="text-sm font-bold text-primary-600">{{ round($agent->avg_score) }}/100</p></div>
            </div>
            @endforeach
            @if($agentScores->isEmpty())<p class="text-sm text-gray-400 text-center py-4">No evaluation data.</p>@endif
        </div>
    </div>
    <div class="dash-card bg-white rounded-xl border border-gray-100 p-5">
        <h3 class="text-sm font-semibold text-gray-900 dark:text-white mb-4">Avg Score by Category</h3>
        <div class="space-y-4">
            @foreach($avgScoreByCategory as $category => $score)
            <div>
                <div class="flex items-center justify-between mb-1"><span class="text-sm text-gray-700 dash-text-strong">{{ ucfirst(str_replace('_', ' ', $category)) }}</span><span class="text-sm font-bold text-gray-900 dark:text-white">{{ round($score, 1) }}/20</span></div>
                <div class="bg-gray-100 dash-bg-subtle rounded-full h-2 overflow-hidden"><div class="bg-primary-500 h-full rounded-full" style="width: {{ ($score / 20) * 100 }}%"></div></div>
            </div>
            @endforeach
        </div>
    </div>
</div>
@endsection
