<?php

namespace App\Http\Controllers\Company;

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

        $callsByDay = Call::selectRaw('DATE(created_at) as date, COUNT(*) as count')
            ->whereMonth('created_at', now()->month)
            ->groupBy('date')
            ->pluck('count', 'date')
            ->toArray();

        $ticketsByStatus = Ticket::selectRaw('status, COUNT(*) as count')
            ->groupBy('status')
            ->pluck('count', 'status')
            ->toArray();

        $agentPerformance = User::where('tenant_id', $tenantId)
            ->role('agent')
            ->withCount(['calls' => fn($q) => $q->whereMonth('created_at', now()->month)])
            ->get();

        return view('company.reports.index', compact('callsByDay', 'ticketsByStatus', 'agentPerformance'));
    }
}
