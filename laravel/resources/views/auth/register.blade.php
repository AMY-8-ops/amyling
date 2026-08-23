@extends('layouts.base')
@section('content')
<div class="min-h-screen bg-gradient-to-b from-violet-900 to-blue-300 flex items-center justify-center p-6">
    <div class="w-full max-w-md bg-white/10 backdrop-blur-lg rounded-3xl shadow-2xl border border-white/20 p-8">
        
        <div class="text-center mb-8">
            <h1 class="text-white text-3xl font-bold tracking-wide drop-shadow-md">Únete a T<span class="text-yellow-300">A</span>SKFL<span class="text-yellow-300">O</span>W</h1>
            <p class="text-blue-200 mt-2 font-medium">Crea tu cuenta gratis</p>
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
        
        <form method="POST" action="{{ route('register') }}" class="space-y-5">
            @csrf

            <div>
                <label for="user_name" class="block text-blue-100 text-sm font-semibold mb-2 ml-1">Nombre de Usuario</label>
                <div class="relative">
                    <span class="absolute inset-y-0 left-0 flex items-center pl-3 text-yellow-300">
                        <span class="material-symbols-outlined">person_add</span>
                    </span>
                    <input id="user_name" type="text"
                        class="w-full bg-white/5 border border-blue-300/30 rounded-xl py-3 pl-10 pr-4 text-white placeholder-blue-200/50 focus:outline-none focus:ring-2 focus:ring-yellow-300 focus:border-transparent transition-all"
                        name="user_name" value="{{ old('user_name') }}" placeholder="Elige un usuario único" required autofocus>
                </div>
            </div>

            <div>
                <label for="password" class="block text-blue-100 text-sm font-semibold mb-2 ml-1">Contraseña</label>
                <div class="relative">
                    <span class="absolute inset-y-0 left-0 flex items-center pl-3 text-yellow-300">
                        <span class="material-symbols-outlined">lock</span>
                    </span>
                    <input id="password" type="password"
                        class="w-full bg-white/5 border border-blue-300/30 rounded-xl py-3 pl-10 pr-4 text-white placeholder-blue-200/50 focus:outline-none focus:ring-2 focus:ring-yellow-300 focus:border-transparent transition-all"
                        name="password" placeholder="Mínimo 8 caracteres" required>
                </div>
            </div>

            <div>
                <label for="password_confirmation" class="block text-blue-100 text-sm font-semibold mb-2 ml-1">Confirmar Contraseña</label>
                <div class="relative">
                    <span class="absolute inset-y-0 left-0 flex items-center pl-3 text-yellow-300">
                        <span class="material-symbols-outlined">verified</span>
                    </span>
                    <input id="password_confirmation" type="password"
                        class="w-full bg-white/5 border border-blue-300/30 rounded-xl py-3 pl-10 pr-4 text-white placeholder-blue-200/50 focus:outline-none focus:ring-2 focus:ring-yellow-300 focus:border-transparent transition-all"
                        name="password_confirmation" placeholder="Repite tu contraseña" required>
                </div>
            </div>

            <div class="pt-4">
                <button type="submit"
                    class="w-full bg-yellow-400 hover:bg-yellow-300 text-purple-900 font-bold py-3 px-4 rounded-xl shadow-lg hover:shadow-yellow-400/50 transform hover:-translate-y-1 transition-all duration-200">
                    Registrar Cuenta
                </button>
            </div>
            
            <p class="text-center text-blue-200 text-sm mt-6">
                ¿Ya tienes una cuenta? 
                <a href="{{ route('login') }}" class="text-yellow-300 font-bold hover:text-white hover:underline transition-colors">
                    Inicia Sesión
                </a>
            </p>
        </form>
    </div>
</div>
@endsection