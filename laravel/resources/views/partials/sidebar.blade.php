{{-- 
  Explicación de clases Tailwind usadas en Sidebar:
  - top-0 / bottom-0: Fija la posición superior e inferior a 0px.
  - fixed: Posicionamiento fijo respecto a la ventana del navegador.
  - w-[250px]: Ancho personalizado de 250px.
  - bg-pink-300: Fondo de color rosado claro.
  - flex: Activa el modelo de caja flexible (Flexbox).
  - flex-col: Orientación de elementos en columna vertical.
  - items-center: Alinea verticalmente los elementos al centro.
  - p-2: Relleno (padding) interno de 8px (0.5rem).
  - gap-2: Espacio de 8px entre elementos del flex.
  - w-12 / h-12: Ancho y alto de 48px (3rem).
  - text-black: Texto de color negro.
  - text-lg: Tamaño de fuente grande (18px).
  - font-bold: Grosor de fuente en negrita (700).
  - font-mono: Tipografía monoespaciada.
  - rounded-lg: Bordes redondeados de 8px (0.5rem).
  - bg-yellow-100: Fondo amarillo muy claro.
  - tracking-[3px]: Espaciado entre caracteres de 3px.
  - mt-auto: Margen superior automático (empuja al fondo en flex-col).
  - bg-blue-300: Fondo azul claro.
  - text-sm: Tamaño de fuente pequeño (14px).
  - text-center: Texto alineado al centro.
  - px-2: Relleno horizontal de 8px (izquierda y derecha).
--}}
@php
$menu = [
    [
        'icon' => 'home',
        'text' => 'Dashboard',
        'url' => '/'
    ],
    [
        'icon' => 'task',
        'text' => 'Tareas',
        'url' => '/tareas'
    ],
    [
        'icon' => 'category',
        'text' => 'Categorías',
        'url' => '/categorias'
    ]
];
@endphp
<!-- Overlay del sidebar -->
<div id="sidebar-overlay" class="fixed inset-0 bg-black/50 z-40 hidden opacity-0 transition-opacity duration-300"></div>

<div id="sidebar" class="sidebar-panel top-0 left-0 bottom-0 fixed w-[250px] bg-pink-300 flex flex-col z-50 transform -translate-x-full transition-transform duration-300">
    <div class="flex items-center justify-center p-6 border-b border-pink-400/50 mb-4">
        <a class="flex items-baseline gap-1 hover:scale-105 transition-transform duration-300" href="/">
            <h1 class="text-violet-900 text-3xl md:text-4xl font-bold tracking-wide drop-shadow-md">Taskflow</h1>
        </a>
    </div>
    <div class="p-2">
        <ul class="rounded-lg bg-yellow-100 p-2 font-bold font-mono tracking-[3px]">
            @foreach ($menu as $item)
            <li class="flex items-center gap-2">
                <span class="material-symbols-outlined">
                {{ $item['icon'] }}
                </span>
                <a class="flex items-center gap-2" href="{{ $item['url'] }}">
                    {{ $item['text'] }}
                </a>
            </li>
            @endforeach
        </ul>
    </div>
    <div class="mt-auto p-2 bg-blue-300">
        <h1 class="text-sm text-center">
            <p>Lima <span class="px-2"> | </span> Actualidad</p>
        </h1>
    </div>
</div>