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
            <h1 class="text-white text-3xl font-bold tracking-wide drop-shadow-md">C<span class="text-green-300">A</span>TEG<span class="text-pink-400">O</span>RÍAS</h1>
            <div class="relative w-full md:w-96">
                <span class="absolute inset-y-0 left-0 flex items-center pl-3 text-gray-400">
                    <span class="material-symbols-outlined">search</span>
                </span>
                <input type="text" class="w-full bg-white/10 backdrop-blur-md border border-white/20 rounded-full py-2.5 pl-10 pr-4 text-white placeholder-gray-300 focus:outline-none focus:ring-2 focus:ring-green-300 transition-all" placeholder="Buscar categoría...">
            </div>
        </div>

        <!-- Botón Crear -->
        <div class="shadow-lg">
            <a href="{{ route('categorias.create') }}" class="flex items-center gap-2 bg-gradient-to-r from-green-500 to-teal-500 hover:from-green-400 hover:to-teal-400 text-white font-bold py-2.5 px-6 rounded-xl shadow-md transition-all hover:-translate-y-1">
                <span class="material-symbols-outlined">category</span>
                Nueva Categoría
            </a>
        </div>
    </div>

    <!-- Tabla de Categorías -->
    <div class="bg-white/10 backdrop-blur-xl border border-white/20 overflow-hidden shadow-2xl">
        <div class="overflow-x-auto">
            <table class="w-full text-left border-collapse">
                <thead>
                    <tr class="bg-black/20 text-green-300 font-mono tracking-widest text-sm uppercase">
                        <th class="p-4 w-16">ID</th>
                        <th class="p-4">Nombre de la Categoría</th>
                        <th class="p-4 text-center">Acciones</th>
                    </tr>
                </thead>
                <tbody class="text-blue-100">
                    @forelse ($categorias as $categoria)
                        <tr class="border-b border-white/10 hover:bg-white/5 transition-colors">
                            <td class="p-4 font-semibold text-white/50">{{ $categoria->id }}</td>
                            <td class="p-4 font-semibold text-white">{{ $categoria->name }}</td>
                            <td class="p-4 text-center">
                                <div class="flex justify-center gap-2">
                                    <a href="{{ route('categorias.edit', $categoria) }}" class="bg-yellow-400/20 text-yellow-400 hover:bg-yellow-400 hover:text-purple-900 p-2 rounded-lg transition-colors" title="Editar">
                                        <span class="material-symbols-outlined text-sm">edit</span>
                                    </a>
                                    <form action="{{ route('categorias.destroy', $categoria) }}" method="POST" class="inline" onsubmit="return confirm('¿Seguro que deseas eliminar esta categoría? Las tareas asociadas podrían verse afectadas.');">
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
                            <td colspan="3" class="p-8 text-center text-purple-200">
                                <div class="flex flex-col items-center justify-center gap-2">
                                    <span class="material-symbols-outlined text-4xl opacity-50">category</span>
                                    <p>No tienes categorías creadas aún.</p>
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
