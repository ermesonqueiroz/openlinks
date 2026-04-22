<x-app-layout>
    <div class="max-w-2xl mx-auto space-y-6">
        <div class="flex items-center gap-4">
            <div>
                <h1 class="text-2xl font-black tracking-tight">Create new user</h1>
                <p class="text-base-content/60 font-medium">Set up a new user.</p>
            </div>
        </div>

        <div class="card bg-base-100 shadow-sm border border-base-200">
            <div class="card-body p-8">
                <form action="{{ route('users.store') }}" method="POST" class="space-y-6">
                    @csrf

                    <div class="form-control w-full">
                        <label class="label">
                            <span class="label-text font-bold">Name</span>
                        </label>
                        <input
                            type="text"
                            name="name"
                            placeholder="John"
                            class="input input-bordered w-full @error('name') input-error @enderror"
                            wire:model="name"
                            required
                        />
                        @error('name')
                            <label class="label">
                                <span class="label-text-alt text-error font-medium">{{ $message }}</span>
                            </label>
                        @enderror
                    </div>

                    <div class="form-control w-full">
                        <label class="label">
                            <span class="label-text font-bold">Email</span>
                        </label>
                        <input
                            type="email"
                            name="email"
                            placeholder="john@mail.com"
                            class="input input-bordered w-full @error('email') input-error @enderror"
                            wire:model="email"
                            required
                        />
                        @error('email')
                            <label class="label">
                                <span class="label-text-alt text-error font-medium">{{ $message }}</span>
                            </label>
                        @enderror
                    </div>

                    <div class="form-control w-full">
                        <label class="label">
                            <span class="label-text font-bold text-base-content/80">Password</span>
                        </label>
                        <input
                            type="password"
                            name="password"
                            placeholder="••••••••"
                            class="input input-bordered w-full @error('password') input-error @enderror"
                            required
                            autocomplete="new-password"
                        />
                        @error('password')
                            <label class="label">
                                <span class="label-text-alt text-error font-medium">{{ $message }}</span>
                            </label>
                        @enderror
                    </div>

                    <div class="form-control w-full">
                        <label class="label">
                            <span class="label-text font-bold text-base-content/80">Confirm Password</span>
                        </label>
                        <input
                            type="password"
                            name="password_confirmation"
                            placeholder="••••••••"
                            class="input input-bordered w-full"
                            required
                            autocomplete="new-password"
                        />
                    </div>

                    <div class="flex justify-end gap-3 pt-4">
                        <a href="{{ url()->previous('app') }}" class="btn btn-ghost font-bold">Cancel</a>
                        <button type="submit" class="btn btn-primary font-bold px-8">
                            Create User
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</x-app-layout>
