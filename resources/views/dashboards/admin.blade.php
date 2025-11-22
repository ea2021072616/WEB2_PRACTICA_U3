<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl leading-tight" style="color: #800000;">
            {{ __('Panel de Administración') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <!-- Tarjetas de estadísticas -->
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6 mb-6">
                <div class="p-6 rounded-lg shadow-lg" style="background-color: #fff; border-left: 4px solid #800000;">
                    <div class="text-sm font-medium" style="color: #800000;">Total Estudiantes</div>
                    <div class="text-3xl font-bold mt-2" style="color: #333333;">{{ $stats['total_estudiantes'] }}</div>
                </div>
                <div class="p-6 rounded-lg shadow-lg" style="background-color: #fff; border-left: 4px solid #800000;">
                    <div class="text-sm font-medium" style="color: #800000;">Total Docentes</div>
                    <div class="text-3xl font-bold mt-2" style="color: #333333;">{{ $stats['total_docentes'] }}</div>
                </div>
                <div class="p-6 rounded-lg shadow-lg" style="background-color: #fff; border-left: 4px solid #800000;">
                    <div class="text-sm font-medium" style="color: #800000;">Total Atenciones</div>
                    <div class="text-3xl font-bold mt-2" style="color: #333333;">{{ $stats['total_atenciones'] }}</div>
                </div>
                <div class="p-6 rounded-lg shadow-lg" style="background-color: #fff; border-left: 4px solid #800000;">
                    <div class="text-sm font-medium" style="color: #800000;">Temas Disponibles</div>
                    <div class="text-3xl font-bold mt-2" style="color: #333333;">{{ $stats['total_temas'] }}</div>
                </div>
            </div>

            <!-- Gráficos y tablas -->
            <div class="grid grid-cols-1 lg:grid-cols-2 gap-6 mb-6">
                <!-- Atenciones por Semestre -->
                <div class="bg-white p-6 rounded-lg shadow-lg">
                    <h3 class="text-lg font-semibold mb-4" style="color: #800000;">Atenciones por Semestre</h3>
                    <div class="overflow-x-auto">
                        <table class="min-w-full">
                            <thead>
                                <tr style="background-color: #F2F2F2;">
                                    <th class="px-4 py-2 text-left" style="color: #800000;">Semestre</th>
                                    <th class="px-4 py-2 text-right" style="color: #800000;">Total</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($atencionesPorSemestre as $item)
                                <tr class="border-b">
                                    <td class="px-4 py-2" style="color: #333333;">{{ $item->semestre }}</td>
                                    <td class="px-4 py-2 text-right font-semibold" style="color: #800000;">{{ $item->total }}</td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>

                <!-- Atenciones por Tema -->
                <div class="bg-white p-6 rounded-lg shadow-lg">
                    <h3 class="text-lg font-semibold mb-4" style="color: #800000;">Atenciones por Tema</h3>
                    <div class="overflow-x-auto">
                        <table class="min-w-full">
                            <thead>
                                <tr style="background-color: #F2F2F2;">
                                    <th class="px-4 py-2 text-left" style="color: #800000;">Tema</th>
                                    <th class="px-4 py-2 text-right" style="color: #800000;">Total</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($atencionesPorTema as $item)
                                <tr class="border-b">
                                    <td class="px-4 py-2" style="color: #333333;">{{ $item->nombre }}</td>
                                    <td class="px-4 py-2 text-right font-semibold" style="color: #800000;">{{ $item->total }}</td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
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
                                <td class="px-4 py-2" style="color: #333333;">{{ $atencion->fecha->format('d/m/Y') }}</td>
                                <td class="px-4 py-2" style="color: #333333;">{{ $atencion->estudiante->nombres }} {{ $atencion->estudiante->apellidos }}</td>
                                <td class="px-4 py-2" style="color: #333333;">{{ $atencion->docente->nombres }} {{ $atencion->docente->apellidos }}</td>
                                <td class="px-4 py-2" style="color: #333333;">{{ $atencion->tema->nombre }}</td>
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
