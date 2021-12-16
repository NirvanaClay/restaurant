<x-guest-layout>
    <div id='register'>
        <x-auth-card>
            <x-slot name="logo">
                <h2>Join Guy's Rewards</h2>
            </x-slot>

            <div class='register-main'>

                <!-- Validation Errors -->
                <x-auth-validation-errors class="mb-4" :errors="$errors" />

                <form method="POST" action="{{ route('register') }}">
                    @csrf

                    <!-- Name -->
                    <div class='row'>
                        <x-label class='col' for="first-name" :value="__('First Name')" />
                        <x-label class='col' for="last-name" :value="__('Last Name')" />
                    </div>

                    <div class='row'>
                        <x-input class='col' id="first-name" class="mt-1 w-full" type="text" name="firstName" :value="old('first-name')" required autofocus />
                        <x-input class='col' id="last-name" class="mt-1 w-full" type="text" name="lastName" :value="old('last-name')" required autofocus />
                    </div>

                    <!-- Email Address -->
                    <div class="mt-4 form-group">
                        <x-label class='email-label' for="email" :value="__('Email')" />

                        <x-input id="email" class="block mt-1 w-full" type="email" name="email" :value="old('email')" required />
                    </div>

                    <!-- Password -->
                    <div class="mt-4 row">
                        <x-label class='col' for="password" :value="__('Password')" />
                        <x-label class='col' for="password_confirmation" :value="__('Confirm Password')" />

                    <!-- Confirm Password -->
                    {{-- <div class="mt-4 form-group"> --}}
                    </div>
                    <div class='row'>
                        <x-input class='col' id="password" class="mt-1 w-full"
                                    type="password"
                                    name="password"
                                    required autocomplete="new-password" />
                        <x-input class='col' id="password_confirmation" class="mt-1 w-full"
                                    type="password"
                                    name="password_confirmation" required />
                    </div>

                    <div class="flex items-center justify-end my-4">
                        <a class="underline text-sm text-gray-600 hover:text-gray-900 registered-q" href="{{ route('login') }}">
                            {{ __('Already registered? Log in.') }}
                        </a>

                        <x-button class="register-button mt-3">
                            {{ __('Register') }}
                        </x-button>
                    </div>
                </form>
            </div>
        </x-auth-card>
    </div>
</x-guest-layout>
