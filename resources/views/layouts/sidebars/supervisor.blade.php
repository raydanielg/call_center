{{-- Supervisor Sidebar --}}
<div class="flex-1 overflow-y-auto py-4 px-3 space-y-1">
    <a href="{{ route('supervisor.dashboard') }}" class="sidebar-link w-full flex items-center gap-3 px-3 py-2.5 rounded-lg text-primary-100 text-sm font-medium {{ request()->routeIs('supervisor.dashboard') ? 'active' : '' }}">
        <svg class="w-5 h-5 text-primary-300" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2H6a2 2 0 01-2-2V6zM14 6a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2h-2a2 2 0 01-2-2V6zM4 16a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2H6a2 2 0 01-2-2v-2zM14 16a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2h-2a2 2 0 01-2-2v-2z"/></svg>
        <span>Dashboard</span>
    </a>
    <a href="{{ route('supervisor.live-monitor') }}" class="sidebar-link w-full flex items-center gap-3 px-3 py-2.5 rounded-lg text-primary-100 text-sm font-medium {{ request()->routeIs('supervisor.live-monitor*') ? 'active' : '' }}">
        <svg class="w-5 h-5 text-red-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"/></svg>
        <span>Live Monitor</span>
    </a>
    <a href="{{ route('supervisor.agents.index') }}" class="sidebar-link w-full flex items-center gap-3 px-3 py-2.5 rounded-lg text-primary-100 text-sm font-medium {{ request()->routeIs('supervisor.agents*') ? 'active' : '' }}">
        <svg class="w-5 h-5 text-primary-300" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z"/></svg>
        <span>Agents</span>
    </a>
    <a href="{{ route('supervisor.calls.index') }}" class="sidebar-link w-full flex items-center gap-3 px-3 py-2.5 rounded-lg text-primary-100 text-sm font-medium {{ request()->routeIs('supervisor.calls*') ? 'active' : '' }}">
        <svg class="w-5 h-5 text-primary-300" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z"/></svg>
        <span>Calls</span>
    </a>
    <a href="{{ route('supervisor.tickets.index') }}" class="sidebar-link w-full flex items-center gap-3 px-3 py-2.5 rounded-lg text-primary-100 text-sm font-medium {{ request()->routeIs('supervisor.tickets*') ? 'active' : '' }}">
        <svg class="w-5 h-5 text-primary-300" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 5v2m0 0v2m0-2h-2m2 0h2M9 5v2m0 0v2m0-2H7m2 0h2m5-4H5a2 2 0 00-2 2v12a2 2 0 002 2h12a2 2 0 002-2V7a2 2 0 00-2-2z"/></svg>
        <span>Tickets</span>
    </a>
    <a href="{{ route('supervisor.campaigns.index') }}" class="sidebar-link w-full flex items-center gap-3 px-3 py-2.5 rounded-lg text-primary-100 text-sm font-medium {{ request()->routeIs('supervisor.campaigns*') ? 'active' : '' }}">
        <svg class="w-5 h-5 text-primary-300" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5.882V19.24a1.76 1.76 0 01-3.417.592l-2.147-6.15M18 13a3 3 0 100-6M5.436 13.683A4.001 4.001 0 017 6h1.832c4.1 0 7.625-1.234 9.168-3v14c-1.543-1.766-5.067-3-9.168-3H7a3.988 3.988 0 01-1.564-.317z"/></svg>
        <span>Campaigns</span>
    </a>
    <a href="{{ route('supervisor.reports.index') }}" class="sidebar-link w-full flex items-center gap-3 px-3 py-2.5 rounded-lg text-primary-100 text-sm font-medium {{ request()->routeIs('supervisor.reports*') ? 'active' : '' }}">
        <svg class="w-5 h-5 text-primary-300" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z"/></svg>
        <span>Reports</span>
    </a>
    <a href="{{ route('profile.edit') }}" class="sidebar-link w-full flex items-center gap-3 px-3 py-2.5 rounded-lg text-primary-100 text-sm font-medium {{ request()->routeIs('profile*') ? 'active' : '' }}">
        <svg class="w-5 h-5 text-primary-300" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"/></svg>
        <span>Profile</span>
    </a>
</div>
