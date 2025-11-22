<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl leading-tight" style="color: #800000;">
            {{ __('Panel de Docente') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <!-- Tarjetas de estadísticas -->
            <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-6">
                <div class="p-6 rounded-lg shadow-lg" style="background-color: #fff; border-left: 4px solid #800000;">
                    <div class="text-sm font-medium" style="color: #800000;">Total de Atenciones</div>
                    <div class="text-3xl font-bold mt-2" style="color: #333333;">{{ $stats['total_atenciones'] }}</div>
                </div>
                <div class="p-6 rounded-lg shadow-lg" style="background-color: #fff; border-left: 4px solid #800000;">
                    <div class="text-sm font-medium" style="color: #800000;">Atenciones este mes</div>
                    <div class="text-3xl font-bold mt-2" style="color: #333333;">{{ $stats['atenciones_mes'] }}</div>
                </div>
                <div class="p-6 rounded-lg shadow-lg" style="background-color: #fff; border-left: 4px solid #800000;">
                    <div class="text-sm font-medium" style="color: #800000;">Estudiantes Atendidos</div>
                    <div class="text-3xl font-bold mt-2" style="color: #333333;">{{ $stats['estudiantes_atendidos'] }}</div>
                </div>
            </div>

            <!-- Botón para registrar nueva atención -->
            <div class="mb-6">
                <a href="{{ route('atenciones.create') }}" class="inline-flex items-center px-4 py-2 rounded-md font-semibold text-sm text-white" style="background-color: #800000;">
                    <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6"></path>
                    </svg>
                    Registrar Nueva Atención
                </a>
            </div>

            <!-- Gráficos y tablas -->
            <div class="grid grid-cols-1 lg:grid-cols-2 gap-6 mb-6">
                <!-- Atenciones por Tema -->
                <div class="bg-white p-6 rounded-lg shadow-lg">
                    <h3 class="text-lg font-semibold mb-4" style="color: #800000;">Mis Atenciones por Tema</h3>
                    <div class="overflow-x-auto">
                        <table class="min-w-full">
                            <thead>
                                <tr style="background-color: #F2F2F2;">
                                    <th class="px-4 py-2 text-left" style="color: #800000;">Tema</th>
                                    <th class="px-4 py-2 text-right" style="color: #800000;">Total</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse($atencionesPorTema as $item)
                                <tr class="border-b">
                                    <td class="px-4 py-2" style="color: #333333;">{{ $item->nombre }}</td>
                                    <td class="px-4 py-2 text-right font-semibold" style="color: #800000;">{{ $item->total }}</td>
                                </tr>
                                @empty
                                <tr>
                                    <td colspan="2" class="px-4 py-2 text-center" style="color: #333333;">No hay datos disponibles</td>
                                </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>

                <!-- Información del docente -->
                <div class="bg-white p-6 rounded-lg shadow-lg">
                    <h3 class="text-lg font-semibold mb-4" style="color: #800000;">Mi Información</h3>
                    <div class="space-y-3">
                        <div>
                            <span class="font-semibold" style="color: #800000;">Nombre:</span>
                            <span style="color: #333333;">{{ auth()->user()->docente->nombres }} {{ auth()->user()->docente->apellidos }}</span>
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
                                <td class="px-4 py-2" style="color: #333333;">{{ $atencion->fecha->format('d/m/Y') }}</td>
                                <td class="px-4 py-2" style="color: #333333;">{{ $atencion->hora ? $atencion->hora->format('H:i') : '--:--' }}</td>
                                <td class="px-4 py-2" style="color: #333333;">{{ $atencion->estudiante->nombres }} {{ $atencion->estudiante->apellidos }}</td>
                                <td class="px-4 py-2" style="color: #333333;">{{ $atencion->tema->nombre }}</td>
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
