@extends('layouts.dashboard')
@section('title', 'Reports - Admin')
@section('page_title', 'Reports')

@section('content')
<div class="mb-6">
    <h2 class="text-lg font-bold text-gray-900 dark:text-white">Platform Reports</h2>
</div>

<div class="grid grid-cols-1 lg:grid-cols-2 gap-4 sm:gap-6 mb-6">
    <div class="dash-card bg-white rounded-xl border border-gray-100 p-5">
        <h3 class="text-sm font-semibold text-gray-900 dark:text-white mb-4">Monthly Revenue ({{ now()->year }})</h3>
        <div class="space-y-2">
            @for($i = 1; $i <= 12; $i++)
                @php $revenue = $monthlyRevenue[$i] ?? 0; @endphp
                <div class="flex items-center gap-3">
                    <span class="text-xs text-gray-400 w-8">{{ date('M', mktime(0,0,0,$i,1)) }}</span>
                    <div class="flex-1 bg-gray-100 dash-bg-subtle rounded-full h-5 overflow-hidden">
                        <div class="bg-primary-500 h-full rounded-full flex items-center justify-end px-2" style="width: {{ min(100, ($revenue > 0 ? max(5, ($revenue / max(1, max($monthlyRevenue))) * 100) : 0)) }}%">
                            @if($revenue > 0)<span class="text-xs text-white font-medium">{{ number_format($revenue / 1000) }}k</span>@endif
                        </div>
                    </div>
                </div>
            @endfor
        </div>
    </div>
    <div class="dash-card bg-white rounded-xl border border-gray-100 p-5">
        <h3 class="text-sm font-semibold text-gray-900 dark:text-white mb-4">Tenant Growth ({{ now()->year }})</h3>
        <div class="space-y-2">
            @for($i = 1; $i <= 12; $i++)
                @php $count = $tenantGrowth[$i] ?? 0; @endphp
                <div class="flex items-center gap-3">
                    <span class="text-xs text-gray-400 w-8">{{ date('M', mktime(0,0,0,$i,1)) }}</span>
                    <div class="flex-1 bg-gray-100 dash-bg-subtle rounded-full h-5 overflow-hidden">
                        <div class="bg-green-500 h-full rounded-full flex items-center justify-end px-2" style="width: {{ min(100, ($count > 0 ? max(5, ($count / max(1, max($tenantGrowth))) * 100) : 0)) }}%">
                            @if($count > 0)<span class="text-xs text-white font-medium">{{ $count }}</span>@endif
                        </div>
                    </div>
                </div>
            @endfor
        </div>
    </div>
</div>
@endsection
