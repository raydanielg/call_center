<?php

namespace App\Http\Controllers\Company;

use App\Http\Controllers\Controller;
use App\Models\Campaign;
use App\Models\Contact;
use Illuminate\Http\Request;

class CampaignController extends Controller
{
    public function index()
    {
        $campaigns = Campaign::with('creator')->latest()->paginate(10);
        return view('company.campaigns.index', compact('campaigns'));
    }

    public function create()
    {
        return view('company.campaigns.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
            'type' => 'required|in:sales,survey,collection',
            'script' => 'nullable|string',
            'starts_at' => 'nullable|date',
            'ends_at' => 'nullable|date|after_or_equal:starts_at',
        ]);

        $campaign = new Campaign($request->all());
        $campaign->created_by = auth()->id();
        $campaign->save();

        return redirect()->route('company.campaigns.index')->with('success', 'Campaign created successfully.');
    }

    public function show(Campaign $campaign)
    {
        $campaign->load('contacts.contact');
        return view('company.campaigns.show', compact('campaign'));
    }

    public function updateStatus(Request $request, Campaign $campaign)
    {
        $request->validate(['status' => 'required|in:draft,active,paused,completed']);
        $campaign->update(['status' => $request->status]);
        return back()->with('success', 'Campaign status updated.');
    }

    public function destroy(Campaign $campaign)
    {
        $campaign->delete();
        return redirect()->route('company.campaigns.index')->with('success', 'Campaign deleted.');
    }
}
