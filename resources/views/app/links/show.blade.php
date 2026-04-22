<x-app-layout>
    <div class="mx-auto space-y-6">
        <!-- Breadcrumbs & Actions -->
        <div class="flex flex-col md:flex-row md:items-center justify-between gap-4">
            <div class="text-sm breadcrumbs text-base-content/60 font-medium">
                <ul>
                    <li><a href="{{ route('links.index') }}">Links</a></li>
                    <li class="text-base-content">{{ $link->title }}</li>
                </ul>
            </div>
            <div class="flex gap-2">
                <a href="{{ route('links.edit', $link) }}" class="btn btn-ghost btn-sm font-bold gap-2">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-4">
                        <path stroke-linecap="round" stroke-linejoin="round" d="m16.862 4.487 1.687-1.688a1.875 1.875 0 1 1 2.652 2.652L10.582 16.07a4.5 4.5 0 0 1-1.897 1.13L6 18l.8-2.685a4.5 4.5 0 0 1 1.13-1.897l8.932-8.931Zm0 0L19.5 7.125M18 14v4.75A2.25 2.25 0 0 1 15.75 21H5.25A2.25 2.25 0 0 1 3 18.75V8.25A2.25 2.25 0 0 1 5.25 6H10" />
                    </svg>
                    Edit
                </a>
                <form action="{{ route('links.destroy', $link) }}" method="POST" onsubmit="return confirm('Are you sure?')">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn btn-ghost btn-sm font-bold gap-2 text-error hover:bg-error/10">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-4">
                            <path stroke-linecap="round" stroke-linejoin="round" d="m14.74 9-.346 9m-4.788 0L9.26 9m9.968-3.21c.342.052.682.107 1.022.166m-1.022-.165L18.16 19.673a2.25 2.25 0 0 1-2.244 2.077H8.084a2.25 2.25 0 0 1-2.244-2.077L4.772 5.79m14.456 0a48.108 48.108 0 0 0-3.478-.397m-12 .562c.34-.059.68-.114 1.022-.165m0 0a48.11 48.11 0 0 1 3.478-.397m7.5 0v-.916c0-1.18-.91-2.164-2.09-2.201a51.964 51.964 0 0 0-3.32 0c-1.18.037-2.09 1.022-2.09 2.201v.916m7.5 0a48.667 48.667 0 0 0-7.5 0" />
                        </svg>
                        Delete
                    </button>
                </form>
            </div>
        </div>

        <!-- Main Content -->
        <div class="grid grid-cols-1 lg:grid-cols-9 gap-6">
            <!-- Details Column -->
            <div class="lg:col-span-6">
                <div class="card bg-base-100 border border-base-200 h-full">
                    <div class="card-body p-8">
                        <div class="flex items-center gap-3 mb-6">
                            <h2 class="card-title text-2xl font-black">{{ $link->title }}</h2>
                            <span class="badge badge-success badge-sm font-bold">Active</span>
                        </div>

                        <div class="space-y-6">
                            <!-- Short Link -->
                            <div>
                                <label class="text-xs font-bold uppercase tracking-widest text-base-content/40 mb-2 block">Short Link</label>
                                <div x-data="clipboard('{{ url($link->alias) }}')" class="flex items-center gap-2">
                                    <div class="bg-base-200 px-4 py-3 rounded-lg font-bold text-primary grow break-all">
                                        {{ $link->aliasLabel() }}
                                    </div>
                                    <button class="btn btn-primary btn-square tooltip" :data-tip="copied ? 'Link copied' : 'Copy link'" @click="copy">
                                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-6">
                                            <path stroke-linecap="round" stroke-linejoin="round" d="M15.75 17.25v3.375c0 .621-.504 1.125-1.125 1.125h-9.75a1.125 1.125 0 0 1-1.125-1.125V7.875c0-.621.504-1.125 1.125-1.125H6.75a9.06 9.06 0 0 1 1.5.124m7.5 10.376h3.375c.621 0 1.125-.504 1.125-1.125V11.25c0-4.46-3.243-8.161-7.5-8.876a9.06 9.06 0 0 0-1.5-.124H9.375c-.621 0-1.125.504-1.125 1.125v3.5m7.5 10.375H9.375a1.125 1.125 0 0 1-1.125-1.125v-9.25m12 6.625v-1.875a3.375 3.375 0 0 0-3.375-3.375h-1.5a1.125 1.125 0 0 1-1.125-1.125v-1.5a3.375 3.375 0 0 0-3.375-3.375H9.75" />
                                        </svg>
                                    </button>
                                </div>
                            </div>

                            <!-- Destination -->
                            <div>
                                <label class="text-xs font-bold uppercase tracking-widest text-base-content/40 mb-2 block">Destination URL</label>
                                <a href="{{ $link->destination_url }}" target="_blank" class="flex items-center gap-3 p-4 bg-base-200/50 rounded-lg hover:bg-base-200 transition-colors group">
                                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-5 text-base-content/30 group-hover:text-primary">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M13.19 8.688a4.5 4.5 0 0 1 1.242 7.244l-4.5 4.5a4.5 4.5 0 0 1-6.364-6.364l1.757-1.757m13.35-.622 1.757-1.757a4.5 4.5 0 0 0-6.364-6.364l-4.5 4.5a4.5 4.5 0 0 0 1.242 7.244" />
                                    </svg>
                                    <span class="text-sm font-medium break-all">{{ $link->destination_url }}</span>
                                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-4 ml-auto text-base-content/20 group-hover:text-base-content/50">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M13.5 6H5.25A2.25 2.25 0 0 0 3 8.25v10.5A2.25 2.25 0 0 0 5.25 21h10.5A2.25 2.25 0 0 0 18 18.75V10.5m-10.5 6L21 3m0 0h-5.25M21 3v5.25" />
                                    </svg>
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="lg:col-span-3">
                <div class="card bg-base-100 border border-base-200">
                    <div class="card-body p-6">
                        <h3 class="font-bold text-sm uppercase tracking-widest text-base-content/40 mb-4">Information</h3>

                        <div class="space-y-4 text-sm font-medium">
                            <div class="flex justify-between items-center">
                                <span class="text-base-content/50">Status</span>
                                <span class="text-success">Active</span>
                            </div>
                            <div class="flex justify-between items-center">
                                <span class="text-base-content/50">Created</span>
                                <span>{{ $link->created_at->format('M d, Y') }}</span>
                            </div>
                            <div class="flex justify-between items-center">
                                <span class="text-base-content/50">Last Updated</span>
                                <span>{{ $link->updated_at->diffForHumans() }}</span>
                            </div>
                        </div>

                        <div class="divider"></div>

                        <div class="stats stats-vertical bg-transparent p-0">
                            <div class="stat p-0">
                                <div class="stat-title font-bold">Total Clicks</div>
                                <div class="stat-value text-primary">{{ $link->visits->count() }}</div>
                                <div class="stat-desc font-medium mt-1">From all sources</div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="lg:col-span-3">
                <div class="card bg-base-100 border border-base-200 shadow-sm">
                    <div class="card-body p-8">
                        <div class="flex items-center justify-between mb-6">
                            <h3 class="text-xl font-black">Devices</h3>
                        </div>
                        <div class="relative h-48 w-full flex justify-center items-center">
                            <canvas id="devicesChart"></canvas>
                            @if($devices->isEmpty())
                                <div class="absolute text-base-content/20 font-bold">No data yet</div>
                            @endif
                        </div>
                    </div>
                </div>
            </div>

            <div class="lg:col-span-3">
                <div class="card bg-base-100 border border-base-200 shadow-sm">
                    <div class="card-body p-8">
                        <div class="flex items-center justify-between mb-6">
                            <h3 class="text-xl font-black">Referrers</h3>
                        </div>
                        <div class="relative h-48 w-full flex justify-center items-center">
                            <canvas id="referrersChart"></canvas>
                            @if($referrers->isEmpty())
                                <div class="absolute text-base-content/20 font-bold">No data yet</div>
                            @endif
                        </div>
                    </div>
                </div>
            </div>

            <div class="lg:col-span-3">
                <div class="card bg-base-100 border border-base-200 shadow-sm h-full">
                    <div class="card-body p-8">
                        <h3 class="text-xl font-black mb-6">Atividade</h3>

                        @if($audits->isEmpty())
                            <div class="flex flex-col items-center justify-center py-12 text-base-content/20">
                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-12 mb-4">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M12 6v6h4.5m4.5 0a9 9 0 1 1-18 0 9 9 0 0 1 18 0Z" />
                                </svg>
                                <span class="font-bold">No activity recorded yet</span>
                            </div>
                        @else
                            <div class="space-y-0">
                                @foreach ($audits as $audit)
                                    <div class="flex gap-4">
                                        <div class="flex flex-col items-center">
                                            <div class="avatar placeholder">
                                                <div class="bg-neutral text-neutral-content rounded-full w-10 flex items-center justify-center">
                                                    <span class="text-xs font-bold">{{ Auth::user()->initials() ?? 'U' }}</span>
                                                </div>
                                            </div>
                                            @if(!$loop->last)
                                                <div class="w-px grow bg-base-200 my-2"></div>
                                            @endif
                                        </div>
                                        <div>
                                            <p class="mb-1">
                                                <span class="font-bold">{{ $audit->user?->name ?? 'System' }}</span>
                                                <span class="text-base-content/50">{{ $audit->event }} this link</span>
                                            </p>
                                            <div class="text-xs text-base-content/40 font-medium mb-3">
                                                {{ $audit->created_at->format('M d, Y \a\t H:i') }} ({{ $audit->created_at->diffForHumans() }})
                                            </div>
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                        @endif
                    </div>
                </div>
            </div>
        </div>

        @push('scripts')
        <script>
            document.addEventListener('DOMContentLoaded', function() {
                const initCharts = () => {
                    if (typeof Chart === 'undefined') {
                        setTimeout(initCharts, 100);
                        return;
                    }

                    const chartConfig = (labels, data) => ({
                        type: 'doughnut',
                        data: {
                            labels: labels,
                            datasets: [{
                                data: data,
                                backgroundColor: [
                                    '#7c3aed',
                                    '#3b82f6',
                                    '#10b981',
                                    '#f59e0b',
                                    '#ef4444'
                                ],
                                borderWidth: 0,
                                hoverOffset: 20,
                                cutout: '70%'
                            }]
                        },
                        options: {
                            responsive: true,
                            maintainAspectRatio: false,
                            plugins: {
                                legend: {
                                    position: 'right',
                                    align: 'center',
                                    labels: {
                                        color: 'rgba(255, 255, 255, 0.5)',
                                        usePointStyle: true,
                                        padding: 15,
                                        font: {
                                            weight: 'bold',
                                            size: 11
                                        },
                                    }
                                }
                            }
                        }
                    });

                    // Devices Chart
                    const devices = {!! json_encode($devices) !!};
                    const deviceLabels = Object.keys(devices);
                    const deviceData = Object.values(devices);
                    if (deviceLabels.length > 0) {
                        new Chart(document.getElementById('devicesChart'), chartConfig(deviceLabels, deviceData));
                    }

                    // Referrers Chart
                    const referrers = {!! json_encode($referrers) !!};
                    const referrerLabels = Object.keys(referrers);
                    const referrerData = Object.values(referrers);
                    if (referrerLabels.length > 0) {
                        new Chart(document.getElementById('referrersChart'), chartConfig(referrerLabels, referrerData));
                    }
                };

                initCharts();
            });
        </script>
        @endpush
    </div>
</x-app-layout>
