<?php

namespace App\Http\Controllers;

use App\Models\Categoria;
use Illuminate\Http\Request;
use Illuminate\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\Rule;

class CategoriaController extends Controller
{
    /**
     * Muestra una lista de las categorías.
     */
    public function index(): View
    {
        // Obtenemos todas las categorías del usuario conectado
        $categorias = Categoria::where('usuario_id', Auth::id())->get();
        
        // Retornamos la vista 'categorias.index' y le pasamos los datos
        return view('categorias.index', compact('categorias'));
    }

    /**
     * Muestra el formulario para crear una nueva categoría.
     */
    public function create(): View
    {
        return view('categorias.create');
    }

    /**
     * Almacena una categoría recién creada en la base de datos.
     */
    public function store(Request $request): RedirectResponse
    {
        // Validamos que el nombre no esté vacío y sea único para el usuario actual
        $validatedData = $request->validate([
            'name' => [
                'required', 
                'string', 
                'max:255',
                //Cuando busques si el nombre ya existe, SOLO mira las filas donde el dueño (usuario_id)
                // sea la persona que está intentando crearla ahora mismo (Auth::id())
                Rule::unique('categoria')->where(function ($query) {
                    return $query->where('usuario_id', Auth::id());
                })
            ],
        ], [
            'name.required' => 'El nombre de la categoría es obligatorio.',
            'name.unique' => 'Esta categoría ya existe.',
        ]);

        // Asignamos el id del usuario actual
        $validatedData['usuario_id'] = Auth::id();

        // Guardamos la categoría
        Categoria::create($validatedData);

        // Volvemos a la lista con un mensaje de confirmación
        return redirect()->route('categorias.index')->with('success', 'Categoría creada exitosamente.');
    }

    /**
     * Muestra el formulario para editar una categoría existente.
     */
    public function edit(Categoria $categoria): View
    {
        // Retorna la vista para editar la categoría seleccionada, enviando los datos de esta a la vista
        return view('categorias.edit', compact('categoria'));
    }

    /**
     * Actualiza la categoría en la base de datos.
     */
    public function update(Request $request, Categoria $categoria): RedirectResponse
    {
        // Valida los datos enviados; asegura que el nombre sea único para este usuario, excluyendo la categoría actual
        $validatedData = $request->validate([
            'name' => [
                'required', 
                'string', 
                'max:255',
                Rule::unique('categoria')->where(function ($query) {
                    return $query->where('usuario_id', Auth::id());
                })->ignore($categoria->id)
            ],
        ], [
            'name.required' => 'El nombre de la categoría es obligatorio.',
            'name.unique' => 'Esta categoría ya existe.',
        ]);

        // Actualiza los campos de la categoría en la base de datos con los datos validados
        $categoria->update($validatedData);

        // Redirige a la lista de categorías con un mensaje de éxito
        return redirect()->route('categorias.index')->with('success', 'Categoría actualizada exitosamente.');
    }

    /**
     * Elimina una categoría de la base de datos.
     */
    public function destroy(Categoria $categoria): RedirectResponse
    {
        // Elimina el registro de la categoría de la base de datos
        $categoria->delete();

        // Redirige a la lista de categorías con un mensaje de confirmación
        return redirect()->route('categorias.index')->with('success', 'Categoría eliminada exitosamente.');
    }
}
