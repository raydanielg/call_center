<?php

namespace App\Http\Controllers\Supervisor;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;

class AgentController extends Controller
{
    public function index()
    {
        $agents = User::where('tenant_id', auth()->user()->tenant_id)
            ->role('agent')
            ->withCount(['calls', 'ticketsAssigned'])
            ->latest()
            ->paginate(10);

        return view('supervisor.agents.index', compact('agents'));
    }

    public function show(User $agent)
    {
        $agent->load('calls.contact', 'ticketsAssigned');
        return view('supervisor.agents.show', compact('agent'));
    }
}
