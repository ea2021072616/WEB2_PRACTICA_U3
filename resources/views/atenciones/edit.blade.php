<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl leading-tight" style="color: #800000;">
            Editar Atención de Consejería
        </h2>
    </x-slot>

    <div class="py-8">
        <div class="max-w-4xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6">
                    <form action="{{ route('atenciones.update', $atencion) }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        @method('PUT')
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-4 mb-4">
                            <div>
                                <label for="semestre" class="block text-sm font-medium mb-2" style="color: #333333;">Semestre</label>
                                <input type="text" name="semestre" id="semestre" value="{{ old('semestre', $atencion->semestre) }}" class="w-full border-gray-300 rounded-md shadow-sm @error('semestre') border-red-500 @enderror">
                                @error('semestre')
                                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                                @enderror
                            </div>

                            <div>
                                <label for="fecha" class="block text-sm font-medium mb-2" style="color: #333333;">Fecha</label>
                                <input type="date" name="fecha" id="fecha" value="{{ old('fecha', $atencion->fecha ? $atencion->fecha->format('Y-m-d') : '') }}" class="w-full border-gray-300 rounded-md shadow-sm @error('fecha') border-red-500 @enderror">
                                @error('fecha')
                                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                                @enderror
                            </div>

                            <div>
                                <label for="hora" class="block text-sm font-medium mb-2" style="color: #333333;">Hora</label>
                                <input type="time" name="hora" id="hora" value="{{ old('hora', $atencion->hora ? $atencion->hora->format('H:i') : '') }}" class="w-full border-gray-300 rounded-md shadow-sm @error('hora') border-red-500 @enderror">
                                @error('hora')
                                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                                @enderror
                            </div>

                            <div>
                                <label for="docente_id" class="block text-sm font-medium mb-2" style="color: #333333;">Docente</label>
                                <select name="docente_id" id="docente_id" class="w-full border-gray-300 rounded-md shadow-sm @error('docente_id') border-red-500 @enderror">
                                    <option value="">Seleccione un docente</option>
                                    @foreach($docentes as $docente)
                                        <option value="{{ $docente->id }}" {{ old('docente_id', $atencion->docente_id) == $docente->id ? 'selected' : '' }}>
                                            {{ $docente->nombres }} {{ $docente->apellidos }}
                                        </option>
                                    @endforeach
                                </select>
                                @error('docente_id')
                                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                                @enderror
                            </div>

                            <div>
                                <label for="estudiante_id" class="block text-sm font-medium mb-2" style="color: #333333;">Estudiante</label>
                                <select name="estudiante_id" id="estudiante_id" class="w-full border-gray-300 rounded-md shadow-sm @error('estudiante_id') border-red-500 @enderror">
                                    <option value="">Seleccione un estudiante</option>
                                    @foreach($estudiantes as $estudiante)
                                        <option value="{{ $estudiante->id }}" {{ old('estudiante_id', $atencion->estudiante_id) == $estudiante->id ? 'selected' : '' }}>
                                            {{ $estudiante->codigo }} - {{ $estudiante->nombres }} {{ $estudiante->apellidos }}
                                        </option>
                                    @endforeach
                                </select>
                                @error('estudiante_id')
                                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                                @enderror
                            </div>

                            <div>
                                <label for="tema_id" class="block text-sm font-medium mb-2" style="color: #333333;">Tema</label>
                                <select name="tema_id" id="tema_id" class="w-full border-gray-300 rounded-md shadow-sm @error('tema_id') border-red-500 @enderror">
                                    <option value="">Seleccione un tema</option>
                                    @foreach($temas as $tema)
                                        <option value="{{ $tema->id }}" {{ old('tema_id', $atencion->tema_id) == $tema->id ? 'selected' : '' }}>
                                            {{ $tema->nombre }}
                                        </option>
                                    @endforeach
                                </select>
                                @error('tema_id')
                                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                                @enderror
                            </div>
                        </div>

                        <div class="mb-4">
                            <label for="consulta" class="block text-sm font-medium mb-2" style="color: #333333;">Consulta del Estudiante</label>
                            <textarea name="consulta" id="consulta" rows="3" class="w-full border-gray-300 rounded-md shadow-sm @error('consulta') border-red-500 @enderror">{{ old('consulta', $atencion->consulta) }}</textarea>
                            @error('consulta')
                                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>

                        <div class="mb-4">
                            <label for="descripcion" class="block text-sm font-medium mb-2" style="color: #333333;">Descripción de la Atención</label>
                            <textarea name="descripcion" id="descripcion" rows="3" class="w-full border-gray-300 rounded-md shadow-sm @error('descripcion') border-red-500 @enderror">{{ old('descripcion', $atencion->descripcion) }}</textarea>
                            @error('descripcion')
                                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>

                        @if($atencion->evidencia)
                            <div class="mb-4">
                                <label class="block text-sm font-medium mb-2" style="color: #333333;">Evidencia Actual</label>
                                <a href="{{ asset('storage/' . $atencion->evidencia) }}" target="_blank" class="text-blue-600 hover:text-blue-900">Ver archivo actual</a>
                            </div>
                        @endif

                        <div class="mb-4">
                            <label for="evidencia" class="block text-sm font-medium mb-2" style="color: #333333;">Nueva Evidencia (Opcional)</label>
                            <input type="file" name="evidencia" id="evidencia" class="w-full border-gray-300 rounded-md shadow-sm @error('evidencia') border-red-500 @enderror">
                            @error('evidencia')
                                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                            <p class="mt-1 text-xs text-gray-500">Formatos permitidos: PDF, JPG, JPEG, PNG (máx. 2MB)</p>
                        </div>

                        <div class="flex justify-end gap-2">
                            <a href="{{ route('atenciones.index') }}" class="px-4 py-2 bg-gray-300 text-gray-700 rounded-md">Cancelar</a>
                            <button type="submit" class="px-4 py-2 text-white rounded-md" style="background-color: #800000;">Actualizar</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
