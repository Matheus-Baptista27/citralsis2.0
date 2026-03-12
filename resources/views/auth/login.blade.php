<x-guest-layout>
    <x-authentication-card>

        <x-slot name="logo">
            <x-application-logo class="w-20 h-20 fill-current text-gray-500" />
        </x-slot>

        <x-validation-errors class="mb-4" />

        @if (session('status'))
            <div class="mb-4 font-medium text-sm text-green-600">
                {{ session('status') }}
            </div>
        @endif

        <form method="POST" action="{{ route('login') }}">
            @csrf

            <!-- Email -->
            <div>
                <x-label for="email" value="{{ __('Email') }}" />
                <x-input id="email" class="block mt-1 w-full"
                         type="email"
                         name="email"
                         :value="old('email')"
                         required autofocus />
            </div>

            <!-- Senha -->
            <div class="mt-4">
                <x-label for="password" value="{{ __('Senha') }}" />
                <x-input id="password" class="block mt-1 w-full"
                         type="password"
                         name="password"
                         required autocomplete="current-password" />
            </div>

            <!-- Remember me -->
            <div class="block mt-4">
                <label for="remember_me" class="flex items-center">
                    <input id="remember_me" type="checkbox"
                           class="rounded border-gray-300 text-indigo-600 shadow-sm focus:ring-indigo-500"
                           name="remember">
                    <span class="ml-2 text-sm text-gray-600">
                        {{ __('Lembrar-me') }}
                    </span>
                </label>
            </div>

            <div class="flex items-center justify-end mt-4">

                @if (Route::has('password.request'))
                    <a class="underline text-sm text-gray-600 hover:text-gray-900"
                       href="{{ route('password.request') }}">
                        {{ __('Esqueceu sua senha?') }}
                    </a>
                @endif

                <x-button class="ml-4">
                    {{ __('Login') }}
                </x-button>

            </div>

        </form>

        {{-- Registro desativado --}}
         {{--<div class="mt-4 text-center">
            <a href="{{ route('register') }}"
               class="underline text-sm text-gray-600 hover:text-gray-900">
                {{ __("Não tem uma conta? Cadastre-se") }}
            </a>
        </div>--}}

        <div class="mt-6 text-center border-t pt-4">
            <p class="text-base font-semibold text-blue-600 tracking-wide">
                CITRAL SIS 2.0
            </p>
            <p class="text-xs text-gray-400 mt-1">
                © {{ date('Y') }} Todos os direitos reservados
            </p>
        </div>
    </x-authentication-card>
</x-guest-layout>
