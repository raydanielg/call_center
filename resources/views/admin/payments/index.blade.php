@extends('layouts.dashboard')
@section('title', 'Payments - Admin')
@section('page_title', 'Payments')

@section('content')
<div class="dash-card bg-white rounded-xl border border-gray-100 overflow-hidden">
    <div class="overflow-x-auto">
        <table class="w-full text-sm">
            <thead class="bg-gray-50 dash-bg-subtle border-b border-gray-100 dash-border">
                <tr>
                    <th class="text-left px-4 py-3 font-medium text-gray-500 dash-text">Company</th>
                    <th class="text-left px-4 py-3 font-medium text-gray-500 dash-text">Amount</th>
                    <th class="text-left px-4 py-3 font-medium text-gray-500 dash-text">Method</th>
                    <th class="text-left px-4 py-3 font-medium text-gray-500 dash-text">Reference</th>
                    <th class="text-left px-4 py-3 font-medium text-gray-500 dash-text">Date</th>
                    <th class="text-left px-4 py-3 font-medium text-gray-500 dash-text">Status</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-gray-100 dash-border">
                @forelse($payments as $payment)
                <tr class="hover:bg-gray-50 dash-hover">
                    <td class="px-4 py-3 font-medium text-gray-900 dark:text-white">{{ $payment->tenant->name ?? 'N/A' }}</td>
                    <td class="px-4 py-3 text-gray-500 dash-text">TZS {{ number_format($payment->amount) }}</td>
                    <td class="px-4 py-3 text-gray-500 dash-text">{{ ucfirst($payment->payment_method) }}</td>
                    <td class="px-4 py-3 text-gray-500 dash-text">{{ $payment->reference_number ?? 'N/A' }}</td>
                    <td class="px-4 py-3 text-gray-500 dash-text">{{ $payment->created_at->format('M d, Y') }}</td>
                    <td class="px-4 py-3"><span class="text-xs px-2 py-0.5 rounded-full {{ $payment->status === 'paid' ? 'bg-green-100 text-green-700' : ($payment->status === 'pending' ? 'bg-amber-100 text-amber-700' : 'bg-red-100 text-red-700') }}">{{ ucfirst($payment->status) }}</span></td>
                </tr>
                @empty
                <tr><td colspan="6" class="text-center py-12 text-gray-400">No payments found.</td></tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>
{{ $payments->withQueryString()->links() }}
@endsection
