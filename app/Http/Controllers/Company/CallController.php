<?php

namespace App\Http\Controllers\Company;

use App\Http\Controllers\Controller;
use App\Models\Call;
use App\Models\Contact;
use App\Models\Disposition;
use App\Models\Queue;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class CallController extends Controller
{
    public function index()
    {
        $calls = Call::with('contact', 'agent', 'queue', 'disposition')
            ->latest()
            ->paginate(15);
        $dispositions = Disposition::where('is_active', true)->orderBy('name')->get();
        return view('company.calls.index', compact('calls', 'dispositions'));
    }

    public function show(Call $call)
    {
        $call->load('contact', 'agent', 'queue', 'disposition', 'campaign', 'evaluation');
        return view('company.calls.show', compact('call'));
    }

    public function create()
    {
        $contacts = Contact::orderBy('name')->get();
        $agents = User::whereHas('roles', fn($q) => $q->where('name', 'agent'))->orderBy('name')->get();
        $queues = Queue::orderBy('name')->get();
        $dispositions = Disposition::where('is_active', true)->orderBy('name')->get();
        return view('company.calls.create', compact('contacts', 'agents', 'queues', 'dispositions'));
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'contact_id' => 'nullable|exists:contacts,id',
            'agent_id' => 'nullable|exists:users,id',
            'queue_id' => 'nullable|exists:queues,id',
            'phone_number' => 'required|string|max:30',
            'direction' => 'required|in:inbound,outbound',
            'status' => 'required|in:completed,missed,abandoned,voicemail,busy,failed',
            'duration' => 'nullable|integer|min:0',
            'disposition_id' => 'nullable|exists:dispositions,id',
            'notes' => 'nullable|string',
        ]);

        $duration = (int) ($data['duration'] ?? 0);
        $endedAt = now();
        $startedAt = $endedAt->copy()->subSeconds($duration);

        $call = Call::create(array_merge($data, [
            'started_at' => $startedAt,
            'answered_at' => $data['status'] === 'completed' ? $startedAt : null,
            'ended_at' => $endedAt,
            'duration' => $duration,
            'wait_time' => 0,
            'provider_call_id' => 'CALL-' . strtoupper(Str::random(12)),
        ]));

        if ($request->wantsJson()) {
            return response()->json(['success' => true, 'message' => 'Call logged successfully.', 'call' => $call]);
        }

        return redirect()->route('company.calls.index')->with('success', 'Call logged successfully.');
    }

    public function edit(Call $call)
    {
        $contacts = Contact::orderBy('name')->get();
        $agents = User::whereHas('roles', fn($q) => $q->where('name', 'agent'))->orderBy('name')->get();
        $queues = Queue::orderBy('name')->get();
        $dispositions = Disposition::where('is_active', true)->orderBy('name')->get();
        return view('company.calls.edit', compact('call', 'contacts', 'agents', 'queues', 'dispositions'));
    }

    public function update(Request $request, Call $call)
    {
        $data = $request->validate([
            'contact_id' => 'nullable|exists:contacts,id',
            'agent_id' => 'nullable|exists:users,id',
            'queue_id' => 'nullable|exists:queues,id',
            'phone_number' => 'required|string|max:30',
            'direction' => 'required|in:inbound,outbound',
            'status' => 'required|in:completed,missed,abandoned,voicemail,busy,failed',
            'duration' => 'nullable|integer|min:0',
            'disposition_id' => 'nullable|exists:dispositions,id',
            'notes' => 'nullable|string',
        ]);

        $call->update($data);

        if ($request->wantsJson()) {
            return response()->json(['success' => true, 'message' => 'Call updated successfully.']);
        }

        return redirect()->route('company.calls.index')->with('success', 'Call updated successfully.');
    }

    public function destroy(Request $request, Call $call)
    {
        $call->delete();

        if ($request->wantsJson()) {
            return response()->json(['success' => true, 'message' => 'Call deleted successfully.']);
        }

        return redirect()->route('company.calls.index')->with('success', 'Call deleted successfully.');
    }
}
