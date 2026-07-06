@extends('layouts.dashboard')
@section('title', 'Staff - Company')
@section('page_title', 'Staff')

@section('content')
<div class="flex items-center justify-between mb-6">
    <h2 class="text-lg font-bold text-gray-900 dark:text-white">Staff Members</h2>
    <a href="{{ route('company.staff.create') }}" class="inline-flex items-center gap-2 px-4 py-2 bg-primary-600 hover:bg-primary-700 text-white text-sm font-medium rounded-lg transition-colors">
        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"/></svg>
        Add Staff
    </a>
</div>

<div class="dash-card bg-white rounded-xl border border-gray-100 overflow-hidden">
    <div class="overflow-x-auto">
        <table class="w-full text-sm">
            <thead class="bg-gray-50 dash-bg-subtle border-b border-gray-100 dash-border">
                <tr>
                    <th class="text-left px-4 py-3 font-medium text-gray-500 dash-text">Name</th>
                    <th class="text-left px-4 py-3 font-medium text-gray-500 dash-text">Email</th>
                    <th class="text-left px-4 py-3 font-medium text-gray-500 dash-text">Role</th>
                    <th class="text-left px-4 py-3 font-medium text-gray-500 dash-text">Status</th>
                    <th class="text-right px-4 py-3 font-medium text-gray-500 dash-text">Actions</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-gray-100 dash-border">
                @forelse($staff as $user)
                <tr class="hover:bg-gray-50 dash-hover">
                    <td class="px-4 py-3 font-medium text-gray-900 dark:text-white">{{ $user->name }}</td>
                    <td class="px-4 py-3 text-gray-500 dash-text">{{ $user->email }}</td>
                    <td class="px-4 py-3"><span class="text-xs px-2 py-0.5 rounded-full bg-primary-100 text-primary-700">{{ $user->roles->first()?->name ?? 'N/A' }}</span></td>
                    <td class="px-4 py-3"><span class="text-xs px-2 py-0.5 rounded-full {{ $user->status === 'active' ? 'bg-green-100 text-green-700' : 'bg-gray-100 text-gray-500' }}">{{ ucfirst($user->status) }}</span></td>
                    <td class="px-4 py-3 text-right">
                        <a href="{{ route('company.staff.edit', $user) }}" class="text-xs text-primary-600 hover:text-primary-700">Edit</a>
                        <form method="POST" action="{{ route('company.staff.destroy', $user) }}" class="inline ml-2" onsubmit="return confirm('Remove this staff member?')">
                            @csrf @method('DELETE')
                            <button class="text-xs text-red-600 hover:text-red-700">Remove</button>
                        </form>
                    </td>
                </tr>
                @empty
                <tr><td colspan="5" class="text-center py-12 text-gray-400">No staff members yet.</td></tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>
{{ $staff->withQueryString()->links() }}
@endsection
