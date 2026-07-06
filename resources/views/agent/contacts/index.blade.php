@extends('layouts.dashboard')
@section('title', 'Contacts - Agent')
@section('page_title', 'Contacts')

@section('content')
<div class="mb-4">
    <form method="GET" action="{{ route('agent.contacts.search') }}" class="flex gap-2 max-w-md">
        <input type="text" name="q" value="{{ $query ?? '' }}" placeholder="Search by name, phone, email..." class="flex-1 px-3 py-2 border border-gray-200 dash-border rounded-lg dash-input text-sm">
        <button type="submit" class="px-4 py-2 bg-primary-600 hover:bg-primary-700 text-white text-sm font-medium rounded-lg">Search</button>
    </form>
</div>
<div class="dash-card bg-white rounded-xl border border-gray-100 overflow-hidden">
    <div class="overflow-x-auto">
        <table class="w-full text-sm">
            <thead class="bg-gray-50 dash-bg-subtle border-b border-gray-100 dash-border"><tr><th class="text-left px-4 py-3 font-medium text-gray-500 dash-text">Name</th><th class="text-left px-4 py-3 font-medium text-gray-500 dash-text">Phone</th><th class="text-left px-4 py-3 font-medium text-gray-500 dash-text">Email</th><th class="text-left px-4 py-3 font-medium text-gray-500 dash-text">Company</th></tr></thead>
            <tbody class="divide-y divide-gray-100 dash-border">
                @forelse($contacts as $contact)
                <tr class="hover:bg-gray-50 dash-hover"><td class="px-4 py-3 font-medium text-gray-900 dark:text-white">{{ $contact->name }}</td><td class="px-4 py-3 text-gray-500 dash-text">{{ $contact->phone }}</td><td class="px-4 py-3 text-gray-500 dash-text">{{ $contact->email ?? 'N/A' }}</td><td class="px-4 py-3 text-gray-500 dash-text">{{ $contact->company ?? 'N/A' }}</td></tr>
                @empty
                <tr><td colspan="4" class="text-center py-12 text-gray-400">No contacts found.</td></tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>
{{ $contacts->withQueryString()->links() }}
@endsection
