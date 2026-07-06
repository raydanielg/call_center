<?php

namespace App\Http\Controllers\Agent;

use App\Http\Controllers\Controller;
use App\Models\Call;
use App\Models\Contact;
use App\Models\Disposition;
use Illuminate\Http\Request;

class CallController extends Controller
{
    public function index()
    {
        $calls = Call::where('agent_id', auth()->id())
            ->with('contact', 'disposition')
            ->latest()
            ->paginate(15);
        $dispositions = Disposition::where('is_active', true)->orderBy('name')->get();
        return view('agent.calls.index', compact('calls', 'dispositions'));
    }

    public function show(Call $call)
    {
        if ($call->agent_id !== auth()->id()) {
            abort(403);
        }
        $call->load('contact', 'disposition', 'queue');
        return view('agent.calls.show', compact('call'));
    }

    /**
     * Store a call record - used both by the manual "Log Call" form
     * and the live Dialer widget once a call has ended.
     */
    public function store(Request $request)
    {
        $data = $request->validate([
            'contact_id' => 'nullable|exists:contacts,id',
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

        $call = Call::create([
            'contact_id' => $data['contact_id'] ?? null,
            'agent_id' => auth()->id(),
            'direction' => $data['direction'],
            'phone_number' => $data['phone_number'],
            'status' => $data['status'],
            'started_at' => $startedAt,
            'answered_at' => $data['status'] === 'completed' ? $startedAt : null,
            'ended_at' => $endedAt,
            'duration' => $duration,
            'wait_time' => 0,
            'disposition_id' => $data['disposition_id'] ?? null,
            'notes' => $data['notes'] ?? null,
            'provider_call_id' => 'CALL-' . strtoupper(\Illuminate\Support\Str::random(12)),
        ]);

        if ($request->wantsJson()) {
            return response()->json([
                'success' => true,
                'message' => 'Call logged successfully.',
                'call' => $call->load('contact', 'disposition'),
            ]);
        }

        return redirect()->route('agent.calls.index')->with('success', 'Call logged successfully.');
    }

    public function edit(Call $call)
    {
        if ($call->agent_id !== auth()->id()) {
            abort(403);
        }
        $dispositions = Disposition::where('is_active', true)->orderBy('name')->get();
        return view('agent.calls.edit', compact('call', 'dispositions'));
    }

    public function update(Request $request, Call $call)
    {
        if ($call->agent_id !== auth()->id()) {
            abort(403);
        }

        $data = $request->validate([
            'status' => 'required|in:completed,missed,abandoned,voicemail,busy,failed',
            'disposition_id' => 'nullable|exists:dispositions,id',
            'notes' => 'nullable|string',
        ]);

        $call->update($data);

        if ($request->wantsJson()) {
            return response()->json(['success' => true, 'message' => 'Call updated successfully.']);
        }

        return redirect()->route('agent.calls.index')->with('success', 'Call updated successfully.');
    }

    public function destroy(Request $request, Call $call)
    {
        if ($call->agent_id !== auth()->id()) {
            abort(403);
        }

        $call->delete();

        if ($request->wantsJson()) {
            return response()->json(['success' => true, 'message' => 'Call deleted successfully.']);
        }

        return redirect()->route('agent.calls.index')->with('success', 'Call deleted successfully.');
    }

    /**
     * AJAX contact search used by the Dialer widget.
     */
    public function dialerContacts(Request $request)
    {
        $query = trim((string) $request->get('q'));

        $contacts = Contact::query()
            ->when($query, function ($q) use ($query) {
                $q->where('name', 'like', "%{$query}%")
                    ->orWhere('phone', 'like', "%{$query}%");
            })
            ->orderBy('name')
            ->limit(20)
            ->get(['id', 'name', 'phone', 'company']);

        return response()->json($contacts);
    }
}
