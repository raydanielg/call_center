<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Tenant;
use Illuminate\Http\Request;

class CompanyController extends Controller
{
    public function index()
    {
        $tenants = Tenant::latest()->paginate(10);
        return view('admin.companies.index', compact('tenants'));
    }

    public function show(Tenant $tenant)
    {
        $tenant->load('users', 'subscription.plan', 'payments');
        return view('admin.companies.show', compact('tenant'));
    }

    public function updateStatus(Request $request, Tenant $tenant)
    {
        $request->validate(['status' => 'required|in:active,suspended,pending']);
        $tenant->update(['status' => $request->status]);
        return back()->with('success', 'Company status updated successfully.');
    }

    public function destroy(Tenant $tenant)
    {
        $tenant->delete();
        return redirect()->route('admin.companies.index')->with('success', 'Company deleted successfully.');
    }
}
