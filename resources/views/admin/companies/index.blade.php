@extends('layouts.dashboard')
@section('title', 'Companies - Admin')
@section('page_title', 'Companies')

@section('content')
<div class="flex items-center justify-between mb-6">
    <h2 class="text-lg font-bold text-gray-900 dark:text-white">All Companies</h2>
</div>

<div class="dash-card bg-white rounded-xl border border-gray-100 overflow-hidden">
    <div class="overflow-x-auto">
        <table class="w-full text-sm">
            <thead class="bg-gray-50 dash-bg-subtle border-b border-gray-100 dash-border">
                <tr>
                    <th class="text-left px-4 py-3 font-medium text-gray-500 dash-text">Company</th>
                    <th class="text-left px-4 py-3 font-medium text-gray-500 dash-text">Email</th>
                    <th class="text-left px-4 py-3 font-medium text-gray-500 dash-text">Status</th>
                    <th class="text-left px-4 py-3 font-medium text-gray-500 dash-text">Joined</th>
                    <th class="text-right px-4 py-3 font-medium text-gray-500 dash-text">Actions</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-gray-100 dash-border">
                @forelse($tenants as $tenant)
                <tr class="hover:bg-gray-50 dash-hover">
                    <td class="px-4 py-3">
                        <a href="{{ route('admin.companies.show', $tenant) }}" class="font-medium text-gray-900 dark:text-white hover:text-primary-600">{{ $tenant->name }}</a>
                    </td>
                    <td class="px-4 py-3 text-gray-500 dash-text">{{ $tenant->email }}</td>
                    <td class="px-4 py-3">
                        <span class="text-xs px-2 py-0.5 rounded-full {{ $tenant->status === 'active' ? 'bg-green-100 text-green-700' : ($tenant->status === 'pending' ? 'bg-amber-100 text-amber-700' : 'bg-red-100 text-red-700') }}">{{ ucfirst($tenant->status) }}</span>
                    </td>
                    <td class="px-4 py-3 text-gray-500 dash-text">{{ $tenant->created_at->format('M d, Y') }}</td>
                    <td class="px-4 py-3 text-right">
                        <form method="POST" action="{{ route('admin.companies.status', $tenant) }}" class="inline">
                            @csrf @method('PUT')
                            <select name="status" onchange="this.form.submit()" class="text-xs border border-gray-200 dash-border rounded-lg px-2 py-1 dash-input">
                                <option value="active" {{ $tenant->status === 'active' ? 'selected' : '' }}>Active</option>
                                <option value="pending" {{ $tenant->status === 'pending' ? 'selected' : '' }}>Pending</option>
                                <option value="suspended" {{ $tenant->status === 'suspended' ? 'selected' : '' }}>Suspended</option>
                            </select>
                        </form>
                    </td>
                </tr>
                @empty
                <tr><td colspan="5" class="text-center py-12 text-gray-400">No companies found.</td></tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>
{{ $tenants->withQueryString()->links() }}
@endsection
