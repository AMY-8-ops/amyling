<!-- hereda diseño y estructura de la vista base -->
@extends('layouts.base')
<!-- reserva espacio para contenido de vistas hijas -->
@section('content')
<div class="wrapper relative">    
    @include('partials.sidebar')
    <!-- Contenido Principal -->
    <main>
        @include('partials.navbar')
        <div>
            @yield('main')
        </div>
    </main>
</div>
@endsection