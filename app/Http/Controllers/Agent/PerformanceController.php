<?php

namespace App\Http\Controllers\Agent;

use App\Http\Controllers\Controller;
use App\Models\Call;
use App\Models\Evaluation;
use Illuminate\Http\Request;

class PerformanceController extends Controller
{
    public function index()
    {
        $userId = auth()->id();

        $totalCalls = Call::where('agent_id', $userId)->count();
        $totalDuration = Call::where('agent_id', $userId)->sum('duration');
        $avgDuration = $totalCalls > 0 ? round($totalDuration / $totalCalls) : 0;

        $evaluations = Evaluation::where('agent_id', $userId)
            ->with('evaluator')
            ->latest()
            ->paginate(10);

        $avgScore = Evaluation::where('agent_id', $userId)
            ->where('status', 'submitted')
            ->avg('total_score') ?? 0;

        $callsByStatus = Call::where('agent_id', $userId)
            ->selectRaw('status, COUNT(*) as count')
            ->groupBy('status')
            ->pluck('count', 'status')
            ->toArray();

        return view('agent.performance.index', compact('totalCalls', 'avgDuration', 'evaluations', 'avgScore', 'callsByStatus'));
    }
}
