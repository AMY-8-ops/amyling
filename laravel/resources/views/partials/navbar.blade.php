{{-- 
  Explicación de nuevas clases Tailwind usadas en Navbar:
  - left-[250px]: Posiciona el elemento a 250px del borde izquierdo.
  - right-0: Fija la posición del elemento al borde derecho (0px).
  - justify-between: Distribuye el espacio horizontal entre los elementos del flex.
  - bg-pink-400: Fondo rosado de tono 400.
  - z-30: Orden de apilamiento en el eje Z (z-index 30).
  - flex-1: Permite que el elemento crezca ocupando el espacio disponible.
  - justify-center: Alinea los elementos flexibles horizontalmente al centro.
  - px-4: Relleno horizontal (izquierda/derecha) de 16px (1rem).
  - relative: Posicionamiento relativo a su ubicación normal.
  - block: Muestra el elemento como un bloque.
  - w-full: Ancho completo al 100%.
  - max-w-md: Ancho máximo mediano de 448px (28rem).
  - placeholder:italic: Aplica cursiva al texto del placeholder.
  - placeholder:text-slate-400: Color gris pizarra para el texto placeholder.
  - bg-white: Fondo blanco.
  - border: Añade un borde de 1px.
  - border-slate-300: Borde de color gris pizarra 300.
  - rounded-md: Bordes redondeados medianos de 6px.
  - py-2: Relleno vertical (arriba/abajo) de 8px (0.5rem).
  - pl-9: Relleno a la izquierda de 36px (2.25rem).
  - pr-3: Relleno a la derecha de 12px (0.75rem).
  - shadow-sm: Aplica una sombra paralela ligera.
  - focus:outline-none: Quita el borde por defecto al enfocar (focus).
  - focus:border-sky-500: Cambia el borde a azul cielo 500 al enfocar.
  - focus:ring-sky-500 / focus:ring-1: Anillo de enfoque azul cielo 500 de 1px.
  - sm:text-sm: Tamaño de texto pequeño en pantallas desde 640px.
  - cursor-pointer: Cambia el puntero del ratón a mano de enlace.
  - px-3 / py-1.5: Relleno horizontal de 12px y vertical de 6px.
  - hover:bg-yellow-200: Fondo amarillo 200 al pasar el cursor (hover).
  - transition-all: Aplica transiciones suaves a todas las propiedades.
--}}
<nav class="navbar sticky top-0 right-0 w-full flex flex-wrap items-center justify-between bg-purple-900 px-6 py-4 z-30 shadow-xl transition-all">
    
    <!-- Tarjetas y Decoración (Izquierda) -->
    <div class="flex gap-4 items-center flex-wrap">
        <!-- Botón de Hamburguesa (Solo visual) -->
        <button id="btn-sidebar" class="text-white hover:text-pink-300 hover:bg-white/10 p-2 rounded-lg transition-colors duration-200 focus:outline-none focus:ring-2 focus:ring-pink-300">
            <span class="material-symbols-outlined text-3xl">menu</span>
        </button>
        
        <div class="ml-2 flex items-baseline gap-2">
            <span class="text-pink-300 text-sm md:text-base font-black uppercase tracking-widest">Bienvenido,</span>
            <span class="text-white text-xl md:text-2xl font-bold font-mono tracking-wide drop-shadow-md">Usuario</span>
        </div>
    </div>

    <!-- Buscador (Centro) -->
    <div class="flex-1 flex justify-center px-4 min-w-[200px] mt-4 xl:mt-0">
        <label class="relative block w-full max-w-lg">
            <span class="absolute inset-y-0 left-0 flex items-center pl-4 text-gray-400">
                <span class="material-symbols-outlined">search</span>
            </span>
            <input class="placeholder:italic text-gray-800 placeholder:text-gray-400 block bg-white/90 w-full border-none rounded-full py-3 pl-12 pr-4 shadow-inner focus:outline-none focus:ring-4 focus:ring-pink-300 focus:bg-white transition-all text-sm font-medium"
            placeholder="Buscar en tareas o categorías..." type="text" name="search"/>
        </label>
    </div> 
    
    <!-- Usuario y Autenticación (Derecha) -->
    <div class="flex items-center gap-3 mt-4 xl:mt-0">
        
        <!-- Vista estática para edición. Luego puedes volver a agregar @@auth y las rutas -->
        <form action="#" method="POST" class="inline">
            <button type="button" class="bg-rose-500 text-white rounded-full cursor-pointer px-5 py-2.5 text-sm font-bold hover:bg-rose-600 hover:shadow-lg hover:shadow-rose-500/30 transition-all duration-300 flex items-center gap-2">
                <span class="material-symbols-outlined text-sm">logout</span> Salir
            </button>
        </form>

        <a href="#" class="bg-yellow-400 text-purple-900 rounded-full cursor-pointer px-5 py-2.5 text-sm font-bold hover:bg-yellow-300 hover:shadow-lg hover:shadow-yellow-400/30 transition-all duration-300 flex items-center gap-2">
            <span class="material-symbols-outlined text-sm">login</span> Entrar
        </a>
        
        <a href="#" class="bg-white/10 text-white border border-white/20 rounded-full cursor-pointer px-5 py-2.5 text-sm font-bold hover:bg-white/20 transition-all duration-300">
            Registro
        </a>
    </div>
</nav>