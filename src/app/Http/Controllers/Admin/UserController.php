<?php
/**
 * ========================================================================
 * CONTROLADOR: UserController
 * ========================================================================
 * Gestiona las operaciones sobre usuarios comunes (alumnos) desde el
 * panel de administración. Solo los docentes pueden acceder.
 *
 * Rutas asociadas (protegidas por middleware 'auth' y 'admin'):
 *   GET  /admin/users          → index()   (listar alumnos)
 *   GET  /admin/users/create   → create()  (formulario de creación)
 *   POST /admin/users          → store()   (guardar nuevo usuario)
 *   GET  /admin/users/{user}   → show()    (detalle de un usuario)
 * ========================================================================
 */

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreUserByAdminRequest;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;
use Illuminate\Http\Request;

class UserController extends Controller
{
    /**
     * ====================================================================
     * INDEX - Listado de todos los alumnos
     * ====================================================================
     * Consulta solo los usuarios donde is_admin = false (alumnos).
     * Retorna la vista admin.users.index con la colección $users.
     *
     * @return \Illuminate\View\View
     */
    public function index()
    {
        $users = User::where('is_admin', false)->get();
        return view('admin.users.index', compact('users'));
    }

    /**
     * ====================================================================
     * SHOW - Detalle de un usuario específico
     * ====================================================================
     * Recibe un usuario por Route Model Binding (Laravel busca el usuario
     * por su ID automáticamente). Retorna la vista admin.users.show.
     *
     * @param  \App\Models\User  $user  Usuario a mostrar
     * @return \Illuminate\View\View
     */
    public function show(User $user)
    {
        return view('admin.users.show', compact('user'));
    }

    /**
     * ====================================================================
     * CREATE - Formulario para crear un nuevo usuario
     * ====================================================================
     * Retorna la vista con el formulario de registro.
     * El formulario permite elegir si es alumno o docente.
     *
     * @return \Illuminate\View\View
     */
    public function create()
    {
        return view('admin.users.create');
    }

    /**
     * ====================================================================
     * STORE - Guarda el nuevo usuario en la base de datos
     * ====================================================================
     * Valida los datos usando StoreUserByAdminRequest.
     * Si se sube una foto, la guarda en storage/app/public/profiles/.
     * La contraseña se encripta con Hash::make().
     *
     * @param  \App\Http\Requests\StoreUserByAdminRequest  $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(StoreUserByAdminRequest $request)
    {
        // Obtener datos validados del formulario
        $validated = $request->validated();

        // Subir foto de perfil si el usuario la envió
        $photoPath = null;
        if ($request->hasFile('photo')) {
            // store() guarda el archivo en storage/app/public/profiles/
            // y retorna la ruta relativa para guardar en la BD
            $photoPath = $request->file('photo')->store('profiles', 'public');
        }

        // Crear el usuario en la base de datos
        User::create([
            'name'             => $validated['name'],
            'email'            => $validated['email'],
            'password'         => Hash::make($validated['password']),
            'phone'            => $validated['phone'] ?? null,
            'professional_url' => $validated['professional_url'] ?? null,
            'photo_path'       => $photoPath,
            'is_admin'         => $validated['is_admin'],
        ]);

        // Redirigir al listado con mensaje de éxito
        return redirect()->route('admin.users.index')->with('success', 'Usuario creado correctamente.');
    }
}
