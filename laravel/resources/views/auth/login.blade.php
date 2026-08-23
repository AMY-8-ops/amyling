@extends('layouts.base')
@section('content')
<div class="min-h-screen bg-gradient-to-br from-indigo-950 to-purple-400 flex items-center justify-center p-6">
    <div class="w-full max-w-md bg-white/10 backdrop-blur-lg rounded-3xl shadow-2xl border border-white/20 p-8">
        
        <div class="text-center mb-8">
            <h1 class="text-white text-3xl font-bold tracking-wide drop-shadow-md">T<span class="text-pink-400">A</span>SKFL<span class="text-pink-400">O</span>W</h1>
            <p class="text-pink-200 mt-2 font-medium">Bienvenido de nuevo</p>
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
        
        <form method="POST" action="{{ route('login') }}" class="space-y-6">
            @csrf

            <div>
                <label for="user_name" class="block text-purple-200 text-sm font-semibold mb-2 ml-1">Nombre de Usuario</label>
                <div class="relative">
                    <span class="absolute inset-y-0 left-0 flex items-center pl-3 text-pink-300">
                        <span class="material-symbols-outlined">person</span>
                    </span>
                    <input id="user_name" type="text"
                        class="w-full bg-white/5 border border-purple-300/30 rounded-xl py-3 pl-10 pr-4 text-white placeholder-purple-300/50 focus:outline-none focus:ring-2 focus:ring-pink-400 focus:border-transparent transition-all"
                        name="user_name" value="{{ old('user_name') }}" placeholder="Ingresa tu usuario" required autofocus>
                </div>
            </div>

            <div>
                <label for="password" class="block text-purple-200 text-sm font-semibold mb-2 ml-1">Contraseña</label>
                <div class="relative">
                    <span class="absolute inset-y-0 left-0 flex items-center pl-3 text-pink-300">
                        <span class="material-symbols-outlined">lock</span>
                    </span>
                    <input id="password" type="password"
                        class="w-full bg-white/5 border border-purple-300/30 rounded-xl py-3 pl-10 pr-4 text-white placeholder-purple-300/50 focus:outline-none focus:ring-2 focus:ring-pink-400 focus:border-transparent transition-all"
                        name="password" placeholder="••••••••" required>
                </div>
            </div>

            <div class="pt-4">
                <button type="submit"
                    class="w-full bg-gradient-to-r from-pink-500 to-purple-500 hover:from-pink-400 hover:to-purple-400 text-white font-bold py-3 px-4 rounded-xl shadow-lg hover:shadow-pink-500/50 transform hover:-translate-y-1 transition-all duration-200">
                    Iniciar Sesión
                </button>
            </div>
            
            <p class="text-center text-purple-200 text-sm mt-6">
                ¿No tienes una cuenta? 
                <a href="{{ route('register') }}" class="text-pink-300 font-bold hover:text-pink-200 hover:underline transition-colors">
                    Regístrate aquí
                </a>
            </p>
        </form>
    </div>
</div>
@endsection
