@extends('layouts.dashboard')
@section('title', 'Edit Contact - Company')
@section('page_title', 'Edit Contact')

@section('content')
<div class="mb-6"><a href="{{ route('company.contacts.index') }}" class="text-sm text-primary-600 hover:text-primary-700">&larr; Back to Contacts</a></div>
<div class="dash-card bg-white rounded-xl border border-gray-100 p-6 max-w-2xl">
    <form method="POST" action="{{ route('company.contacts.update', $contact) }}">
        @csrf @method('PUT')
        <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
            <div><label class="block text-sm font-medium text-gray-700 dash-text-strong mb-1">Name</label><input type="text" name="name" value="{{ old('name', $contact->name) }}" class="w-full px-3 py-2 border border-gray-200 dash-border rounded-lg dash-input text-sm" required></div>
            <div><label class="block text-sm font-medium text-gray-700 dash-text-strong mb-1">Phone</label><input type="text" name="phone" value="{{ old('phone', $contact->phone) }}" class="w-full px-3 py-2 border border-gray-200 dash-border rounded-lg dash-input text-sm" required></div>
            <div><label class="block text-sm font-medium text-gray-700 dash-text-strong mb-1">Email</label><input type="email" name="email" value="{{ old('email', $contact->email) }}" class="w-full px-3 py-2 border border-gray-200 dash-border rounded-lg dash-input text-sm"></div>
            <div><label class="block text-sm font-medium text-gray-700 dash-text-strong mb-1">Company</label><input type="text" name="company" value="{{ old('company', $contact->company) }}" class="w-full px-3 py-2 border border-gray-200 dash-border rounded-lg dash-input text-sm"></div>
        </div>
        <div class="mt-4"><label class="block text-sm font-medium text-gray-700 dash-text-strong mb-1">Address</label><textarea name="address" rows="2" class="w-full px-3 py-2 border border-gray-200 dash-border rounded-lg dash-input text-sm">{{ old('address', $contact->address) }}</textarea></div>
        <div class="mt-4"><label class="block text-sm font-medium text-gray-700 dash-text-strong mb-1">Notes</label><textarea name="notes" rows="3" class="w-full px-3 py-2 border border-gray-200 dash-border rounded-lg dash-input text-sm">{{ old('notes', $contact->notes) }}</textarea></div>
        <div class="mt-6"><button type="submit" class="px-6 py-2 bg-primary-600 hover:bg-primary-700 text-white text-sm font-medium rounded-lg transition-colors">Update Contact</button></div>
    </form>
</div>
@endsection
