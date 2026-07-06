@php
    $icon = $icon ?? 'chart';
    $color = $color ?? 'primary';
    $colors = [
        'primary' => ['bg' => 'bg-primary-100', 'text' => 'text-primary-600', 'darkBg' => 'bg-primary-900/30', 'darkText' => 'text-primary-400'],
        'amber' => ['bg' => 'bg-amber-100', 'text' => 'text-amber-600', 'darkBg' => 'bg-amber-900/30', 'darkText' => 'text-amber-400'],
        'green' => ['bg' => 'bg-green-100', 'text' => 'text-green-600', 'darkBg' => 'bg-green-900/30', 'darkText' => 'text-green-400'],
        'violet' => ['bg' => 'bg-violet-100', 'text' => 'text-violet-600', 'darkBg' => 'bg-violet-900/30', 'darkText' => 'text-violet-400'],
        'red' => ['bg' => 'bg-red-100', 'text' => 'text-red-600', 'darkBg' => 'bg-red-900/30', 'darkText' => 'text-red-400'],
    ];
    $c = $colors[$color] ?? $colors['primary'];
@endphp
<div class="dash-card bg-white rounded-xl border border-gray-100 p-4 sm:p-5">
    <div class="flex items-start justify-between mb-3">
        <span class="text-xs font-medium text-gray-500 dash-text">{{ $label }}</span>
        <div class="w-8 h-8 rounded-lg {{ $c['bg'] }} dark:{{ $c['darkBg'] }} flex items-center justify-center">
            {!! $iconHtml ?? '' !!}
        </div>
    </div>
    <p class="text-xl sm:text-2xl font-bold text-gray-900 dark:text-white">{{ $value }}</p>
    @isset($subtitle)
    <p class="text-xs text-gray-400 mt-1">{{ $subtitle }}</p>
    @endisset
</div>
