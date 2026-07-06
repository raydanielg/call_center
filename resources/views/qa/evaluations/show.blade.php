@extends('layouts.dashboard')
@section('title', 'Evaluation Details')
@section('page_title', 'Evaluation Details')

@section('content')
<div class="mb-6"><a href="{{ route('qa.evaluations.index') }}" class="text-sm text-primary-600 hover:text-primary-700">&larr; Back to Evaluations</a></div>
<div class="grid grid-cols-1 lg:grid-cols-3 gap-4 sm:gap-6">
    <div class="dash-card lg:col-span-2 bg-white rounded-xl border border-gray-100 p-6">
        <h3 class="text-sm font-semibold text-gray-900 dark:text-white mb-4">Evaluation Scores</h3>
        <div class="space-y-4">
            @php $categories = ['greeting_score' => 'Greeting', 'communication_score' => 'Communication', 'problem_solving_score' => 'Problem Solving', 'compliance_score' => 'Compliance', 'closing_score' => 'Closing']; @endphp
            @foreach($categories as $field => $label)
            <div>
                <div class="flex items-center justify-between mb-1"><span class="text-sm text-gray-700 dash-text-strong">{{ $label }}</span><span class="text-sm font-bold text-gray-900 dark:text-white">{{ $evaluation->$field }}/20</span></div>
                <div class="bg-gray-100 dash-bg-subtle rounded-full h-2 overflow-hidden"><div class="bg-primary-500 h-full rounded-full" style="width: {{ ($evaluation->$field / 20) * 100 }}%"></div></div>
            </div>
            @endforeach
        </div>
        <div class="mt-6 pt-4 border-t border-gray-100 dash-border">
            <div class="flex items-center justify-between"><span class="text-sm font-semibold text-gray-900 dark:text-white">Total Score</span><span class="text-2xl font-bold text-primary-600">{{ $evaluation->total_score }}/100</span></div>
        </div>
        @if($evaluation->comments)
        <div class="mt-4 pt-4 border-t border-gray-100 dash-border"><p class="text-xs text-gray-400 mb-1">Comments</p><p class="text-sm text-gray-600 dash-text">{{ $evaluation->comments }}</p></div>
        @endif
    </div>
    <div class="dash-card bg-white rounded-xl border border-gray-100 p-5">
        <h3 class="text-sm font-semibold text-gray-900 dark:text-white mb-4">Details</h3>
        <div class="space-y-3 text-sm">
            <div><p class="text-xs text-gray-400">Agent</p><p class="font-medium text-gray-900 dark:text-white">{{ $evaluation->agent->name ?? 'N/A' }}</p></div>
            <div><p class="text-xs text-gray-400">Evaluator</p><p class="font-medium text-gray-900 dark:text-white">{{ $evaluation->evaluator->name ?? 'N/A' }}</p></div>
            <div><p class="text-xs text-gray-400">Date</p><p class="font-medium text-gray-900 dark:text-white">{{ $evaluation->created_at->format('M d, Y') }}</p></div>
            <div><p class="text-xs text-gray-400">Status</p><span class="text-xs px-2 py-0.5 rounded-full {{ $evaluation->status === 'submitted' ? 'bg-green-100 text-green-700' : 'bg-amber-100 text-amber-700' }}">{{ ucfirst($evaluation->status) }}</span></div>
        </div>
    </div>
</div>
@endsection
