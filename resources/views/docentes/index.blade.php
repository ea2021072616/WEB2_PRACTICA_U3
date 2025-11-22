<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center">
            <h2 class="font-semibold text-xl leading-tight" style="color: #800000;">
                Docentes
            </h2>
            <a href="{{ route('docentes.create') }}" class="px-4 py-2 text-white rounded-md" style="background-color: #800000;">
                Nuevo Docente
            </a>
        </div>
    </x-slot>

    <div class="py-8">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            @if(session('success'))
                <div class="mb-4 p-4 bg-green-100 border border-green-400 text-green-700 rounded">
                    {{ session('success') }}
                </div>
            @endif

            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6">
                    <table class="min-w-full divide-y divide-gray-200">
                        <thead>
                            <tr style="background-color: #F2F2F2;">
                                <th class="px-6 py-3 text-left text-xs font-medium uppercase tracking-wider" style="color: #333333;">Usuario</th>
                                <th class="px-6 py-3 text-left text-xs font-medium uppercase tracking-wider" style="color: #333333;">Apellidos</th>
                                <th class="px-6 py-3 text-left text-xs font-medium uppercase tracking-wider" style="color: #333333;">Nombres</th>
                                <th class="px-6 py-3 text-left text-xs font-medium uppercase tracking-wider" style="color: #333333;">Acciones</th>
                            </tr>
                        </thead>
                        <tbody class="bg-white divide-y divide-gray-200">
                            @foreach($docentes as $docente)
                                <tr>
                                    <td class="px-6 py-4 whitespace-nowrap" style="color: #333333;">{{ $docente->user->email }}</td>
                                    <td class="px-6 py-4 whitespace-nowrap" style="color: #333333;">{{ $docente->apellidos }}</td>
                                    <td class="px-6 py-4 whitespace-nowrap" style="color: #333333;">{{ $docente->nombres }}</td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm">
                                        <a href="{{ route('docentes.edit', $docente) }}" class="text-blue-600 hover:text-blue-900 mr-3">Editar</a>
                                        <form action="{{ route('docentes.destroy', $docente) }}" method="POST" class="inline">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="text-red-600 hover:text-red-900" onclick="return confirm('¿Está seguro?')">Eliminar</button>
                                        </form>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                    <div class="mt-4">
                        {{ $docentes->links() }}
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
