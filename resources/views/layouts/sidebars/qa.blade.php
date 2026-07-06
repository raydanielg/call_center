{{-- QA Analyst Sidebar --}}
<div class="flex-1 overflow-y-auto py-4 px-3 space-y-1">
    <a href="{{ route('qa.dashboard') }}" class="sidebar-link w-full flex items-center gap-3 px-3 py-2.5 rounded-lg text-primary-100 text-sm font-medium {{ request()->routeIs('qa.dashboard') ? 'active' : '' }}">
        <svg class="w-5 h-5 text-primary-300" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2H6a2 2 0 01-2-2V6zM14 6a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2h-2a2 2 0 01-2-2V6zM4 16a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2H6a2 2 0 01-2-2v-2zM14 16a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2h-2a2 2 0 01-2-2v-2z"/></svg>
        <span>Dashboard</span>
    </a>
    <a href="{{ route('qa.recordings.index') }}" class="sidebar-link w-full flex items-center gap-3 px-3 py-2.5 rounded-lg text-primary-100 text-sm font-medium {{ request()->routeIs('qa.recordings*') ? 'active' : '' }}">
        <svg class="w-5 h-5 text-primary-300" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 114a7 7 0 01-7 7m0 0a7 7 0 01-7-7m7 7v4a2 2 0 002 2h1a2 2 0 002-2v-4m-5 0a7 7 0 01-7-7V7a7 7 0 1114 0v7a7 7 0 01-7 7z"/></svg>
        <span>Recordings</span>
    </a>
    <a href="{{ route('qa.evaluations.index') }}" class="sidebar-link w-full flex items-center gap-3 px-3 py-2.5 rounded-lg text-primary-100 text-sm font-medium {{ request()->routeIs('qa.evaluations*') ? 'active' : '' }}">
        <svg class="w-5 h-5 text-primary-300" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
        <span>Evaluations</span>
    </a>
    <a href="{{ route('qa.reports.index') }}" class="sidebar-link w-full flex items-center gap-3 px-3 py-2.5 rounded-lg text-primary-100 text-sm font-medium {{ request()->routeIs('qa.reports*') ? 'active' : '' }}">
        <svg class="w-5 h-5 text-primary-300" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z"/></svg>
        <span>QA Reports</span>
    </a>
    <a href="{{ route('profile.edit') }}" class="sidebar-link w-full flex items-center gap-3 px-3 py-2.5 rounded-lg text-primary-100 text-sm font-medium {{ request()->routeIs('profile*') ? 'active' : '' }}">
        <svg class="w-5 h-5 text-primary-300" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"/></svg>
        <span>Profile</span>
    </a>
</div>
