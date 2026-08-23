<!-- hereda diseño y estructura de la vista base -->
@extends('layouts.base')
<!-- reserva espacio para contenido de vistas hijas -->
@section('content')
<div class="wrapper flex">
    <!-- Sidebar -->
    @include('partials.sidebar')
    
    <!-- Contenido Principal -->
    <main class="ml-[250px] flex-1 flex flex-col min-h-screen">
        @include('partials.navbar')
        <div class="flex-1 flex flex-col">
            @yield('main')
        </div>
    </main>
</div>
@endsection