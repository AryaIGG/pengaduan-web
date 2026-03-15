<!DOCTYPE html>
<html lang="id" class="dark">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Admin - Aspirasi Sekolah')</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    @stack('styles')
</head>

<body class="bg-background text-foreground">

    <div class="flex h-screen overflow-hidden">

        {{-- ========== SIDEBAR ========== --}}
        <div id="sidebar"
            class="sidebar-expanded shrink-0 flex flex-col bg-sidebar-2 border-e border-sidebar-2-divider
        transition-all duration-300 ease-in-out
        fixed lg:static inset-y-0 start-0 z-[60]
        -translate-x-full lg:translate-x-0">

            {{-- Sidebar Top --}}
            <div
                class="sidebar-top shrink-0 flex items-center h-14 px-4 border-b border-sidebar-2-divider overflow-hidden">
                <a href="{{ route('dashboard') }}"
                    class="shrink-0 flex items-center justify-center size-7 rounded-md bg-primary">
                    <svg class="size-4 fill-primary-foreground" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                        <path d="M12 2L2 7l10 5 10-5-10-5zM2 17l10 5 10-5M2 12l10 5 10-5" />
                    </svg>
                </a>
                <span
                    class="sidebar-label ms-2.5 font-semibold text-sm text-foreground whitespace-nowrap overflow-hidden transition-all duration-300">Aspirasi
                    Pro</span>
            </div>

            {{-- Sidebar Body --}}
            <nav class="sidebar-nav flex-1 overflow-y-auto overflow-x-hidden p-3 space-y-6">

                {{-- Search --}}
                <div class="sidebar-label overflow-hidden transition-all duration-300">
                    <button type="button"
                        class="w-full flex items-center gap-x-2 py-1.5 px-2.5 text-sm text-muted-foreground-2 bg-layer border border-layer-line rounded-lg hover:bg-layer-hover transition-colors">
                        <svg class="size-3.5 shrink-0" fill="none" stroke="currentColor" stroke-width="2"
                            viewBox="0 0 24 24">
                            <circle cx="11" cy="11" r="8" />
                            <path d="m21 21-4.35-4.35" />
                        </svg>
                        <span class="text-xs">Search</span>
                        <span
                            class="ms-auto flex items-center gap-x-1 py-px px-1.5 border border-line-2 rounded text-[10px] text-muted-foreground-1">⌘K</span>
                    </button>
                </div>

                {{-- Home --}}
                <div>
                    <span
                        class="sidebar-label block ps-2.5 mb-2 text-[10px] font-semibold uppercase tracking-widest text-muted-foreground-1 overflow-hidden whitespace-nowrap transition-all duration-300">Home</span>
                    <ul class="space-y-0.5">
                        <li>
                            <a href="{{ route('dashboard') }}"
                                class="sidebar-nav-item group flex items-center gap-x-2.5 py-2 px-2.5 text-sm rounded-lg transition-colors
                            {{ request()->routeIs('dashboard') ? 'bg-sidebar-2-nav-active text-sidebar-2-nav-foreground font-medium' : 'text-sidebar-2-nav-foreground hover:bg-sidebar-2-nav-hover' }}"
                                title="Dashboard">
                                <svg class="size-4 shrink-0" fill="none" stroke="currentColor" stroke-width="2"
                                    viewBox="0 0 24 24">
                                    <rect width="7" height="9" x="3" y="3" rx="1" />
                                    <rect width="7" height="5" x="14" y="3" rx="1" />
                                    <rect width="7" height="9" x="14" y="12" rx="1" />
                                    <rect width="7" height="5" x="3" y="16" rx="1" />
                                </svg>
                                <span
                                    class="sidebar-label whitespace-nowrap overflow-hidden transition-all duration-300">Dashboard</span>
                            </a>
                        </li>
                    </ul>
                </div>

                {{-- Management --}}
                <div>
                    <span
                        class="sidebar-label block ps-2.5 mb-2 text-[10px] font-semibold uppercase tracking-widest text-muted-foreground-1 overflow-hidden whitespace-nowrap transition-all duration-300">Management</span>
                    <ul class="space-y-0.5">
                        <li>
                            <a href="#"
                                class="sidebar-nav-item group flex items-center gap-x-2.5 py-2 px-2.5 text-sm rounded-lg transition-colors text-sidebar-2-nav-foreground hover:bg-sidebar-2-nav-hover"
                                title="Aspirasi">
                                <svg class="size-4 shrink-0" fill="none" stroke="currentColor" stroke-width="2"
                                    viewBox="0 0 24 24">
                                    <path d="M14 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V8z" />
                                    <polyline points="14 2 14 8 20 8" />
                                    <line x1="16" y1="13" x2="8" y2="13" />
                                    <line x1="16" y1="17" x2="8" y2="17" />
                                </svg>
                                <span
                                    class="sidebar-label whitespace-nowrap overflow-hidden transition-all duration-300">Aspirasi</span>
                            </a>
                        </li>
                        <li>
                            <a href="#"
                                class="sidebar-nav-item group flex items-center gap-x-2.5 py-2 px-2.5 text-sm rounded-lg transition-colors text-sidebar-2-nav-foreground opacity-40 pointer-events-none"
                                title="Siswa (Segera)">
                                <svg class="size-4 shrink-0" fill="none" stroke="currentColor" stroke-width="2"
                                    viewBox="0 0 24 24">
                                    <path d="M16 21v-2a4 4 0 0 0-4-4H6a4 4 0 0 0-4 4v2" />
                                    <circle cx="9" cy="7" r="4" />
                                    <path d="M22 21v-2a4 4 0 0 0-3-3.87" />
                                    <path d="M16 3.13a4 4 0 0 1 0 7.75" />
                                </svg>
                                <span
                                    class="sidebar-label whitespace-nowrap overflow-hidden transition-all duration-300">
                                    Siswa
                                    <span
                                        class="ms-1 text-[9px] bg-muted px-1.5 py-0.5 rounded-full font-semibold">Soon</span>
                                </span>
                            </a>
                        </li>
                        <li>
                            <a href="#"
                                class="sidebar-nav-item group flex items-center gap-x-2.5 py-2 px-2.5 text-sm rounded-lg transition-colors text-sidebar-2-nav-foreground opacity-40 pointer-events-none"
                                title="Kategori (Segera)">
                                <svg class="size-4 shrink-0" fill="none" stroke="currentColor" stroke-width="2"
                                    viewBox="0 0 24 24">
                                    <rect width="7" height="7" x="3" y="3" rx="1" />
                                    <rect width="7" height="7" x="14" y="3" rx="1" />
                                    <rect width="7" height="7" x="14" y="14" rx="1" />
                                    <rect width="7" height="7" x="3" y="14" rx="1" />
                                </svg>
                                <span
                                    class="sidebar-label whitespace-nowrap overflow-hidden transition-all duration-300">
                                    Kategori
                                    <span
                                        class="ms-1 text-[9px] bg-muted px-1.5 py-0.5 rounded-full font-semibold">Soon</span>
                                </span>
                            </a>
                        </li>
                    </ul>
                </div>

            </nav>

            {{-- Sidebar Footer --}}
            <div class="sidebar-footer shrink-0 p-3 border-t border-sidebar-2-divider space-y-0.5 overflow-hidden">
                <a href="#"
                    class="sidebar-nav-item flex items-center gap-x-2.5 py-1.5 px-2.5 text-sm rounded-lg text-sidebar-2-nav-foreground hover:bg-sidebar-2-nav-hover transition-colors"
                    title="What's new?">
                    <svg class="size-4 shrink-0" fill="none" stroke="currentColor" stroke-width="2"
                        viewBox="0 0 24 24">
                        <path
                            d="M8.5 14.5A2.5 2.5 0 0 0 11 12c0-1.38-.5-2-1-3-1.072-2.143-.224-4.054 2-6 .5 2.5 2 4.9 4 6.5 2 1.6 3 3.5 3 5.5a7 7 0 1 1-14 0c0-1.153.433-2.294 1-3a2.5 2.5 0 0 0 2.5 2.5z" />
                    </svg>
                    <span class="sidebar-label whitespace-nowrap overflow-hidden transition-all duration-300">What's
                        new?</span>
                </a>
                <a href="#"
                    class="sidebar-nav-item flex items-center gap-x-2.5 py-1.5 px-2.5 text-sm rounded-lg text-sidebar-2-nav-foreground hover:bg-sidebar-2-nav-hover transition-colors"
                    title="Help & support">
                    <svg class="size-4 shrink-0" fill="none" stroke="currentColor" stroke-width="2"
                        viewBox="0 0 24 24">
                        <path d="M7.9 20A9 9 0 1 0 4 16.1L2 22Z" />
                    </svg>
                    <span class="sidebar-label whitespace-nowrap overflow-hidden transition-all duration-300">Help &
                        support</span>
                </a>
            </div>

        </div>
        {{-- ========== END SIDEBAR ========== --}}

        {{-- ========== RIGHT SIDE ========== --}}
        <div class="flex-1 flex flex-col min-w-0 overflow-hidden bg-sidebar-2">

            {{-- ========== HEADER ========== --}}
            <header class="shrink-0 flex items-center h-14 px-4 sm:px-5 gap-x-3">

                {{-- Toggle Button --}}
                <button type="button" id="sidebar-toggle"
                    class="p-1.5 inline-flex items-center justify-center size-8 rounded-md text-foreground hover:bg-surface-hover focus:outline-none transition-colors"
                    title="Toggle Sidebar">
                    <svg id="icon-collapse" class="size-4" fill="none" stroke="currentColor" stroke-width="2"
                        viewBox="0 0 24 24">
                        <rect width="18" height="18" x="3" y="3" rx="2" />
                        <path d="M15 3v18" />
                        <path d="m10 15-3-3 3-3" />
                    </svg>
                    <svg id="icon-expand" class="size-4 hidden" fill="none" stroke="currentColor"
                        stroke-width="2" viewBox="0 0 24 24">
                        <rect width="18" height="18" x="3" y="3" rx="2" />
                        <path d="M9 3v18" />
                        <path d="m14 9 3 3-3 3" />
                    </svg>
                    <svg id="icon-menu-mobile" class="size-4 hidden" fill="none" stroke="currentColor"
                        stroke-width="2" viewBox="0 0 24 24">
                        <line x1="3" y1="6" x2="21" y2="6" />
                        <line x1="3" y1="12" x2="21" y2="12" />
                        <line x1="3" y1="18" x2="21" y2="18" />
                    </svg>
                </button>

                {{-- Page Title --}}
                <div class="flex-1 min-w-0">
                    <h1 class="text-sm font-semibold text-foreground truncate">@yield('title', 'Dashboard')</h1>
                </div>

                @php
                    $admin = Auth::guard('admin')->user();
                @endphp

                {{-- Account Dropdown --}}
                <div
                    class="hs-dropdown inline-flex [--strategy:absolute] [--auto-close:inside] [--placement:bottom-right] relative">
                    <button id="hs-admin-dd" type="button"
                        class="flex items-center gap-x-2 py-1 px-2 rounded-lg hover:bg-surface-hover transition-colors focus:outline-none">
                        @if (!empty($admin?->avatar_url))
                            <img src="{{ $admin->avatar_url }}" alt="Admin Avatar"
                                class="size-7 rounded-full object-cover border border-card-line">
                        @else
                            <div
                                class="size-7 rounded-full bg-primary flex items-center justify-center text-primary-foreground text-xs font-bold">
                                {{ strtoupper(substr($admin?->username ?? 'A', 0, 1)) }}
                            </div>
                        @endif
                        <span class="hidden sm:block text-sm font-medium text-foreground">
                            {{ $admin?->username ?? 'Admin' }}
                        </span>
                        <svg class="hidden sm:block size-3.5 text-muted-foreground-1" fill="none"
                            stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                            <path d="m7 15 5 5 5-5" />
                            <path d="m7 9 5-5 5 5" />
                        </svg>
                    </button>

                    <div class="hs-dropdown-menu hs-dropdown-open:opacity-100 w-56 transition-[opacity,margin] duration opacity-0 hidden z-20 bg-dropdown border border-dropdown-line rounded-xl shadow-xl"
                        role="menu">
                        <div class="py-2 px-3.5 border-b border-dropdown-divider">
                            <span class="font-semibold text-sm text-foreground">{{ $admin?->username ?? 'Admin' }}</span>
                            <p class="text-xs text-muted-foreground-1">System Administrator</p>
                        </div>
                        <div class="p-1">
                            <form method="POST" action="{{ route('admin.logout') }}">
                                @csrf
                                <button type="submit"
                                    class="w-full flex items-center gap-x-2.5 py-2 px-3 rounded-lg text-sm text-red-500 hover:bg-red-500/10 transition-colors focus:outline-none">
                                    <svg class="size-4 shrink-0" fill="none" stroke="currentColor"
                                        stroke-width="2" viewBox="0 0 24 24">
                                        <path d="m16 17 5-5-5-5" />
                                        <path d="M21 12H9" />
                                        <path d="M9 21H5a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h4" />
                                    </svg>
                                    Logout
                                </button>
                            </form>
                        </div>
                    </div>
                </div>

            </header>
            {{-- ========== END HEADER ========== --}}

            {{-- ========== CONTENT AREA (floating inside frame) ========== --}}
            <main class="flex-1 overflow-hidden px-2 pb-2">
                <div class="h-full bg-background rounded-xl overflow-y-auto">
                    <div class="p-4 sm:p-6 space-y-4 sm:space-y-6">

                        @if (session('success'))
                            <div
                                class="p-3 rounded-lg bg-teal-500/10 border border-teal-500/20 text-teal-500 text-xs font-bold uppercase tracking-wider">
                                {{ session('success') }}
                            </div>
                        @endif

                        @if (session('error'))
                            <div
                                class="p-3 rounded-lg bg-red-500/10 border border-red-500/20 text-red-400 text-xs font-bold uppercase tracking-wider">
                                {{ session('error') }}
                            </div>
                        @endif

                        @yield('content')

                    </div>
                </div>
            </main>
            {{-- ========== END CONTENT ========== --}}

        </div>
        {{-- ========== END RIGHT SIDE ========== --}}

    </div>

    {{-- Mobile Overlay --}}
    <div id="sidebar-overlay" class="fixed inset-0 bg-black/50 z-[55] hidden lg:hidden"></div>

    <script>
        const sidebar = document.getElementById('sidebar');
        const overlay = document.getElementById('sidebar-overlay');
        const toggleBtn = document.getElementById('sidebar-toggle');
        const iconCollapse = document.getElementById('icon-collapse');
        const iconExpand = document.getElementById('icon-expand');
        const iconMobile = document.getElementById('icon-menu-mobile');
        const sidebarTop = document.querySelector('.sidebar-top');
        const sidebarNav = document.querySelector('.sidebar-nav');
        const sidebarFooter = document.querySelector('.sidebar-footer');

        const EXPANDED_W = 'w-60';
        const MINIMIZED_W = 'w-16';
        const STORAGE_KEY = 'sidebar_minimized';

        let isMinimized = localStorage.getItem(STORAGE_KEY) === 'true';
        let isMobile = window.innerWidth < 1024;

        function applyMinimizedVisualState() {
            document.querySelectorAll('.sidebar-label').forEach(el => {
                el.classList.add('hidden');
            });
            document.querySelectorAll('.sidebar-nav-item').forEach(el => {
                el.classList.add('justify-center');
                el.classList.remove('gap-x-2.5');
            });
            sidebarTop?.classList.remove('px-4');
            sidebarTop?.classList.add('px-2', 'justify-center');
            sidebarNav?.classList.remove('p-3');
            sidebarNav?.classList.add('p-2');
            sidebarFooter?.classList.remove('p-3');
            sidebarFooter?.classList.add('p-2');
        }

        function applyExpandedVisualState() {
            document.querySelectorAll('.sidebar-label').forEach(el => {
                el.classList.remove('hidden');
            });
            document.querySelectorAll('.sidebar-nav-item').forEach(el => {
                el.classList.remove('justify-center');
                el.classList.add('gap-x-2.5');
            });
            sidebarTop?.classList.remove('px-2', 'justify-center');
            sidebarTop?.classList.add('px-4');
            sidebarNav?.classList.remove('p-2');
            sidebarNav?.classList.add('p-3');
            sidebarFooter?.classList.remove('p-2');
            sidebarFooter?.classList.add('p-3');
        }

        function init() {
            isMobile = window.innerWidth < 1024;
            if (isMobile) {
                sidebar.classList.remove(EXPANDED_W, MINIMIZED_W);
                sidebar.classList.add('w-72', '-translate-x-full');
                applyExpandedVisualState();
                iconCollapse.classList.add('hidden');
                iconExpand.classList.add('hidden');
                iconMobile.classList.remove('hidden');
            } else {
                sidebar.classList.remove('w-72', '-translate-x-full');
                iconMobile.classList.add('hidden');
                applyDesktopState();
            }
        }

        function applyDesktopState() {
            if (isMinimized) {
                sidebar.classList.remove(EXPANDED_W);
                sidebar.classList.add(MINIMIZED_W);
                iconCollapse.classList.add('hidden');
                iconExpand.classList.remove('hidden');
                applyMinimizedVisualState();
            } else {
                sidebar.classList.remove(MINIMIZED_W);
                sidebar.classList.add(EXPANDED_W);
                iconCollapse.classList.remove('hidden');
                iconExpand.classList.add('hidden');
                applyExpandedVisualState();
            }
        }

        toggleBtn.addEventListener('click', () => {
            isMobile = window.innerWidth < 1024;
            if (isMobile) {
                const isOpen = !sidebar.classList.contains('-translate-x-full');
                isOpen ? closeMobile() : openMobile();
            } else {
                isMinimized = !isMinimized;
                localStorage.setItem(STORAGE_KEY, isMinimized);
                applyDesktopState();
            }
        });

        function openMobile() {
            sidebar.classList.remove('-translate-x-full');
            overlay.classList.remove('hidden');
        }

        function closeMobile() {
            sidebar.classList.add('-translate-x-full');
            overlay.classList.add('hidden');
        }

        overlay.addEventListener('click', closeMobile);
        window.addEventListener('resize', init);
        init();
    </script>

    @stack('scripts')
</body>

</html>
