<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl leading-tight" style="color: #800000;">
            Reportes de Atenciones
        </h2>
    </x-slot>

    <div class="py-8">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg mb-4">
                <div class="p-6">
                    <form method="GET" class="grid grid-cols-1 md:grid-cols-5 gap-4">
                        <div>
                            <label class="block text-sm font-medium mb-1" style="color: #333333;">Semestre</label>
                            <select name="semestre" class="w-full border-gray-300 rounded-md shadow-sm">
                                <option value="">Todos</option>
                                @foreach($semestres as $sem)
                                    <option value="{{ $sem }}" {{ request('semestre') == $sem ? 'selected' : '' }}>{{ $sem }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div>
                            <label class="block text-sm font-medium mb-1" style="color: #333333;">Docente</label>
                            <select name="docente_id" class="w-full border-gray-300 rounded-md shadow-sm">
                                <option value="">Todos</option>
                                @foreach($docentes as $docente)
                                    <option value="{{ $docente->id }}" {{ request('docente_id') == $docente->id ? 'selected' : '' }}>
                                        {{ $docente->nombres }} {{ $docente->apellidos }}
                                    </option>
                                @endforeach
                            </select>
                        </div>
                        <div>
                            <label class="block text-sm font-medium mb-1" style="color: #333333;">Tema</label>
                            <select name="tema_id" class="w-full border-gray-300 rounded-md shadow-sm">
                                <option value="">Todos</option>
                                @foreach($temas as $tema)
                                    <option value="{{ $tema->id }}" {{ request('tema_id') == $tema->id ? 'selected' : '' }}>
                                        {{ $tema->nombre }}
                                    </option>
                                @endforeach
                            </select>
                        </div>
                        <div>
                            <label class="block text-sm font-medium mb-1" style="color: #333333;">Desde</label>
                            <input type="date" name="fecha_desde" value="{{ request('fecha_desde') }}" class="w-full border-gray-300 rounded-md shadow-sm">
                        </div>
                        <div>
                            <label class="block text-sm font-medium mb-1" style="color: #333333;">Hasta</label>
                            <input type="date" name="fecha_hasta" value="{{ request('fecha_hasta') }}" class="w-full border-gray-300 rounded-md shadow-sm">
                        </div>
                        <div class="flex items-end md:col-span-5">
                            <button type="submit" class="px-4 py-2 text-white rounded-md mr-2" style="background-color: #800000;">Generar Reporte</button>
                            <a href="{{ route('reportes') }}" class="px-4 py-2 bg-gray-300 text-gray-700 rounded-md">Limpiar</a>
                        </div>
                    </form>
                </div>
            </div>

            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg mb-4">
                <div class="p-6">
                    <h3 class="text-lg font-semibold mb-4" style="color: #800000;">Resumen</h3>
                    <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
                        <div class="text-center p-4 border rounded" style="border-color: #800000;">
                            <div class="text-3xl font-bold" style="color: #800000;">{{ $atenciones->count() }}</div>
                            <div class="text-sm" style="color: #333333;">Total Atenciones</div>
                        </div>
                        <div class="text-center p-4 border rounded" style="border-color: #800000;">
                            <div class="text-3xl font-bold" style="color: #800000;">{{ $atenciones->pluck('docente_id')->unique()->count() }}</div>
                            <div class="text-sm" style="color: #333333;">Docentes Participantes</div>
                        </div>
                        <div class="text-center p-4 border rounded" style="border-color: #800000;">
                            <div class="text-3xl font-bold" style="color: #800000;">{{ $atenciones->pluck('estudiante_id')->unique()->count() }}</div>
                            <div class="text-sm" style="color: #333333;">Estudiantes Atendidos</div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6">
                    <h3 class="text-lg font-semibold mb-4" style="color: #800000;">Detalle de Atenciones</h3>
                    <div class="overflow-x-auto">
                        <table class="min-w-full divide-y divide-gray-200">
                            <thead>
                                <tr style="background-color: #F2F2F2;">
                                    <th class="px-4 py-3 text-left text-xs font-medium uppercase tracking-wider" style="color: #333333;">Semestre</th>
                                    <th class="px-4 py-3 text-left text-xs font-medium uppercase tracking-wider" style="color: #333333;">Fecha</th>
                                    <th class="px-4 py-3 text-left text-xs font-medium uppercase tracking-wider" style="color: #333333;">Docente</th>
                                    <th class="px-4 py-3 text-left text-xs font-medium uppercase tracking-wider" style="color: #333333;">Estudiante</th>
                                    <th class="px-4 py-3 text-left text-xs font-medium uppercase tracking-wider" style="color: #333333;">Tema</th>
                                </tr>
                            </thead>
                            <tbody class="bg-white divide-y divide-gray-200">
                                @forelse($atenciones as $atencion)
                                    <tr>
                                        <td class="px-4 py-3 whitespace-nowrap text-sm" style="color: #333333;">{{ $atencion->semestre ?? 'N/A' }}</td>
                                        <td class="px-4 py-3 whitespace-nowrap text-sm" style="color: #333333;">{{ $atencion->fecha ? $atencion->fecha->format('d/m/Y') : 'Sin fecha' }}</td>
                                        <td class="px-4 py-3 text-sm" style="color: #333333;">{{ $atencion->docente?->nombres ?? 'N/A' }} {{ $atencion->docente?->apellidos ?? '' }}</td>
                                        <td class="px-4 py-3 text-sm" style="color: #333333;">{{ $atencion->estudiante?->nombres ?? 'N/A' }} {{ $atencion->estudiante?->apellidos ?? '' }}</td>
                                        <td class="px-4 py-3 text-sm" style="color: #333333;">{{ $atencion->tema?->nombre ?? 'Sin tema' }}</td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="5" class="px-4 py-3 text-center text-gray-500">No hay atenciones para los filtros seleccionados</td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
