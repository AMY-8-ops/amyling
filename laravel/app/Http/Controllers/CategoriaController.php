<?php

namespace App\Http\Controllers;

use App\Models\Categoria;
use Illuminate\Http\Request;
use Illuminate\View\View;
use Illuminate\Http\RedirectResponse;

class CategoriaController extends Controller
{
    /**
     * Muestra la lista de categorías.
     */
    public function index(): View
    {
        $categorias = Categoria::all();
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
     * Almacena una nueva categoría en la base de datos.
     */
    public function store(Request $request): RedirectResponse
    {
        $validatedData = $request->validate([
            'name' => 'required|string|max:255|unique:categoria,name',
        ]);

        Categoria::create($validatedData);

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
