<x-guest-layout>
    <x-auth-card>
        <x-slot name="logo">
            <a href="/">
                <x-application-logo class="w-20 h-20 fill-current text-gray-500" />
            </a>
        </x-slot>

        <!-- Validation Errors -->
        <x-auth-validation-errors class="mb-4" :errors="$errors" />

        <form method="POST" action="{{ route('register') }}">
            @csrf
            <div class="flex items-center mb-2 justify-center">
                <h1 class="text-xl">{{ __('Enregistrement') }}</h1>
            </div>
            <hr class="mb-4">
            <!-- Name -->
            <div>
                <x-input-label for="name" :value="__('Nom & Prénoms')" />

                <x-text-input id="name" class="block mt-1 w-full" type="text" name="name" :value="old('name')"
                    required autofocus />
            </div>

            <!-- Email Address -->
            <div class="mt-4">
                <x-input-label for="email" :value="__('Email')" />

                <x-text-input id="email" class="block mt-1 w-full" type="email" name="email" :value="old('email')"
                    required />
            </div>

            <!-- Password -->
            <div class="mt-4">
                <x-input-label for="password" :value="__('Mot de passe')" />

                <x-text-input id="password" class="block mt-1 w-full" type="password" name="password" required
                    autocomplete="new-password" />
            </div>

            <!-- Confirm Password -->
            <div class="mt-4">
                <x-input-label for="password_confirmation" :value="__('Confirmer le mot de passe')" />

                <x-text-input id="password_confirmation" class="block mt-1 w-full" type="password"
                    name="password_confirmation" required />
            </div>

            <div class="flex items-center justify-center mt-4">
                <x-primary-button class="ml-3">
                    {{ __('Soumettre') }}
                </x-primary-button>
            </div>

            <div class="flex items-center justify-center mt-4">
                @if (Route::has('login'))
                    <p>{{ __('Vous avez un compte ?') }}
                        <a class="underline" href="{{ route('login') }}">
                            {{ __(' Connectez vous') }}
                        </a>
                    </p>
                @endif
            </div>
        </form>
    </x-auth-card>
</x-guest-layout>
