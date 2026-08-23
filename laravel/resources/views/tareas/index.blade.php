@extends('layouts.app')
@section('main')
<div class="p-8">
    
    @if(session('success'))
        <div class="bg-green-500/20 border border-green-500/50 text-green-200 px-4 py-3 rounded-xl mb-6 shadow-sm">
            {{ session('success') }}
        </div>
    @endif

    <div class="flex flex-col md:flex-row justify-between items-center mb-8 gap-4">
        <!-- Título y Búsqueda -->
        <div class="flex-1 w-full max-w-2xl flex flex-col md:flex-row gap-4 items-center">
            <h1 class="text-white text-3xl font-bold tracking-wide drop-shadow-md">T<span class="text-yellow-300">A</span>REAS</h1>
            <div class="relative w-full md:w-96">
                <span class="absolute inset-y-0 left-0 flex items-center pl-3 text-gray-400">
                    <span class="material-symbols-outlined">search</span>
                </span>
                <input type="text" class="w-full bg-white/10 backdrop-blur-md border border-white/20 rounded-full py-2.5 pl-10 pr-4 text-white placeholder-gray-300 focus:outline-none focus:ring-2 focus:ring-yellow-300 transition-all" placeholder="Buscar tarea...">
            </div>
        </div>

        <!-- Botón Crear -->
        <div class="shadow-lg">
            <a href="{{ route('tareas.create') }}" class="flex items-center gap-2 bg-gradient-to-r from-pink-500 to-purple-500 hover:from-pink-400 hover:to-purple-400 text-white font-bold py-2.5 px-6 rounded-xl shadow-md transition-all hover:-translate-y-1">
                <span class="material-symbols-outlined">add_task</span>
                Nueva Tarea
            </a>
        </div>
    </div>

    <!-- Tabla de Tareas -->
    <div class="bg-white/10 backdrop-blur-xl border border-white/20 overflow-hidden shadow-2xl">
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
                    @forelse ($tareas as $tarea)
                        <tr class="border-b border-white/10 hover:bg-white/5 transition-colors">
                            <td class="p-4 font-semibold text-white">{{ $tarea->titulo }}</td>
                            <td class="p-4">
                                <span class="text-white font-bold text-sm">
                                    {{ $tarea->categoria->name ?? 'Sin categoría' }}
                                </span>
                            </td>
                            <td class="p-4">
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
                                    <a href="{{ route('tareas.edit', $tarea) }}" class="bg-yellow-400/20 text-yellow-400 hover:bg-yellow-400 hover:text-purple-900 p-2 rounded-lg transition-colors" title="Editar">
                                        <span class="material-symbols-outlined text-sm">edit</span>
                                    </a>
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
                    @empty
                        <tr>
                            <td colspan="5" class="p-8 text-center text-purple-200">
                                <div class="flex flex-col items-center justify-center gap-2">
                                    <span class="material-symbols-outlined text-4xl opacity-50">inbox</span>
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
