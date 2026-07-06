<?php

namespace App\Http\Controllers\Agent;

use App\Http\Controllers\Controller;
use App\Models\Call;
use Illuminate\Http\Request;

class CallController extends Controller
{
    public function index()
    {
        $calls = Call::where('agent_id', auth()->id())
            ->with('contact', 'disposition')
            ->latest()
            ->paginate(15);
        return view('agent.calls.index', compact('calls'));
    }

    public function show(Call $call)
    {
        if ($call->agent_id !== auth()->id()) {
            abort(403);
        }
        $call->load('contact', 'disposition', 'queue');
        return view('agent.calls.show', compact('call'));
    }
}
