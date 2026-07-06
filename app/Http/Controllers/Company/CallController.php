<?php

namespace App\Http\Controllers\Company;

use App\Http\Controllers\Controller;
use App\Models\Call;
use Illuminate\Http\Request;

class CallController extends Controller
{
    public function index()
    {
        $calls = Call::with('contact', 'agent', 'queue', 'disposition')
            ->latest()
            ->paginate(15);
        return view('company.calls.index', compact('calls'));
    }

    public function show(Call $call)
    {
        $call->load('contact', 'agent', 'queue', 'disposition', 'campaign', 'evaluation');
        return view('company.calls.show', compact('call'));
    }
}
