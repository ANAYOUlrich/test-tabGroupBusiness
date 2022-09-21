<x-guest-layout>
    <x-auth-card>
        <x-slot name="logo">
            <a href="/">
                <x-application-logo class="w-20 h-20 fill-current text-gray-500" />
            </a>
        </x-slot>

        <!-- Session Status -->
        <x-auth-session-status class="mb-4" :status="session('status')" />

        <!-- Validation Errors -->
        <x-auth-validation-errors class="mb-4" :errors="$errors" />

        <form method="POST" action="{{ route('login') }}">
            @csrf
            <div class="flex items-center mb-2 justify-center">
                <h1 class="text-xl">{{ __("Connexion") }}</h1>
            </div>
            <hr class="mb-4">

            <!-- Email Address -->
            <div>
                <x-input-label for="email" :value="__('Email')" />

                <x-text-input id="email" class="block mt-1 w-full" type="email" name="email" :value="old('email')" required autofocus />
            </div>

            <!-- Password -->
            <div class="mt-4">
                <x-input-label for="password" :value="__('Mot de passe')" />

                <x-text-input id="password" class="block mt-1 w-full"
                                type="password"
                                name="password"
                                required autocomplete="current-password" />
            </div>

            <!-- Remember Me -->
            <div class="block mt-4">
                <label for="remember_me" class="inline-flex items-center">
                    <input id="remember_me" type="checkbox" class="rounded border-gray-300 text-indigo-600 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50" name="remember">
                    <span class="ml-2 text-sm text-gray-600">{{ __('Garder ma session ouverte') }}</span>
                </label>
            </div>

            <div class="flex items-center justify-center mt-4">
                <x-primary-button class="ml-3">
                    {{ __('Connexion') }}
                </x-primary-button>
            </div>
            <div class="flex items-center justify-center mt-4">
                @if (Route::has('password.request'))
                    <a class="underline" href="{{ route('password.request') }}">
                        {{ __('Mot de passe oublier?') }}
                    </a>
                @endif
            </div>
            <div class="flex items-center justify-center mt-4">
                @if (Route::has('register'))
                <p>{{ __("Vous n'avez pas de compte ?") }}
                    <a class="underline" href="{{ route('register') }}">
                        {{ __(' Inscrivez vous') }}
                    </a>
                </p>

                @endif
            </div>
        </form>
    </x-auth-card>
</x-guest-layout>
