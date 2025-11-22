<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl leading-tight" style="color: #800000;">
            {{ __('Panel de Estudiante') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <!-- Tarjetas de estadísticas -->
            <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-6">
                <div class="p-6 rounded-lg shadow-lg" style="background-color: #fff; border-left: 4px solid #800000;">
                    <div class="text-sm font-medium" style="color: #800000;">Total de Asesorías</div>
                    <div class="text-3xl font-bold mt-2" style="color: #333333;">{{ $stats['total_atenciones'] }}</div>
                </div>
                <div class="p-6 rounded-lg shadow-lg" style="background-color: #fff; border-left: 4px solid #800000;">
                    <div class="text-sm font-medium" style="color: #800000;">Asesorías este Semestre</div>
                    <div class="text-3xl font-bold mt-2" style="color: #333333;">{{ $stats['atenciones_semestre'] }}</div>
                </div>
                <div class="p-6 rounded-lg shadow-lg" style="background-color: #fff; border-left: 4px solid #800000;">
                    <div class="text-sm font-medium" style="color: #800000;">Docentes Consultados</div>
                    <div class="text-3xl font-bold mt-2" style="color: #333333;">{{ $stats['docentes_consultados'] }}</div>
                </div>
            </div>

            <!-- Información del estudiante -->
            <div class="bg-white p-6 rounded-lg shadow-lg mb-6">
                <h3 class="text-lg font-semibold mb-4" style="color: #800000;">Mi Información</h3>
                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                    <div>
                        <span class="font-semibold" style="color: #800000;">Código:</span>
                        <span style="color: #333333;">{{ auth()->user()->estudiante->codigo }}</span>
                    </div>
                    <div>
                        <span class="font-semibold" style="color: #800000;">Nombre:</span>
                        <span style="color: #333333;">{{ auth()->user()->estudiante->nombres }} {{ auth()->user()->estudiante->apellidos }}</span>
                    </div>
                    <div>
                        <span class="font-semibold" style="color: #800000;">Email:</span>
                        <span style="color: #333333;">{{ auth()->user()->email }}</span>
                    </div>
                </div>
            </div>

            <!-- Gráficos y tablas -->
            <div class="grid grid-cols-1 lg:grid-cols-2 gap-6 mb-6">
                <!-- Asesorías por Tema -->
                <div class="bg-white p-6 rounded-lg shadow-lg">
                    <h3 class="text-lg font-semibold mb-4" style="color: #800000;">Mis Asesorías por Tema</h3>
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
                                    <td colspan="2" class="px-4 py-2 text-center" style="color: #333333;">No tienes asesorías registradas</td>
                                </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>

                <!-- Información útil -->
                <div class="bg-white p-6 rounded-lg shadow-lg">
                    <h3 class="text-lg font-semibold mb-4" style="color: #800000;">Información Importante</h3>
                    <div class="space-y-3" style="color: #333333;">
                        <p>Las asesorías de consejería te permiten recibir orientación académica y profesional.</p>
                        <p>Puedes consultar el historial de tus asesorías en la tabla de abajo.</p>
                        <p>Para solicitar una nueva asesoría, contacta directamente con tu docente consejero asignado.</p>
                    </div>
                </div>
            </div>

            <!-- Asesorías Recientes -->
            <div class="bg-white p-6 rounded-lg shadow-lg">
                <h3 class="text-lg font-semibold mb-4" style="color: #800000;">Mis Asesorías Recientes</h3>
                <div class="overflow-x-auto">
                    <table class="min-w-full">
                        <thead>
                            <tr style="background-color: #F2F2F2;">
                                <th class="px-4 py-2 text-left" style="color: #800000;">Fecha</th>
                                <th class="px-4 py-2 text-left" style="color: #800000;">Hora</th>
                                <th class="px-4 py-2 text-left" style="color: #800000;">Docente</th>
                                <th class="px-4 py-2 text-left" style="color: #800000;">Tema</th>
                                <th class="px-4 py-2 text-left" style="color: #800000;">Acciones</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($atenciones_recientes as $atencion)
                            <tr class="border-b">
                                <td class="px-4 py-2" style="color: #333333;">{{ $atencion->fecha->format('d/m/Y') }}</td>
                                <td class="px-4 py-2" style="color: #333333;">{{ $atencion->hora ? $atencion->hora->format('H:i') : '--:--' }}</td>
                                <td class="px-4 py-2" style="color: #333333;">{{ $atencion->docente->nombres }} {{ $atencion->docente->apellidos }}</td>
                                <td class="px-4 py-2" style="color: #333333;">{{ $atencion->tema->nombre }}</td>
                                <td class="px-4 py-2">
                                    <a href="{{ route('atenciones.show', $atencion->id) }}" class="px-3 py-1 rounded text-white text-sm" style="background-color: #800000;">Ver Detalles</a>
                                </td>
                            </tr>
                            @empty
                            <tr>
                                <td colspan="5" class="px-4 py-2 text-center" style="color: #333333;">No tienes asesorías registradas</td>
                            </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
