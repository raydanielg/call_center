<?php

namespace App\Http\Controllers\Supervisor;

use App\Http\Controllers\Controller;
use App\Models\Campaign;
use Illuminate\Http\Request;

class CampaignController extends Controller
{
    public function index()
    {
        $campaigns = Campaign::with('creator', 'contacts')
            ->withCount('contacts')
            ->latest()
            ->paginate(10);
        return view('supervisor.campaigns.index', compact('campaigns'));
    }

    public function show(Campaign $campaign)
    {
        $campaign->load('contacts.contact');
        return view('supervisor.campaigns.show', compact('campaign'));
    }
}
