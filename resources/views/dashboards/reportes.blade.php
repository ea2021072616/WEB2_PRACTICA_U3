<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl leading-tight" style="color: #800000;">
            📊 {{ __('Reportes y Estadísticas') }}
        </h2>
    </x-slot>

    <div class="py-6">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">

            <!-- ========== TARJETAS DE RESUMEN ========== -->
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-4 mb-6">
                <!-- Total Atenciones -->
                <div class="bg-gradient-to-br from-red-800 to-red-900 rounded-xl shadow-lg p-5 text-white">
                    <div class="flex items-center justify-between">
                        <div>
                            <p class="text-red-200 text-sm font-medium">Total Atenciones</p>
                            <p class="text-3xl font-bold">{{ $totalAtenciones }}</p>
                        </div>
                        <div class="bg-white bg-opacity-20 rounded-full p-3">
                            <svg class="w-8 h-8" fill="currentColor" viewBox="0 0 20 20">
                                <path d="M9 2a1 1 0 000 2h2a1 1 0 100-2H9z"/>
                                <path fill-rule="evenodd" d="M4 5a2 2 0 012-2 3 3 0 003 3h2a3 3 0 003-3 2 2 0 012 2v11a2 2 0 01-2 2H6a2 2 0 01-2-2V5zm3 4a1 1 0 000 2h.01a1 1 0 100-2H7zm3 0a1 1 0 000 2h3a1 1 0 100-2h-3zm-3 4a1 1 0 100 2h.01a1 1 0 100-2H7zm3 0a1 1 0 100 2h3a1 1 0 100-2h-3z" clip-rule="evenodd"/>
                            </svg>
                        </div>
                    </div>
                </div>

                <!-- Estudiantes Atendidos -->
                <div class="bg-gradient-to-br from-blue-600 to-blue-800 rounded-xl shadow-lg p-5 text-white">
                    <div class="flex items-center justify-between">
                        <div>
                            <p class="text-blue-200 text-sm font-medium">Estudiantes Atendidos</p>
                            <p class="text-3xl font-bold">{{ $estudiantesAtendidos }}<span class="text-lg">/{{ $totalEstudiantes }}</span></p>
                            <p class="text-blue-200 text-xs mt-1">{{ $porcentajeEstudiantesAtendidos }}% del total</p>
                        </div>
                        <div class="bg-white bg-opacity-20 rounded-full p-3">
                            <svg class="w-8 h-8" fill="currentColor" viewBox="0 0 20 20">
                                <path d="M10.394 2.08a1 1 0 00-.788 0l-7 3a1 1 0 000 1.84L5.25 8.051a.999.999 0 01.356-.257l4-1.714a1 1 0 11.788 1.838L7.667 9.088l1.94.831a1 1 0 00.787 0l7-3a1 1 0 000-1.838l-7-3zM3.31 9.397L5 10.12v4.102a8.969 8.969 0 00-1.05-.174 1 1 0 01-.89-.89 11.115 11.115 0 01.25-3.762zM9.3 16.573A9.026 9.026 0 007 14.935v-3.957l1.818.78a3 3 0 002.364 0l5.508-2.361a11.026 11.026 0 01.25 3.762 1 1 0 01-.89.89 8.968 8.968 0 00-5.35 2.524 1 1 0 01-1.4 0z"/>
                            </svg>
                        </div>
                    </div>
                </div>

                <!-- Docentes Activos -->
                <div class="bg-gradient-to-br from-green-600 to-green-800 rounded-xl shadow-lg p-5 text-white">
                    <div class="flex items-center justify-between">
                        <div>
                            <p class="text-green-200 text-sm font-medium">Docentes</p>
                            <p class="text-3xl font-bold">{{ $totalDocentes }}</p>
                            <p class="text-green-200 text-xs mt-1">~{{ $promedioAtencionesDocente }} atenciones c/u</p>
                        </div>
                        <div class="bg-white bg-opacity-20 rounded-full p-3">
                            <svg class="w-8 h-8" fill="currentColor" viewBox="0 0 20 20">
                                <path fill-rule="evenodd" d="M10 9a3 3 0 100-6 3 3 0 000 6zm-7 9a7 7 0 1114 0H3z" clip-rule="evenodd"/>
                            </svg>
                        </div>
                    </div>
                </div>

                <!-- Temas Disponibles -->
                <div class="bg-gradient-to-br from-purple-600 to-purple-800 rounded-xl shadow-lg p-5 text-white">
                    <div class="flex items-center justify-between">
                        <div>
                            <p class="text-purple-200 text-sm font-medium">Temas</p>
                            <p class="text-3xl font-bold">{{ $temas->count() }}</p>
                            <p class="text-purple-200 text-xs mt-1">Categorías de asesoría</p>
                        </div>
                        <div class="bg-white bg-opacity-20 rounded-full p-3">
                            <svg class="w-8 h-8" fill="currentColor" viewBox="0 0 20 20">
                                <path d="M7 3a1 1 0 000 2h6a1 1 0 100-2H7zM4 7a1 1 0 011-1h10a1 1 0 110 2H5a1 1 0 01-1-1zM2 11a2 2 0 012-2h12a2 2 0 012 2v4a2 2 0 01-2 2H4a2 2 0 01-2-2v-4z"/>
                            </svg>
                        </div>
                    </div>
                </div>
            </div>

            <!-- ========== GRÁFICOS PRINCIPALES ========== -->
            <div class="grid grid-cols-1 lg:grid-cols-2 gap-6 mb-6">

                <!-- Gráfico: Atenciones por Mes -->
                <div class="bg-white rounded-xl shadow-lg p-6">
                    <h3 class="text-lg font-bold mb-4 flex items-center" style="color: #800000;">
                        📈 Atenciones por Mes (Últimos 6 meses)
                    </h3>
                    <div class="space-y-3">
                        @php
                            $maxMes = $atencionesPorMes->max('total') ?: 1;
                        @endphp
                        @forelse($atencionesPorMes as $mes)
                            <div class="flex items-center">
                                <div class="w-16 text-sm font-medium text-gray-600">{{ $mes['label'] }}</div>
                                <div class="flex-1 mx-3">
                                    <div class="h-8 bg-gray-200 rounded-full overflow-hidden">
                                        <div class="h-full rounded-full flex items-center justify-end pr-2 text-white text-xs font-bold transition-all duration-500"
                                             style="width: {{ ($mes['total'] / $maxMes) * 100 }}%; background: linear-gradient(90deg, #800000, #b91c1c);">
                                            {{ $mes['total'] }}
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @empty
                            <p class="text-gray-500 text-center py-4">Sin datos de atenciones por mes</p>
                        @endforelse
                    </div>
                </div>

                <!-- Gráfico: Atenciones por Día de la Semana -->
                <div class="bg-white rounded-xl shadow-lg p-6">
                    <h3 class="text-lg font-bold mb-4 flex items-center" style="color: #800000;">
                        📅 Distribución por Día de la Semana
                    </h3>
                    <div class="flex items-end justify-around h-48 pt-4">
                        @php
                            $maxDia = $atencionesPorDia->max('total') ?: 1;
                        @endphp
                        @forelse($atencionesPorDia as $dia)
                            <div class="flex flex-col items-center">
                                <span class="text-xs font-bold text-gray-700 mb-1">{{ $dia['total'] }}</span>
                                <div class="w-10 rounded-t-lg transition-all duration-500"
                                     style="height: {{ ($dia['total'] / $maxDia) * 140 }}px; background: linear-gradient(180deg, #800000, #dc2626);">
                                </div>
                                <span class="text-xs font-medium text-gray-600 mt-2">{{ $dia['label'] }}</span>
                            </div>
                        @empty
                            <p class="text-gray-500 text-center w-full">Sin datos</p>
                        @endforelse
                    </div>
                </div>
            </div>

            <!-- ========== TOP RANKINGS ========== -->
            <div class="grid grid-cols-1 lg:grid-cols-3 gap-6 mb-6">

                <!-- Top 5 Temas -->
                <div class="bg-white rounded-xl shadow-lg p-6">
                    <h3 class="text-lg font-bold mb-4 flex items-center" style="color: #800000;">
                        🏆 Top 5 Temas Consultados
                    </h3>
                    <div class="space-y-3">
                        @php $rank = 1; @endphp
                        @forelse($topTemas as $tema)
                            <div class="flex items-center p-3 rounded-lg {{ $rank === 1 ? 'bg-yellow-50 border border-yellow-200' : ($rank === 2 ? 'bg-gray-50 border border-gray-200' : ($rank === 3 ? 'bg-orange-50 border border-orange-200' : 'bg-white border border-gray-100')) }}">
                                <div class="w-8 h-8 rounded-full flex items-center justify-center font-bold text-white text-sm mr-3"
                                     style="background-color: {{ $rank === 1 ? '#f59e0b' : ($rank === 2 ? '#9ca3af' : ($rank === 3 ? '#f97316' : '#800000')) }};">
                                    {{ $rank }}
                                </div>
                                <div class="flex-1">
                                    <p class="font-medium text-gray-800 text-sm">{{ Str::limit($tema->nombre, 25) }}</p>
                                </div>
                                <div class="text-right">
                                    <span class="font-bold" style="color: #800000;">{{ $tema->total }}</span>
                                </div>
                            </div>
                            @php $rank++; @endphp
                        @empty
                            <p class="text-gray-500 text-center py-4">Sin datos de temas</p>
                        @endforelse
                    </div>
                </div>

                <!-- Top 5 Docentes -->
                <div class="bg-white rounded-xl shadow-lg p-6">
                    <h3 class="text-lg font-bold mb-4 flex items-center" style="color: #800000;">
                        👨‍🏫 Top 5 Docentes
                    </h3>
                    <div class="space-y-3">
                        @php $rank = 1; @endphp
                        @forelse($topDocentes as $docente)
                            <div class="flex items-center p-3 rounded-lg {{ $rank === 1 ? 'bg-yellow-50 border border-yellow-200' : ($rank === 2 ? 'bg-gray-50 border border-gray-200' : ($rank === 3 ? 'bg-orange-50 border border-orange-200' : 'bg-white border border-gray-100')) }}">
                                <div class="w-8 h-8 rounded-full flex items-center justify-center font-bold text-white text-sm mr-3"
                                     style="background-color: {{ $rank === 1 ? '#f59e0b' : ($rank === 2 ? '#9ca3af' : ($rank === 3 ? '#f97316' : '#800000')) }};">
                                    {{ $rank }}
                                </div>
                                <div class="flex-1">
                                    <p class="font-medium text-gray-800 text-sm">{{ Str::limit($docente->nombres . ' ' . $docente->apellidos, 20) }}</p>
                                </div>
                                <div class="text-right">
                                    <span class="font-bold" style="color: #800000;">{{ $docente->total }}</span>
                                </div>
                            </div>
                            @php $rank++; @endphp
                        @empty
                            <p class="text-gray-500 text-center py-4">Sin datos de docentes</p>
                        @endforelse
                    </div>
                </div>

                <!-- Atenciones por Semestre -->
                <div class="bg-white rounded-xl shadow-lg p-6">
                    <h3 class="text-lg font-bold mb-4 flex items-center" style="color: #800000;">
                        📚 Por Semestre
                    </h3>
                    <div class="space-y-3">
                        @php
                            $maxSem = $atencionesPorSemestre->max('total') ?: 1;
                        @endphp
                        @forelse($atencionesPorSemestre as $sem)
                            <div class="flex items-center">
                                <div class="w-20 text-sm font-medium text-gray-700">{{ $sem->semestre }}</div>
                                <div class="flex-1 mx-2">
                                    <div class="h-6 bg-gray-200 rounded-full overflow-hidden">
                                        <div class="h-full rounded-full flex items-center justify-end pr-2 text-white text-xs font-bold"
                                             style="width: {{ ($sem->total / $maxSem) * 100 }}%; background: linear-gradient(90deg, #059669, #10b981);">
                                            {{ $sem->total }}
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @empty
                            <p class="text-gray-500 text-center py-4">Sin datos por semestre</p>
                        @endforelse
                    </div>
                </div>
            </div>

            <!-- ========== GRÁFICO CIRCULAR DE COBERTURA ========== -->
            <div class="bg-white rounded-xl shadow-lg p-6 mb-6">
                <h3 class="text-lg font-bold mb-4 flex items-center" style="color: #800000;">
                    🎯 Indicador de Cobertura de Atención
                </h3>
                <div class="flex flex-wrap items-center justify-around">
                    <!-- Gráfico circular CSS -->
                    <div class="relative w-40 h-40">
                        <svg class="w-40 h-40 transform -rotate-90" viewBox="0 0 100 100">
                            <circle cx="50" cy="50" r="40" fill="none" stroke="#e5e7eb" stroke-width="12"/>
                            <circle cx="50" cy="50" r="40" fill="none" stroke="#800000" stroke-width="12"
                                    stroke-dasharray="{{ $porcentajeEstudiantesAtendidos * 2.51 }} 251"
                                    stroke-linecap="round"/>
                        </svg>
                        <div class="absolute inset-0 flex items-center justify-center">
                            <span class="text-2xl font-bold" style="color: #800000;">{{ $porcentajeEstudiantesAtendidos }}%</span>
                        </div>
                    </div>
                    <div class="mt-4 lg:mt-0 text-center lg:text-left">
                        <p class="text-gray-600">De los <strong class="text-blue-600">{{ $totalEstudiantes }}</strong> estudiantes registrados,</p>
                        <p class="text-gray-600"><strong style="color: #800000;">{{ $estudiantesAtendidos }}</strong> han recibido asesoría o tutoría.</p>
                        <div class="mt-3 flex gap-4 justify-center lg:justify-start">
                            <div class="flex items-center">
                                <div class="w-3 h-3 rounded-full mr-2" style="background-color: #800000;"></div>
                                <span class="text-sm text-gray-600">Atendidos</span>
                            </div>
                            <div class="flex items-center">
                                <div class="w-3 h-3 rounded-full bg-gray-300 mr-2"></div>
                                <span class="text-sm text-gray-600">Sin atención</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- ========== FILTROS Y TABLA DE DATOS ========== -->
            <div class="bg-white p-6 rounded-xl shadow-lg mb-6">
                <h3 class="text-lg font-bold mb-4 flex items-center" style="color: #800000;">
                    🔍 Filtros de Búsqueda Avanzada
                </h3>
                <form method="GET" action="{{ route('admin.reportes') }}">
                    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-6 gap-4">
                        <div>
                            <label for="semestre" class="block text-sm font-medium mb-1" style="color: #800000;">Semestre</label>
                            <input type="text" id="semestre" name="semestre" value="{{ request('semestre') }}"
                                   placeholder="Ej: 2024-1"
                                   class="w-full border-gray-300 rounded-lg shadow-sm focus:border-red-500 focus:ring focus:ring-red-200 text-sm">
                        </div>

                        <div>
                            <label for="docente_id" class="block text-sm font-medium mb-1" style="color: #800000;">Docente</label>
                            <select id="docente_id" name="docente_id"
                                    class="w-full border-gray-300 rounded-lg shadow-sm focus:border-red-500 focus:ring focus:ring-red-200 text-sm">
                                <option value="">Todos</option>
                                @foreach($docentes as $docente)
                                    <option value="{{ $docente->id }}" {{ request('docente_id') == $docente->id ? 'selected' : '' }}>
                                        {{ $docente->nombres }} {{ $docente->apellidos }}
                                    </option>
                                @endforeach
                            </select>
                        </div>

                        <div>
                            <label for="tema_id" class="block text-sm font-medium mb-1" style="color: #800000;">Tema</label>
                            <select id="tema_id" name="tema_id"
                                    class="w-full border-gray-300 rounded-lg shadow-sm focus:border-red-500 focus:ring focus:ring-red-200 text-sm">
                                <option value="">Todos</option>
                                @foreach($temas as $tema)
                                    <option value="{{ $tema->id }}" {{ request('tema_id') == $tema->id ? 'selected' : '' }}>
                                        {{ $tema->nombre }}
                                    </option>
                                @endforeach
                            </select>
                        </div>

                        <div>
                            <label for="fecha_desde" class="block text-sm font-medium mb-1" style="color: #800000;">Desde</label>
                            <input type="date" id="fecha_desde" name="fecha_desde" value="{{ request('fecha_desde') }}"
                                   class="w-full border-gray-300 rounded-lg shadow-sm focus:border-red-500 focus:ring focus:ring-red-200 text-sm">
                        </div>

                        <div>
                            <label for="fecha_hasta" class="block text-sm font-medium mb-1" style="color: #800000;">Hasta</label>
                            <input type="date" id="fecha_hasta" name="fecha_hasta" value="{{ request('fecha_hasta') }}"
                                   class="w-full border-gray-300 rounded-lg shadow-sm focus:border-red-500 focus:ring focus:ring-red-200 text-sm">
                        </div>

                        <div class="flex items-end gap-2">
                            <button type="submit" class="flex-1 px-4 py-2 rounded-lg font-semibold text-sm text-white transition hover:opacity-90" style="background-color: #800000;">
                                Filtrar
                            </button>
                            <a href="{{ route('admin.reportes') }}" class="px-3 py-2 rounded-lg font-semibold text-sm border border-gray-300 text-gray-600 hover:bg-gray-100 transition">
                                Limpiar
                            </a>
                        </div>
                    </div>
                </form>
            </div>

            <!-- Tabla de resultados -->
            <div class="bg-white p-6 rounded-xl shadow-lg">
                <div class="flex justify-between items-center mb-4">
                    <h3 class="text-lg font-bold flex items-center" style="color: #800000;">
                        📋 Detalle de Atenciones
                    </h3>
                    <span class="px-3 py-1 rounded-full text-sm font-medium text-white" style="background-color: #800000;">
                        {{ $atenciones->total() }} registros
                    </span>
                </div>

                <div class="overflow-x-auto">
                    <table class="min-w-full">
                        <thead>
                            <tr class="bg-gray-100">
                                <th class="px-4 py-3 text-left text-sm font-semibold" style="color: #800000;">Semestre</th>
                                <th class="px-4 py-3 text-left text-sm font-semibold" style="color: #800000;">Fecha</th>
                                <th class="px-4 py-3 text-left text-sm font-semibold" style="color: #800000;">Hora</th>
                                <th class="px-4 py-3 text-left text-sm font-semibold" style="color: #800000;">Estudiante</th>
                                <th class="px-4 py-3 text-left text-sm font-semibold" style="color: #800000;">Docente</th>
                                <th class="px-4 py-3 text-left text-sm font-semibold" style="color: #800000;">Tema</th>
                                <th class="px-4 py-3 text-center text-sm font-semibold" style="color: #800000;">Acciones</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-gray-200">
                            @forelse($atenciones as $atencion)
                            <tr class="hover:bg-gray-50 transition">
                                <td class="px-4 py-3 text-sm text-gray-700">
                                    <span class="px-2 py-1 bg-blue-100 text-blue-800 rounded text-xs font-medium">
                                        {{ $atencion->semestre ?? 'N/A' }}
                                    </span>
                                </td>
                                <td class="px-4 py-3 text-sm text-gray-700">{{ $atencion->fecha ? $atencion->fecha->format('d/m/Y') : 'Sin fecha' }}</td>
                                <td class="px-4 py-3 text-sm text-gray-700">{{ $atencion->hora ? $atencion->hora->format('H:i') : '--:--' }}</td>
                                <td class="px-4 py-3">
                                    <div class="text-sm font-medium text-gray-900">{{ $atencion->estudiante?->nombres ?? 'N/A' }} {{ $atencion->estudiante?->apellidos ?? '' }}</div>
                                    <div class="text-xs text-gray-500">{{ $atencion->estudiante?->codigo ?? '' }}</div>
                                </td>
                                <td class="px-4 py-3 text-sm text-gray-700">{{ $atencion->docente?->nombres ?? 'N/A' }} {{ $atencion->docente?->apellidos ?? '' }}</td>
                                <td class="px-4 py-3">
                                    <span class="px-2 py-1 bg-purple-100 text-purple-800 rounded text-xs font-medium">
                                        {{ Str::limit($atencion->tema?->nombre ?? 'Sin tema', 20) }}
                                    </span>
                                </td>
                                <td class="px-4 py-3 text-center">
                                    <a href="{{ route('atenciones.show', $atencion->id) }}"
                                       class="inline-flex items-center px-3 py-1 rounded-lg text-white text-sm transition hover:opacity-90"
                                       style="background-color: #800000;">
                                        <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/>
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"/>
                                        </svg>
                                        Ver
                                    </a>
                                </td>
                            </tr>
                            @empty
                            <tr>
                                <td colspan="7" class="px-4 py-8 text-center">
                                    <div class="text-gray-400">
                                        <svg class="mx-auto h-12 w-12 mb-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9.172 16.172a4 4 0 015.656 0M9 10h.01M15 10h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>
                                        </svg>
                                        <p class="text-gray-500">No se encontraron atenciones con los filtros aplicados</p>
                                    </div>
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
