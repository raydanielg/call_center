@extends('layouts.dashboard')
@section('title', 'Edit Call')
@section('page_title', 'Edit Call')

@section('content')
<div class="mb-6"><a href="{{ route('agent.calls.index') }}" class="text-sm text-primary-600 hover:text-primary-700">&larr; Back to My Calls</a></div>
<div class="dash-card bg-white rounded-xl border border-gray-100 p-6 max-w-2xl">
    <div class="mb-4 pb-4 border-b border-gray-100 dash-border">
        <p class="text-sm text-gray-500 dash-text">Phone Number</p>
        <p class="font-semibold text-gray-800 dash-text-strong">{{ $call->phone_number }}</p>
    </div>
    <form method="POST" action="{{ route('agent.calls.update', $call) }}">
        @csrf
        @method('PUT')
        <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
            <div>
                <label class="block text-sm font-medium text-gray-700 dash-text-strong mb-1">Status</label>
                <select name="status" class="w-full px-3 py-2 border border-gray-200 dash-border rounded-lg dash-input text-sm" required>
                    @foreach(['completed','missed','abandoned','voicemail','busy','failed'] as $st)
                        <option value="{{ $st }}" {{ old('status', $call->status) == $st ? 'selected' : '' }}>{{ ucfirst($st) }}</option>
                    @endforeach
                </select>
            </div>
            <div>
                <label class="block text-sm font-medium text-gray-700 dash-text-strong mb-1">Disposition</label>
                <select name="disposition_id" class="w-full px-3 py-2 border border-gray-200 dash-border rounded-lg dash-input text-sm">
                    <option value="">-- None --</option>
                    @foreach($dispositions as $disposition)
                        <option value="{{ $disposition->id }}" {{ old('disposition_id', $call->disposition_id) == $disposition->id ? 'selected' : '' }}>{{ $disposition->name }}</option>
                    @endforeach
                </select>
            </div>
        </div>
        <div class="mt-4">
            <label class="block text-sm font-medium text-gray-700 dash-text-strong mb-1">Notes</label>
            <textarea name="notes" rows="4" class="w-full px-3 py-2 border border-gray-200 dash-border rounded-lg dash-input text-sm">{{ old('notes', $call->notes) }}</textarea>
        </div>
        <div class="mt-6"><button type="submit" class="px-6 py-2 bg-primary-600 hover:bg-primary-700 text-white text-sm font-medium rounded-lg transition-colors">Update Call</button></div>
    </form>
</div>
@endsection
