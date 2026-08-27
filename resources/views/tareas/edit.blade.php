<!-- Hereda el diseño base de la aplicación (navbar, sidebar, fondo) -->
@extends('layouts.app')

<!-- Inyecta este contenido en la sección 'main' de layouts/app.blade.php -->
@section('main')
<div class="p-8 flex justify-center items-center min-h-[80vh]">
    <div class="w-full max-w-2xl bg-white/10 backdrop-blur-xl rounded-3xl shadow-2xl border border-white/20 p-8">
        
        <div class="flex items-center justify-between mb-8 border-b border-white/10 pb-4">
            <h1 class="text-white text-3xl font-bold tracking-wide drop-shadow-md flex items-center gap-2">
                <span class="material-symbols-outlined text-yellow-300 text-3xl">edit_note</span>
                Editar Tarea
            </h1>
            <a href="{{ route('tareas.index') }}" class="text-purple-300 hover:text-white transition-colors">
                <span class="material-symbols-outlined">close</span>
            </a>
        </div>

        @if ($errors->any())
            <div class="bg-red-500/20 border border-red-500/50 text-red-200 px-4 py-3 rounded-xl mb-6 shadow-sm">
                <ul class="list-disc list-inside text-sm">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <!-- Formulario: Envía datos a TareaController@update -->
        {{-- route('tareas.update', $tarea) genera la URL a la que se enviarán los datos modificados --}}
        <form action="{{ route('tareas.update', $tarea) }}" method="POST" class="space-y-6">
            <!-- Token de seguridad y método PUT (requerido por Laravel para actualizar recursos) -->
            @csrf
            {{-- html no soporta el método PUT, así que Laravel lo simula con @method('PUT') --}}
            @method('PUT')

            <div>
                <label for="titulo" class="block text-yellow-300 text-sm font-bold mb-2">Título de la Tarea</label>
                {{-- old('titulo', $tarea->titulo) pone el valor anterior si falló la validación, o el valor actual de la base de datos si es la primera carga --}}
                <input type="text" name="titulo" id="titulo" value="{{ old('titulo', $tarea->titulo) }}" required
                    class="w-full bg-white/5 border border-purple-300/30 rounded-xl py-3 px-4 text-white placeholder-purple-300/50 focus:outline-none focus:ring-2 focus:ring-pink-400 focus:border-transparent transition-all">
            </div>

            <div>
                <label for="descripcion" class="block text-yellow-300 text-sm font-bold mb-2">Descripción (Opcional)</label>
                <textarea name="descripcion" id="descripcion" rows="3"
                    class="w-full bg-white/5 border border-purple-300/30 rounded-xl py-3 px-4 text-white placeholder-purple-300/50 focus:outline-none focus:ring-2 focus:ring-pink-400 focus:border-transparent transition-all">{{ old('descripcion', $tarea->descripcion) }}</textarea>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <div>
                    <label for="categoria_id" class="block text-yellow-300 text-sm font-bold mb-2">Categoría</label>
                    <select name="categoria_id" id="categoria_id" required
                        class="w-full bg-indigo-900 border border-purple-300/30 rounded-xl py-3 px-4 text-white focus:outline-none focus:ring-2 focus:ring-pink-400 focus:border-transparent transition-all cursor-pointer">
                        <option value="" disabled>Selecciona una categoría</option>
                        @foreach($categorias as $categoria)
                            <option value="{{ $categoria->id }}" {{ old('categoria_id', $tarea->categoria_id) == $categoria->id ? 'selected' : '' }}>
                                {{ $categoria->name }}
                            </option>
                        @endforeach
                    </select>
                </div>

                <div>
                    <label for="estado" class="block text-yellow-300 text-sm font-bold mb-2">Estado</label>
                    <select name="estado" id="estado" required
                        class="w-full bg-indigo-900 border border-purple-300/30 rounded-xl py-3 px-4 text-white focus:outline-none focus:ring-2 focus:ring-pink-400 focus:border-transparent transition-all cursor-pointer">
                        <option value="pendiente" {{ old('estado', $tarea->estado) == 'pendiente' ? 'selected' : '' }}>Pendiente</option>
                        <option value="completado" {{ old('estado', $tarea->estado) == 'completado' ? 'selected' : '' }}>Completado</option>
                    </select>
                </div>
            </div>

            <div class="pt-6 flex justify-end gap-4">
                <a href="{{ route('tareas.index') }}" class="px-6 py-3 rounded-xl font-bold text-white bg-white/10 hover:bg-white/20 transition-all">Cancelar</a>
                <button type="submit" class="bg-gradient-to-r from-yellow-400 to-orange-500 hover:from-yellow-300 hover:to-orange-400 text-white font-bold py-3 px-8 rounded-xl shadow-lg hover:shadow-orange-500/50 transform hover:-translate-y-1 transition-all duration-200">
                    Actualizar Tarea
                </button>
            </div>
        </form>

    </div>
</div>
@endsection
