<x-app-layout>
    <div class="space-y-6">
        <!-- Header -->
        <div class="flex flex-col md:flex-row md:items-center justify-between gap-4">
            <div>
                <h1 class="text-3xl font-black tracking-tight">My Links</h1>
                <p class="text-base-content/60 mt-1 font-medium">Manage and monitor all your shortened URLs.</p>
            </div>
            <a href="{{ route('links.create') }}" class="btn btn-primary font-bold">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2.5" stroke="currentColor" class="size-5 mr-1">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M12 4.5v15m7.5-7.5h-15" />
                </svg>
                Create New Link
            </a>
        </div>

        <!-- Links List -->
        <div class="card bg-base-100 shadow-sm border border-base-200">
            <div class="card-body p-0">
                @if($links->isEmpty())
                    <div class="p-12 text-center">
                        <div class="inline-flex items-center justify-center w-16 h-16 rounded-full bg-base-200 text-base-content/20 mb-4">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-8">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M13.19 8.688a4.5 4.5 0 0 1 1.242 7.244l-4.5 4.5a4.5 4.5 0 0 1-6.364-6.364l1.757-1.757m13.35-.622 1.757-1.757a4.5 4.5 0 0 0-6.364-6.364l-4.5 4.5a4.5 4.5 0 0 0 1.242 7.244" />
                            </svg>
                        </div>
                        <h3 class="text-lg font-bold">No links created yet</h3>
                        <p class="text-base-content/50 font-medium mb-6">Start by creating your first shortened URL.</p>
                        <a href="{{ route('links.create') }}" class="btn btn-primary btn-sm font-bold">Create Link</a>
                    </div>
                @else
                    <div class="overflow-x-auto">
                        <table class="table table-lg">
                            <thead>
                                <tr class="text-base-content/40 font-bold uppercase text-xs tracking-widest border-b border-base-200">
                                    <th class="pl-8">Link Info</th>
                                    <th>Short URL</th>
                                    <th>Destination</th>
                                    <th class="text-right pr-8">Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($links as $link)
                                    <tr class="hover:bg-base-200/50 transition-colors border-b border-base-200/50">
                                        <td class="pl-8">
                                            <div class="font-bold text-base">{{ $link->title }}</div>
                                            <div class="text-xs text-base-content/40 font-medium mt-0.5">Created {{ $link->created_at->diffForHumans() }}</div>
                                        </td>
                                        <td>
                                            <div x-data="clipboard('{{ url($link->alias) }}')" class="flex items-center gap-2">
                                                <a href="{{ url($link->alias) }}" class="link link-primary text-sm">
                                                    {{ $link->aliasLabel() }}
                                                </a>
                                                <button class="btn btn-ghost btn-xs btn-square text-base-content/30 hover:text-primary tooltip"
                                                    :data-tip="copied ? 'Link copied' : 'Copy link'" @click="copy">
                                                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-4">
                                                        <path stroke-linecap="round" stroke-linejoin="round" d="M15.75 17.25v3.375c0 .621-.504 1.125-1.125 1.125h-9.75a1.125 1.125 0 0 1-1.125-1.125V7.875c0-.621.504-1.125 1.125-1.125H6.75a9.06 9.06 0 0 1 1.5.124m7.5 10.376h3.375c.621 0 1.125-.504 1.125-1.125V11.25c0-4.46-3.243-8.161-7.5-8.876a9.06 9.06 0 0 0-1.5-.124H9.375c-.621 0-1.125.504-1.125 1.125v3.5m7.5 10.375H9.375a1.125 1.125 0 0 1-1.125-1.125v-9.25m12 6.625v-1.875a3.375 3.375 0 0 0-3.375-3.375h-1.5a1.125 1.125 0 0 1-1.125-1.125v-1.5a3.375 3.375 0 0 0-3.375-3.375H9.75" />
                                                    </svg>
                                                </button>
                                            </div>
                                        </td>
                                        <td>
                                            <a href="{{ $link->destination_url }}" class="link link-secondary text-sm">
                                                {{ $link->destination_url }}
                                            </a>
                                        </td>
                                        <td class="text-right pr-8">
                                            <div class="flex justify-end gap-1">
                                                <form action="{{ route('links.destroy', $link->id) }}" method="POST">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="btn btn-ghost btn-sm btn-square text-base-content/40 hover:text-error">
                                                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-5">
                                                            <path stroke-linecap="round" stroke-linejoin="round" d="m14.74 9-.346 9m-4.788 0L9.26 9m9.968-3.21c.342.052.682.107 1.022.166m-1.022-.165L18.16 19.673a2.25 2.25 0 0 1-2.244 2.077H8.084a2.25 2.25 0 0 1-2.244-2.077L4.772 5.79m14.456 0a48.108 48.108 0 0 0-3.478-.397m-12 .562c.34-.059.68-.114 1.022-.165m0 0a48.11 48.11 0 0 1 3.478-.397m7.5 0v-.916c0-1.18-.91-2.164-2.09-2.201a51.964 51.964 0 0 0-3.32 0c-1.18.037-2.09 1.022-2.09 2.201v.916m7.5 0a48.667 48.667 0 0 0-7.5 0" />
                                                        </svg>
                                                    </button>
                                                </form>
                                            </div>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                @endif
            </div>
        </div>
    </div>
</x-app-layout>
