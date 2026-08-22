@extends('layouts.app')
@section('content')
<div class="w-full h-[100dvh] flex flex-col">
    <div class="flex flex-col md:flex-row flex-1 overflow-y-auto md:overflow-hidden">
        <div id="scroll-content" class="w-full md:w-[60%] bg-blue-900 p-5 md:overflow-y-auto">
            <h1 class="text-amber-300 mb-2 text-4xl font-bold">T<span class="text-pink-400">A</span>R<span class="text-pink-400">EA</span>S D<span class="text-pink-400">E</span> <span class="text-blue-400">H<span class="text-pink-400">OY</span></span></h1>
        @php
        $tasks = [
            ['border' => 'border-purple-500', 'text' => 'text-purple-500', 'title' => 'Titulo tarea', 'content' => 'Contenido aquí...'],
            ['border' => 'border-pink-500', 'text' => 'text-pink-500', 'title' => 'Titulo tarea', 'content' => 'Contenido aquí...'],
            ['border' => 'border-orange-500', 'text' => 'text-orange-500', 'title' => 'Titulo tarea', 'content' => 'Contenido aquí...'],
            ['border' => 'border-yellow-500', 'text' => 'text-yellow-500', 'title' => 'Titulo tarea', 'content' => 'Contenido aquí...'],
            ['border' => 'border-orange-500', 'text' => 'text-orange-500', 'title' => 'Titulo tarea', 'content' => 'Contenido aquí...'],
            ['border' => 'border-yellow-500', 'text' => 'text-yellow-500', 'title' => 'Titulo tarea', 'content' => 'Contenido aquí...'],
        ];
        @endphp

        @foreach ($tasks as $task)
        <fieldset class="flex flex-col bg-blue-200 w-full h-[100px] px-6 {{ $task['border'] }} border-l-[14px] border-t-[14px] mb-2">
            <legend class="px-1 font-bold {{ $task['text'] }} ">
                {{ $task['title'] }}
            </legend>
            <p class="text-blue-800">{{ $task['content'] }}</p>
        </fieldset>
        @endforeach

        </div>
        <div id="list-categories" class="w-full md:w-[40%] bg-indigo-950 p-8 md:overflow-y-auto">
            <h2 class="text-amber-300 mb-6 text-3xl font-bold">M<span class="text-green-400">Á</span>S <span class="text-pink-400">I</span>MP<span class="text-yellow-400">O</span>RT<span class="text-purple-400">A</span>NTES</h2>
            
            @php
            $importantTasks = [
                ['border' => 'border-pink-900', 'text' => 'text-pink-100', 'title' => 'Tarea urgente 1', 'bg' => 'bg-pink-700'],
                ['border' => 'border-green-900', 'text' => 'text-green-100', 'title' => 'Tarea urgente 2', 'bg' => 'bg-green-700'],
                ['border' => 'border-yellow-900', 'text' => 'text-yellow-100', 'title' => 'Tarea urgente 3', 'bg' => 'bg-yellow-700'],
                ['border' => 'border-purple-900', 'text' => 'text-purple-100', 'title' => 'Tarea urgente 4', 'bg' => 'bg-purple-700'],
                ['border' => 'border-orange-900', 'text' => 'text-orange-100', 'title' => 'Tarea urgente 5', 'bg' => 'bg-orange-700'],
                ['border' => 'border-pink-900', 'text' => 'text-pink-100', 'title' => 'Tarea urgente 1', 'bg' => 'bg-pink-700'],
                ['border' => 'border-green-900', 'text' => 'text-green-100', 'title' => 'Tarea urgente 2', 'bg' => 'bg-green-700'],
                ['border' => 'border-yellow-900', 'text' => 'text-yellow-100', 'title' => 'Tarea urgente 3', 'bg' => 'bg-yellow-700'],
                ['border' => 'border-purple-900', 'text' => 'text-purple-100', 'title' => 'Tarea urgente 4', 'bg' => 'bg-purple-700'],
                ['border' => 'border-orange-900', 'text' => 'text-orange-100', 'title' => 'Tarea urgente 5', 'bg' => 'bg-orange-700'],
            ];
            @endphp

            <ul class="space-y-4">
                @foreach ($importantTasks as $cat)
                <li class="flex items-center justify-between {{ $cat['bg'] }} p-4 border-l-[12px] {{ $cat['border'] }} shadow-md hover:scale-105 transition-transform duration-200 cursor-pointer">
                    <span class="font-bold text-xl {{ $cat['text'] }}">{{ $cat['title'] }}</span>
                    <span class="material-symbols-outlined {{ $cat['text'] }}">arrow_forward_ios</span>
                </li>
                @endforeach
            </ul>
        </div>
    </div>
    <div class="flex p-5 gap-3 flex-wrap bg-violet-950 z-50 shadow-[0_-15px_30px_-5px_rgba(0,0,0,0.3)]">
        @php
        $cards = [
            [
                'container_bg' => 'bg-pink-300',
                'btn_bg' => 'bg-yellow-300',
                'btn_text' => 'text-blue-700',
                'btn_hover_bg' => 'hover:bg-pink-500',
                'btn_hover_text' => 'hover:text-yellow-300',
                'title_color' => 'text-blue-700',
                'title_html' => 'T<span class="text-yellow-300">A</span>REAS'
            ],
            [
                'container_bg' => 'bg-blue-400',
                'btn_bg' => 'bg-green-300',
                'btn_text' => 'text-fuchsia-500',
                'btn_hover_bg' => 'hover:bg-fuchsia-500',
                'btn_hover_text' => 'hover:text-green-300',
                'title_color' => 'text-yellow-200',
                'title_html' => 'C<span class="text-green-300">A</span>TEGORIAS'
            ]
        ];
        @endphp

        @foreach ($cards as $card)
        <div class="w-full md:w-auto h-auto min-h-[60px] md:h-[80px] {{ $card['container_bg'] }}
            rounded-[8px] p-5 md:p-7 flex justify-center items-center gap-4">
            <button class="btn {{ $card['btn_bg'] }} {{ $card['btn_text'] }} border-none
            {{ $card['btn_hover_bg'] }} hover:border-none {{ $card['btn_hover_text'] }}">
            <span class="material-symbols-outlined">add</span>
            </button>
            <h1 class="{{ $card['title_color'] }} font-bold text-4xl md:text-5xl break-words break-all">{!! $card['title_html'] !!}</h1>
        </div>
        @endforeach
    </div>
</div>
@endsection

