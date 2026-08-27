@extends('layouts.app')
@section('main')
<div class="p-8 flex justify-center items-center min-h-[80vh]">
    <div class="w-full max-w-lg bg-white/10 backdrop-blur-xl rounded-3xl shadow-2xl border border-white/20 p-8">
        
        <div class="flex items-center justify-between mb-8 border-b border-white/10 pb-4">
            <h1 class="text-white text-3xl font-bold tracking-wide drop-shadow-md flex items-center gap-2">
                <span class="material-symbols-outlined text-green-300 text-3xl">edit</span>
                Editar Categoría
            </h1>
            <a href="{{ route('categorias.index') }}" class="text-purple-300 hover:text-white transition-colors">
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

        {{-- Formulario que envía los datos modificados a 'categorias.update'. La ruta recibe la categoría que se va a editar. --}}
        <form action="{{ route('categorias.update', $categoria) }}" method="POST" class="space-y-6">
            @csrf
            {{-- Especifica el método PUT, que es el que se usa en Laravel para actualizar recursos existentes --}}
            @method('PUT')

            <div>
                <label for="name" class="block text-green-300 text-sm font-bold mb-2">Nombre de la Categoría</label>
                {{-- Muestra el valor de 'name' de la categoría cargada desde la base de datos, o 'old' si hubo un error --}}
                <input type="text" name="name" id="name" value="{{ old('name', $categoria->name) }}" required
                    class="w-full bg-white/5 border border-purple-300/30 rounded-xl py-3 px-4 text-white placeholder-purple-300/50 focus:outline-none focus:ring-2 focus:ring-green-400 focus:border-transparent transition-all">
            </div>

            <div class="pt-6 flex justify-end gap-4">
                <a href="{{ route('categorias.index') }}" class="px-6 py-3 rounded-xl font-bold text-white bg-white/10 hover:bg-white/20 transition-all">Cancelar</a>
                <button type="submit" class="bg-gradient-to-r from-yellow-400 to-orange-500 hover:from-yellow-300 hover:to-orange-400 text-white font-bold py-3 px-8 rounded-xl shadow-lg hover:shadow-orange-500/50 transform hover:-translate-y-1 transition-all duration-200">
                    Actualizar Categoría
                </button>
            </div>
        </form>

    </div>
</div>
@endsection
