<?php

namespace App\Http\Controllers\Agent;

use App\Http\Controllers\Controller;
use App\Models\Call;
use App\Models\Ticket;
use App\Models\Callback;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index()
    {
        $userId = auth()->id();

        $stats = [
            'myCallsToday' => Call::where('agent_id', $userId)
                ->whereDate('created_at', today())->count(),
            'myOpenTickets' => Ticket::where('assigned_to', $userId)
                ->where('status', 'open')->count(),
            'pendingCallbacks' => Callback::where('agent_id', $userId)
                ->where('status', 'pending')->count(),
            'myTotalCalls' => Call::where('agent_id', $userId)->count(),
        ];

        $recentCalls = Call::where('agent_id', $userId)
            ->with('contact')->latest()->take(5)->get();

        $myTickets = Ticket::where('assigned_to', $userId)
            ->latest()->take(5)->get();

        $upcomingCallbacks = Callback::where('agent_id', $userId)
            ->where('status', 'pending')
            ->with('contact')
            ->orderBy('scheduled_at')
            ->take(5)->get();

        return view('agent.dashboard', compact('stats', 'recentCalls', 'myTickets', 'upcomingCallbacks'));
    }
}
