@extends('layouts.app')
@section('main')
<div class="w-full h-[100dvh] flex flex-col">
    
    <div class="flex flex-col md:flex-row flex-1 overflow-y-auto md:overflow-hidden">
        
        <!-- Columna Izquierda: Lista las Tareas del día -->
        <div id="scroll-content" class="w-full md:w-[70%] bg-gradient-to-br from-indigo-950 to-purple-400 p-10 overflow-y-auto">
            <div class="flex flex-wrap justify-between items-center gap-6 mb-8">
                <h1 class="text-purple-600 text-4xl font-bold">T<span class="text-pink-400">A</span>R<span class="text-pink-400">EA</span>S D<span class="text-pink-400">E</span> <span class="text-orange-400">H<span class="text-pink-400">OY</span></span></h1>
                
                <!-- Tarjetas de Acciones -->
                <div class="flex gap-4 items-center flex-wrap">
                    @php
                    $cards = [
                        [
                            'container_bg' => 'bg-pink-300',
                            'btn_bg' => 'bg-yellow-300',
                            'btn_text' => 'text-blue-700',
                            'btn_hover_bg' => 'hover:bg-pink-500',
                            'btn_hover_text' => 'hover:text-yellow-300',
                            'title_color' => 'text-blue-700',
                            'title_html' => 'T<span class="text-yellow-300">A</span>REAS',
                            'route' => route('tareas.index')
                        ],
                        [
                            'container_bg' => 'bg-blue-400',
                            'btn_bg' => 'bg-green-300',
                            'btn_text' => 'text-fuchsia-500',
                            'btn_hover_bg' => 'hover:bg-fuchsia-500',
                            'btn_hover_text' => 'hover:text-green-300',
                            'title_color' => 'text-yellow-200',
                            'title_html' => 'C<span class="text-green-300">A</span>TEGORIAS',
                            'route' => route('categorias.index')
                        ]
                    ];
                    @endphp

                    @foreach ($cards as $card)
                    <a href="{{ $card['route'] ?? '#' }}" class="h-[50px] md:h-[60px] {{ $card['container_bg'] }} rounded-xl px-4 md:px-6 flex justify-center items-center gap-3 shadow-md hover:shadow-lg transition-transform duration-300 hover:-translate-y-1 cursor-pointer">
                        <button class="btn btn-sm btn-circle {{ $card['btn_bg'] }} {{ $card['btn_text'] }} border-none {{ $card['btn_hover_bg'] }} hover:border-none {{ $card['btn_hover_text'] }}">
                            <span class="material-symbols-outlined text-lg">arrow_forward</span>
                        </button>
                        <h1 class="{{ $card['title_color'] }} font-bold text-xl md:text-2xl tracking-tight">{!! $card['title_html'] !!}</h1>
                    </a>
                    @endforeach
                </div>
            </div>

            @if(isset($error) || session('error'))
                <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded relative mb-6 shadow-md" role="alert">
                    <strong class="font-bold">¡Ups!</strong>
                    <span class="block sm:inline">{{ $error ?? session('error') }}</span>
                </div>
            @endif
            
            @if(session('success'))
                <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded relative mb-6 shadow-md" role="alert">
                    <strong class="font-bold">¡Genial!</strong>
                    <span class="block sm:inline">{{ session('success') }}</span>
                </div>
            @endif

        @forelse ($tareas as $tarea)
            @php
                // Definir colores según estado
                $borderColor = 'border-purple-500';
                $textColor = 'text-purple-500';
                
                if($tarea->estado === 'completado') {
                    $borderColor = 'border-green-500';
                    $textColor = 'text-green-600';
                } elseif($tarea->estado === 'cancelado') {
                    $borderColor = 'border-red-500';
                    $textColor = 'text-red-600';
                } else {
                    $borderColor = 'border-yellow-500';
                    $textColor = 'text-yellow-600';
                }
            @endphp
            
            <fieldset class="flex flex-col bg-white w-full min-h-[100px] px-6 py-2 {{ $borderColor }} border-l-[14px] border-t-[14px] mb-4 rounded-br-xl shadow-md relative">
                <legend class="px-2 font-bold {{ $textColor }} bg-white flex items-center gap-2">
                    {{ $tarea->titulo }}
                    @if($tarea->categoria)
                        <span class="bg-gray-100 text-gray-500 text-xs px-2 py-1 rounded-full font-mono">
                            {{ $tarea->categoria->name }}
                        </span>
                    @endif
                    <span class="text-xs font-normal text-gray-400 ml-auto">
                        <span class="material-symbols-outlined text-[14px] align-middle">schedule</span>
                        {{ $tarea->created_at->format('H:i') }}
                    </span>
                </legend>
                <div class="text-blue-800 text-sm mt-1 mb-8 pr-32">{{ $tarea->descripcion ?? 'Sin descripción' }}</div>
                
                <!-- Selector de estado interactivo -->
                <div class="absolute bottom-4 right-4">
                    <form action="{{ route('tareas.updateStatus', $tarea->id) }}" method="POST" class="m-0 p-0">
                        @csrf
                        @method('PATCH')
                        
                        <select name="estado" onchange="this.form.submit()" 
                            class="px-4 py-1 rounded-full text-xs font-bold text-white shadow-sm cursor-pointer outline-none focus:ring-2 focus:ring-white/50 text-center appearance-none transition-colors
                            {{ $tarea->estado === 'completado' ? 'bg-green-500 hover:bg-green-600' : 
                              ($tarea->estado === 'cancelado' ? 'bg-red-500 hover:bg-red-600' : 'bg-yellow-500 hover:bg-yellow-600') }}">
                            <option class="text-gray-800 bg-white" value="pendiente" {{ $tarea->estado === 'pendiente' ? 'selected' : '' }}>Pendiente</option>
                            <option class="text-gray-800 bg-white" value="completado" {{ $tarea->estado === 'completado' ? 'selected' : '' }}>Completado</option>
                            <option class="text-gray-800 bg-white" value="cancelado" {{ $tarea->estado === 'cancelado' ? 'selected' : '' }}>Cancelado</option>
                        </select>
                    </form>
                </div>
            </fieldset>
        @empty
            <div class="rounded-xl p-8 text-center text-white">
                <p class="font-bold text-xl opacity-80">¡Todo al día!</p>
                <p class="opacity-60 text-sm">No tienes tareas registradas para hoy.</p>
            </div>
        @endforelse

        </div>
        <!-- Columna Derecha: Muestra la lista rápida de Categorías -->
        <div id="list-categories" class="w-full md:w-[30%] bg-gradient-to-b from-violet-900 to-blue-300 p-8 overflow-y-auto">
            <h2 class="text-yellow-300 mb-6 text-3xl font-bold">
                C<span class="text-pink-500">A</span>TEG<span class="text-orange-500">O</span>RÍ<span class="text-purple-500">A</span>S</h2>
            
            @php
            $colors = [
                ['text' => 'text-pink-600', 'bg' => 'bg-pink-100'],
                ['text' => 'text-green-600', 'bg' => 'bg-green-100'],
                ['text' => 'text-yellow-600', 'bg' => 'bg-yellow-100'],
                ['text' => 'text-purple-600', 'bg' => 'bg-purple-100'],
                ['text' => 'text-orange-600', 'bg' => 'bg-orange-100'],
            ];
            @endphp

            <ul class="space-y-4">
                @forelse ($categorias as $index => $cat)
                @php
                    $color = $colors[$index % count($colors)];
                @endphp
                <li class="flex items-center justify-between {{ $color['bg'] }} p-4
                    rounded-[50px]
                    shadow-md hover:scale-105 
                    transition-transform duration-200 cursor-pointer"
                    onclick="window.location='{{ route('categorias.index') }}'">
                    <span class="font-bold text-xl {{ $color['text'] }}">{{ $cat->name }}</span>
                    <span class="material-symbols-outlined {{ $color['text'] }}">arrow_forward_ios</span>
                </li>
                @empty
                <li class="text-white/70 italic text-center mt-8">No hay categorías registradas.</li>
                @endforelse
            </ul>
        </div>
    </div>
</div>
@endsection

