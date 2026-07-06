<?php

namespace App\Http\Controllers\Qa;

use App\Http\Controllers\Controller;
use App\Models\Call;
use App\Models\Evaluation;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index()
    {
        $pendingEvaluations = Evaluation::where('status', 'draft')->count();
        $submittedEvaluations = Evaluation::where('status', 'submitted')->count();
        $avgScore = Evaluation::where('status', 'submitted')->avg('total_score') ?? 0;
        $recordingsCount = Call::whereNotNull('recording_url')->count();

        $recentEvaluations = Evaluation::with('agent', 'call')
            ->latest()
            ->take(5)
            ->get();

        return view('qa.dashboard', compact('pendingEvaluations', 'submittedEvaluations', 'avgScore', 'recordingsCount', 'recentEvaluations'));
    }
}
