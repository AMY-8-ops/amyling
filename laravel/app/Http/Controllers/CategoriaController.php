<?php

namespace App\Http\Controllers;

use App\Models\Categoria;
use Illuminate\Http\Request;
use Illuminate\View\View;
use Illuminate\Http\RedirectResponse;

class CategoriaController extends Controller
{
    /**
     * Muestra una lista de las categorías.
     */
    public function index(): View
    {
        // Obtenemos todas las categorías de la base de datos
        $categorias = Categoria::all();
        
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
        // Validamos que el nombre no esté vacío y no supere los 255 caracteres
        $validatedData = $request->validate([
            'name' => 'required|string|max:255',
        ]);

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
        return view('categorias.edit', compact('categoria'));
    }

    /**
     * Actualiza la categoría en la base de datos.
     */
    public function update(Request $request, Categoria $categoria): RedirectResponse
    {
        $validatedData = $request->validate([
            'name' => 'required|string|max:255|unique:categoria,name,' . $categoria->id,
        ]);

        $categoria->update($validatedData);

        return redirect()->route('categorias.index')->with('success', 'Categoría actualizada exitosamente.');
    }

    /**
     * Elimina una categoría de la base de datos.
     */
    public function destroy(Categoria $categoria): RedirectResponse
    {
        $categoria->delete();

        return redirect()->route('categorias.index')->with('success', 'Categoría eliminada exitosamente.');
    }
}
