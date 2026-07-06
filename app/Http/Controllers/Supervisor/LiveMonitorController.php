<?php

namespace App\Http\Controllers\Supervisor;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\AgentSession;
use Illuminate\Http\Request;

class LiveMonitorController extends Controller
{
    public function index()
    {
        $agents = User::where('tenant_id', auth()->user()->tenant_id)
            ->role('agent')
            ->with(['agentSessions' => fn($q) => $q->latest()->take(1)])
            ->get();

        return view('supervisor.live-monitor.index', compact('agents'));
    }
}
