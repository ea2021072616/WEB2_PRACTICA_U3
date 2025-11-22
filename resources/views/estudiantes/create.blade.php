<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl leading-tight" style="color: #800000;">
            Nuevo Estudiante
        </h2>
    </x-slot>

    <div class="py-8">
        <div class="max-w-2xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6">
                    <form action="{{ route('estudiantes.store') }}" method="POST">
                        @csrf
                        <div class="mb-4">
                            <label for="codigo" class="block text-sm font-medium mb-2" style="color: #333333;">Código</label>
                            <input type="text" name="codigo" id="codigo" value="{{ old('codigo') }}" class="w-full border-gray-300 rounded-md shadow-sm @error('codigo') border-red-500 @enderror">
                            @error('codigo')
                                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>

                        <div class="mb-4">
                            <label for="apellidos" class="block text-sm font-medium mb-2" style="color: #333333;">Apellidos</label>
                            <input type="text" name="apellidos" id="apellidos" value="{{ old('apellidos') }}" class="w-full border-gray-300 rounded-md shadow-sm @error('apellidos') border-red-500 @enderror">
                            @error('apellidos')
                                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>

                        <div class="mb-4">
                            <label for="nombres" class="block text-sm font-medium mb-2" style="color: #333333;">Nombres</label>
                            <input type="text" name="nombres" id="nombres" value="{{ old('nombres') }}" class="w-full border-gray-300 rounded-md shadow-sm @error('nombres') border-red-500 @enderror">
                            @error('nombres')
                                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>

                        <div class="flex justify-end gap-2">
                            <a href="{{ route('estudiantes.index') }}" class="px-4 py-2 bg-gray-300 text-gray-700 rounded-md">Cancelar</a>
                            <button type="submit" class="px-4 py-2 text-white rounded-md" style="background-color: #800000;">Guardar</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
