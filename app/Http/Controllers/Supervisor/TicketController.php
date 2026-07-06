<?php

namespace App\Http\Controllers\Supervisor;

use App\Http\Controllers\Controller;
use App\Models\Ticket;
use App\Models\User;
use Illuminate\Http\Request;

class TicketController extends Controller
{
    public function index()
    {
        $tickets = Ticket::with('contact', 'assignedTo')
            ->latest()
            ->paginate(15);
        $agents = User::where('tenant_id', auth()->user()->tenant_id)
            ->role(['agent', 'supervisor'])
            ->get();
        return view('supervisor.tickets.index', compact('tickets', 'agents'));
    }

    public function assign(Request $request, Ticket $ticket)
    {
        $request->validate(['assigned_to' => 'required|exists:users,id']);
        $ticket->update(['assigned_to' => $request->assigned_to, 'status' => 'in_progress']);
        return back()->with('success', 'Ticket assigned successfully.');
    }
}
