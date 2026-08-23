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

Route::get('/', function () {
    if (\Illuminate\Support\Facades\Auth::check()) {
        return redirect()->route('dashboard');
    }
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
        $tareas = \App\Models\Tareas::with('categoria')
            ->where('usuario_id', \Illuminate\Support\Facades\Auth::id())
            ->get();
            
        return view('welcome', compact('tareas'));
    })->name('dashboard');

    Route::resource('tareas', TareaController::class);
    Route::resource('categorias', CategoriaController::class);

    // Ruta para actualizar solo el estado desde el dashboard
    Route::patch('/tareas/{tarea}/status', [TareaController::class, 'updateStatus'])->name('tareas.updateStatus');

    Route::post('/logout', [AuthController::class, 'logout'])->name('logout');
});

