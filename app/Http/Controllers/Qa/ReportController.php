<?php

namespace App\Http\Controllers\Qa;

use App\Http\Controllers\Controller;
use App\Models\Evaluation;
use App\Models\User;
use Illuminate\Http\Request;

class ReportController extends Controller
{
    public function index()
    {
        $agentScores = User::where('tenant_id', auth()->user()->tenant_id)
            ->role('agent')
            ->with(['evaluations' => fn($q) => $q->where('status', 'submitted')])
            ->get()
            ->map(function ($agent) {
                $agent->avg_score = $agent->evaluations->avg('total_score') ?? 0;
                $agent->evaluation_count = $agent->evaluations->count();
                return $agent;
            });

        $avgScoreByCategory = [
            'greeting' => Evaluation::where('status', 'submitted')->avg('greeting_score') ?? 0,
            'communication' => Evaluation::where('status', 'submitted')->avg('communication_score') ?? 0,
            'problem_solving' => Evaluation::where('status', 'submitted')->avg('problem_solving_score') ?? 0,
            'compliance' => Evaluation::where('status', 'submitted')->avg('compliance_score') ?? 0,
            'closing' => Evaluation::where('status', 'submitted')->avg('closing_score') ?? 0,
        ];

        return view('qa.reports.index', compact('agentScores', 'avgScoreByCategory'));
    }
}
