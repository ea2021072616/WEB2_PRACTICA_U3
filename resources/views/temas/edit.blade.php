<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl leading-tight" style="color: #800000;">
            Editar Tema
        </h2>
    </x-slot>

    <div class="py-8">
        <div class="max-w-2xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6">
                    <form action="{{ route('temas.update', $tema) }}" method="POST">
                        @csrf
                        @method('PUT')
                        <div class="mb-4">
                            <label for="nombre" class="block text-sm font-medium mb-2" style="color: #333333;">Nombre del Tema</label>
                            <input type="text" name="nombre" id="nombre" value="{{ old('nombre', $tema->nombre) }}" class="w-full border-gray-300 rounded-md shadow-sm @error('nombre') border-red-500 @enderror">
                            @error('nombre')
                                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>

                        <div class="flex justify-end gap-2">
                            <a href="{{ route('temas.index') }}" class="px-4 py-2 bg-gray-300 text-gray-700 rounded-md">Cancelar</a>
                            <button type="submit" class="px-4 py-2 text-white rounded-md" style="background-color: #800000;">Actualizar</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
