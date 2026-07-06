<?php

namespace App\Http\Controllers;

use App\Models\Call;
use App\Models\Contact;
use App\Models\Disposition;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class DialerController extends Controller
{
    /**
     * Return the current user's phone connection status.
     */
    public function phoneStatus()
    {
        $user = auth()->user();

        return response()->json([
            'connected' => !empty($user->phone),
            'phone' => $user->phone,
            'extension' => $user->extension_number,
            'name' => $user->name,
        ]);
    }

    /**
     * Save (connect) the agent's phone number and extension.
     */
    public function connectPhone(Request $request)
    {
        $data = $request->validate([
            'phone' => 'required|string|max:20',
            'extension' => 'nullable|string|max:10',
        ]);

        $user = auth()->user();
        $user->update([
            'phone' => $data['phone'],
            'extension_number' => $data['extension'] ?? $user->extension_number,
        ]);

        return response()->json([
            'success' => true,
            'message' => 'Phone connected successfully.',
            'phone' => $user->phone,
            'extension' => $user->extension_number,
        ]);
    }

    /**
     * Disconnect the agent's phone number.
     */
    public function disconnectPhone()
    {
        $user = auth()->user();
        $user->update([
            'phone' => null,
            'extension_number' => null,
        ]);

        return response()->json([
            'success' => true,
            'message' => 'Phone disconnected.',
        ]);
    }

    /**
     * Search contacts for the dialer's "Contacts" tab.
     */
    public function contacts(Request $request)
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

    /**
     * Active dispositions for the tenant, used in the post-call wrap-up modal.
     */
    public function dispositions()
    {
        $dispositions = Disposition::where('is_active', true)
            ->orderBy('name')
            ->get(['id', 'name', 'color']);

        return response()->json($dispositions);
    }

    /**
     * Persist the call once the dialer session ends (hangup + wrap-up saved).
     */
    public function logCall(Request $request)
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
            'provider_call_id' => 'CALL-' . strtoupper(Str::random(12)),
        ]);

        return response()->json([
            'success' => true,
            'message' => 'Call logged successfully.',
            'call' => $call->load('contact', 'disposition'),
        ]);
    }
}
