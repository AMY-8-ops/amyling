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
        // Traemos todas las categorías para mostrarlas en un menú desplegable (select)
        $categorias = Categoria::all();
        
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
        $categorias = Categoria::all();
        return view('tareas.edit', compact('tarea', 'categorias'));
    }

    /**
     * Actualiza la tarea en la base de datos.
     */
    public function update(Request $request, Tareas $tarea): RedirectResponse
    {
        $validatedData = $request->validate([
            'titulo' => 'required|string|max:255',
            'descripcion' => 'nullable|string',
            'categoria_id' => 'required|exists:categoria,id',
            'estado' => 'required|string|max:50',
        ]);

        $tarea->update($validatedData);

        return redirect()->route('tareas.index')->with('success', 'Tarea actualizada exitosamente.');
    }

    /**
     * Elimina una tarea de la base de datos.
     */
    public function destroy(Tareas $tarea): RedirectResponse
    {
        $tarea->delete();

        return redirect()->route('tareas.index')->with('success', 'Tarea eliminada exitosamente.');
    }

    /**
     * Actualiza solo el estado de la tarea (usado desde el Dashboard).
     */
    public function updateStatus(Request $request, Tareas $tarea): RedirectResponse
    {
        $validatedData = $request->validate([
            'estado' => 'required|string|max:50',
        ]);

        $tarea->update($validatedData);

        return back()->with('success', 'Estado de la tarea actualizado.');
    }
}
