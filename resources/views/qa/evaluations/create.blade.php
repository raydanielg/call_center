@extends('layouts.dashboard')
@section('title', 'New Evaluation - QA')
@section('page_title', 'Create Evaluation')

@section('content')
<div class="mb-6"><a href="{{ route('qa.evaluations.index') }}" class="text-sm text-primary-600 hover:text-primary-700">&larr; Back to Evaluations</a></div>
<div class="dash-card bg-white rounded-xl border border-gray-100 p-6 max-w-2xl">
    <form method="POST" action="{{ route('qa.evaluations.store') }}">@csrf
        <div class="mb-4">
            <label class="block text-sm font-medium text-gray-700 dash-text-strong mb-1">Select Call</label>
            <select name="call_id" id="callSelect" class="w-full px-3 py-2 border border-gray-200 dash-border rounded-lg dash-input text-sm" required onchange="updateAgent()">
                <option value="">Select a call...</option>
                @foreach($calls as $call)
                <option value="{{ $call->id }}" data-agent="{{ $call->agent_id ?? '' }}">{{ $call->phone_number }} - {{ $call->agent->name ?? 'N/A' }} ({{ $call->created_at->format('M d, Y') }})</option>
                @endforeach
            </select>
            <input type="hidden" name="agent_id" id="agentId">
        </div>
        <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
            <div><label class="block text-sm font-medium text-gray-700 dash-text-strong mb-1">Greeting (0-20)</label><input type="number" name="greeting_score" min="0" max="20" value="0" class="w-full px-3 py-2 border border-gray-200 dash-border rounded-lg dash-input text-sm" required></div>
            <div><label class="block text-sm font-medium text-gray-700 dash-text-strong mb-1">Communication (0-20)</label><input type="number" name="communication_score" min="0" max="20" value="0" class="w-full px-3 py-2 border border-gray-200 dash-border rounded-lg dash-input text-sm" required></div>
            <div><label class="block text-sm font-medium text-gray-700 dash-text-strong mb-1">Problem Solving (0-20)</label><input type="number" name="problem_solving_score" min="0" max="20" value="0" class="w-full px-3 py-2 border border-gray-200 dash-border rounded-lg dash-input text-sm" required></div>
            <div><label class="block text-sm font-medium text-gray-700 dash-text-strong mb-1">Compliance (0-20)</label><input type="number" name="compliance_score" min="0" max="20" value="0" class="w-full px-3 py-2 border border-gray-200 dash-border rounded-lg dash-input text-sm" required></div>
            <div><label class="block text-sm font-medium text-gray-700 dash-text-strong mb-1">Closing (0-20)</label><input type="number" name="closing_score" min="0" max="20" value="0" class="w-full px-3 py-2 border border-gray-200 dash-border rounded-lg dash-input text-sm" required></div>
        </div>
        <div class="mt-4"><label class="block text-sm font-medium text-gray-700 dash-text-strong mb-1">Comments</label><textarea name="comments" rows="4" class="w-full px-3 py-2 border border-gray-200 dash-border rounded-lg dash-input text-sm"></textarea></div>
        <div class="mt-6"><button type="submit" class="px-6 py-2 bg-primary-600 hover:bg-primary-700 text-white text-sm font-medium rounded-lg transition-colors">Submit Evaluation</button></div>
    </form>
</div>
<script>
function updateAgent() {
    const select = document.getElementById('callSelect');
    const option = select.options[select.selectedIndex];
    document.getElementById('agentId').value = option.dataset.agent || '';
}
</script>
@endsection
