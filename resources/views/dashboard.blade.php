<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl leading-tight" style="color: #800000;">
            Dashboard - Sistema de Consejería UPT
        </h2>
    </x-slot>

    <div class="py-8">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="grid grid-cols-1 md:grid-cols-4 gap-4 mb-6">
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                    <div class="p-6">
                        <div class="text-sm" style="color: #333333;">Total Estudiantes</div>
                        <div class="text-3xl font-bold" style="color: #800000;">{{ $totalEstudiantes }}</div>
                    </div>
                </div>
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                    <div class="p-6">
                        <div class="text-sm" style="color: #333333;">Total Docentes</div>
                        <div class="text-3xl font-bold" style="color: #800000;">{{ $totalDocentes }}</div>
                    </div>
                </div>
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                    <div class="p-6">
                        <div class="text-sm" style="color: #333333;">Total Temas</div>
                        <div class="text-3xl font-bold" style="color: #800000;">{{ $totalTemas }}</div>
                    </div>
                </div>
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                    <div class="p-6">
                        <div class="text-sm" style="color: #333333;">Total Atenciones</div>
                        <div class="text-3xl font-bold" style="color: #800000;">{{ $totalAtenciones }}</div>
                    </div>
                </div>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-6">
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                    <div class="p-6">
                        <h3 class="text-lg font-semibold mb-4" style="color: #800000;">Atenciones por Semestre</h3>
                        @foreach($atencionesPorSemestre as $item)
                            <div class="flex justify-between items-center mb-2 pb-2 border-b">
                                <span style="color: #333333;">{{ $item->semestre }}</span>
                                <span class="font-bold" style="color: #800000;">{{ $item->total }}</span>
                            </div>
                        @endforeach
                    </div>
                </div>

                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                    <div class="p-6">
                        <h3 class="text-lg font-semibold mb-4" style="color: #800000;">Top 5 Docentes</h3>
                        @foreach($atencionesPorDocente as $item)
                            <div class="flex justify-between items-center mb-2 pb-2 border-b">
                                <span style="color: #333333;">{{ $item->docente->nombres }} {{ $item->docente->apellidos }}</span>
                                <span class="font-bold" style="color: #800000;">{{ $item->total }}</span>
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                    <div class="p-6">
                        <h3 class="text-lg font-semibold mb-4" style="color: #800000;">Atenciones por Tema</h3>
                        @foreach($atencionesPorTema as $item)
                            <div class="flex justify-between items-center mb-2 pb-2 border-b">
                                <span style="color: #333333;">{{ $item->tema->nombre }}</span>
                                <span class="font-bold" style="color: #800000;">{{ $item->total }}</span>
                            </div>
                        @endforeach
                    </div>
                </div>

                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                    <div class="p-6">
                        <h3 class="text-lg font-semibold mb-4" style="color: #800000;">Últimas Atenciones</h3>
                        @foreach($recientesAtenciones as $atencion)
                            <div class="mb-3 pb-3 border-b">
                                <div class="text-sm font-semibold" style="color: #333333;">
                                    {{ $atencion->estudiante->nombres }} {{ $atencion->estudiante->apellidos }}
                                </div>
                                <div class="text-xs" style="color: #666;">
                                    {{ $atencion->tema->nombre }} - {{ $atencion->fecha->format('d/m/Y') }}
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
