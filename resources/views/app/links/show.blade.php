<x-app-layout>
    <div class="max-w-4xl mx-auto space-y-6">
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
        <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
            <!-- Details Column -->
            <div class="lg:col-span-2">
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

            <!-- Sidebar Info -->
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

            <div class="lg:col-span-2">
                <div class="card bg-base-100 border border-base-200 h-full">
                    <div class="card-body px-8 text-center items-center justify-center relative py-10">
                        <div class="inline-flex items-center justify-center w-12 h-12 rounded-full bg-base-200 text-base-content/20 mb-4 absolute inset-8">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-6">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M3 13.125C3 12.504 3.504 12 4.125 12h2.25c.621 0 1.125.504 1.125 1.125v6.75C7.5 20.496 6.996 21 6.375 21h-2.25A1.125 1.125 0 0 1 3 19.875v-6.75ZM9.75 8.625c0-.621.504-1.125 1.125-1.125h2.25c.621 0 1.125.504 1.125 1.125v11.25c0 .621-.504 1.125-1.125 1.125h-2.25a1.125 1.125 0 0 1-1.125-1.125V8.625ZM16.5 4.125c0-.621.504-1.125 1.125-1.125h2.25C20.496 3 21 3.504 21 4.125v15.75c0 .621-.504 1.125-1.125 1.125h-2.25a1.125 1.125 0 0 1-1.125-1.125V4.125Z" />
                            </svg>
                        </div>
                        <div>
                            <h3 class="text-lg font-bold">Analytics coming soon</h3>
                            <p class="text-base-content/50 font-medium text-sm">Detailed insights for your links.</p>
                        </div>
                    </div>
                </div>
            </div>

            <div class="card bg-primary/10 border border-primary/20">
                <div class="card-body p-8 flex flex-col justify-center">
                    <h3 class="font-bold text-primary flex items-center gap-2 text-lg">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-6">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M11.25 11.25.041-.02a.75.75 0 0 1 1.063.852l-.708 2.836a.75.75 0 0 0 1.063.853l.041-.021M21 12a9 9 0 1 1-18 0 9 9 0 0 1 18 0Zm-9-3.75h.008v.008H12V8.25Z" />
                        </svg>
                        Did you know?
                    </h3>
                    <p class="text-sm font-medium text-base-content/70 mt-3 leading-relaxed">
                        Shortened links receive up to 34% more clicks than long, messy URLs. Keep them clean and trackable!
                    </p>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
