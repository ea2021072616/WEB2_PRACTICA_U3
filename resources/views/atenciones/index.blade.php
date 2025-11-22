<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center">
            <h2 class="font-semibold text-xl leading-tight" style="color: #800000;">
                Atenciones de Consejería
            </h2>
            <a href="{{ route('atenciones.create') }}" class="px-4 py-2 text-white rounded-md" style="background-color: #800000;">
                Nueva Atención
            </a>
        </div>
    </x-slot>

    <div class="py-8">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            @if(session('success'))
                <div class="mb-4 p-4 bg-green-100 border border-green-400 text-green-700 rounded">
                    {{ session('success') }}
                </div>
            @endif

            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg mb-4">
                <div class="p-6">
                    <form method="GET" class="grid grid-cols-1 md:grid-cols-3 gap-4">
                        <div>
                            <label class="block text-sm font-medium mb-1" style="color: #333333;">Semestre</label>
                            <input type="text" name="semestre" value="{{ request('semestre') }}" class="w-full border-gray-300 rounded-md shadow-sm" placeholder="Ej: 2024-1">
                        </div>
                        <div>
                            <label class="block text-sm font-medium mb-1" style="color: #333333;">Desde</label>
                            <input type="date" name="fecha_desde" value="{{ request('fecha_desde') }}" class="w-full border-gray-300 rounded-md shadow-sm">
                        </div>
                        <div>
                            <label class="block text-sm font-medium mb-1" style="color: #333333;">Hasta</label>
                            <input type="date" name="fecha_hasta" value="{{ request('fecha_hasta') }}" class="w-full border-gray-300 rounded-md shadow-sm">
                        </div>
                        <div class="flex items-end">
                            <button type="submit" class="px-4 py-2 text-white rounded-md mr-2" style="background-color: #800000;">Filtrar</button>
                            <a href="{{ route('atenciones.index') }}" class="px-4 py-2 bg-gray-300 text-gray-700 rounded-md">Limpiar</a>
                        </div>
                    </form>
                </div>
            </div>

            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6">
                    <div class="overflow-x-auto">
                        <table class="min-w-full divide-y divide-gray-200">
                            <thead>
                                <tr style="background-color: #F2F2F2;">
                                    <th class="px-6 py-3 text-left text-xs font-medium uppercase tracking-wider" style="color: #333333;">Semestre</th>
                                    <th class="px-6 py-3 text-left text-xs font-medium uppercase tracking-wider" style="color: #333333;">Fecha</th>
                                    <th class="px-6 py-3 text-left text-xs font-medium uppercase tracking-wider" style="color: #333333;">Estudiante</th>
                                    <th class="px-6 py-3 text-left text-xs font-medium uppercase tracking-wider" style="color: #333333;">Docente</th>
                                    <th class="px-6 py-3 text-left text-xs font-medium uppercase tracking-wider" style="color: #333333;">Tema</th>
                                    <th class="px-6 py-3 text-left text-xs font-medium uppercase tracking-wider" style="color: #333333;">Acciones</th>
                                </tr>
                            </thead>
                            <tbody class="bg-white divide-y divide-gray-200">
                                @foreach($atenciones as $atencion)
                                    <tr>
                                        <td class="px-6 py-4 whitespace-nowrap" style="color: #333333;">{{ $atencion->semestre }}</td>
                                        <td class="px-6 py-4 whitespace-nowrap" style="color: #333333;">{{ $atencion->fecha->format('d/m/Y') }}</td>
                                        <td class="px-6 py-4 whitespace-nowrap" style="color: #333333;">{{ $atencion->estudiante->nombres }} {{ $atencion->estudiante->apellidos }}</td>
                                        <td class="px-6 py-4 whitespace-nowrap" style="color: #333333;">{{ $atencion->docente->nombres }} {{ $atencion->docente->apellidos }}</td>
                                        <td class="px-6 py-4" style="color: #333333;">{{ $atencion->tema->nombre }}</td>
                                        <td class="px-6 py-4 whitespace-nowrap text-sm">
                                            <a href="{{ route('atenciones.show', $atencion) }}" class="text-green-600 hover:text-green-900 mr-3">Ver</a>
                                            <a href="{{ route('atenciones.edit', $atencion) }}" class="text-blue-600 hover:text-blue-900 mr-3">Editar</a>
                                            <form action="{{ route('atenciones.destroy', $atencion) }}" method="POST" class="inline">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="text-red-600 hover:text-red-900" onclick="return confirm('¿Está seguro?')">Eliminar</button>
                                            </form>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                    <div class="mt-4">
                        {{ $atenciones->links() }}
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
