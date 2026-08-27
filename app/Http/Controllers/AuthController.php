<?php
namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;

class AuthController extends Controller
{   
    public function showRegistrationForm(): View
    {
        // Retorna la vista con el formulario de registro de usuario
        return view('auth.register');
    }

    public function register(Request $request): RedirectResponse
    {   
        // Valida los datos enviados en la petición de registro
        $validatedData = $request->validate([
            'user_name' => 'required|string|max:255|unique:usuarios,user_name',
            'password' => 'required|string|min:8|confirmed',
        ]);
       
        // Crea un nuevo usuario en la base de datos con los datos validados
        $user = User::create([
            'user_name' => $validatedData['user_name'],
            'password' => $validatedData['password'],
        ]);

        // Autentica (inicia sesión) automáticamente al usuario recién creado
        Auth::login($user);
        // Ayuda a regenerar la sesión para evitar ataques de fijación de sesión
        $request->session()->regenerate();

        // Redirige al usuario a la ruta principal o panel de control
        return redirect()->route('dashboard');
    }

    public function showLoginForm(): View
    {
        // Retorna la vista con el formulario de inicio de sesión
        return view('auth.login');
    }

    public function login(Request $request): RedirectResponse
    {
        // Valida que se hayan proporcionado usuario y contraseña
        $credentials = $request->validate([
            'user_name' => 'required|string',
            'password' => 'required|string',
        ]);

        // Intenta autenticar al usuario con las credenciales proporcionadas
        if (!Auth::attempt($credentials)) {
            // Si la autenticación falla, redirige de vuelta con un mensaje de error y mantiene el nombre de usuario
            return back()->withErrors([
                'user_name' => 'Usuario y contraseña incorrectos.'
            ])->onlyInput('user_name');

        }
        // Si tiene éxito, regenera la sesión por seguridad
        $request->session()->regenerate();

        // Redirige al usuario al panel de control (dashboard)
        return redirect()->route('dashboard');
    }

    public function logout(Request $request): RedirectResponse
    {
        // Cierra la sesión del usuario actual
        Auth::logout();
        // Invalida la sesión actual en el sistema
        $request->session()->invalidate();
        // Regenera el token CSRF para proteger contra ataques en futuras peticiones
        $request->session()->regenerateToken();

        // Redirige al usuario a la página de inicio de sesión
        return redirect('/login');
    }
}