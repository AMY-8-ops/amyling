<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

use App\Http\Controllers\CategoriaController;
use App\Http\Controllers\TareaController;
use App\Http\Controllers\AuthController;

// Ruta Raíz: Determina a dónde enviar al usuario apenas ingresa a la aplicación.
Route::get('/', function () {
    // Si el usuario ya inició sesión, lo enviamos al panel de control (Dashboard)
    if (\Illuminate\Support\Facades\Auth::check()) {
        return redirect()->route('dashboard');
    }
    // Si no ha iniciado sesión, lo forzamos a ir a la pantalla de Login
    return redirect()->route('login');
});

// Rutas para usuarios NO autenticados (invitados)
Route::middleware('guest')->group(function () {
    Route::get('/register', [AuthController::class, 'showRegistrationForm'])->name('register');
    Route::post('/register', [AuthController::class, 'register']);

    Route::get('/login', [AuthController::class, 'showLoginForm'])->name('login');
    Route::post('/login', [AuthController::class, 'login']);
});

// Rutas protegidas por autenticación
Route::middleware('auth')->group(function () {
    
    // Ruta Dashboard (hacia donde redirige el AuthController al iniciar sesión)
    Route::get('/dashboard', function () {
        // Obtenemos el ID del usuario actualmente logueado
        $userId = \Illuminate\Support\Facades\Auth::id();
        
        // Buscamos todas sus tareas (con sus categorías) en la base de datos
        $tareas = \App\Models\Tareas::with('categoria')->where('usuario_id', $userId)->get();
        
        // Buscamos todas las categorías existentes
        $categorias = \App\Models\Categoria::all();
            
        // Renderizamos la vista 'welcome' (dashboard) y le enviamos las variables
        return view('welcome', compact('tareas', 'categorias'));
    })->name('dashboard');

    // Crea automáticamente las rutas CRUD (index, create, store, edit, update, destroy) para Tareas
    Route::resource('tareas', TareaController::class);
    
    // Crea automáticamente las rutas CRUD para Categorías
    Route::resource('categorias', CategoriaController::class);

    // Ruta para actualizar solo el estado desde el dashboard
    Route::patch('/tareas/{tarea}/status', [TareaController::class, 'updateStatus'])->name('tareas.updateStatus');

    Route::post('/logout', [AuthController::class, 'logout'])->name('logout');
});

