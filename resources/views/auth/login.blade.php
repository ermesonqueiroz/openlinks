<x-guest-layout>
    <div class="min-h-screen flex flex-col justify-center items-center bg-base-200 p-4">
        <div class="card w-full max-w-lg bg-base-100 shadow-2xl">
            <div class="card-body p-8">
                <div class="flex flex-col items-center mb-8">
                    <a href="/" class="text-4xl font-extrabold text-primary mb-2">OpenLinks</a>
                    <p class="text-base-content/60 text-center">The open-source link infrastructure</p>
                </div>

                <form method="POST" action="{{ route('login.store') }}" class="space-y-4">
                    @csrf

                    <!-- Email Address -->
                    <div class="form-control w-full space-y-1">
                        <label class="label">
                            <span class="label-text text-base-content/80">Email Address</span>
                        </label>
                        <input
                            type="email"
                            name="email"
                            placeholder="name@example.com"
                            class="input input-bordered w-full @error('email') input-error @enderror"
                            value="{{ old('email') }}"
                            required
                            autofocus
                            autocomplete="username"
                        />
                        @error('email')
                            <label class="label">
                                <span class="label-text-alt text-error font-medium">{{ $message }}</span>
                            </label>
                        @enderror
                    </div>

                    <!-- Password -->
                    <div class="form-control w-full space-y-1">
                        <div class="flex justify-between items-center">
                            <label class="label">
                                <span class="label-text text-base-content/80">Password</span>
                            </label>
                            @if (Route::has('password.request'))
                                <a class="link link-hover text-xs text-primary font-medium" href="{{ route('password.request') }}">
                                    Forgot password?
                                </a>
                            @endif
                        </div>
                        <input
                            type="password"
                            name="password"
                            placeholder="••••••••"
                            class="input input-bordered w-full @error('password') input-error @enderror"
                            required
                            autocomplete="current-password"
                        />
                        @error('password')
                            <label class="label">
                                <span class="label-text-alt text-error font-medium">{{ $message }}</span>
                            </label>
                        @enderror
                    </div>

                    <!-- Remember Me -->
                    <div class="form-control">
                        <label class="label cursor-pointer justify-start gap-3">
                            <input type="checkbox" name="remember" class="checkbox checkbox-primary checkbox-sm rounded-md" />
                            <span class="label-text text-base-content/70">Remember me</span>
                        </label>
                    </div>

                    <div class="form-control mt-4">
                        <button type="submit" class="btn btn-primary btn-block text-lg font-bold">
                            Sign In
                        </button>
                    </div>
                </form>

                <div class="divider my-2 text-base-content/30 text-xs uppercase tracking-widest">OR</div>

                <div class="text-center">
                    <a href="{{ route('login') }}" class="btn btn-outline btn-block border-base-300 hover:bg-base-200 hover:text-base-content hover:border-base-300">
                        Create an account
                    </a>
                </div>
            </div>
        </div>

        <footer class="mt-8 text-center text-sm text-base-content/50 font-medium">
            &copy; {{ date('Y') }} OpenLinks.
        </footer>
    </div>
</x-guest-layout>
