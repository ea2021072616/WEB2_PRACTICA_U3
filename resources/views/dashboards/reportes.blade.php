<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl leading-tight" style="color: #800000;">
            {{ __('Reportes de Atenciones') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <!-- Formulario de filtros -->
            <div class="bg-white p-6 rounded-lg shadow-lg mb-6">
                <h3 class="text-lg font-semibold mb-4" style="color: #800000;">Filtros de Búsqueda</h3>
                <form method="GET" action="{{ route('admin.reportes') }}">
                    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-4">
                        <div>
                            <label for="semestre" class="block text-sm font-medium mb-2" style="color: #800000;">Semestre</label>
                            <input type="text" id="semestre" name="semestre" value="{{ request('semestre') }}" 
                                   placeholder="Ej: 2024-1" 
                                   class="w-full border-gray-300 rounded-md shadow-sm focus:border-red-500 focus:ring focus:ring-red-200">
                        </div>
                        
                        <div>
                            <label for="docente_id" class="block text-sm font-medium mb-2" style="color: #800000;">Docente</label>
                            <select id="docente_id" name="docente_id" 
                                    class="w-full border-gray-300 rounded-md shadow-sm focus:border-red-500 focus:ring focus:ring-red-200">
                                <option value="">Todos</option>
                                @foreach($docentes as $docente)
                                    <option value="{{ $docente->id }}" {{ request('docente_id') == $docente->id ? 'selected' : '' }}>
                                        {{ $docente->nombres }} {{ $docente->apellidos }}
                                    </option>
                                @endforeach
                            </select>
                        </div>
                        
                        <div>
                            <label for="tema_id" class="block text-sm font-medium mb-2" style="color: #800000;">Tema</label>
                            <select id="tema_id" name="tema_id" 
                                    class="w-full border-gray-300 rounded-md shadow-sm focus:border-red-500 focus:ring focus:ring-red-200">
                                <option value="">Todos</option>
                                @foreach($temas as $tema)
                                    <option value="{{ $tema->id }}" {{ request('tema_id') == $tema->id ? 'selected' : '' }}>
                                        {{ $tema->nombre }}
                                    </option>
                                @endforeach
                            </select>
                        </div>
                        
                        <div>
                            <label for="fecha_desde" class="block text-sm font-medium mb-2" style="color: #800000;">Fecha Desde</label>
                            <input type="date" id="fecha_desde" name="fecha_desde" value="{{ request('fecha_desde') }}" 
                                   class="w-full border-gray-300 rounded-md shadow-sm focus:border-red-500 focus:ring focus:ring-red-200">
                        </div>
                        
                        <div>
                            <label for="fecha_hasta" class="block text-sm font-medium mb-2" style="color: #800000;">Fecha Hasta</label>
                            <input type="date" id="fecha_hasta" name="fecha_hasta" value="{{ request('fecha_hasta') }}" 
                                   class="w-full border-gray-300 rounded-md shadow-sm focus:border-red-500 focus:ring focus:ring-red-200">
                        </div>
                        
                        <div class="flex items-end">
                            <button type="submit" class="w-full px-4 py-2 rounded-md font-semibold text-sm text-white" style="background-color: #800000;">
                                Filtrar
                            </button>
                        </div>
                    </div>
                </form>
            </div>

            <!-- Tabla de resultados -->
            <div class="bg-white p-6 rounded-lg shadow-lg">
                <h3 class="text-lg font-semibold mb-4" style="color: #800000;">
                    Resultados ({{ $atenciones->total() }} atenciones encontradas)
                </h3>
                
                <div class="overflow-x-auto">
                    <table class="min-w-full">
                        <thead>
                            <tr style="background-color: #F2F2F2;">
                                <th class="px-4 py-2 text-left" style="color: #800000;">Semestre</th>
                                <th class="px-4 py-2 text-left" style="color: #800000;">Fecha</th>
                                <th class="px-4 py-2 text-left" style="color: #800000;">Hora</th>
                                <th class="px-4 py-2 text-left" style="color: #800000;">Estudiante</th>
                                <th class="px-4 py-2 text-left" style="color: #800000;">Docente</th>
                                <th class="px-4 py-2 text-left" style="color: #800000;">Tema</th>
                                <th class="px-4 py-2 text-left" style="color: #800000;">Acciones</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($atenciones as $atencion)
                            <tr class="border-b">
                                <td class="px-4 py-2" style="color: #333333;">{{ $atencion->semestre }}</td>
                                <td class="px-4 py-2" style="color: #333333;">{{ $atencion->fecha->format('d/m/Y') }}</td>
                                <td class="px-4 py-2" style="color: #333333;">{{ $atencion->hora ? $atencion->hora->format('H:i') : '--:--' }}</td>
                                <td class="px-4 py-2" style="color: #333333;">
                                    {{ $atencion->estudiante->nombres }} {{ $atencion->estudiante->apellidos }}
                                    <br><span class="text-xs text-gray-500">{{ $atencion->estudiante->codigo }}</span>
                                </td>
                                <td class="px-4 py-2" style="color: #333333;">{{ $atencion->docente->nombres }} {{ $atencion->docente->apellidos }}</td>
                                <td class="px-4 py-2" style="color: #333333;">{{ $atencion->tema->nombre }}</td>
                                <td class="px-4 py-2">
                                    <a href="{{ route('atenciones.show', $atencion->id) }}" 
                                       class="px-3 py-1 rounded text-white text-sm" 
                                       style="background-color: #800000;">Ver</a>
                                </td>
                            </tr>
                            @empty
                            <tr>
                                <td colspan="7" class="px-4 py-4 text-center" style="color: #333333;">
                                    No se encontraron atenciones con los filtros aplicados
                                </td>
                            </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
                
                <!-- Paginación -->
                <div class="mt-4">
                    {{ $atenciones->links() }}
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
