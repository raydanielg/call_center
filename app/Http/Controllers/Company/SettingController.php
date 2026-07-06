<?php

namespace App\Http\Controllers\Company;

use App\Http\Controllers\Controller;
use App\Models\Setting;
use App\Models\Disposition;
use Illuminate\Http\Request;

class SettingController extends Controller
{
    public function index()
    {
        $tenantId = auth()->user()->tenant_id;
        $settings = Setting::where('tenant_id', $tenantId)->get()->pluck('value', 'key');
        $dispositions = Disposition::latest()->get();
        return view('company.settings.index', compact('settings', 'dispositions'));
    }

    public function update(Request $request)
    {
        $tenantId = auth()->user()->tenant_id;
        foreach ($request->except('_token', '_method') as $key => $value) {
            Setting::set($key, $value, $tenantId);
        }
        return back()->with('success', 'Settings updated successfully.');
    }

    public function storeDisposition(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'color' => 'required|string|max:20',
        ]);
        Disposition::create($request->only('name', 'color'));
        return back()->with('success', 'Disposition added.');
    }

    public function destroyDisposition(Disposition $disposition)
    {
        $disposition->delete();
        return back()->with('success', 'Disposition removed.');
    }
}
