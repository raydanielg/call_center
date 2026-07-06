<?php

namespace App\Http\Controllers\Supervisor;

use App\Http\Controllers\Controller;
use App\Models\Call;
use App\Models\Ticket;
use App\Models\User;
use App\Models\Campaign;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index()
    {
        $tenantId = auth()->user()->tenant_id;

        $stats = [
            'callsToday' => Call::whereDate('created_at', today())->count(),
            'agentsOnline' => User::where('tenant_id', $tenantId)
                ->where('agent_status', 'available')->count(),
            'agentsOnCall' => User::where('tenant_id', $tenantId)
                ->where('agent_status', 'on_call')->count(),
            'agentsOnBreak' => User::where('tenant_id', $tenantId)
                ->where('agent_status', 'break')->count(),
            'openTickets' => Ticket::where('status', 'open')->count(),
            'activeCampaigns' => Campaign::where('status', 'active')->count(),
        ];

        $agents = User::where('tenant_id', $tenantId)
            ->role('agent')
            ->withCount(['calls' => fn($q) => $q->whereDate('created_at', today())])
            ->get();

        return view('supervisor.dashboard', compact('stats', 'agents'));
    }
}
