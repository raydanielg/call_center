<?php

namespace App\Http\Controllers\Supervisor;

use App\Http\Controllers\Controller;
use App\Models\Call;
use App\Models\Ticket;
use App\Models\User;
use Illuminate\Http\Request;

class ReportController extends Controller
{
    public function index()
    {
        $tenantId = auth()->user()->tenant_id;

        $agentPerformance = User::where('tenant_id', $tenantId)
            ->role('agent')
            ->withCount(['calls', 'ticketsAssigned'])
            ->with(['calls' => fn($q) => $q->select('agent_id', 'duration')->latest()->take(50)])
            ->get()
            ->map(function ($agent) {
                $agent->avg_call_duration = $agent->calls->avg('duration') ?? 0;
                return $agent;
            });

        $callsByDay = Call::selectRaw('DATE(created_at) as date, COUNT(*) as count')
            ->whereMonth('created_at', now()->month)
            ->groupBy('date')
            ->pluck('count', 'date')
            ->toArray();

        return view('supervisor.reports.index', compact('agentPerformance', 'callsByDay'));
    }
}
