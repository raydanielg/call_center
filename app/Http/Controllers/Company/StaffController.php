<?php

namespace App\Http\Controllers\Company;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\Tenant;
use Illuminate\Http\Request;
use Spatie\Permission\Models\Role;

class StaffController extends Controller
{
    public function index()
    {
        $staff = User::where('tenant_id', auth()->user()->tenant_id)
            ->with('roles')
            ->latest()
            ->paginate(10);
        return view('company.staff.index', compact('staff'));
    }

    public function create()
    {
        $roles = Role::whereIn('name', ['company_admin', 'supervisor', 'agent', 'qa_analyst'])->get();
        return view('company.staff.create', compact('roles'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users',
            'phone' => 'nullable|string|max:20',
            'password' => 'required|string|min:8|confirmed',
            'role' => 'required|in:company_admin,supervisor,agent,qa_analyst',
            'extension_number' => 'nullable|string|max:10',
        ]);

        $tenant = auth()->user()->tenant;
        $plan = $tenant->plan;

        if ($request->role === 'agent' && $plan) {
            $agentCount = User::where('tenant_id', $tenant->id)
                ->whereHas('roles', fn($q) => $q->where('name', 'agent'))
                ->count();
            if ($agentCount >= $plan->max_agents) {
                return back()->with('error', 'You have reached the maximum number of agents for your plan. Please upgrade.');
            }
        }

        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'phone' => $request->phone,
            'password' => $request->password,
            'tenant_id' => auth()->user()->tenant_id,
            'extension_number' => $request->extension_number,
            'status' => 'active',
        ]);

        $user->assignRole($request->role);

        return redirect()->route('company.staff.index')->with('success', 'Staff member added successfully.');
    }

    public function edit(User $staff)
    {
        $this->authorize('update', $staff);
        $roles = Role::whereIn('name', ['company_admin', 'supervisor', 'agent', 'qa_analyst'])->get();
        return view('company.staff.edit', compact('staff', 'roles'));
    }

    public function update(Request $request, User $staff)
    {
        $this->authorize('update', $staff);

        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email,' . $staff->id,
            'phone' => 'nullable|string|max:20',
            'role' => 'required|in:company_admin,supervisor,agent,qa_analyst',
            'extension_number' => 'nullable|string|max:10',
            'status' => 'required|in:active,inactive',
        ]);

        $staff->update($request->only('name', 'email', 'phone', 'extension_number', 'status'));
        $staff->syncRoles([$request->role]);

        return redirect()->route('company.staff.index')->with('success', 'Staff member updated successfully.');
    }

    public function destroy(User $staff)
    {
        $this->authorize('delete', $staff);
        $staff->delete();
        return redirect()->route('company.staff.index')->with('success', 'Staff member removed successfully.');
    }
}
