<?php

namespace App\Http\Controllers\Qa;

use App\Http\Controllers\Controller;
use App\Models\Call;
use Illuminate\Http\Request;

class RecordingController extends Controller
{
    public function index()
    {
        $calls = Call::whereNotNull('recording_url')
            ->with('agent', 'contact')
            ->latest()
            ->paginate(15);
        return view('qa.recordings.index', compact('calls'));
    }

    public function show(Call $call)
    {
        $call->load('agent', 'contact', 'evaluation');
        return view('qa.recordings.show', compact('call'));
    }
}
