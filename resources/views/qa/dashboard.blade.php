@extends('layouts.dashboard')
@section('title', 'QA Dashboard')
@section('page_title', 'QA Dashboard')

@section('content')
<div class="mb-6 bg-gradient-to-r from-primary-600 to-primary-800 rounded-2xl p-6 sm:p-8 text-white relative overflow-hidden">
    <div class="absolute top-0 right-0 w-40 h-40 bg-white/10 rounded-full -mr-20 -mt-20"></div>
    <div class="relative z-10">
        <h2 class="text-xl sm:text-2xl font-bold mb-1">QA Analyst Dashboard</h2>
        <p class="text-primary-100 text-sm">Evaluate calls and track agent quality scores.</p>
    </div>
</div>

<div class="grid grid-cols-2 lg:grid-cols-4 gap-3 sm:gap-4 mb-6">
    @include('partials.stat-card', ['label' => 'Pending Evaluations', 'value' => $pendingEvaluations, 'color' => 'amber', 'iconHtml' => '<svg class="w-4 h-4 text-amber-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>'])
    @include('partials.stat-card', ['label' => 'Submitted', 'value' => $submittedEvaluations, 'color' => 'green', 'iconHtml' => '<svg class="w-4 h-4 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>'])
    @include('partials.stat-card', ['label' => 'Avg Score', 'value' => round($avgScore) . '/100', 'color' => 'primary', 'iconHtml' => '<svg class="w-4 h-4 text-primary-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11.049 2.927c.3-.921 1.603-.921 1.902 0l1.519 4.674a1 1 0 00.95.69h4.915c.969 0 1.371 1.24.588 1.81l-3.976 2.888a1 1 0 00-.363 1.118l1.518 4.674c.3.922-.755 1.688-1.538 1.118l-3.976-2.888a1 1 0 00-1.176 0l-3.976 2.888c-.783.57-1.838-.197-1.538-1.118l1.518-4.674a1 1 0 00-.363-1.118l-3.976-2.888c-.784-.57-.38-1.81.588-1.81h4.914a1 1 0 00.951-.69l1.519-4.674z"/></svg>'])
    @include('partials.stat-card', ['label' => 'Recordings', 'value' => $recordingsCount, 'color' => 'violet', 'iconHtml' => '<svg class="w-4 h-4 text-violet-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 114a7 7 0 01-7 7m0 0a7 7 0 01-7-7m7 7v4a2 2 0 002 2h1a2 2 0 002-2v-4m-5 0a7 7 0 01-7-7V7a7 7 0 1114 0v7a7 7 0 01-7 7z"/></svg>'])
</div>

<div class="dash-card bg-white rounded-xl border border-gray-100 p-5">
    <div class="flex items-center justify-between mb-4"><h3 class="text-sm font-semibold text-gray-900 dark:text-white">Recent Evaluations</h3><a href="{{ route('qa.evaluations.index') }}" class="text-xs text-primary-600">View All</a></div>
    @if($recentEvaluations->isEmpty())<p class="text-sm text-gray-400 text-center py-8">No evaluations yet.</p>@else
    <div class="space-y-3">
        @foreach($recentEvaluations as $eval)
        <div class="flex items-center justify-between">
            <div><p class="text-sm font-medium text-gray-900 dark:text-white">{{ $eval->agent->name ?? 'N/A' }}</p><p class="text-xs text-gray-400">{{ $eval->created_at->format('M d, Y') }}</p></div>
            <div class="text-right"><p class="text-sm font-bold text-primary-600">{{ $eval->total_score }}/100</p><span class="text-xs px-2 py-0.5 rounded-full {{ $eval->status === 'submitted' ? 'bg-green-100 text-green-700' : 'bg-amber-100 text-amber-700' }}">{{ ucfirst($eval->status) }}</span></div>
        </div>
        @endforeach
    </div>
    @endif
</div>
@endsection
