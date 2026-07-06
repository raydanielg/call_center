@extends('layouts.dashboard')
@section('title', 'Add Contact - Company')
@section('page_title', 'Add Contact')

@section('content')
<div class="mb-6"><a href="{{ route('company.contacts.index') }}" class="text-sm text-primary-600 hover:text-primary-700">&larr; Back to Contacts</a></div>
<div class="dash-card bg-white rounded-xl border border-gray-100 p-6 max-w-2xl">
    <form method="POST" action="{{ route('company.contacts.store') }}">
        @csrf
        <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
            <div><label class="block text-sm font-medium text-gray-700 dash-text-strong mb-1">Name</label><input type="text" name="name" value="{{ old('name') }}" class="w-full px-3 py-2 border border-gray-200 dash-border rounded-lg dash-input text-sm" required></div>
            <div><label class="block text-sm font-medium text-gray-700 dash-text-strong mb-1">Phone</label><input type="text" name="phone" value="{{ old('phone') }}" class="w-full px-3 py-2 border border-gray-200 dash-border rounded-lg dash-input text-sm" required></div>
            <div><label class="block text-sm font-medium text-gray-700 dash-text-strong mb-1">Email</label><input type="email" name="email" value="{{ old('email') }}" class="w-full px-3 py-2 border border-gray-200 dash-border rounded-lg dash-input text-sm"></div>
            <div><label class="block text-sm font-medium text-gray-700 dash-text-strong mb-1">Company</label><input type="text" name="company" value="{{ old('company') }}" class="w-full px-3 py-2 border border-gray-200 dash-border rounded-lg dash-input text-sm"></div>
        </div>
        <div class="mt-4"><label class="block text-sm font-medium text-gray-700 dash-text-strong mb-1">Address</label><textarea name="address" rows="2" class="w-full px-3 py-2 border border-gray-200 dash-border rounded-lg dash-input text-sm">{{ old('address') }}</textarea></div>
        <div class="mt-4"><label class="block text-sm font-medium text-gray-700 dash-text-strong mb-1">Notes</label><textarea name="notes" rows="3" class="w-full px-3 py-2 border border-gray-200 dash-border rounded-lg dash-input text-sm">{{ old('notes') }}</textarea></div>
        <div class="mt-6"><button type="submit" class="px-6 py-2 bg-primary-600 hover:bg-primary-700 text-white text-sm font-medium rounded-lg transition-colors">Add Contact</button></div>
    </form>
</div>
@endsection
