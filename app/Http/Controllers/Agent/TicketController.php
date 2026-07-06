<?php

namespace App\Http\Controllers\Agent;

use App\Http\Controllers\Controller;
use App\Models\Ticket;
use App\Models\TicketReply;
use Illuminate\Http\Request;

class TicketController extends Controller
{
    public function index()
    {
        $tickets = Ticket::where('assigned_to', auth()->id())
            ->with('contact')
            ->latest()
            ->paginate(15);
        return view('agent.tickets.index', compact('tickets'));
    }

    public function show(Ticket $ticket)
    {
        if ($ticket->assigned_to !== auth()->id()) {
            abort(403);
        }
        $ticket->load('contact', 'replies.user');
        return view('agent.tickets.show', compact('ticket'));
    }

    public function reply(Request $request, Ticket $ticket)
    {
        if ($ticket->assigned_to !== auth()->id()) {
            abort(403);
        }

        $request->validate([
            'message' => 'required|string',
            'is_internal_note' => 'boolean',
        ]);

        TicketReply::create([
            'ticket_id' => $ticket->id,
            'user_id' => auth()->id(),
            'message' => $request->message,
            'is_internal_note' => $request->boolean('is_internal_note'),
        ]);

        return back()->with('success', 'Reply added successfully.');
    }

    public function updateStatus(Request $request, Ticket $ticket)
    {
        if ($ticket->assigned_to !== auth()->id()) {
            abort(403);
        }

        $request->validate(['status' => 'required|in:open,in_progress,resolved,closed']);
        $ticket->update([
            'status' => $request->status,
            'resolved_at' => $request->status === 'resolved' ? now() : null,
            'closed_at' => $request->status === 'closed' ? now() : null,
        ]);
        return back()->with('success', 'Ticket status updated.');
    }
}
