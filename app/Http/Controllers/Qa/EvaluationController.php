<?php

namespace App\Http\Controllers\Qa;

use App\Http\Controllers\Controller;
use App\Models\Evaluation;
use App\Models\Call;
use Illuminate\Http\Request;

class EvaluationController extends Controller
{
    public function index()
    {
        $evaluations = Evaluation::with('agent', 'call', 'evaluator')
            ->latest()
            ->paginate(15);
        return view('qa.evaluations.index', compact('evaluations'));
    }

    public function create()
    {
        $calls = Call::with('agent', 'contact')
            ->whereDoesntHave('evaluation')
            ->latest()
            ->take(50)
            ->get();
        return view('qa.evaluations.create', compact('calls'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'call_id' => 'required|exists:calls,id',
            'agent_id' => 'required|exists:users,id',
            'greeting_score' => 'required|integer|min:0|max:20',
            'communication_score' => 'required|integer|min:0|max:20',
            'problem_solving_score' => 'required|integer|min:0|max:20',
            'compliance_score' => 'required|integer|min:0|max:20',
            'closing_score' => 'required|integer|min:0|max:20',
            'comments' => 'nullable|string',
        ]);

        $total = $request->greeting_score + $request->communication_score +
                 $request->problem_solving_score + $request->compliance_score +
                 $request->closing_score;

        Evaluation::create([
            'call_id' => $request->call_id,
            'agent_id' => $request->agent_id,
            'evaluator_id' => auth()->id(),
            'greeting_score' => $request->greeting_score,
            'communication_score' => $request->communication_score,
            'problem_solving_score' => $request->problem_solving_score,
            'compliance_score' => $request->compliance_score,
            'closing_score' => $request->closing_score,
            'total_score' => $total,
            'comments' => $request->comments,
            'status' => 'submitted',
        ]);

        return redirect()->route('qa.evaluations.index')->with('success', 'Evaluation submitted successfully.');
    }

    public function show(Evaluation $evaluation)
    {
        $evaluation->load('agent', 'call', 'evaluator');
        return view('qa.evaluations.show', compact('evaluation'));
    }
}
