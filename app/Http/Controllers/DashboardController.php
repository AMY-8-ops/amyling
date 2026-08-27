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
        try {
            // Obtenemos el ID del usuario actualmente logueado
            $userId = \Illuminate\Support\Facades\Auth::id();
            
            // Buscamos todas sus tareas de HOY (con sus categorías) en la base de datos
            $tareas = \App\Models\Tareas::with('categoria')
                ->where('usuario_id', $userId)
                ->whereDate('created_at', now()->toDateString())
                ->get();
            
            // Buscamos las categorías que pertenecen ÚNICAMENTE al usuario logueado
            $categorias = \App\Models\Categoria::where('usuario_id', $userId)->get();
                
            // Renderizamos la vista 'welcome' (dashboard) y le enviamos las variables
            return view('welcome', compact('tareas', 'categorias'));
        } catch (\Exception $e) {
            // Control de errores: mensaje en español y directo para el usuario
            return view('welcome', [
                'tareas' => collect(),
                'categorias' => collect(),
                'error' => 'Ocurrió un error inesperado al cargar tus tareas de hoy. Por favor, intenta de nuevo más tarde.'
            ]);
        }
    }
}
