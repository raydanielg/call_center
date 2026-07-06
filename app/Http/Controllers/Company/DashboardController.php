<?php

namespace App\Http\Controllers\Company;

use App\Http\Controllers\Controller;
use App\Models\Call;
use App\Models\Ticket;
use App\Models\Contact;
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
            'openTickets' => Ticket::where('status', 'open')->count(),
            'activeAgents' => User::where('tenant_id', $tenantId)
                ->where('agent_status', 'available')->count(),
            'totalContacts' => Contact::count(),
            'activeCampaigns' => Campaign::where('status', 'active')->count(),
            'missedCalls' => Call::where('status', 'missed')->whereDate('created_at', today())->count(),
        ];

        $recentCalls = Call::with('contact', 'agent')->latest()->take(5)->get();
        $recentTickets = Ticket::latest()->take(5)->get();

        return view('company.dashboard', compact('stats', 'recentCalls', 'recentTickets'));
    }
}
