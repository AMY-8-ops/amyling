@extends('layouts.app')
@section('main')
<div class="p-8">
    
    {{-- Comprueba si hay un mensaje flash llamado 'success' (enviado desde el controlador tras una acción) --}}
    @if(session('success'))
        <div class="bg-green-500/20 border border-green-500/50 text-green-200 px-4 py-3 rounded-xl mb-6 shadow-sm">
            {{ session('success') }}
        </div>
    @endif

    <!-- Encabezado de la página de Tareas: Contiene el Título Principal y el Botón de Crear -->
    <div class="flex flex-col md:flex-row justify-between items-center mb-8 gap-4">
        <!-- Título y Búsqueda -->
        <div class="flex-1 w-full max-w-2xl flex flex-col md:flex-row gap-4 items-center">
            <h1 class="text-white text-3xl font-bold tracking-wide drop-shadow-md">T<span class="text-yellow-300">A</span>REAS</h1>
            <div class="relative w-full md:w-96">
                <span class="absolute inset-y-0 left-0 flex items-center pl-3 text-gray-400">
                </span>
                <input type="text" class="w-full bg-pink-500/40 backdrop-blur-md border border-white/20 rounded-full py-2.5 pl-10 pr-4
                text-white placeholder-gray-300 focus:outline-none focus:ring-2 focus:ring-yellow-300 transition-all"
                placeholder="Buscar tarea...">
            </div>
        </div>

        <!-- Botón Crear -->
        <div class="shadow-lg">
            <a href="{{ route('tareas.create') }}" class="flex items-center gap-2 bg-gradient-to-r
            from-pink-500 to-purple-500 hover:from-pink-400 hover:to-purple-400
            text-white font-bold py-2.5 px-6 rounded-xl shadow-md transition-all
            hover:-translate-y-1">
                <span class="material-symbols-outlined">add_task</span>
                Nueva Tarea
            </a>
        </div>
    </div>

    <!-- Contenedor Principal de la Tabla de Tareas -->
    <div class="bg-white/10 backdrop-blur-xl border border-white/20 overflow-hidden shadow-2xl">
        <!-- Permite scroll horizontal en dispositivos pequeños -->
        <div class="overflow-x-auto">
            <table class="w-full text-left border-collapse">
                <thead>
                    <tr class="bg-black/20 text-yellow-300 font-mono tracking-widest text-sm uppercase">
                        <th class="p-4">Título</th>
                        <th class="p-4">Categoría</th>
                        <th class="p-4">Estado</th>
                        <th class="p-4 text-center">Acciones</th>
                    </tr>
                </thead>
                <tbody class="text-blue-100">
                    {{-- @forelse hace un bucle sobre las tareas, y si no hay (está vacío), ejecuta el bloque @empty --}}
                    @forelse ($tareas as $tarea)
                        <tr class="border-b border-white/10 hover:bg-white/5 transition-colors">
                            <td class="p-4 font-semibold text-white">{{ $tarea->titulo }}</td>
                            <td class="p-4">
                                <span class="text-white font-bold text-sm">
                                    {{-- Intenta mostrar el nombre de la categoría o un texto alternativo si es null --}}
                                    {{ $tarea->categoria->name ?? 'Sin categoría' }}
                                </span>
                            </td>
                            <td class="p-4">
                                {{-- Verifica el estado de la tarea para mostrar un ícono y texto diferente --}}
                                @if($tarea->estado === 'completado')
                                    <span class="text-white font-bold flex items-center gap-1 text-sm">
                                        <span class="material-symbols-outlined text-base">check_circle</span> Completado
                                    </span>
                                @else
                                    <span class="text-white font-bold flex items-center gap-1 text-sm">
                                        <span class="material-symbols-outlined text-base">schedule</span> Pendiente
                                    </span>
                                @endif
                            </td>
                            <td class="p-4 text-center">
                                <div class="flex justify-center gap-2">
                                    {{-- Botón para ir a la vista de editar, pasando el id de la tarea --}}
                                    <a href="{{ route('tareas.edit', $tarea) }}" class="bg-yellow-400/20 text-yellow-400 hover:bg-yellow-400 hover:text-purple-900 p-2 rounded-lg transition-colors" title="Editar">
                                        <span class="material-symbols-outlined text-sm">edit</span>
                                    </a>
                                    {{-- Formulario para eliminar la tarea. Se requiere POST con @method('DELETE') para borrar recursos --}}
                                    <form action="{{ route('tareas.destroy', $tarea) }}" method="POST" class="inline" onsubmit="return confirm('¿Seguro que deseas eliminar esta tarea?');">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="bg-red-500/20 text-red-400 hover:bg-red-500 hover:text-white p-2 rounded-lg transition-colors" title="Eliminar">
                                            <span class="material-symbols-outlined text-sm">delete</span>
                                        </button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                    {{-- Si no hay tareas en la base de datos para este usuario, muestra este mensaje --}}
                    @empty
                        <tr>
                            <td colspan="5" class="p-8 text-center text-purple-200">
                                <div class="flex flex-col items-center justify-center gap-2">
                                    <p>No tienes tareas creadas aún.</p>
                                </div>
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>

</div>
@endsection
