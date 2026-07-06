@extends('layouts.dashboard')
@section('title', 'New Ticket - Company')
@section('page_title', 'Create Ticket')

@section('content')
<div class="mb-6"><a href="{{ route('company.tickets.index') }}" class="text-sm text-primary-600 hover:text-primary-700">&larr; Back to Tickets</a></div>
<div class="dash-card bg-white rounded-xl border border-gray-100 p-6 max-w-2xl">
    <form method="POST" action="{{ route('company.tickets.store') }}">
        @csrf
        <div class="space-y-4">
            <div>
                <label class="block text-sm font-medium text-gray-700 dash-text-strong mb-1">Subject</label>
                <input type="text" name="subject" value="{{ old('subject') }}" class="w-full px-3 py-2 border border-gray-200 dash-border rounded-lg dash-input text-sm" required>
            </div>
            <div>
                <label class="block text-sm font-medium text-gray-700 dash-text-strong mb-1">Description</label>
                <textarea name="description" rows="5" class="w-full px-3 py-2 border border-gray-200 dash-border rounded-lg dash-input text-sm" required>{{ old('description') }}</textarea>
            </div>
            <div class="grid grid-cols-2 gap-4">
                <div>
                    <label class="block text-sm font-medium text-gray-700 dash-text-strong mb-1">Contact</label>
                    <select name="contact_id" class="w-full px-3 py-2 border border-gray-200 dash-border rounded-lg dash-input text-sm">
                        <option value="">Select contact...</option>
                        @foreach($contacts as $contact)
                        <option value="{{ $contact->id }}" {{ old('contact_id') == $contact->id ? 'selected' : '' }}>{{ $contact->name }} ({{ $contact->phone }})</option>
                        @endforeach
                    </select>
                </div>
                <div>
                    <label class="block text-sm font-medium text-gray-700 dash-text-strong mb-1">Assign To</label>
                    <select name="assigned_to" class="w-full px-3 py-2 border border-gray-200 dash-border rounded-lg dash-input text-sm">
                        <option value="">Auto-assign</option>
                        @foreach($agents as $agent)
                        <option value="{{ $agent->id }}" {{ old('assigned_to') == $agent->id ? 'selected' : '' }}>{{ $agent->name }}</option>
                        @endforeach
                    </select>
                </div>
            </div>
            <div class="grid grid-cols-2 gap-4">
                <div>
                    <label class="block text-sm font-medium text-gray-700 dash-text-strong mb-1">Category</label>
                    <input type="text" name="category" value="{{ old('category') }}" class="w-full px-3 py-2 border border-gray-200 dash-border rounded-lg dash-input text-sm">
                </div>
                <div>
                    <label class="block text-sm font-medium text-gray-700 dash-text-strong mb-1">Priority</label>
                    <select name="priority" class="w-full px-3 py-2 border border-gray-200 dash-border rounded-lg dash-input text-sm">
                        <option value="low">Low</option>
                        <option value="medium" selected>Medium</option>
                        <option value="high">High</option>
                        <option value="urgent">Urgent</option>
                    </select>
                </div>
            </div>
        </div>
        <div class="mt-6">
            <button type="submit" class="px-6 py-2 bg-primary-600 hover:bg-primary-700 text-white text-sm font-medium rounded-lg transition-colors">Create Ticket</button>
        </div>
    </form>
</div>
@endsection
