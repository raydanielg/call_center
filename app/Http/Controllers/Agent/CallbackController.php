<?php

namespace App\Http\Controllers\Agent;

use App\Http\Controllers\Controller;
use App\Models\Callback;
use Illuminate\Http\Request;

class CallbackController extends Controller
{
    public function index()
    {
        $callbacks = Callback::where('agent_id', auth()->id())
            ->with('contact')
            ->latest()
            ->paginate(15);
        return view('agent.callbacks.index', compact('callbacks'));
    }

    public function updateStatus(Request $request, Callback $callback)
    {
        if ($callback->agent_id !== auth()->id()) {
            abort(403);
        }

        $request->validate(['status' => 'required|in:pending,done,missed']);
        $callback->update(['status' => $request->status]);
        return back()->with('success', 'Callback status updated.');
    }
}
