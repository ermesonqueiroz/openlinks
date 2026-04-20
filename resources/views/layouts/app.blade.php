<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" data-theme="openlinks-dark">
<head>
    @include('layouts.components.head')
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
</head>
<body class="bg-base-200 font-sans antialiased">
    <div class="drawer lg:drawer-open">
        <input id="main-drawer" type="checkbox" class="drawer-toggle" />

        <div class="drawer-content flex flex-col">
            <!-- Navbar -->
            <div class="navbar bg-base-100 lg:hidden border-b border-base-200">
                <div class="flex-none">
                    <label for="main-drawer" class="btn btn-square btn-ghost drawer-button">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M3.75 6.75h16.5M3.75 12h16.5m-16.5 5.25h16.5" />
                        </svg>
                    </label>
                </div>
                <div class="flex-1">
                    <a class="btn btn-ghost text-xl font-bold tracking-tight">OpenLinks</a>
                </div>
            </div>

            <!-- Page Content -->
            <main class="p-4 lg:p-8">
                {{ $slot }}
            </main>
        </div>

        <!-- Sidebar -->
        <div class="drawer-side z-40">
            <label for="main-drawer" aria-label="close sidebar" class="drawer-overlay"></label>
            <aside class="bg-base-100 border-r border-base-200 w-80 min-h-full flex flex-col">
                <div class="p-6">
                    <a href="/" class="text-2xl font-black text-primary tracking-tighter">OpenLinks</a>
                </div>

                <ul class="menu p-4 w-full grow text-base-content/80 gap-1">
                    <li>
                        <a href="{{ route('home') }}" class="{{ request()->routeIs('home') ? 'menu-active' : '' }} flex gap-3 items-center py-3">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-6">
                                <path stroke-linecap="round" stroke-linejoin="round" d="m2.25 12 8.954-8.955c.44-.439 1.152-.439 1.591 0L21.75 12M4.5 9.75v10.125c0 .621.504 1.125 1.125 1.125H9.75v-4.875c0-.621.504-1.125 1.125-1.125h2.25c.621 0 1.125.504 1.125 1.125V21h4.125c.621 0 1.125-.504 1.125-1.125V9.75M8.25 21h8.25" />
                            </svg>
                            <span class="font-bold">Home</span>
                        </a>
                    </li>
                    <li>
                        <a href="{{ route('links.index') }}" class="{{ request()->routeIs('links.*') ? 'menu-active' : '' }} flex gap-3 items-center py-3">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-6">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M13.19 8.688a4.5 4.5 0 0 1 1.242 7.244l-4.5 4.5a4.5 4.5 0 0 1-6.364-6.364l1.757-1.757m13.35-.622 1.757-1.757a4.5 4.5 0 0 0-6.364-6.364l-4.5 4.5a4.5 4.5 0 0 0 1.242 7.244" />
                            </svg>
                            <span class="font-bold">Links</span>
                        </a>
                    </li>
                </ul>

                <div class="p-4 border-t border-base-200">
                    <div class="flex items-center gap-3 p-2">
                        <div class="avatar placeholder">
                            <div class="bg-neutral text-neutral-content rounded-full w-10 flex items-center justify-center">
                                <span class="text-xs font-bold">{{ Auth::user()->initials() ?? 'U' }}</span>
                            </div>
                        </div>
                        <div class="grow min-w-0">
                            <p class="text-sm font-bold truncate">{{ Auth::user()->name ?? 'User' }}</p>
                            <p class="text-xs text-base-content/50 truncate">{{ Auth::user()->email ?? 'user@example.com' }}</p>
                        </div>
                        <form method="POST" action="{{ route('logout') }}">
                            @csrf
                            <button type="submit" class="btn btn-ghost btn-xs">
                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-4 h-4">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M15.75 9V5.25A2.25 2.25 0 0 0 13.5 3h-6a2.25 2.25 0 0 0-2.25 2.25v13.5A2.25 2.25 0 0 0 7.5 21h6a2.25 2.25 0 0 0 2.25-2.25V15m3 0 3-3m0 0-3-3m3 3H9" />
                                </svg>
                            </button>
                        </form>
                    </div>
                </div>
            </aside>
        </div>
    </div>
    @stack('scripts')
</body>
</html>
