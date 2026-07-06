<?php

namespace App\Http\Controllers\Company;

use App\Http\Controllers\Controller;
use App\Models\Ticket;
use App\Models\Contact;
use App\Models\User;
use Illuminate\Http\Request;

class TicketController extends Controller
{
    public function index()
    {
        $tickets = Ticket::with('contact', 'assignedTo', 'createdBy')
            ->latest()
            ->paginate(15);
        return view('company.tickets.index', compact('tickets'));
    }

    public function create()
    {
        $contacts = Contact::orderBy('name')->get();
        $agents = User::where('tenant_id', auth()->user()->tenant_id)
            ->role(['agent', 'supervisor'])
            ->get();
        return view('company.tickets.create', compact('contacts', 'agents'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'contact_id' => 'nullable|exists:contacts,id',
            'assigned_to' => 'nullable|exists:users,id',
            'subject' => 'required|string|max:255',
            'description' => 'required|string',
            'category' => 'nullable|string|max:100',
            'priority' => 'required|in:low,medium,high,urgent',
        ]);

        $ticket = new Ticket($request->all());
        $ticket->created_by = auth()->id();
        $ticket->save();

        return redirect()->route('company.tickets.index')->with('success', 'Ticket created successfully.');
    }

    public function show(Ticket $ticket)
    {
        $ticket->load('contact', 'assignedTo', 'createdBy', 'replies.user');
        return view('company.tickets.show', compact('ticket'));
    }

    public function updateStatus(Request $request, Ticket $ticket)
    {
        $request->validate(['status' => 'required|in:open,in_progress,resolved,closed']);
        $ticket->update([
            'status' => $request->status,
            'resolved_at' => $request->status === 'resolved' ? now() : null,
            'closed_at' => $request->status === 'closed' ? now() : null,
        ]);
        return back()->with('success', 'Ticket status updated.');
    }
}
