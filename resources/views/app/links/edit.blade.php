<x-app-layout>
    <div class="max-w-2xl mx-auto space-y-6">
        <!-- Header -->
        <div class="flex items-center gap-4">
            <div>
                <h1 class="text-2xl font-black tracking-tight">Edit Link</h1>
                <p class="text-base-content/60 font-medium">Update your link details and configuration.</p>
            </div>
        </div>

        <!-- Form Card -->
        <div class="card bg-base-100 shadow-sm border border-base-200">
            <div class="card-body p-8">
                <form action="{{ route('links.update', $link) }}" method="POST" class="space-y-6">
                    @csrf
                    @method('PUT')

                    <!-- Title -->
                    <div class="form-control w-full">
                        <label class="label">
                            <span class="label-text font-bold">Display Title</span>
                        </label>
                        <input
                            type="text"
                            name="title"
                            placeholder="e.g. My Personal Portfolio"
                            class="input input-bordered w-full @error('title') input-error @enderror"
                            value="{{ old('title', $link->title) }}"
                            required
                        />
                        @error('title')
                            <label class="label">
                                <span class="label-text-alt text-error font-medium">{{ $message }}</span>
                            </label>
                        @enderror
                    </div>

                    <!-- Destination URL -->
                    <div class="form-control w-full">
                        <label class="label">
                            <span class="label-text font-bold">Destination URL</span>
                        </label>
                        <input
                            type="url"
                            name="destination_url"
                            placeholder="https://example.com/your-long-url"
                            class="input input-bordered w-full @error('destination_url') input-error @enderror"
                            value="{{ old('destination_url', $link->destination_url) }}"
                            required
                        />
                        @error('destination_url')
                            <label class="label">
                                <span class="label-text-alt text-error font-medium">{{ $message }}</span>
                            </label>
                        @enderror
                    </div>

                    <!-- Custom Alias -->
                    <div class="form-control w-full">
                        <label class="label">
                            <span class="label-text font-bold">Custom Alias</span>
                        </label>
                        <div class="join w-full border border-base-300 rounded-lg overflow-hidden ring-offset-base-100 focus-within:ring-2 focus-within:ring-primary focus-within:ring-offset-2">
                            <span class="join-item bg-base-200 px-4 flex items-center text-sm font-bold text-base-content/50 border-r border-base-300">
                                {{ config('app.domain') }}/
                            </span>
                            <input
                                type="text"
                                name="alias"
                                placeholder="my-custom-link"
                                class="input input-ghost join-item w-full focus:bg-transparent font-medium"
                                value="{{ old('alias', $link->alias) }}"
                                required
                            />
                        </div>
                        <label class="label">
                            <span class="label-text-alt text-base-content/50 font-medium">Choosing a new alias will break old links.</span>
                        </label>
                        @error('alias')
                            <label class="label">
                                <span class="label-text-alt text-error font-medium">{{ $message }}</span>
                            </label>
                        @enderror
                    </div>

                    <!-- Actions -->
                    <div class="flex justify-end gap-3 pt-4">
                        <a href="{{ url()->previous() }}" class="btn btn-ghost font-bold">Cancel</a>
                        <button type="submit" class="btn btn-primary font-bold px-8">
                            Save Changes
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</x-app-layout>
