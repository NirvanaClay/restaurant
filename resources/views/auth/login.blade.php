<x-guest-layout>
    <div class='login-register fluid-container'>
        <h2>If you are a Guy's Rewards member, log in now! If not, join now for great deals, starting with your first purchase!</h2>
        <div class='login-main row my-5 mx-3'>
            <section class='login-section col-12 col-md-6'>
                <x-auth-card>
                    <x-slot name="logo">
                        <h3 class='mb-3'>Log In</h3>
                        {{-- <a href="/">
                            <x-application-logo class="w-20 h-20 fill-current text-gray-500 shit" />
                        </a> --}}
                    </x-slot>

                    <!-- Session Status -->
                    <x-auth-session-status class="mb-4" :status="session('status')" />

                    <!-- Validation Errors -->
                    <x-auth-validation-errors class="mb-4" :errors="$errors" />

                    <form method="POST" action="{{ route('login') }}">
                        @csrf
                        <div class="form-group mb-2">
                            <x-label for="email" :value="__('Email')" />
                            <x-input id="email" class="block mt-1 w-full" type="email" name="email" :value="old('email')" required autofocus />
                        </div>
                        <div class="form-group">
                            <x-label for="password" :value="__('Password')" />
                            <x-input id="password" class="block mt-1 w-full"
                                type="password"
                                name="password"
                                required autocomplete="current-password" />
                        </div>
                        <div class="block mt-4">
                            <label for="remember_me" class="inline-flex items-center">
                                <input id="remember_me" type="checkbox" class="rounded border-gray-300 text-indigo-600 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50" name="remember">
                                <span class="ml-2 text-sm text-gray-600">{{ __('Remember me') }}</span>
                            </label>
                        </div>

                        <div class="flex items-center justify-end mt-4">
                            @if (Route::has('password.request'))
                                <a class="underline text-sm text-gray-600 hover:text-gray-900" href="{{ route('password.request') }}">
                                    {{ __('Forgot your password?') }}
                                </a>
                            @endif

                            <x-button class="ml-3 btn btn-primary mt-2">
                                {{ __('Log in') }}
                            </x-button>
                        </div>
                    </form>
                </x-auth-card>
            </section>
            <section class='register-section col-12 col-md-6'>
                <h2>Not a member?</h2>
                <p>Join now to earn towards rewards with every purchase.</p>
                <a href='/register'><button>Join Now</button></a>
            </section>
        </div>
    </div>
</x-guest-layout>
