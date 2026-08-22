<!-- hereda diseño y estructura de la vista base -->
@extends('layouts.base')
<!-- reserva espacio para contenido de vistas hijas -->
@section('content')
<div>
    @yield('content')
</div>
@endsection