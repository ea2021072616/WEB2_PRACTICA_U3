<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl leading-tight" style="color: #800000;">
            Editar Docente
        </h2>
    </x-slot>

    <div class="py-8">
        <div class="max-w-2xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6">
                    <form action="{{ route('docentes.update', $docente) }}" method="POST">
                        @csrf
                        @method('PUT')
                        <div class="mb-4">
                            <label for="user_id" class="block text-sm font-medium mb-2" style="color: #333333;">Usuario</label>
                            <select name="user_id" id="user_id" class="w-full border-gray-300 rounded-md shadow-sm @error('user_id') border-red-500 @enderror">
                                <option value="">Seleccione un usuario</option>
                                @foreach($users as $user)
                                    <option value="{{ $user->id }}" {{ old('user_id', $docente->user_id) == $user->id ? 'selected' : '' }}>{{ $user->email }}</option>
                                @endforeach
                            </select>
                            @error('user_id')
                                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>

                        <div class="mb-4">
                            <label for="apellidos" class="block text-sm font-medium mb-2" style="color: #333333;">Apellidos</label>
                            <input type="text" name="apellidos" id="apellidos" value="{{ old('apellidos', $docente->apellidos) }}" class="w-full border-gray-300 rounded-md shadow-sm @error('apellidos') border-red-500 @enderror">
                            @error('apellidos')
                                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>

                        <div class="mb-4">
                            <label for="nombres" class="block text-sm font-medium mb-2" style="color: #333333;">Nombres</label>
                            <input type="text" name="nombres" id="nombres" value="{{ old('nombres', $docente->nombres) }}" class="w-full border-gray-300 rounded-md shadow-sm @error('nombres') border-red-500 @enderror">
                            @error('nombres')
                                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>

                        <div class="flex justify-end gap-2">
                            <a href="{{ route('docentes.index') }}" class="px-4 py-2 bg-gray-300 text-gray-700 rounded-md">Cancelar</a>
                            <button type="submit" class="px-4 py-2 text-white rounded-md" style="background-color: #800000;">Actualizar</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
