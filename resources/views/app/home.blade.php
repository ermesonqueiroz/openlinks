<x-app-layout>
    <div class="space-y-6">
        <!-- Header Section -->
        <div class="flex flex-col md:flex-row md:items-center justify-between gap-4">
            <div>
                <h1 class="text-3xl font-black tracking-tight">Welcome back, {{ Auth::user()->name ?? 'User' }}!</h1>
                <p class="text-base-content/60 mt-1 font-medium">Here's what's happening with your links.</p>
            </div>
        </div>

            <!-- Stats Grid -->
        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
            <div class="stats shadow-sm bg-base-100 border border-base-200">
                <div class="stat">
                    <div class="stat-figure text-primary">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-8">
                            <path stroke-linecap="round" stroke-linejoin="round" d="m11.25 11.25.041-.02a.75.75 0 0 1 1.063.852l-.708 2.836a.75.75 0 0 0 1.063.853l.041-.021M21 12a9 9 0 1 1-18 0 9 9 0 0 1 18 0Zm-9-3.75h.008v.008H12V8.25Z" />
                        </svg>

                    </div>
                    <div class="stat-title font-bold">Total Links</div>
                    <div class="stat-value text-primary font-black">{{ $totalLinks }}</div>
                    {{-- <div class="stat-desc font-medium">Jan 1st - Feb 1st</div> --}}
                </div>
            </div>

            <div class="stats shadow-sm bg-base-100 border border-base-200">
                <div class="stat">
                    <div class="stat-figure text-secondary">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-8">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M15.042 21.672 13.684 16.6m0 0-2.51 2.225.569-9.47 5.227 7.917-3.286-.672ZM12 2.25V4.5m5.834.166-1.591 1.591M20.25 10.5H18M7.757 14.743l-1.59 1.59M6 10.5H3.75m4.007-4.243-1.59-1.59" />
                        </svg>
                    </div>
                    <div class="stat-title font-bold">Total Clicks</div>
                    <div class="stat-value text-secondary font-black">{{ $totalClicks }}</div>
                    {{-- <div class="stat-desc font-medium">↗︎ 400 (22%)</div> --}}
                </div>
            </div>
        </div>

        <!-- Recent Activity Placeholder -->
        <div class="card bg-base-100 shadow-sm border border-base-200">
            <div class="card-body">
                <h2 class="card-title text-xl font-black mb-4">Recent Links</h2>
                <div class="overflow-x-auto">
                    <table class="table table-zebra font-medium">
                        <thead>
                            <tr class="text-base-content/40 font-bold uppercase text-xs tracking-widest">
                                <th>Name</th>
                                <th>Url</th>
                                <th>Clicks</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($recentLinks as $link)
                                <tr :key="$link->id">
                                    <td class="font-bold">{{ $link->title }}</td>
                                    <td>
                                        <a href="{{ url($link->alias) }}" target="_blank" class="link link-secondary">
                                            {{ $link->aliasLabel() }}
                                        </a>
                                    </td>
                                    <td class="font-bold">{{ $link->visits->count() }}</td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
                <div class="card-actions justify-center mt-4">
                    <a href="{{ route('links.index') }}" class="btn btn-ghost btn-sm font-bold">View all links</a>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
