<?php

use App\Actions\CreateLink;
use Livewire\Component;
use Livewire\Attributes\Validate;
use Livewire\Attributes\On;

new class extends Component
{
    #[Validate('required|string|max:255')]
    public string $title = '';

    #[Validate('required|url|max:2048')]
    public string $destinationUrl = '';

    #[Validate('required|string|min:1|max:50|alpha_dash|unique:links,alias')]
    public string $alias = '';

    #[On('random-alias-generated')]
    public function randomAliasGenerated(string $alias): void
    {
        $this->alias = $alias;
    }

    public function save(CreateLink $createLink)
    {
        $this->validate();
        $createLink->execute(auth()->user(), $this->all());
        return $this->redirectRoute('links.index')->with('success', 'Link created successfully!');
    }
};
?>

<div class="card bg-base-100 shadow-sm border border-base-200">
    <div class="card-body p-8">
        <form action="{{ route('links.store') }}" method="POST" class="space-y-6">
            @csrf

            <div class="form-control w-full">
                <label class="label">
                    <span class="label-text font-bold">Destination URL</span>
                </label>
                <input
                    type="url"
                    name="destination_url"
                    placeholder="https://example.com/your-long-url"
                    class="input input-bordered w-full @error('destination_url') input-error @enderror"
                    wire:model="destinationUrl"
                    required
                />
                @error('destination_url')
                    <label class="label">
                        <span class="label-text-alt text-error font-medium">{{ $message }}</span>
                    </label>
                @enderror
            </div>

            <div class="form-control w-full relative">
                <div class="flex justify-between items-end">
                    <label class="label">
                        <span class="label-text font-bold">Custom Alias</span>
                    </label>
                    <livewire:random-alias-button />
                </div>
                <div class="join w-full border border-base-300 rounded-lg overflow-hidden ring-offset-base-100 focus-within:ring-2 focus-within:ring-primary focus-within:ring-offset-2">
                    <span class="join-item bg-base-200 px-4 flex items-center text-sm font-bold text-base-content/50 border-r border-base-300">
                        {{ config('app.domain') }}/
                    </span>
                    <input
                        type="text"
                        name="alias"
                        placeholder="my-custom-link"
                        class="input input-ghost join-item w-full focus:bg-transparent font-medium"
                        wire:model="alias"
                        required
                    />
                </div>
                @error('alias')
                    <label class="label">
                        <span class="label-text-alt text-error font-medium">{{ $message }}</span>
                    </label>
                @enderror
            </div>

            <div class="form-control w-full">
                <label class="label">
                    <span class="label-text font-bold">Display Title</span>
                </label>
                <input
                    type="text"
                    name="title"
                    placeholder=""
                    class="input input-bordered w-full @error('title') input-error @enderror"
                    wire:model="title"
                    required
                />
                @error('title')
                    <label class="label">
                        <span class="label-text-alt text-error font-medium">{{ $message }}</span>
                    </label>
                @enderror
            </div>

            <!-- Actions -->
            <div class="flex justify-end gap-3 pt-4">
                <a href="{{ url()->previous('app') }}" class="btn btn-ghost font-bold">Cancel</a>
                <button type="submit" class="btn btn-primary font-bold px-8">
                    Create Link
                </button>
            </div>
        </form>
    </div>
</div>
