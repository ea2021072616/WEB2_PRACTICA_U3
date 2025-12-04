<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl leading-tight text-white">
            Ficha de Registro de Atenciones de Asesoría y Tutoría
        </h2>
        <p class="text-sm text-red-200 mt-1">Panel de Administración</p>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <!-- Tarjetas de estadísticas con iconos -->
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6 mb-6">
                <div class="p-6 rounded-lg shadow-lg bg-white" style="border-left: 4px solid #800000;">
                    <div class="flex items-center justify-between">
                        <div>
                            <div class="text-sm font-medium" style="color: #800000;">👨‍🎓 Total Estudiantes</div>
                            <div class="text-3xl font-bold mt-2" style="color: #333333;">{{ $stats['total_estudiantes'] }}</div>
                        </div>
                        <div class="w-12 h-12 rounded-full flex items-center justify-center" style="background-color: #f5e6e6;">
                            <svg class="w-6 h-6" style="color: #800000;" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197m9 5.197v-1"></path>
                            </svg>
                        </div>
                    </div>
                </div>
                <div class="p-6 rounded-lg shadow-lg bg-white" style="border-left: 4px solid #800000;">
                    <div class="flex items-center justify-between">
                        <div>
                            <div class="text-sm font-medium" style="color: #800000;">👨‍🏫 Total Docentes</div>
                            <div class="text-3xl font-bold mt-2" style="color: #333333;">{{ $stats['total_docentes'] }}</div>
                        </div>
                        <div class="w-12 h-12 rounded-full flex items-center justify-center" style="background-color: #f5e6e6;">
                            <svg class="w-6 h-6" style="color: #800000;" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4"></path>
                            </svg>
                        </div>
                    </div>
                </div>
                <div class="p-6 rounded-lg shadow-lg bg-white" style="border-left: 4px solid #800000;">
                    <div class="flex items-center justify-between">
                        <div>
                            <div class="text-sm font-medium" style="color: #800000;">📋 Total Atenciones</div>
                            <div class="text-3xl font-bold mt-2" style="color: #333333;">{{ $stats['total_atenciones'] }}</div>
                        </div>
                        <div class="w-12 h-12 rounded-full flex items-center justify-center" style="background-color: #f5e6e6;">
                            <svg class="w-6 h-6" style="color: #800000;" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path>
                            </svg>
                        </div>
                    </div>
                </div>
                <div class="p-6 rounded-lg shadow-lg bg-white" style="border-left: 4px solid #800000;">
                    <div class="flex items-center justify-between">
                        <div>
                            <div class="text-sm font-medium" style="color: #800000;">📚 Temas Disponibles</div>
                            <div class="text-3xl font-bold mt-2" style="color: #333333;">{{ $stats['total_temas'] }}</div>
                        </div>
                        <div class="w-12 h-12 rounded-full flex items-center justify-center" style="background-color: #f5e6e6;">
                            <svg class="w-6 h-6" style="color: #800000;" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253"></path>
                            </svg>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Gráficos y tablas -->
            <div class="grid grid-cols-1 lg:grid-cols-2 gap-6 mb-6">
                <!-- Gráfico de Atenciones por Semestre -->
                <div class="bg-white p-6 rounded-lg shadow-lg">
                    <h3 class="text-lg font-semibold mb-4" style="color: #800000;">📊 Atenciones por Semestre</h3>
                    <div class="space-y-4">
                        @php
                            $maxSemestre = $atencionesPorSemestre->max('total') ?: 1;
                        @endphp
                        @forelse($atencionesPorSemestre as $item)
                        <div>
                            <div class="flex justify-between mb-1">
                                <span class="text-sm font-medium" style="color: #333333;">{{ $item->semestre }}</span>
                                <span class="text-sm font-bold" style="color: #800000;">{{ $item->total }}</span>
                            </div>
                            <div class="w-full bg-gray-200 rounded-full h-4">
                                <div class="h-4 rounded-full" style="width: {{ ($item->total / $maxSemestre) * 100 }}%; background-color: #800000;"></div>
                            </div>
                        </div>
                        @empty
                        <p class="text-gray-500 text-center py-4">No hay datos disponibles</p>
                        @endforelse
                    </div>
                </div>

                <!-- Gráfico de Atenciones por Tema -->
                <div class="bg-white p-6 rounded-lg shadow-lg">
                    <h3 class="text-lg font-semibold mb-4" style="color: #800000;">📈 Atenciones por Tema</h3>
                    <div class="space-y-4">
                        @php
                            $maxTema = $atencionesPorTema->max('total') ?: 1;
                            $colores = ['#800000', '#A52A2A', '#CD5C5C', '#DC143C', '#B22222'];
                        @endphp
                        @forelse($atencionesPorTema as $index => $item)
                        <div>
                            <div class="flex justify-between mb-1">
                                <span class="text-sm font-medium truncate" style="color: #333333; max-width: 70%;">{{ $item->nombre }}</span>
                                <span class="text-sm font-bold" style="color: #800000;">{{ $item->total }}</span>
                            </div>
                            <div class="w-full bg-gray-200 rounded-full h-4">
                                <div class="h-4 rounded-full" style="width: {{ ($item->total / $maxTema) * 100 }}%; background-color: {{ $colores[$index % count($colores)] }};"></div>
                            </div>
                        </div>
                        @empty
                        <p class="text-gray-500 text-center py-4">No hay datos disponibles</p>
                        @endforelse
                    </div>
                </div>
            </div>

            <!-- Top Docentes -->
            <div class="bg-white p-6 rounded-lg shadow-lg mb-6">
                <h3 class="text-lg font-semibold mb-4" style="color: #800000;">Top 10 Docentes con más atenciones</h3>
                <div class="overflow-x-auto">
                    <table class="min-w-full">
                        <thead>
                            <tr style="background-color: #F2F2F2;">
                                <th class="px-4 py-2 text-left" style="color: #800000;">Docente</th>
                                <th class="px-4 py-2 text-right" style="color: #800000;">Total Atenciones</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($atencionesPorDocente as $item)
                            <tr class="border-b">
                                <td class="px-4 py-2" style="color: #333333;">{{ $item->nombres }} {{ $item->apellidos }}</td>
                                <td class="px-4 py-2 text-right font-semibold" style="color: #800000;">{{ $item->total }}</td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>

            <!-- Atenciones Recientes -->
            <div class="bg-white p-6 rounded-lg shadow-lg">
                <h3 class="text-lg font-semibold mb-4" style="color: #800000;">Atenciones Recientes</h3>
                <div class="overflow-x-auto">
                    <table class="min-w-full">
                        <thead>
                            <tr style="background-color: #F2F2F2;">
                                <th class="px-4 py-2 text-left" style="color: #800000;">Fecha</th>
                                <th class="px-4 py-2 text-left" style="color: #800000;">Estudiante</th>
                                <th class="px-4 py-2 text-left" style="color: #800000;">Docente</th>
                                <th class="px-4 py-2 text-left" style="color: #800000;">Tema</th>
                                <th class="px-4 py-2 text-left" style="color: #800000;">Acciones</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($atenciones_recientes as $atencion)
                            <tr class="border-b">
                                <td class="px-4 py-2" style="color: #333333;">{{ $atencion->fecha ? $atencion->fecha->format('d/m/Y') : 'Sin fecha' }}</td>
                                <td class="px-4 py-2" style="color: #333333;">{{ $atencion->estudiante?->nombres ?? 'N/A' }} {{ $atencion->estudiante?->apellidos ?? '' }}</td>
                                <td class="px-4 py-2" style="color: #333333;">{{ $atencion->docente?->nombres ?? 'N/A' }} {{ $atencion->docente?->apellidos ?? '' }}</td>
                                <td class="px-4 py-2" style="color: #333333;">{{ $atencion->tema?->nombre ?? 'Sin tema' }}</td>
                                <td class="px-4 py-2">
                                    <a href="{{ route('atenciones.show', $atencion->id) }}" class="px-3 py-1 rounded text-white text-sm" style="background-color: #800000;">Ver</a>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
