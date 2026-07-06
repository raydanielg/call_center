<?php

namespace App\Http\Controllers\Company;

use App\Http\Controllers\Controller;
use App\Models\Queue;
use App\Models\User;
use Illuminate\Http\Request;

class QueueController extends Controller
{
    public function index()
    {
        $queues = Queue::with('agents')->latest()->paginate(10);
        return view('company.queues.index', compact('queues'));
    }

    public function create()
    {
        $agents = User::where('tenant_id', auth()->user()->tenant_id)
            ->role('agent')
            ->get();
        return view('company.queues.create', compact('agents'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
            'strategy' => 'required|in:round_robin,longest_idle',
            'max_wait_time' => 'required|integer|min:30',
            'agents' => 'nullable|array',
            'agents.*' => 'exists:users,id',
        ]);

        $queue = Queue::create($request->only('name', 'description', 'strategy', 'max_wait_time'));

        if ($request->has('agents')) {
            $queue->agents()->attach($request->agents);
        }

        return redirect()->route('company.queues.index')->with('success', 'Queue created successfully.');
    }

    public function edit(Queue $queue)
    {
        $agents = User::where('tenant_id', auth()->user()->tenant_id)
            ->role('agent')
            ->get();
        return view('company.queues.edit', compact('queue', 'agents'));
    }

    public function update(Request $request, Queue $queue)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
            'strategy' => 'required|in:round_robin,longest_idle',
            'max_wait_time' => 'required|integer|min:30',
            'is_active' => 'boolean',
            'agents' => 'nullable|array',
            'agents.*' => 'exists:users,id',
        ]);

        $queue->update($request->only('name', 'description', 'strategy', 'max_wait_time', 'is_active'));
        $queue->agents()->sync($request->agents ?? []);

        return redirect()->route('company.queues.index')->with('success', 'Queue updated successfully.');
    }

    public function destroy(Queue $queue)
    {
        $queue->delete();
        return redirect()->route('company.queues.index')->with('success', 'Queue deleted.');
    }
}
