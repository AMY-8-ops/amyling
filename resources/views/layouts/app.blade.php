<!-- hereda diseño y estructura de la vista base -->
@extends('layouts.base')
<!-- reserva espacio para contenido de vistas hijas -->
@section('content')
<div class="wrapper relative">    
    @include('partials.sidebar')
    <!-- Contenido Principal -->
    <main>
        @include('partials.navbar')
        <div class="bg-gradient-to-b from-violet-900 to-black w-full h-screen">
            @yield('main')
        </div>
    </main>
</div>
@endsection