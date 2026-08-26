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
use App\Http\Controllers\DashboardController;

// Ruta Raíz: Determina a dónde enviar al usuario apenas ingresa a la aplicación.
Route::get('/', [DashboardController::class, 'root']);

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
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

    // Crea automáticamente las rutas CRUD (index, create, store, edit, update, destroy) para Tareas
    Route::resource('tareas', TareaController::class);
    
    // Crea automáticamente las rutas CRUD para Categorías
    Route::resource('categorias', CategoriaController::class);

    // Ruta para actualizar solo el estado desde el dashboard
    Route::patch('/tareas/{tarea}/status', [TareaController::class, 'updateStatus'])->name('tareas.updateStatus');

    Route::post('/logout', [AuthController::class, 'logout'])->name('logout');
});

