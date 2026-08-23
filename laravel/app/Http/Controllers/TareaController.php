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
     * Muestra la lista de tareas.
     */
    public function index(): View
    {
        // Traemos las tareas con su categoría y usuario usando Eager Loading para optimizar consultas
        $tareas = Tareas::with(['categoria', 'usuario'])->get();
        return view('tareas.index', compact('tareas'));
    }

    /**
     * Muestra el formulario para crear una nueva tarea.
     */
    public function create(): View
    {
        $categorias = Categoria::all();
        return view('tareas.create', compact('categorias'));
    }

    /**
     * Almacena una nueva tarea en la base de datos.
     */
    public function store(Request $request): RedirectResponse
    {
        $validatedData = $request->validate([
            'titulo' => 'required|string|max:255',
            'descripcion' => 'nullable|string',
            'categoria_id' => 'required|exists:categoria,id',
            'estado' => 'required|string|max:50',
        ]);

        // Asignamos automáticamente el ID del usuario autenticado
        $validatedData['usuario_id'] = Auth::id();

        Tareas::create($validatedData);

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
