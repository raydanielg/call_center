<?php

namespace App\Http\Controllers\Supervisor;

use App\Http\Controllers\Controller;
use App\Models\Call;
use Illuminate\Http\Request;

class CallController extends Controller
{
    public function index()
    {
        $calls = Call::with('contact', 'agent', 'queue')
            ->latest()
            ->paginate(15);
        return view('supervisor.calls.index', compact('calls'));
    }
}
