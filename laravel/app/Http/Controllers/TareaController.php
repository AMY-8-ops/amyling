<?php

namespace App\Http\Controllers;

use App\Models\Tareas;
use App\Models\Categoria;
use Illuminate\Http\Request;
use Illuminate\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Auth;

class TareaController extends Controller
{
    /**
     * Muestra la lista principal de tareas.
     */
    public function index(): View
    {
        // Obtenemos el ID del usuario actualmente autenticado
        $userId = Auth::id();
        
        // Consultamos la base de datos: traemos las tareas del usuario, incluyendo su categoría asociada
        $tareas = Tareas::with('categoria')->where('usuario_id', $userId)->get();
        
        // Retornamos la vista 'tareas.index' pasándole la variable $tareas
        return view('tareas.index', compact('tareas'));
    }

    /**
     * Muestra el formulario para crear una nueva tarea.
     */
    public function create(): View
    {
        // Traemos todas las categorías del usuario actual para mostrarlas en un menú desplegable (select)
        $categorias = Categoria::where('usuario_id', Auth::id())->get();
        
        // Retornamos la vista que contiene el formulario
        return view('tareas.create', compact('categorias'));
    }

    /**
     * Almacena una nueva tarea en la base de datos.
     */
    public function store(Request $request): RedirectResponse
    {
        // Validamos que los datos enviados por el usuario cumplan las reglas
        $validatedData = $request->validate([
            'titulo' => 'required|string|max:255',
            'descripcion' => 'nullable|string',
            'categoria_id' => 'required|exists:categoria,id', // Verifica que la categoría elegida exista
            'estado' => 'required|string|max:50',
        ]);

        // Asignamos automáticamente el ID del usuario autenticado a la nueva tarea
        $validatedData['usuario_id'] = Auth::id();

        // Guardamos la tarea en la base de datos con los datos validados
        Tareas::create($validatedData);

        // Redirigimos de vuelta a la lista de tareas con un mensaje de éxito
        return redirect()->route('tareas.index')->with('success', 'Tarea creada exitosamente.');
    }

    /**
     * Muestra el formulario para editar una tarea existente.
     */
    public function edit(Tareas $tarea): View
    {
        // Obtenemos todas las categorías del usuario actual para mostrarlas en el selector del formulario
        $categorias = Categoria::where('usuario_id', Auth::id())->get();
        // Retornamos la vista de edición pasándole la tarea a editar y las categorías disponibles
        return view('tareas.edit', compact('tarea', 'categorias'));
    }

    /**
     * Actualiza la tarea en la base de datos.
     */
    public function update(Request $request, Tareas $tarea): RedirectResponse
    {
        // Validamos que los datos ingresados en el formulario de edición sean correctos y cumplan las reglas
        $validatedData = $request->validate([
            'titulo' => 'required|string|max:255',
            'descripcion' => 'nullable|string',
            'categoria_id' => 'required|exists:categoria,id',
            'estado' => 'required|string|max:50',
        ]);

        // Actualizamos los datos de la tarea en la base de datos con los datos validados
        $tarea->update($validatedData);

        // Redirigimos al usuario a la lista de tareas con un mensaje de éxito
        return redirect()->route('tareas.index')->with('success', 'Tarea actualizada exitosamente.');
    }

    /**
     * Elimina una tarea de la base de datos.
     */
    public function destroy(Tareas $tarea): RedirectResponse
    {
        // Elimina el registro de la tarea de la base de datos
        $tarea->delete();

        // Redirige al listado de tareas con un mensaje confirmando la eliminación
        return redirect()->route('tareas.index')->with('success', 'Tarea eliminada exitosamente.');
    }

    /**
     * Actualiza solo el estado de la tarea (usado desde el Dashboard).
     */
    public function updateStatus(Request $request, Tareas $tarea): RedirectResponse
    {
        // Solo validamos que el nuevo estado enviado sea correcto y no esté vacío
        $validatedData = $request->validate([
            'estado' => 'required|string|max:50',
        ]);

        // Actualizamos únicamente el estado de la tarea seleccionada en la base de datos
        $tarea->update($validatedData);

        // Retornamos a la página anterior (por ejemplo, el Dashboard) con un mensaje de éxito
        return back()->with('success', 'Estado de la tarea actualizado.');
    }
}
