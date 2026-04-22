<x-app-layout>
    <div class="mx-auto space-y-6">
        <!-- Breadcrumbs & Actions -->
        <div class="flex flex-col md:flex-row md:items-center justify-between gap-4">
            <div class="text-sm breadcrumbs text-base-content/60 font-medium">
                <ul>
                    <li><a href="{{ route('users.index') }}">Users</a></li>
                    <li class="text-base-content">{{ $user->name }}</li>
                </ul>
            </div>
            <div class="flex gap-2">
                <form action="{{ route('users.destroy', $user) }}" method="POST" onsubmit="return confirm('Are you sure?')">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn btn-ghost btn-sm font-bold gap-2 text-error hover:bg-error/10">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-4">
                            <path stroke-linecap="round" stroke-linejoin="round" d="m14.74 9-.346 9m-4.788 0L9.26 9m9.968-3.21c.342.052.682.107 1.022.166m-1.022-.165L18.16 19.673a2.25 2.25 0 0 1-2.244 2.077H8.084a2.25 2.25 0 0 1-2.244-2.077L4.772 5.79m14.456 0a48.108 48.108 0 0 0-3.478-.397m-12 .562c.34-.059.68-.114 1.022-.165m0 0a48.11 48.11 0 0 1 3.478-.397m7.5 0v-.916c0-1.18-.91-2.164-2.09-2.201a51.964 51.964 0 0 0-3.32 0c-1.18.037-2.09 1.022-2.09 2.201v.916m7.5 0a48.667 48.667 0 0 0-7.5 0" />
                        </svg>
                        Delete User
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
                        <div class="flex items-center gap-4 mb-8">
                            <div class="avatar placeholder">
                                <div class="bg-primary text-primary-content rounded-full w-16 flex items-center justify-center">
                                    <span class="text-xl font-black">{{ $user->initials() }}</span>
                                </div>
                            </div>
                            <div>
                                <h2 class="card-title text-3xl font-black tracking-tight">{{ $user->name }}</h2>
                                <p class="text-base-content/50 font-medium">{{ $user->email }}</p>
                            </div>
                        </div>

                        <div class="space-y-6">
                            <!-- Information -->
                            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                                <div>
                                    <label class="text-xs font-bold uppercase tracking-widest text-base-content/40 mb-2 block">Account Status</label>
                                    <div class="flex items-center gap-2">
                                        <span class="badge badge-success font-bold">Active</span>
                                        @if($user->email_verified_at)
                                            <span class="badge badge-info font-bold">Verified</span>
                                        @endif
                                    </div>
                                </div>
                                <div>
                                    <label class="text-xs font-bold uppercase tracking-widest text-base-content/40 mb-2 block">Member Since</label>
                                    <p class="font-bold text-lg">{{ $user->created_at->format('M d, Y') }}</p>
                                </div>
                            </div>

                            <div class="divider"></div>

                            <!-- Links Summary -->
                            <div>
                                <label class="text-xs font-bold uppercase tracking-widest text-base-content/40 mb-4 block">Links Created</label>
                                <div class="stats bg-base-200 w-full">
                                    <div class="stat">
                                        <div class="stat-title font-bold">Total Links</div>
                                        <div class="stat-value text-primary">{{ $user->links->count() }}</div>
                                        <div class="stat-desc font-medium">Active shortened URLs</div>
                                    </div>
                                    <div class="stat">
                                        <div class="stat-title font-bold">Total Clicks</div>
                                        <div class="stat-value text-secondary">{{ $user->links->sum(fn($l) => $l->visits->count()) }}</div>
                                        <div class="stat-desc font-medium">Across all links</div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="lg:col-span-3 space-y-6">
                <!-- User Info Card -->
                <div class="card bg-base-100 border border-base-200 shadow-sm">
                    <div class="card-body p-6">
                        <h3 class="font-bold text-sm uppercase tracking-widest text-base-content/40 mb-4">Quick Stats</h3>
                        <div class="space-y-4 text-sm font-medium">
                            <div class="flex justify-between items-center">
                                <span class="text-base-content/50">Last Login</span>
                                <span>{{ $user->updated_at->diffForHumans() }}</span>
                            </div>
                            <div class="flex justify-between items-center">
                                <span class="text-base-content/50">Role</span>
                                <span class="badge badge-ghost font-bold">Administrator</span>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Activity Feed -->
                <div class="card bg-base-100 border border-base-200 shadow-sm">
                    <div class="card-body p-6">
                        <h3 class="text-lg font-black mb-6">Recent Activity</h3>

                        @if($audits->isEmpty())
                            <div class="flex flex-col items-center justify-center py-8 text-base-content/20 text-center">
                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-10 mb-2">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M12 6v6h4.5m4.5 0a9 9 0 1 1-18 0 9 9 0 0 1 18 0Z" />
                                </svg>
                                <span class="font-bold text-sm">No activity recorded</span>
                            </div>
                        @else
                            <div class="space-y-6">
                                @foreach ($audits->take(10) as $audit)
                                    <div class="flex gap-3">
                                        <div class="flex flex-col items-center">
                                            <div class="w-8 h-8 rounded-full bg-base-200 flex items-center justify-center">
                                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-4 text-base-content/50">
                                                    @if($audit->event === 'created')
                                                        <path stroke-linecap="round" stroke-linejoin="round" d="M12 4.5v15m7.5-7.5h-15" />
                                                    @elseif($audit->event === 'updated')
                                                        <path stroke-linecap="round" stroke-linejoin="round" d="M16.023 9.348h4.992v-.001M2.985 19.644v-4.992m0 0h4.992m-4.993 0 3.181 3.183a8.25 8.25 0 0 0 13.803-3.7M4.031 9.865a8.25 8.25 0 0 1 13.803-3.7l3.181 3.182m0-4.991v4.99" />
                                                    @else
                                                        <path stroke-linecap="round" stroke-linejoin="round" d="m14.74 9-.346 9m-4.788 0L9.26 9m9.968-3.21c.342.052.682.107 1.022.166m-1.022-.165L18.16 19.673a2.25 2.25 0 0 1-2.244 2.077H8.084a2.25 2.25 0 0 1-2.244-2.077L4.772 5.79m14.456 0a48.108 48.108 0 0 0-3.478-.397m-12 .562c.34-.059.68-.114 1.022-.165m0 0a48.11 48.11 0 0 1 3.478-.397m7.5 0v-.916c0-1.18-.91-2.164-2.09-2.201a51.964 51.964 0 0 0-3.32 0c-1.18.037-2.09 1.022-2.09 2.201v.916m7.5 0a48.667 48.667 0 0 0-7.5 0" />
                                                    @endif
                                                </svg>
                                            </div>
                                            @if(!$loop->last)
                                                <div class="w-px grow bg-base-200 my-1"></div>
                                            @endif
                                        </div>
                                        <div class="min-w-0">
                                            <p class="text-sm">
                                                <span class="font-bold capitalize">{{ $audit->event }}</span>
                                                <span class="text-base-content/60">
                                                    @php
                                                        $modelName = strtolower(class_basename($audit->auditable_type));
                                                        $displayName = $modelName;
                                                        
                                                        // Tenta pegar um nome amigável do objeto auditado se ele ainda existir
                                                        if ($audit->auditable) {
                                                            if ($modelName === 'link') {
                                                                $displayName = "link \"{$audit->auditable->title}\"";
                                                            } elseif ($modelName === 'user') {
                                                                $displayName = $audit->auditable->id === $user->id ? 'their profile' : "user \"{$audit->auditable->name}\"";
                                                            }
                                                        }
                                                    @endphp
                                                    {{ $displayName }}
                                                </span>
                                            </p>
                                            <div class="text-[10px] text-base-content/40 font-bold uppercase tracking-wider mt-1">
                                                {{ $audit->created_at->diffForHumans() }}
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
    </div>
</x-app-layout>
