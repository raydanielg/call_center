@extends('layouts.dashboard')
@section('title', 'Edit Call - Company')
@section('page_title', 'Edit Call Record')

@section('content')
<div class="mb-6"><a href="{{ route('company.calls.index') }}" class="text-sm text-primary-600 hover:text-primary-700">&larr; Back to Calls</a></div>
<div class="dash-card bg-white rounded-xl border border-gray-100 p-6 max-w-3xl">
    <form method="POST" action="{{ route('company.calls.update', $call) }}">
        @csrf
        @method('PUT')
        <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
            <div>
                <label class="block text-sm font-medium text-gray-700 dash-text-strong mb-1">Phone Number</label>
                <input type="text" name="phone_number" value="{{ old('phone_number', $call->phone_number) }}" class="w-full px-3 py-2 border border-gray-200 dash-border rounded-lg dash-input text-sm" required>
            </div>
            <div>
                <label class="block text-sm font-medium text-gray-700 dash-text-strong mb-1">Contact</label>
                <select name="contact_id" class="w-full px-3 py-2 border border-gray-200 dash-border rounded-lg dash-input text-sm">
                    <option value="">-- None --</option>
                    @foreach($contacts as $contact)
                        <option value="{{ $contact->id }}" {{ old('contact_id', $call->contact_id) == $contact->id ? 'selected' : '' }}>{{ $contact->name }} ({{ $contact->phone }})</option>
                    @endforeach
                </select>
            </div>
            <div>
                <label class="block text-sm font-medium text-gray-700 dash-text-strong mb-1">Agent</label>
                <select name="agent_id" class="w-full px-3 py-2 border border-gray-200 dash-border rounded-lg dash-input text-sm">
                    <option value="">-- Unassigned --</option>
                    @foreach($agents as $agent)
                        <option value="{{ $agent->id }}" {{ old('agent_id', $call->agent_id) == $agent->id ? 'selected' : '' }}>{{ $agent->name }}</option>
                    @endforeach
                </select>
            </div>
            <div>
                <label class="block text-sm font-medium text-gray-700 dash-text-strong mb-1">Queue</label>
                <select name="queue_id" class="w-full px-3 py-2 border border-gray-200 dash-border rounded-lg dash-input text-sm">
                    <option value="">-- None --</option>
                    @foreach($queues as $queue)
                        <option value="{{ $queue->id }}" {{ old('queue_id', $call->queue_id) == $queue->id ? 'selected' : '' }}>{{ $queue->name }}</option>
                    @endforeach
                </select>
            </div>
            <div>
                <label class="block text-sm font-medium text-gray-700 dash-text-strong mb-1">Direction</label>
                <select name="direction" class="w-full px-3 py-2 border border-gray-200 dash-border rounded-lg dash-input text-sm" required>
                    <option value="inbound" {{ old('direction', $call->direction) == 'inbound' ? 'selected' : '' }}>Inbound</option>
                    <option value="outbound" {{ old('direction', $call->direction) == 'outbound' ? 'selected' : '' }}>Outbound</option>
                </select>
            </div>
            <div>
                <label class="block text-sm font-medium text-gray-700 dash-text-strong mb-1">Status</label>
                <select name="status" class="w-full px-3 py-2 border border-gray-200 dash-border rounded-lg dash-input text-sm" required>
                    @foreach(['completed','missed','abandoned','voicemail','busy','failed'] as $st)
                        <option value="{{ $st }}" {{ old('status', $call->status) == $st ? 'selected' : '' }}>{{ ucfirst($st) }}</option>
                    @endforeach
                </select>
            </div>
            <div>
                <label class="block text-sm font-medium text-gray-700 dash-text-strong mb-1">Duration (seconds)</label>
                <input type="number" min="0" name="duration" value="{{ old('duration', $call->duration) }}" class="w-full px-3 py-2 border border-gray-200 dash-border rounded-lg dash-input text-sm">
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
            <textarea name="notes" rows="3" class="w-full px-3 py-2 border border-gray-200 dash-border rounded-lg dash-input text-sm">{{ old('notes', $call->notes) }}</textarea>
        </div>
        <div class="mt-6"><button type="submit" class="px-6 py-2 bg-primary-600 hover:bg-primary-700 text-white text-sm font-medium rounded-lg transition-colors">Update Call Record</button></div>
    </form>
</div>
@endsection
