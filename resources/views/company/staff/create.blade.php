@extends('layouts.dashboard')
@section('title', 'Add Staff - Company')
@section('page_title', 'Add Staff Member')

@section('content')
<div class="mb-6"><a href="{{ route('company.staff.index') }}" class="text-sm text-primary-600 hover:text-primary-700">&larr; Back to Staff</a></div>
<div class="dash-card bg-white rounded-xl border border-gray-100 p-6 max-w-2xl">
    <form method="POST" action="{{ route('company.staff.store') }}">
        @csrf
        <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
            <div>
                <label class="block text-sm font-medium text-gray-700 dash-text-strong mb-1">Name</label>
                <input type="text" name="name" value="{{ old('name') }}" class="w-full px-3 py-2 border border-gray-200 dash-border rounded-lg dash-input text-sm" required>
            </div>
            <div>
                <label class="block text-sm font-medium text-gray-700 dash-text-strong mb-1">Email</label>
                <input type="email" name="email" value="{{ old('email') }}" class="w-full px-3 py-2 border border-gray-200 dash-border rounded-lg dash-input text-sm" required>
            </div>
            <div>
                <label class="block text-sm font-medium text-gray-700 dash-text-strong mb-1">Phone</label>
                <input type="text" name="phone" value="{{ old('phone') }}" class="w-full px-3 py-2 border border-gray-200 dash-border rounded-lg dash-input text-sm">
            </div>
            <div>
                <label class="block text-sm font-medium text-gray-700 dash-text-strong mb-1">Extension Number</label>
                <input type="text" name="extension_number" value="{{ old('extension_number') }}" class="w-full px-3 py-2 border border-gray-200 dash-border rounded-lg dash-input text-sm">
            </div>
            <div>
                <label class="block text-sm font-medium text-gray-700 dash-text-strong mb-1">Role</label>
                <select name="role" class="w-full px-3 py-2 border border-gray-200 dash-border rounded-lg dash-input text-sm">
                    @foreach($roles as $role)
                    <option value="{{ $role->name }}" {{ old('role') === $role->name ? 'selected' : '' }}>{{ ucwords(str_replace('_', ' ', $role->name)) }}</option>
                    @endforeach
                </select>
            </div>
            <div>
                <label class="block text-sm font-medium text-gray-700 dash-text-strong mb-1">Password</label>
                <input type="password" name="password" class="w-full px-3 py-2 border border-gray-200 dash-border rounded-lg dash-input text-sm" required>
            </div>
        </div>
        <div class="mt-6">
            <button type="submit" class="px-6 py-2 bg-primary-600 hover:bg-primary-700 text-white text-sm font-medium rounded-lg transition-colors">Add Staff Member</button>
        </div>
    </form>
</div>
@endsection
