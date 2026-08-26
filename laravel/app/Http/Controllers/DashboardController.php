<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class DashboardController extends Controller
{
    /**
     * Ruta Raíz: Determina a dónde enviar al usuario apenas ingresa a la aplicación.
     */
    public function root()
    {
        // Si el usuario ya inició sesión, lo enviamos al panel de control (Dashboard)
        if (\Illuminate\Support\Facades\Auth::check()) {
            return redirect()->route('dashboard');
        }
        // Si no ha iniciado sesión, lo forzamos a ir a la pantalla de Login
        return redirect()->route('login');
    }

    /**
     * Renderiza el Dashboard.
     */
    public function index()
    {
        // Obtenemos el ID del usuario actualmente logueado
        $userId = \Illuminate\Support\Facades\Auth::id();
        
        // Buscamos todas sus tareas (con sus categorías) en la base de datos
        $tareas = \App\Models\Tareas::with('categoria')->where('usuario_id', $userId)->get();
        
        // Buscamos todas las categorías existentes
        $categorias = \App\Models\Categoria::all();
            
        // Renderizamos la vista 'welcome' (dashboard) y le enviamos las variables
        return view('welcome', compact('tareas', 'categorias'));
    }
}
