{{-- Top Navbar Component --}}
<header class="sticky top-0 z-20 glass border-b border-white/5">
    <div class="flex items-center justify-between px-6 py-3">
        {{-- Left: Mobile menu + Page title --}}
        <div class="flex items-center gap-4">
            <button onclick="toggleSidebar()" class="md:hidden p-2 rounded-lg hover:bg-white/5 text-dark-400">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16" />
                </svg>
            </button>
            <div>
                <h1 class="text-lg font-semibold text-dark-100">@yield('page_title', 'Dashboard')</h1>
                <p class="text-xs text-dark-500">@yield('page_subtitle', now()->format('l, d F Y'))</p>
            </div>
        </div>

        {{-- Right: Actions --}}
        <div class="flex items-center gap-3">
            {{-- Quick search --}}
            <div class="hidden sm:block relative">
                <input type="text" class="form-input pl-9 py-2 w-56 text-xs" style="background: rgba(15,23,42,0.4);">
                <svg class="w-4 h-4 text-dark-500 absolute left-3 top-1/2 -translate-y-1/2" fill="none"
                    stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" />
                </svg>
            </div>

            {{-- Notification bell --}}
            <button class="relative p-2 rounded-lg hover:bg-white/5 text-dark-400 transition">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M15 17h5l-1.405-1.405A2.032 2.032 0 0118 14.158V11a6.002 6.002 0 00-4-5.659V5a2 2 0 10-4 0v.341C7.67 6.165 6 8.388 6 11v3.159c0 .538-.214 1.055-.595 1.436L4 17h5m6 0v1a3 3 0 11-6 0v-1m6 0H9" />
                </svg>
                <span class="absolute top-1.5 right-1.5 w-2 h-2 bg-indigo-500 rounded-full"></span>
            </button>
        </div>
    </div>
</header>