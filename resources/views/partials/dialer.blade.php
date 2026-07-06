{{-- ============================================================
     Zerixa Softphone Dialer Widget
     Full click-to-call experience: keypad, contact search, live
     call simulation (ringback / DTMF / waveform), and real call
     logging via AJAX (creates a genuine Call record in the DB).
============================================================ --}}
<div id="dialerRoot">

    {{-- Floating Action Button --}}
    <button id="dialerFab" onclick="Dialer.openPanel()"
        class="dialer-fab fixed bottom-6 right-6 z-[60] w-16 h-16 rounded-full bg-gradient-to-br from-primary-500 to-primary-700 text-white shadow-2xl flex items-center justify-center hover:scale-105 active:scale-95 transition-transform">
        <svg class="w-7 h-7" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z"/></svg>
    </button>

    {{-- Backdrop (mobile) --}}
    <div id="dialerBackdrop" onclick="Dialer.closePanel()" class="hidden fixed inset-0 bg-black/30 z-[65] sm:hidden dialer-backdrop-enter"></div>

    {{-- Main Panel --}}
    <div id="dialerPanel" class="hidden fixed bottom-6 right-6 z-[70] w-[360px] max-w-[92vw] rounded-2xl shadow-2xl overflow-hidden bg-white dialer-panel-enter">

        {{-- Header --}}
        <div class="bg-gradient-to-r from-primary-600 to-primary-700 px-4 py-3 flex items-center justify-between text-white">
            <div class="flex items-center gap-2">
                <span id="dialerStatusDot" class="w-2 h-2 rounded-full bg-gray-400"></span>
                <span class="font-semibold text-sm" id="dialerHeaderTitle">Softphone</span>
                <span id="dialerExtBadge" class="hidden text-[10px] bg-white/20 px-1.5 py-0.5 rounded-full">Ext: --</span>
            </div>
            <div class="flex items-center gap-1">
                <button onclick="Dialer.simulateIncoming()" id="dialerIncomingBtn" title="Simulate incoming call" class="hidden p-1.5 rounded-lg hover:bg-white/15 transition-colors">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 17h5l-1.405-1.405A2.032 2.032 0 0118 14.158V11a6.002 6.002 0 00-4-5.659V5a2 2 0 10-4 0v.341C7.67 6.165 6 8.388 6 11v3.159c0 .538-.214 1.055-.595 1.436L4 17h5m6 0v1a3 3 0 11-6 0v-1m6 0H9"/></svg>
                </button>
                <button onclick="Dialer.openSettings()" id="dialerSettingsBtn" title="Phone settings" class="hidden p-1.5 rounded-lg hover:bg-white/15 transition-colors">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10.325 4.317c.426-1.756 2.924-1.756 3.35 0a1.724 1.724 0 002.573 1.066c1.543-.94 3.31.826 2.37 2.37a1.724 1.724 0 001.065 2.572c1.756.426 1.756 2.924 0 3.35a1.724 1.724 0 00-1.066 2.573c.94 1.543-.826 3.31-2.37 2.37a1.724 1.724 0 00-2.572 1.065c-.426 1.756-2.924 1.756-3.35 0a1.724 1.724 0 00-2.573-1.066c-1.543.94-3.31-.826-2.37-2.37a1.724 1.724 0 00-1.065-2.572c-1.756-.426-1.756-2.924 0-3.35a1.724 1.724 0 001.066-2.573c-.94-1.543.826-3.31 2.37-2.37.996.608 2.296.07 2.572-1.065z"/><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/></svg>
                </button>
                <button onclick="Dialer.closePanel()" class="p-1.5 rounded-lg hover:bg-white/15 transition-colors">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/></svg>
                </button>
            </div>
        </div>

        {{-- ============ CONNECT PHONE STATE ============ --}}
        <div id="dialerConnect" class="p-6 text-center">
            <div class="w-16 h-16 mx-auto rounded-full bg-gradient-to-br from-primary-100 to-primary-200 flex items-center justify-center mb-4 dialer-pulse-ring">
                <svg class="w-8 h-8 text-primary-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z"/></svg>
            </div>
            <h3 class="font-bold text-gray-800 text-base mb-1">Connect Your Phone</h3>
            <p class="text-xs text-gray-400 mb-5 leading-relaxed">Register your phone number and extension to start making and receiving calls through the softphone dialer.</p>

            <div class="space-y-3 text-left">
                <div>
                    <label class="block text-xs font-semibold text-gray-600 mb-1">Your Phone Number</label>
                    <div class="relative">
                        <span class="absolute left-3 top-1/2 -translate-y-1/2 text-gray-400 text-sm">+255</span>
                        <input type="tel" id="connectPhoneNumber" placeholder="712 345 678" class="w-full pl-12 pr-3 py-2.5 rounded-lg border border-gray-200 focus:border-primary-500 focus:ring-2 focus:ring-primary-100 outline-none text-sm transition-all">
                    </div>
                </div>
                <div>
                    <label class="block text-xs font-semibold text-gray-600 mb-1">Extension <span class="text-gray-400 font-normal">(optional)</span></label>
                    <input type="text" id="connectExtension" placeholder="e.g. 101" maxlength="5" class="w-full px-3 py-2.5 rounded-lg border border-gray-200 focus:border-primary-500 focus:ring-2 focus:ring-primary-100 outline-none text-sm transition-all">
                </div>
            </div>

            <button onclick="Dialer.submitConnectPhone()" id="connectPhoneBtn" class="w-full mt-5 py-3 rounded-xl bg-gradient-to-r from-primary-600 to-primary-700 hover:from-primary-700 hover:to-primary-800 text-white font-bold text-sm flex items-center justify-center gap-2 shadow-lg shadow-primary-500/30 transition-all">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z"/></svg>
                Connect Now
            </button>
        </div>

        {{-- ============ IDLE STATE (Keypad / Contacts) ============ --}}
        <div id="dialerIdle" class="hidden p-4">
            {{-- Tabs --}}
            <div class="flex gap-1 bg-gray-100 rounded-lg p-1 mb-4">
                <button onclick="Dialer.switchTab('keypad')" id="tabBtnKeypad" class="dialer-tab flex-1 py-1.5 text-xs font-semibold rounded-md bg-white shadow-sm text-primary-700 transition-all">Keypad</button>
                <button onclick="Dialer.switchTab('contacts')" id="tabBtnContacts" class="dialer-tab flex-1 py-1.5 text-xs font-semibold rounded-md text-gray-500 transition-all">Contacts</button>
            </div>

            {{-- Keypad Tab --}}
            <div id="tabKeypad">
                <div class="mb-3 relative">
                    <input type="text" id="dialerNumberDisplay" readonly placeholder="Enter a number"
                        class="w-full text-center text-2xl font-bold tracking-wider py-2 border-b-2 border-gray-200 focus:border-primary-500 outline-none text-gray-800">
                    <button onclick="Dialer.backspace()" class="absolute right-0 top-1/2 -translate-y-1/2 p-2 text-gray-400 hover:text-red-500">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 19l-7-7 7-7m-7 7h18"/></svg>
                    </button>
                </div>

                <div class="grid grid-cols-3 gap-2 mb-4">
                    @php
                        $keys = [
                            ['1',''],['2','ABC'],['3','DEF'],
                            ['4','GHI'],['5','JKL'],['6','MNO'],
                            ['7','PQRS'],['8','TUV'],['9','WXYZ'],
                            ['*',''],['0','+'],['#',''],
                        ];
                    @endphp
                    @foreach($keys as [$digit, $letters])
                    <button onclick="Dialer.pressKey('{{ $digit }}')" class="dialer-key aspect-square rounded-xl bg-gray-50 hover:bg-gray-100 flex flex-col items-center justify-center border border-gray-100">
                        <span class="text-lg font-bold text-gray-800">{{ $digit }}</span>
                        <span class="text-[9px] text-gray-400 tracking-wide">{{ $letters }}</span>
                    </button>
                    @endforeach
                </div>

                <button onclick="Dialer.startCallFromKeypad()" class="w-full py-3 rounded-xl bg-gradient-to-r from-green-500 to-green-600 hover:from-green-600 hover:to-green-700 text-white font-bold text-sm flex items-center justify-center gap-2 shadow-lg shadow-green-500/30 transition-all">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z"/></svg>
                    Call
                </button>
            </div>

            {{-- Contacts Tab --}}
            <div id="tabContacts" class="hidden">
                <div class="relative mb-3">
                    <svg class="w-4 h-4 text-gray-400 absolute left-3 top-1/2 -translate-y-1/2" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"/></svg>
                    <input type="text" id="dialerContactSearch" oninput="Dialer.searchContacts(this.value)" placeholder="Search name or phone..."
                        class="w-full pl-9 pr-3 py-2 rounded-lg border border-gray-200 focus:border-primary-500 outline-none text-sm">
                </div>
                <div id="dialerContactResults" class="max-h-64 overflow-y-auto space-y-1">
                    <p class="text-center text-xs text-gray-400 py-8">Start typing to search contacts...</p>
                </div>
            </div>
        </div>

        {{-- ============ RINGING STATE (outgoing) ============ --}}
        <div id="dialerRinging" class="hidden p-6 text-center">
            <div id="dialerRingAvatar" class="dialer-avatar-ringing w-20 h-20 mx-auto rounded-full bg-gradient-to-br from-primary-400 to-primary-600 text-white flex items-center justify-center text-2xl font-bold mb-4"></div>
            <p id="dialerRingName" class="font-bold text-gray-800 text-lg"></p>
            <p id="dialerRingNumber" class="text-sm text-gray-400 mb-1"></p>
            <p class="text-xs font-medium text-green-600 flex items-center justify-center gap-1.5 mb-6">
                <span class="w-1.5 h-1.5 rounded-full bg-green-500 dialer-live-dot"></span> Ringing...
            </p>
            <button onclick="Dialer.hangup('missed')" class="w-16 h-16 rounded-full bg-red-500 hover:bg-red-600 text-white flex items-center justify-center mx-auto shadow-lg shadow-red-500/30 transition-all">
                <svg class="w-6 h-6 rotate-[135deg]" fill="currentColor" viewBox="0 0 24 24"><path d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z"/></svg>
            </button>
        </div>

        {{-- ============ INCOMING CALL STATE ============ --}}
        <div id="dialerIncoming" class="hidden p-6 text-center">
            <div class="dialer-shake w-20 h-20 mx-auto rounded-full bg-gradient-to-br from-green-400 to-green-600 text-white flex items-center justify-center mb-4">
                <svg class="w-9 h-9" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z"/></svg>
            </div>
            <p id="dialerIncomingName" class="font-bold text-gray-800 text-lg"></p>
            <p id="dialerIncomingNumber" class="text-sm text-gray-400 mb-6">Incoming call...</p>
            <div class="flex items-center justify-center gap-6">
                <button onclick="Dialer.declineIncoming()" class="w-14 h-14 rounded-full bg-red-500 hover:bg-red-600 text-white flex items-center justify-center shadow-lg shadow-red-500/30 transition-all">
                    <svg class="w-6 h-6 rotate-[135deg]" fill="currentColor" viewBox="0 0 24 24"><path d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z"/></svg>
                </button>
                <button onclick="Dialer.acceptIncoming()" class="w-14 h-14 rounded-full bg-green-500 hover:bg-green-600 text-white flex items-center justify-center shadow-lg shadow-green-500/30 transition-all">
                    <svg class="w-6 h-6" fill="currentColor" viewBox="0 0 24 24"><path d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z"/></svg>
                </button>
            </div>
        </div>

        {{-- ============ ACTIVE CALL STATE ============ --}}
        <div id="dialerActive" class="hidden p-6 text-center">
            <div id="dialerActiveAvatar" class="w-20 h-20 mx-auto rounded-full bg-gradient-to-br from-primary-400 to-primary-600 text-white flex items-center justify-center text-2xl font-bold mb-3"></div>
            <p id="dialerActiveName" class="font-bold text-gray-800 text-lg"></p>
            <p id="dialerActiveNumber" class="text-sm text-gray-400 mb-1"></p>
            <p id="dialerTimer" class="text-2xl font-mono font-bold text-primary-600 mb-4">00:00</p>

            {{-- Waveform --}}
            <div id="dialerWaveform" class="flex items-center justify-center gap-1 h-8 mb-5">
                @for($i = 0; $i < 12; $i++)
                <span class="dialer-wave-bar" style="height: {{ rand(30,100) }}%; animation-delay: {{ $i * 0.08 }}s;"></span>
                @endfor
            </div>

            <div class="grid grid-cols-4 gap-3 mb-5">
                <button onclick="Dialer.toggleMute()" id="dialerMuteBtn" class="flex flex-col items-center gap-1 group">
                    <span class="w-11 h-11 rounded-full bg-gray-100 group-hover:bg-gray-200 flex items-center justify-center transition-colors">
                        <svg class="w-5 h-5 text-gray-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 11a7 7 0 01-7 7m0 0a7 7 0 01-7-7m7 7v4m-4 0h8M9 9v3a3 3 0 006 0V6a3 3 0 00-6 0v1"/></svg>
                    </span>
                    <span class="text-[10px] text-gray-500">Mute</span>
                </button>
                <button onclick="Dialer.toggleHold()" id="dialerHoldBtn" class="flex flex-col items-center gap-1 group">
                    <span class="w-11 h-11 rounded-full bg-gray-100 group-hover:bg-gray-200 flex items-center justify-center transition-colors">
                        <svg class="w-5 h-5 text-gray-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 9v6m4-6v6m7-3a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                    </span>
                    <span class="text-[10px] text-gray-500">Hold</span>
                </button>
                <button onclick="Dialer.switchToActiveKeypad()" class="flex flex-col items-center gap-1 group">
                    <span class="w-11 h-11 rounded-full bg-gray-100 group-hover:bg-gray-200 flex items-center justify-center transition-colors">
                        <svg class="w-5 h-5 text-gray-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 17V7m0 10a2 2 0 01-2 2H5a2 2 0 01-2-2V7a2 2 0 012-2h2a2 2 0 012 2m0 10a2 2 0 002 2h2a2 2 0 002-2M9 7a2 2 0 012-2h2a2 2 0 012 2m0 10V7m0 10a2 2 0 002 2h2a2 2 0 002-2V7a2 2 0 00-2-2h-2a2 2 0 00-2 2"/></svg>
                    </span>
                    <span class="text-[10px] text-gray-500">Keypad</span>
                </button>
                <button onclick="Dialer.toggleSpeaker()" id="dialerSpeakerBtn" class="flex flex-col items-center gap-1 group">
                    <span class="w-11 h-11 rounded-full bg-gray-100 group-hover:bg-gray-200 flex items-center justify-center transition-colors">
                        <svg class="w-5 h-5 text-gray-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15.536 8.464a5 5 0 010 7.072m2.828-9.9a9 9 0 010 12.728M7 9v6h4l5 5V4l-5 5H7z"/></svg>
                    </span>
                    <span class="text-[10px] text-gray-500">Speaker</span>
                </button>
            </div>

            <button onclick="Dialer.hangup('completed')" class="w-16 h-16 rounded-full bg-red-500 hover:bg-red-600 text-white flex items-center justify-center mx-auto shadow-lg shadow-red-500/30 transition-all">
                <svg class="w-6 h-6 rotate-[135deg]" fill="currentColor" viewBox="0 0 24 24"><path d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z"/></svg>
            </button>
        </div>

        {{-- ============ WRAP-UP / DISPOSITION STATE ============ --}}
        <div id="dialerWrapup" class="hidden p-5">
            <div class="text-center mb-4">
                <div class="w-12 h-12 mx-auto rounded-full bg-green-100 flex items-center justify-center mb-2">
                    <svg class="w-6 h-6 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                </div>
                <p class="font-bold text-gray-800 text-sm">Call Ended</p>
                <p class="text-xs text-gray-400"><span id="dialerWrapupNumber"></span> &middot; Duration: <span id="dialerWrapupDuration" class="font-semibold text-gray-600"></span></p>
            </div>

            <label class="block text-xs font-semibold text-gray-600 mb-1">Disposition</label>
            <select id="dialerDispositionSelect" class="w-full mb-3 px-3 py-2 rounded-lg border border-gray-200 focus:border-primary-500 outline-none text-sm">
                <option value="">Select disposition...</option>
            </select>

            <label class="block text-xs font-semibold text-gray-600 mb-1">Notes</label>
            <textarea id="dialerNotes" rows="3" placeholder="Add call notes..." class="w-full mb-4 px-3 py-2 rounded-lg border border-gray-200 focus:border-primary-500 outline-none text-sm resize-none"></textarea>

            <div class="flex gap-2">
                <button onclick="Dialer.skipWrapup()" class="flex-1 py-2.5 rounded-lg bg-gray-100 hover:bg-gray-200 text-gray-600 text-sm font-semibold transition-colors">Skip</button>
                <button onclick="Dialer.saveWrapup()" class="flex-1 py-2.5 rounded-lg bg-gradient-to-r from-primary-600 to-primary-700 hover:from-primary-700 hover:to-primary-800 text-white text-sm font-semibold shadow-md transition-all">Save Call</button>
            </div>
        </div>

    </div>
