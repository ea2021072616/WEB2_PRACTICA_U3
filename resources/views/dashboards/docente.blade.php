<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl leading-tight text-white">
            Ficha de Registro de Atenciones de Asesoría y Tutoría
        </h2>
        <p class="text-sm text-red-200 mt-1">Panel de Docente</p>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <!-- Tarjetas de estadísticas con iconos -->
            <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-6">
                <div class="p-6 rounded-lg shadow-lg bg-white" style="border-left: 4px solid #800000;">
                    <div class="flex items-center justify-between">
                        <div>
                            <div class="text-sm font-medium" style="color: #800000;">📋 Total de Atenciones</div>
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
                            <div class="text-sm font-medium" style="color: #800000;">📅 Atenciones este mes</div>
                            <div class="text-3xl font-bold mt-2" style="color: #333333;">{{ $stats['atenciones_mes'] }}</div>
                        </div>
                        <div class="w-12 h-12 rounded-full flex items-center justify-center" style="background-color: #f5e6e6;">
                            <svg class="w-6 h-6" style="color: #800000;" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                            </svg>
                        </div>
                    </div>
                </div>
                <div class="p-6 rounded-lg shadow-lg bg-white" style="border-left: 4px solid #800000;">
                    <div class="flex items-center justify-between">
                        <div>
                            <div class="text-sm font-medium" style="color: #800000;">👥 Estudiantes Atendidos</div>
                            <div class="text-3xl font-bold mt-2" style="color: #333333;">{{ $stats['estudiantes_atendidos'] }}</div>
                        </div>
                        <div class="w-12 h-12 rounded-full flex items-center justify-center" style="background-color: #f5e6e6;">
                            <svg class="w-6 h-6" style="color: #800000;" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197m9 5.197v-1"></path>
                            </svg>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Botón para registrar nueva atención -->
            <div class="mb-6">
                <a href="{{ route('atenciones.create') }}" class="inline-flex items-center px-6 py-3 rounded-md font-semibold text-white shadow-lg transition hover:opacity-90" style="background-color: #800000;">
                    <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6"></path>
                    </svg>
                    Registrar Nueva Atención
                </a>
            </div>

            <!-- Gráficos y tablas -->
            <div class="grid grid-cols-1 lg:grid-cols-2 gap-6 mb-6">
                <!-- Gráfico de Atenciones por Tema -->
                <div class="bg-white p-6 rounded-lg shadow-lg">
                    <h3 class="text-lg font-semibold mb-4" style="color: #800000;">📊 Mis Atenciones por Tema</h3>
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
                        <p class="text-gray-500 text-center py-4">No hay atenciones registradas aún</p>
                        @endforelse
                    </div>
                </div>

                <!-- Información del docente -->
                <div class="bg-white p-6 rounded-lg shadow-lg">
                    <h3 class="text-lg font-semibold mb-4" style="color: #800000;">👤 Mi Información</h3>
                    <div class="space-y-3">
                        <div>
                            <span class="font-semibold" style="color: #800000;">Nombre:</span>
                            <span style="color: #333333;">{{ auth()->user()->docente?->nombres ?? 'N/A' }} {{ auth()->user()->docente?->apellidos ?? '' }}</span>
                        </div>
                        <div>
                            <span class="font-semibold" style="color: #800000;">Email:</span>
                            <span style="color: #333333;">{{ auth()->user()->email }}</span>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Atenciones Recientes -->
            <div class="bg-white p-6 rounded-lg shadow-lg">
                <h3 class="text-lg font-semibold mb-4" style="color: #800000;">Mis Atenciones Recientes</h3>
                <div class="overflow-x-auto">
                    <table class="min-w-full">
                        <thead>
                            <tr style="background-color: #F2F2F2;">
                                <th class="px-4 py-2 text-left" style="color: #800000;">Fecha</th>
                                <th class="px-4 py-2 text-left" style="color: #800000;">Hora</th>
                                <th class="px-4 py-2 text-left" style="color: #800000;">Estudiante</th>
                                <th class="px-4 py-2 text-left" style="color: #800000;">Tema</th>
                                <th class="px-4 py-2 text-left" style="color: #800000;">Acciones</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($atenciones_recientes as $atencion)
                            <tr class="border-b">
                                <td class="px-4 py-2" style="color: #333333;">{{ $atencion->fecha ? $atencion->fecha->format('d/m/Y') : 'Sin fecha' }}</td>
                                <td class="px-4 py-2" style="color: #333333;">{{ $atencion->hora ? $atencion->hora->format('H:i') : '--:--' }}</td>
                                <td class="px-4 py-2" style="color: #333333;">{{ $atencion->estudiante?->nombres ?? 'N/A' }} {{ $atencion->estudiante?->apellidos ?? '' }}</td>
                                <td class="px-4 py-2" style="color: #333333;">{{ $atencion->tema?->nombre ?? 'Sin tema' }}</td>
                                <td class="px-4 py-2">
                                    <div class="flex space-x-2">
                                        <a href="{{ route('atenciones.show', $atencion->id) }}" class="px-3 py-1 rounded text-white text-sm" style="background-color: #800000;">Ver</a>
                                        <a href="{{ route('atenciones.edit', $atencion->id) }}" class="px-3 py-1 rounded text-white text-sm" style="background-color: #333333;">Editar</a>
                                    </div>
                                </td>
                            </tr>
                            @empty
                            <tr>
                                <td colspan="5" class="px-4 py-2 text-center" style="color: #333333;">No tienes atenciones registradas</td>
                            </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
