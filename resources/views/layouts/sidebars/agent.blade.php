{{-- Agent Sidebar --}}
<div class="flex-1 overflow-y-auto py-4 px-3 space-y-1">
    <a href="{{ route('agent.dashboard') }}" class="sidebar-link w-full flex items-center gap-3 px-3 py-2.5 rounded-lg text-primary-100 text-sm font-medium {{ request()->routeIs('agent.dashboard') ? 'active' : '' }}">
        <svg class="w-5 h-5 text-primary-300" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2H6a2 2 0 01-2-2V6zM14 6a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2h-2a2 2 0 01-2-2V6zM4 16a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2H6a2 2 0 01-2-2v-2zM14 16a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2h-2a2 2 0 01-2-2v-2z"/></svg>
        <span>Dashboard</span>
    </a>
    <a href="{{ route('agent.calls.index') }}" class="sidebar-link w-full flex items-center gap-3 px-3 py-2.5 rounded-lg text-primary-100 text-sm font-medium {{ request()->routeIs('agent.calls*') ? 'active' : '' }}">
        <svg class="w-5 h-5 text-primary-300" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z"/></svg>
        <span>My Calls</span>
    </a>
    <a href="{{ route('agent.tickets.index') }}" class="sidebar-link w-full flex items-center gap-3 px-3 py-2.5 rounded-lg text-primary-100 text-sm font-medium {{ request()->routeIs('agent.tickets*') ? 'active' : '' }}">
        <svg class="w-5 h-5 text-primary-300" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 5v2m0 0v2m0-2h-2m2 0h2M9 5v2m0 0v2m0-2H7m2 0h2m5-4H5a2 2 0 00-2 2v12a2 2 0 002 2h12a2 2 0 002-2V7a2 2 0 00-2-2z"/></svg>
        <span>My Tickets</span>
    </a>
    <a href="{{ route('agent.contacts.index') }}" class="sidebar-link w-full flex items-center gap-3 px-3 py-2.5 rounded-lg text-primary-100 text-sm font-medium {{ request()->routeIs('agent.contacts*') ? 'active' : '' }}">
        <svg class="w-5 h-5 text-primary-300" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"/></svg>
        <span>Contacts</span>
    </a>
    <a href="{{ route('agent.callbacks.index') }}" class="sidebar-link w-full flex items-center gap-3 px-3 py-2.5 rounded-lg text-primary-100 text-sm font-medium {{ request()->routeIs('agent.callbacks*') ? 'active' : '' }}">
        <svg class="w-5 h-5 text-primary-300" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
        <span>Callbacks</span>
    </a>
    <a href="{{ route('agent.performance.index') }}" class="sidebar-link w-full flex items-center gap-3 px-3 py-2.5 rounded-lg text-primary-100 text-sm font-medium {{ request()->routeIs('agent.performance*') ? 'active' : '' }}">
        <svg class="w-5 h-5 text-primary-300" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11.049 2.927c.3-.921 1.603-.921 1.902 0l1.519 4.674a1 1 0 00.95.69h4.915c.969 0 1.371 1.24.588 1.81l-3.976 2.888a1 1 0 00-.363 1.118l1.518 4.674c.3.922-.755 1.688-1.538 1.118l-3.976-2.888a1 1 0 00-1.176 0l-3.976 2.888c-.783.57-1.838-.197-1.538-1.118l1.518-4.674a1 1 0 00-.363-1.118l-3.976-2.888c-.784-.57-.38-1.81.588-1.81h4.914a1 1 0 00.951-.69l1.519-4.674z"/></svg>
        <span>My Performance</span>
    </a>
    <a href="{{ route('profile.edit') }}" class="sidebar-link w-full flex items-center gap-3 px-3 py-2.5 rounded-lg text-primary-100 text-sm font-medium {{ request()->routeIs('profile*') ? 'active' : '' }}">
        <svg class="w-5 h-5 text-primary-300" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"/></svg>
        <span>Profile</span>
    </a>
</div>
