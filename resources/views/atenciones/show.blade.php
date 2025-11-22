<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl leading-tight" style="color: #800000;">
            Detalle de Atención
        </h2>
    </x-slot>

    <div class="py-8">
        <div class="max-w-4xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6">
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-6">
                        <div>
                            <h3 class="font-semibold mb-2" style="color: #800000;">Información General</h3>
                            <div class="space-y-2">
                                <div>
                                    <span class="font-medium" style="color: #333333;">Semestre:</span>
                                    <span class="text-gray-700">{{ $atencion->semestre }}</span>
                                </div>
                                <div>
                                    <span class="font-medium" style="color: #333333;">Fecha:</span>
                                    <span class="text-gray-700">{{ $atencion->fecha->format('d/m/Y') }}</span>
                                </div>
                                <div>
                                    <span class="font-medium" style="color: #333333;">Hora:</span>
                                    <span class="text-gray-700">{{ $atencion->hora ? $atencion->hora->format('H:i') : 'No especificada' }}</span>
                                </div>
                            </div>
                        </div>

                        <div>
                            <h3 class="font-semibold mb-2" style="color: #800000;">Participantes</h3>
                            <div class="space-y-2">
                                <div>
                                    <span class="font-medium" style="color: #333333;">Docente:</span>
                                    <span class="text-gray-700">{{ $atencion->docente->nombres }} {{ $atencion->docente->apellidos }}</span>
                                </div>
                                <div>
                                    <span class="font-medium" style="color: #333333;">Estudiante:</span>
                                    <span class="text-gray-700">{{ $atencion->estudiante->nombres }} {{ $atencion->estudiante->apellidos }}</span>
                                </div>
                                <div>
                                    <span class="font-medium" style="color: #333333;">Código:</span>
                                    <span class="text-gray-700">{{ $atencion->estudiante->codigo }}</span>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="mb-6">
                        <h3 class="font-semibold mb-2" style="color: #800000;">Tema</h3>
                        <p class="text-gray-700">{{ $atencion->tema->nombre }}</p>
                    </div>

                    <div class="mb-6">
                        <h3 class="font-semibold mb-2" style="color: #800000;">Consulta del Estudiante</h3>
                        <p class="text-gray-700">{{ $atencion->consulta }}</p>
                    </div>

                    <div class="mb-6">
                        <h3 class="font-semibold mb-2" style="color: #800000;">Descripción de la Atención</h3>
                        <p class="text-gray-700">{{ $atencion->descripcion }}</p>
                    </div>

                    @if($atencion->evidencia)
                        <div class="mb-6">
                            <h3 class="font-semibold mb-2" style="color: #800000;">Evidencia</h3>
                            <a href="{{ asset('storage/' . $atencion->evidencia) }}" target="_blank" class="text-blue-600 hover:text-blue-900">
                                Ver archivo adjunto
                            </a>
                        </div>
                    @endif

                    <div class="flex justify-end gap-2">
                        <a href="{{ route('atenciones.index') }}" class="px-4 py-2 bg-gray-300 text-gray-700 rounded-md">Volver</a>
                        <a href="{{ route('atenciones.edit', $atencion) }}" class="px-4 py-2 text-white rounded-md" style="background-color: #800000;">Editar</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
