<?php
/**
 * ========================================================================
 * CONTROLADOR: AdminController
 * ========================================================================
 * Gestiona las operaciones CRUD para administradores (docentes).
 * Solo los usuarios con rol de administrador pueden acceder.
 *
 * Rutas asociadas (protegidas por middleware 'auth' y 'admin'):
 *   GET  /admin/admins          → index()   (listar docentes)
 *   GET  /admin/admins/create   → create()  (formulario de creación)
 *   POST /admin/admins          → store()   (guardar nuevo docente)
 * ========================================================================
 */

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreAdminRequest;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class AdminController extends Controller
{
    /**
     * ====================================================================
     * INDEX - Listado de todos los administradores/docentes
     * ====================================================================
     * Consulta todos los usuarios donde is_admin = true.
     * Los ordena del más reciente al más antiguo (latest()).
     * Retorna la vista admin.admins.index con la colección $admins.
     *
     * @return \Illuminate\View\View
     */
    public function index()
    {
        $admins = User::where('is_admin', true)->latest()->get();
        return view('admin.admins.index', compact('admins'));
    }

    /**
     * ====================================================================
     * CREATE - Formulario para crear un nuevo administrador
     * ====================================================================
     * Retorna la vista con el formulario de registro de docente.
     * No necesita pasar datos adicionales al formulario.
     *
     * @return \Illuminate\View\View
     */
    public function create()
    {
        return view('admin.admins.create');
    }

    /**
     * ====================================================================
     * STORE - Guarda el nuevo administrador en la base de datos
     * ====================================================================
     * Valida los datos usando StoreAdminRequest (nombre, email, contraseña,
     * teléfono opcional). Crea el usuario con is_admin = true siempre.
     * La contraseña se encripta automáticamente con Hash::make().
     *
     * @param  \App\Http\Requests\StoreAdminRequest  $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(StoreAdminRequest $request)
    {
        User::create([
            'name'     => $request->validated('name'),
            'email'    => $request->validated('email'),
            'password' => Hash::make($request->validated('password')),
            'phone'    => $request->validated('phone') ?? null,
            'is_admin' => true, // Siempre se crea como administrador
        ]);

        // Redirige al listado con mensaje de éxito
        return redirect()->route('admin.admins.index')->with('success', 'Administrador creado correctamente.');
    }
}
