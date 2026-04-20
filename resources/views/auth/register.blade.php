<x-guest-layout>
    <div class="min-h-screen flex flex-col justify-center items-center bg-base-200 p-4">
        <div class="card w-full max-w-md bg-base-100 shadow-2xl">
            <div class="card-body p-8">
                <div class="flex flex-col items-center mb-8">
                    <a href="/" class="text-4xl font-extrabold text-primary mb-2 text-center">OpenLinks</a>
                    <p class="text-base-content/60 text-center">Join the open-source link infrastructure</p>
                </div>
                
                <h2 class="card-title text-2xl font-bold justify-center mb-6 text-center">Create your account</h2>
                
                <form method="POST" action="{{ route('register.store') }}" class="space-y-4">
                    @csrf

                    <!-- Name -->
                    <div class="form-control w-full">
                        <label class="label">
                            <span class="label-text font-bold text-base-content/80">Full Name</span>
                        </label>
                        <input 
                            type="text" 
                            name="name" 
                            placeholder="John Doe" 
                            class="input input-bordered w-full @error('name') input-error @enderror" 
                            value="{{ old('name') }}"
                            required 
                            autofocus 
                            autocomplete="name" 
                        />
                        @error('name')
                            <label class="label">
                                <span class="label-text-alt text-error font-medium">{{ $message }}</span>
                            </label>
                        @enderror
                    </div>

                    <!-- Email Address -->
                    <div class="form-control w-full">
                        <label class="label">
                            <span class="label-text font-bold text-base-content/80">Email Address</span>
                        </label>
                        <input 
                            type="email" 
                            name="email" 
                            placeholder="name@example.com" 
                            class="input input-bordered w-full @error('email') input-error @enderror" 
                            value="{{ old('email') }}"
                            required 
                            autocomplete="username" 
                        />
                        @error('email')
                            <label class="label">
                                <span class="label-text-alt text-error font-medium">{{ $message }}</span>
                            </label>
                        @enderror
                    </div>

                    <!-- Password -->
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

                    <!-- Confirm Password -->
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

                    <div class="form-control mt-6">
                        <button type="submit" class="btn btn-primary btn-block text-lg font-bold">
                            Sign Up
                        </button>
                    </div>
                </form>

                <div class="divider my-8 text-base-content/30 text-xs uppercase tracking-widest">Already have an account?</div>

                <div class="text-center">
                    <a href="{{ route('login') }}" class="btn btn-outline btn-block border-base-300 hover:bg-base-200 hover:text-base-content hover:border-base-300">
                        Login instead
                    </a>
                </div>
            </div>
        </div>
        
        <footer class="mt-8 text-center text-sm text-base-content/50 font-medium">
            &copy; {{ date('Y') }} OpenLinks. All rights reserved.
        </footer>
    </div>
</x-guest-layout>
