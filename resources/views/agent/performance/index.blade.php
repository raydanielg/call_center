@extends('layouts.dashboard')
@section('title', 'My Performance')
@section('page_title', 'My Performance')

@section('content')
<div class="grid grid-cols-2 lg:grid-cols-4 gap-3 sm:gap-4 mb-6">
    @include('partials.stat-card', ['label' => 'Total Calls', 'value' => $totalCalls, 'color' => 'primary', 'iconHtml' => '<svg class="w-4 h-4 text-primary-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z"/></svg>'])
    @include('partials.stat-card', ['label' => 'Avg Duration', 'value' => gmdate('i:s', $avgDuration), 'color' => 'amber', 'iconHtml' => '<svg class="w-4 h-4 text-amber-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>'])
    @include('partials.stat-card', ['label' => 'QA Score', 'value' => round($avgScore) . '/100', 'color' => 'green', 'iconHtml' => '<svg class="w-4 h-4 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11.049 2.927c.3-.921 1.603-.921 1.902 0l1.519 4.674a1 1 0 00.95.69h4.915c.969 0 1.371 1.24.588 1.81l-3.976 2.888a1 1 0 00-.363 1.118l1.518 4.674c.3.922-.755 1.688-1.538 1.118l-3.976-2.888a1 1 0 00-1.176 0l-3.976 2.888c-.783.57-1.838-.197-1.538-1.118l1.518-4.674a1 1 0 00-.363-1.118l-3.976-2.888c-.784-.57-.38-1.81.588-1.81h4.914a1 1 0 00.951-.69l1.519-4.674z"/></svg>'])
    @include('partials.stat-card', ['label' => 'Evaluations', 'value' => $evaluations->total(), 'color' => 'violet', 'iconHtml' => '<svg class="w-4 h-4 text-violet-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>'])
</div>

<div class="grid grid-cols-1 lg:grid-cols-2 gap-4 sm:gap-6">
    <div class="dash-card bg-white rounded-xl border border-gray-100 p-5">
        <h3 class="text-sm font-semibold text-gray-900 dark:text-white mb-4">Calls by Status</h3>
        <div class="space-y-3">
            @foreach($callsByStatus as $status => $count)
            <div class="flex items-center justify-between text-sm"><span class="text-gray-700 dash-text-strong">{{ ucfirst($status) }}</span><span class="font-bold text-gray-900 dark:text-white">{{ $count }}</span></div>
            @endforeach
            @if(empty($callsByStatus))<p class="text-sm text-gray-400">No call data.</p>@endif
        </div>
    </div>
    <div class="dash-card bg-white rounded-xl border border-gray-100 p-5">
        <h3 class="text-sm font-semibold text-gray-900 dark:text-white mb-4">Recent Evaluations</h3>
        @if($evaluations->isEmpty())<p class="text-sm text-gray-400">No evaluations yet.</p>@else
        <div class="space-y-3">
            @foreach($evaluations as $eval)
            <div class="flex items-center justify-between text-sm"><div><p class="font-medium text-gray-900 dark:text-white">Score: {{ $eval->total_score }}/100</p><p class="text-xs text-gray-400">{{ $eval->created_at->format('M d, Y') }}</p></div><span class="text-xs px-2 py-0.5 rounded-full {{ $eval->status === 'submitted' ? 'bg-green-100 text-green-700' : 'bg-amber-100 text-amber-700' }}">{{ ucfirst($eval->status) }}</span></div>
            @endforeach
        </div>
        @endif
    </div>
</div>
@endsection
