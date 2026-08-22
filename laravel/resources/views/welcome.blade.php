@extends('layouts.app')
@section('content')
<div class="container mx-auto p-6 max-w-4xl space-y-6">
    
    <!-- Hero / Header con componentes de DaisyUI -->
    <div class="hero bg-base-200 rounded-box p-8 shadow-sm">
        <div class="hero-content text-center">
            <div class="max-w-md">
                <h1 class="text-4xl font-extrabold text-primary flex items-center justify-center gap-2">
                    <span class="material-symbols-outlined text-4xl">task_alt</span>
                    MIS TAREAS
                </h1>
                <p class="py-4 text-base-content/80">
                    Organiza tus actividades con estilo utilizando el tema <span class="badge badge-secondary font-semibold">Valentine</span> de DaisyUI.
                </p>
                <div class="flex justify-center gap-3">
                    <button class="btn btn-primary">
                        <span class="material-symbols-outlined">add</span>
                        Nueva Tarea
                    </button>
                    <button class="btn btn-outline btn-accent">Ver Filtros</button>
                </div>
            </div>
        </div>
    </div>

    <!-- Ejemplo de Lista de Tarjetas (Cards) de Tareas -->
    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
        
        <!-- Tarjeta Tarea 1 -->
        <div class="card bg-base-100 shadow-md border border-primary/20 hover:shadow-lg transition-shadow">
            <div class="card-body">
                <div class="flex justify-between items-start">
                    <h2 class="card-title text-primary">Diseñar Interfaz</h2>
                    <span class="badge badge-primary">Pendiente</span>
                </div>
                <p class="text-sm text-base-content/70">Aplicar temas y componentes interactivos de DaisyUI.</p>
                <div class="card-actions justify-end mt-4">
                    <button class="btn btn-sm btn-ghost text-error">Eliminar</button>
                    <button class="btn btn-sm btn-secondary">Completar</button>
                </div>
            </div>
        </div>

        <!-- Tarjeta Tarea 2 -->
        <div class="card bg-base-100 shadow-md border border-primary/20 hover:shadow-lg transition-shadow">
            <div class="card-body">
                <div class="flex justify-between items-start">
                    <h2 class="card-title text-primary">Configurar Rutas</h2>
                    <span class="badge badge-accent">En Proceso</span>
                </div>
                <p class="text-sm text-base-content/70">Crear controladores y vincularlos a las vistas Blade.</p>
                <div class="card-actions justify-end mt-4">
                    <button class="btn btn-sm btn-ghost text-error">Eliminar</button>
                    <button class="btn btn-sm btn-secondary">Completar</button>
                </div>
            </div>
        </div>

    </div>

</div>
@endsection