</div>

<script>
const Dialer = (function () {
    const csrfToken = document.querySelector('meta[name="csrf-token"]').content;

    let state = 'idle'; // idle | ringing | incoming | active | wrapup | connect
    let dialedNumber = '';
    let activeCall = { contact_id: null, name: '', phone: '', direction: 'outbound' };
    let timerInterval = null;
    let elapsedSeconds = 0;
    let ringingTimeout = null;
    let muted = false;
    let onHold = false;
    let speakerOn = false;
    let phoneConnected = false;
    let myPhoneNumber = '';
    let myExtension = '';

    // ---------------- Web Audio (synthesized tones) ----------------
    let audioCtx = null;
    let toneNodes = [];

    function ctx() {
        if (!audioCtx) audioCtx = new (window.AudioContext || window.webkitAudioContext)();
        return audioCtx;
    }

    function stopTones() {
        toneNodes.forEach(n => { try { n.stop(); } catch (e) {} });
        toneNodes = [];
    }

    function tone(freqs, duration, gainVal = 0.05) {
        const c = ctx();
        const gain = c.createGain();
        gain.gain.value = gainVal;
        gain.connect(c.destination);
        freqs.forEach(f => {
            const osc = c.createOscillator();
            osc.type = 'sine';
            osc.frequency.value = f;
            osc.connect(gain);
            osc.start();
            osc.stop(c.currentTime + duration / 1000);
            toneNodes.push(osc);
        });
    }

    function playDTMF(digit) {
        const map = {
            '1': [697, 1209], '2': [697, 1336], '3': [697, 1477],
            '4': [770, 1209], '5': [770, 1336], '6': [770, 1477],
            '7': [852, 1209], '8': [852, 1336], '9': [852, 1477],
            '*': [941, 1209], '0': [941, 1336], '#': [941, 1477],
        };
        if (map[digit]) tone(map[digit], 120, 0.04);
    }

    let ringbackInterval = null;
    function startRingback() {
        stopRingback();
        tone([440, 480], 900, 0.03);
        ringbackInterval = setInterval(() => tone([440, 480], 900, 0.03), 2000);
    }
    function stopRingback() {
        if (ringbackInterval) clearInterval(ringbackInterval);
        ringbackInterval = null;
        stopTones();
    }

    let ringtoneInterval = null;
    function startRingtone() {
        stopRingtone();
        const pattern = () => { tone([950], 350, 0.05); setTimeout(() => tone([950], 350, 0.05), 500); };
        pattern();
        ringtoneInterval = setInterval(pattern, 1600);
    }
    function stopRingtone() {
        if (ringtoneInterval) clearInterval(ringtoneInterval);
        ringtoneInterval = null;
        stopTones();
    }

    function playConnectTone() { tone([660, 880], 220, 0.05); }
    function playHangupTone() { tone([480, 320], 320, 0.05); }

    // ---------------- UI helpers ----------------
    function show(id) {
        ['dialerConnect', 'dialerIdle', 'dialerRinging', 'dialerIncoming', 'dialerActive', 'dialerWrapup'].forEach(s => {
            document.getElementById(s).classList.toggle('hidden', s !== id);
        });
    }

    function initials(name) {
        if (!name) return '#';
        return name.split(' ').map(p => p[0]).slice(0, 2).join('').toUpperCase();
    }

    function formatTime(sec) {
        const m = Math.floor(sec / 60).toString().padStart(2, '0');
        const s = (sec % 60).toString().padStart(2, '0');
        return `${m}:${s}`;
    }

    function openPanel() {
        document.getElementById('dialerPanel').classList.remove('hidden');
        document.getElementById('dialerBackdrop').classList.remove('hidden');
        document.getElementById('dialerFab').classList.add('hidden');
        if (!phoneConnected && state === 'idle') {
            checkPhoneStatus();
        }
    }

    function closePanel() {
        document.getElementById('dialerPanel').classList.add('hidden');
        document.getElementById('dialerBackdrop').classList.add('hidden');
        document.getElementById('dialerFab').classList.remove('hidden');
    }

    function switchTab(tab) {
        const isKeypad = tab === 'keypad';
        document.getElementById('tabKeypad').classList.toggle('hidden', !isKeypad);
        document.getElementById('tabContacts').classList.toggle('hidden', isKeypad);
        document.getElementById('tabBtnKeypad').classList.toggle('bg-white', isKeypad);
        document.getElementById('tabBtnKeypad').classList.toggle('shadow-sm', isKeypad);
        document.getElementById('tabBtnKeypad').classList.toggle('text-primary-700', isKeypad);
        document.getElementById('tabBtnKeypad').classList.toggle('text-gray-500', !isKeypad);
        document.getElementById('tabBtnContacts').classList.toggle('bg-white', !isKeypad);
        document.getElementById('tabBtnContacts').classList.toggle('shadow-sm', !isKeypad);
        document.getElementById('tabBtnContacts').classList.toggle('text-primary-700', !isKeypad);
        document.getElementById('tabBtnContacts').classList.toggle('text-gray-500', isKeypad);
    }

    function pressKey(digit) {
        dialedNumber += digit;
        document.getElementById('dialerNumberDisplay').value = dialedNumber;
        playDTMF(digit);
    }

    function backspace() {
        dialedNumber = dialedNumber.slice(0, -1);
        document.getElementById('dialerNumberDisplay').value = dialedNumber;
    }

    let searchDebounce = null;
    function searchContacts(q) {
        clearTimeout(searchDebounce);
        searchDebounce = setTimeout(async () => {
            const box = document.getElementById('dialerContactResults');
            if (!q || q.length < 1) {
                box.innerHTML = '<p class="text-center text-xs text-gray-400 py-8">Start typing to search contacts...</p>';
                return;
            }
            box.innerHTML = '<p class="text-center text-xs text-gray-400 py-8">Searching...</p>';
            try {
                const res = await fetch(`{{ route('dialer.contacts') }}?q=${encodeURIComponent(q)}`);
                const contacts = await res.json();
                if (!contacts.length) {
                    box.innerHTML = '<p class="text-center text-xs text-gray-400 py-8">No contacts found.</p>';
                    return;
                }
                box.innerHTML = contacts.map(c => `
                    <button onclick='Dialer.startCallWithContact(${JSON.stringify(c).replace(/'/g, "&apos;")})' class="w-full flex items-center gap-3 p-2 rounded-lg hover:bg-gray-50 text-left transition-colors">
                        <span class="w-9 h-9 rounded-full bg-primary-100 text-primary-700 flex items-center justify-center text-xs font-bold flex-shrink-0">${initials(c.name)}</span>
                        <span class="flex-1 min-w-0">
                            <span class="block text-sm font-semibold text-gray-800 truncate">${c.name}</span>
                            <span class="block text-xs text-gray-400">${c.phone}</span>
                        </span>
                        <svg class="w-4 h-4 text-green-500 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z"/></svg>
                    </button>
                `).join('');
            } catch (e) {
                box.innerHTML = '<p class="text-center text-xs text-red-400 py-8">Search failed.</p>';
            }
        }, 300);
    }

    function startCallFromKeypad() {
        if (!dialedNumber) return;
        startCall({ contact_id: null, name: dialedNumber, phone: dialedNumber, direction: 'outbound' });
    }

    function startCallWithContact(contact) {
        startCall({ contact_id: contact.id, name: contact.name, phone: contact.phone, direction: 'outbound' });
    }

    function startCall(callInfo) {
        if (!phoneConnected) {
            Swal.fire({
                toast: true, position: 'top-end', icon: 'warning',
                title: 'Please connect your phone first.',
                showConfirmButton: false, timer: 3000, timerProgressBar: true,
            });
            openPanel();
            show('dialerConnect');
            return;
        }
        activeCall = callInfo;
        state = 'ringing';
        document.getElementById('dialerRingAvatar').textContent = initials(callInfo.name);
        document.getElementById('dialerRingName').textContent = callInfo.name;
        document.getElementById('dialerRingNumber').textContent = callInfo.phone;
        show('dialerRinging');
        openPanel();
        startRingback();

        // Simulate the call being answered after a short, realistic delay
        ringingTimeout = setTimeout(() => answerCall(), 2600 + Math.random() * 1800);
    }

    function answerCall() {
        stopRingback();
        playConnectTone();
        state = 'active';
        document.getElementById('dialerActiveAvatar').textContent = initials(activeCall.name);
        document.getElementById('dialerActiveName').textContent = activeCall.name;
        document.getElementById('dialerActiveNumber').textContent = activeCall.phone;
        show('dialerActive');
        elapsedSeconds = 0;
        muted = false; onHold = false;
        updateTimer();
        timerInterval = setInterval(() => { elapsedSeconds++; updateTimer(); }, 1000);
    }

    function updateTimer() {
        document.getElementById('dialerTimer').textContent = formatTime(elapsedSeconds);
    }

    function toggleMute() {
        muted = !muted;
        const btn = document.getElementById('dialerMuteBtn').querySelector('span');
        btn.classList.toggle('bg-red-100', muted);
        btn.classList.toggle('text-red-600', muted);
    }

    function toggleHold() {
        onHold = !onHold;
        const btn = document.getElementById('dialerHoldBtn').querySelector('span');
        btn.classList.toggle('bg-amber-100', onHold);
        document.getElementById('dialerWaveform').style.opacity = onHold ? 0.25 : 1;
    }

    function toggleSpeaker() {
        speakerOn = !speakerOn;
        const btn = document.getElementById('dialerSpeakerBtn').querySelector('span');
        btn.classList.toggle('bg-primary-100', speakerOn);
        btn.classList.toggle('text-primary-600', speakerOn);
    }

    function switchToActiveKeypad() {
        Swal.fire({
            title: 'Send DTMF',
            input: 'text',
            inputPlaceholder: 'e.g. 1',
            showCancelButton: true,
            confirmButtonText: 'Send',
            confirmButtonColor: '#2563eb',
        }).then(res => {
            if (res.isConfirmed && res.value) {
                [...res.value].forEach(d => playDTMF(d));
            }
        });
    }

    function hangup(resultStatus) {
        clearTimeout(ringingTimeout);
        stopRingback();
        clearInterval(timerInterval);
        playHangupTone();

        if (resultStatus === 'missed') {
            // Cancelled before being answered - log immediately, no wrap-up needed
            persistCall({
                contact_id: activeCall.contact_id,
                phone_number: activeCall.phone,
                direction: activeCall.direction,
                status: 'missed',
                duration: 0,
                disposition_id: null,
                notes: null,
            });
            resetToIdle();
            return;
        }

        openWrapup(resultStatus);
    }

    async function openWrapup(status) {
        state = 'wrapup';
        document.getElementById('dialerWrapupNumber').textContent = activeCall.phone;
        document.getElementById('dialerWrapupDuration').textContent = formatTime(elapsedSeconds);
        show('dialerWrapup');

        const select = document.getElementById('dialerDispositionSelect');
        select.innerHTML = '<option value="">Select disposition...</option>';
        try {
            const res = await fetch(`{{ route('dialer.dispositions') }}`);
            const dispositions = await res.json();
            dispositions.forEach(d => {
                const opt = document.createElement('option');
                opt.value = d.id;
                opt.textContent = d.name;
                select.appendChild(opt);
            });
        } catch (e) { /* silently ignore */ }

        document.getElementById('dialerNotes').value = '';
        window.__dialerFinalStatus = status;
    }

    function skipWrapup() {
        persistCall({
            contact_id: activeCall.contact_id,
            phone_number: activeCall.phone,
            direction: activeCall.direction,
            status: window.__dialerFinalStatus || 'completed',
            duration: elapsedSeconds,
            disposition_id: null,
            notes: null,
        });
        resetToIdle();
    }

    function saveWrapup() {
        const dispositionId = document.getElementById('dialerDispositionSelect').value || null;
        const notes = document.getElementById('dialerNotes').value || null;
        persistCall({
            contact_id: activeCall.contact_id,
            phone_number: activeCall.phone,
            direction: activeCall.direction,
            status: window.__dialerFinalStatus || 'completed',
            duration: elapsedSeconds,
            disposition_id: dispositionId,
            notes: notes,
        });
        resetToIdle();
    }

    async function persistCall(payload) {
        try {
            const res = await fetch(`{{ route('dialer.log-call') }}`, {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': csrfToken,
                    'Accept': 'application/json',
                },
                body: JSON.stringify(payload),
            });
            const data = await res.json();
            if (data.success) {
                Swal.fire({
                    toast: true, position: 'top-end', icon: 'success',
                    title: data.message || 'Call logged successfully.',
                    showConfirmButton: false, timer: 2500, timerProgressBar: true,
                });
            }
        } catch (e) {
            Swal.fire({
                toast: true, position: 'top-end', icon: 'error',
                title: 'Could not save call record.',
                showConfirmButton: false, timer: 3000,
            });
        }
    }

    function resetToIdle() {
        state = 'idle';
        dialedNumber = '';
        document.getElementById('dialerNumberDisplay').value = '';
        show('dialerIdle');
        switchTab('keypad');
    }

    // ---------------- Incoming call simulation ----------------
    const demoCallers = [
        { name: 'Amina Mwangaza', phone: '+255712345001' },
        { name: 'Juma Kimaro', phone: '+255712345002' },
        { name: 'Fatuma Hassan', phone: '+255712345003' },
        { name: 'Unknown Caller', phone: '+255700000000' },
    ];

    function simulateIncoming() {
        if (state !== 'idle') return;
        if (!phoneConnected) {
            Swal.fire({
                toast: true, position: 'top-end', icon: 'warning',
                title: 'Please connect your phone first.',
                showConfirmButton: false, timer: 3000, timerProgressBar: true,
            });
            return;
        }
        const caller = demoCallers[Math.floor(Math.random() * demoCallers.length)];
        activeCall = { contact_id: null, name: caller.name, phone: caller.phone, direction: 'inbound' };
        state = 'incoming';
        document.getElementById('dialerIncomingName').textContent = caller.name;
        document.getElementById('dialerIncomingNumber').textContent = caller.phone;
        show('dialerIncoming');
        openPanel();
        startRingtone();
    }

    function acceptIncoming() {
        stopRingtone();
        answerCall();
    }

    function declineIncoming() {
        stopRingtone();
        persistCall({
            contact_id: activeCall.contact_id,
            phone_number: activeCall.phone,
            direction: 'inbound',
            status: 'missed',
            duration: 0,
            disposition_id: null,
            notes: null,
        });
        resetToIdle();
    }

    // ---------------- Phone connection ----------------
    async function checkPhoneStatus() {
        try {
            const res = await fetch(`{{ route('dialer.phone-status') }}`);
            const data = await res.json();
            if (data.connected) {
                phoneConnected = true;
                myPhoneNumber = data.phone;
                myExtension = data.extension || '';
                updateConnectedUI();
                if (state === 'idle' || state === 'connect') {
                    state = 'idle';
                    show('dialerIdle');
                }
            } else {
                phoneConnected = false;
                state = 'connect';
                show('dialerConnect');
            }
        } catch (e) {
            // If check fails, default to connect screen
            phoneConnected = false;
            state = 'connect';
            show('dialerConnect');
        }
    }

    function updateConnectedUI() {
        const dot = document.getElementById('dialerStatusDot');
        dot.className = 'w-2 h-2 rounded-full bg-green-400 dialer-live-dot';
        document.getElementById('dialerIncomingBtn').classList.remove('hidden');
        document.getElementById('dialerSettingsBtn').classList.remove('hidden');
        const extBadge = document.getElementById('dialerExtBadge');
        if (myExtension) {
            extBadge.textContent = 'Ext: ' + myExtension;
            extBadge.classList.remove('hidden');
        } else {
            extBadge.classList.add('hidden');
        }
    }

    function updateDisconnectedUI() {
        const dot = document.getElementById('dialerStatusDot');
        dot.className = 'w-2 h-2 rounded-full bg-gray-400';
        document.getElementById('dialerIncomingBtn').classList.add('hidden');
        document.getElementById('dialerSettingsBtn').classList.add('hidden');
        document.getElementById('dialerExtBadge').classList.add('hidden');
    }

    async function submitConnectPhone() {
        const phoneInput = document.getElementById('connectPhoneNumber').value.trim();
        const extInput = document.getElementById('connectExtension').value.trim();
        const btn = document.getElementById('connectPhoneBtn');

        if (!phoneInput) {
            Swal.fire({
                toast: true, position: 'top-end', icon: 'error',
                title: 'Please enter your phone number.',
                showConfirmButton: false, timer: 3000, timerProgressBar: true,
            });
            return;
        }

        const fullPhone = '+255' + phoneInput.replace(/\s/g, '');

        btn.disabled = true;
        btn.innerHTML = '<svg class="animate-spin w-5 h-5" fill="none" viewBox="0 0 24 24"><circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"/><path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4z"/></svg> Connecting...';

        try {
            const res = await fetch(`{{ route('dialer.connect-phone') }}`, {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': csrfToken,
                    'Accept': 'application/json',
                },
                body: JSON.stringify({ phone: fullPhone, extension: extInput || null }),
            });
            const data = await res.json();

            if (data.success) {
                phoneConnected = true;
                myPhoneNumber = data.phone;
                myExtension = data.extension || '';
                updateConnectedUI();
                state = 'idle';
                show('dialerIdle');
                playConnectTone();
                Swal.fire({
                    toast: true, position: 'top-end', icon: 'success',
                    title: 'Phone connected! You can make calls now.',
                    showConfirmButton: false, timer: 3000, timerProgressBar: true,
                });
            } else {
                throw new Error('Failed');
            }
        } catch (e) {
            Swal.fire({
                toast: true, position: 'top-end', icon: 'error',
                title: 'Could not connect phone. Try again.',
                showConfirmButton: false, timer: 3000, timerProgressBar: true,
            });
        } finally {
            btn.disabled = false;
            btn.innerHTML = '<svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z"/></svg> Connect Now';
        }
    }

    function openSettings() {
        Swal.fire({
            title: '<span class="text-base">Phone Settings</span>',
            html: `
                <div class="text-left space-y-3">
                    <div class="bg-green-50 border border-green-200 rounded-lg p-3 text-center">
                        <p class="text-xs text-green-600 font-semibold mb-0.5">Connected</p>
                        <p class="text-sm font-bold text-gray-800">${myPhoneNumber}</p>
                        ${myExtension ? '<p class="text-xs text-gray-500 mt-0.5">Extension: ' + myExtension + '</p>' : ''}
                    </div>
                    <p class="text-xs text-gray-500 text-center">Disconnecting will prevent you from making or receiving calls.</p>
                </div>
            `,
            showCancelButton: true,
            showConfirmButton: true,
            confirmButtonText: 'Disconnect',
            confirmButtonColor: '#ef4444',
            cancelButtonText: 'Close',
            cancelButtonColor: '#6b7280',
        }).then(result => {
            if (result.isConfirmed) {
                disconnectPhone();
            }
        });
    }

    async function disconnectPhone() {
        try {
            await fetch(`{{ route('dialer.disconnect-phone') }}`, {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': csrfToken,
                    'Accept': 'application/json',
                },
            });
            phoneConnected = false;
            myPhoneNumber = '';
            myExtension = '';
            updateDisconnectedUI();
            state = 'connect';
            show('dialerConnect');
            Swal.fire({
                toast: true, position: 'top-end', icon: 'info',
                title: 'Phone disconnected.',
                showConfirmButton: false, timer: 2500, timerProgressBar: true,
            });
        } catch (e) {
            Swal.fire({
                toast: true, position: 'top-end', icon: 'error',
                title: 'Could not disconnect phone.',
                showConfirmButton: false, timer: 3000,
            });
        }
    }

    // ---------------- Init on load ----------------
    checkPhoneStatus();

    return {
        openPanel, closePanel, switchTab, pressKey, backspace, searchContacts,
        startCallFromKeypad, startCallWithContact, hangup, toggleMute, toggleHold,
        toggleSpeaker, switchToActiveKeypad, skipWrapup, saveWrapup,
        simulateIncoming, acceptIncoming, declineIncoming,
        submitConnectPhone, openSettings, checkPhoneStatus,
    };
})();
</script>
