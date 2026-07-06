@extends('layouts.dashboard')
@section('title', 'Contacts - Company')
@section('page_title', 'Contacts')

@section('content')
<div class="flex items-center justify-between mb-6">
    <h2 class="text-lg font-bold text-gray-900 dark:text-white">Contacts</h2>
    <a href="{{ route('company.contacts.create') }}" class="inline-flex items-center gap-2 px-4 py-2 bg-primary-600 hover:bg-primary-700 text-white text-sm font-medium rounded-lg transition-colors">
        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"/></svg>
        Add Contact
    </a>
</div>
<div class="dash-card bg-white rounded-xl border border-gray-100 overflow-hidden">
    <div class="overflow-x-auto">
        <table class="w-full text-sm">
            <thead class="bg-gray-50 dash-bg-subtle border-b border-gray-100 dash-border">
                <tr>
                    <th class="text-left px-4 py-3 font-medium text-gray-500 dash-text">Name</th>
                    <th class="text-left px-4 py-3 font-medium text-gray-500 dash-text">Phone</th>
                    <th class="text-left px-4 py-3 font-medium text-gray-500 dash-text">Email</th>
                    <th class="text-left px-4 py-3 font-medium text-gray-500 dash-text">Company</th>
                    <th class="text-right px-4 py-3 font-medium text-gray-500 dash-text">Actions</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-gray-100 dash-border">
                @forelse($contacts as $contact)
                <tr class="hover:bg-gray-50 dash-hover">
                    <td class="px-4 py-3 font-medium text-gray-900 dark:text-white">{{ $contact->name }}</td>
                    <td class="px-4 py-3 text-gray-500 dash-text">{{ $contact->phone }}</td>
                    <td class="px-4 py-3 text-gray-500 dash-text">{{ $contact->email ?? 'N/A' }}</td>
                    <td class="px-4 py-3 text-gray-500 dash-text">{{ $contact->company ?? 'N/A' }}</td>
                    <td class="px-4 py-3 text-right">
                        <a href="{{ route('company.contacts.edit', $contact) }}" class="text-xs text-primary-600 hover:text-primary-700">Edit</a>
                        <form method="POST" action="{{ route('company.contacts.destroy', $contact) }}" class="inline ml-2" onsubmit="return confirm('Delete this contact?')">
                            @csrf @method('DELETE')
                            <button class="text-xs text-red-600 hover:text-red-700">Delete</button>
                        </form>
                    </td>
                </tr>
                @empty
                <tr><td colspan="5" class="text-center py-12 text-gray-400">No contacts found.</td></tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>
{{ $contacts->withQueryString()->links() }}
@endsection
