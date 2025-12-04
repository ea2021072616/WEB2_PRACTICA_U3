<x-guest-layout>
    <div class="mb-4 text-center">
        <h2 class="text-2xl font-bold" style="color: #800000;">Crear Cuenta</h2>
        <p class="text-sm text-gray-500 mt-1">Regístrate con tu correo institucional @upt.edu.pe</p>
    </div>

    <form method="POST" action="{{ route('register') }}">
        @csrf

        <!-- Name -->
        <div>
            <x-input-label for="name" value="Nombre Completo" />
            <x-text-input id="name" class="block mt-1 w-full" type="text" name="name" :value="old('name')" required autofocus autocomplete="name" placeholder="Juan Pérez García" />
            <x-input-error :messages="$errors->get('name')" class="mt-2" />
        </div>

        <!-- Email Address -->
        <div class="mt-4">
            <x-input-label for="email" value="Correo Electrónico" />
            <x-text-input id="email" class="block mt-1 w-full" type="email" name="email" :value="old('email')" required autocomplete="username" placeholder="usuario@upt.edu.pe" />
            <x-input-error :messages="$errors->get('email')" class="mt-2" />
            <p class="text-xs text-gray-500 mt-1">Debe ser un correo @upt.edu.pe</p>
        </div>

        <!-- Password -->
        <div class="mt-4">
            <x-input-label for="password" value="Contraseña" />

            <x-text-input id="password" class="block mt-1 w-full"
                            type="password"
                            name="password"
                            required autocomplete="new-password"
                            placeholder="••••••••" />

            <x-input-error :messages="$errors->get('password')" class="mt-2" />
        </div>

        <!-- Confirm Password -->
        <div class="mt-4">
            <x-input-label for="password_confirmation" value="Confirmar Contraseña" />

            <x-text-input id="password_confirmation" class="block mt-1 w-full"
                            type="password"
                            name="password_confirmation" required autocomplete="new-password"
                            placeholder="••••••••" />

            <x-input-error :messages="$errors->get('password_confirmation')" class="mt-2" />
        </div>

        <div class="mt-6">
            <button type="submit" class="w-full py-3 px-4 text-white font-semibold rounded-md transition" style="background-color: #800000;">
                Registrarse
            </button>
        </div>

        <div class="text-center mt-4">
            <a class="text-sm hover:underline" style="color: #800000;" href="{{ route('login') }}">
                ¿Ya tienes cuenta? Inicia Sesión
            </a>
        </div>
    </form>
</x-guest-layout>
