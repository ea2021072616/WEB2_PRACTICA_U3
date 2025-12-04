<x-guest-layout>
    <div class="mb-4 text-center">
        <h2 class="text-2xl font-bold" style="color: #800000;">Iniciar Sesión</h2>
        <p class="text-sm text-gray-500 mt-1">Ingresa tus credenciales para acceder</p>
    </div>

    <!-- Session Status -->
    <x-auth-session-status class="mb-4" :status="session('status')" />

    <form method="POST" action="{{ route('login') }}">
        @csrf

        <!-- Email Address -->
        <div>
            <x-input-label for="email" value="Correo Electrónico" />
            <x-text-input id="email" class="block mt-1 w-full" type="email" name="email" :value="old('email')" required autofocus autocomplete="username" placeholder="usuario@upt.edu.pe" />
            <x-input-error :messages="$errors->get('email')" class="mt-2" />
        </div>

        <!-- Password -->
        <div class="mt-4">
            <x-input-label for="password" value="Contraseña" />

            <x-text-input id="password" class="block mt-1 w-full"
                            type="password"
                            name="password"
                            required autocomplete="current-password"
                            placeholder="••••••••" />

            <x-input-error :messages="$errors->get('password')" class="mt-2" />
        </div>

        <!-- Remember Me -->
        <div class="block mt-4">
            <label for="remember_me" class="inline-flex items-center">
                <input id="remember_me" type="checkbox" class="rounded border-gray-300 shadow-sm focus:ring-red-500" style="color: #800000;" name="remember">
                <span class="ms-2 text-sm text-gray-600">Recordarme</span>
            </label>
        </div>

        <div class="mt-6">
            <button type="submit" class="w-full py-3 px-4 text-white font-semibold rounded-md transition" style="background-color: #800000;">
                Iniciar Sesión
            </button>
        </div>

        <div class="flex items-center justify-between mt-4">
            @if (Route::has('password.request'))
                <a class="text-sm hover:underline" style="color: #800000;" href="{{ route('password.request') }}">
                    ¿Olvidaste tu contraseña?
                </a>
            @endif

            @if (Route::has('register'))
                <a class="text-sm hover:underline" style="color: #800000;" href="{{ route('register') }}">
                    ¿No tienes cuenta? Regístrate
                </a>
            @endif
        </div>
    </form>
</x-guest-layout>
