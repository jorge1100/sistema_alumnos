<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
    /**
     *Muestra el listado de Todo los ususarios.
     *Solo accesible para docentes(admin).
     */

    public function index()
    {
        $users = User::all();
        return view('admin.users.index', compact('users'));
    }

    /**
     * Muestra el detalle de un ususario.
     * El docente puede ver cualquier alumno.
     */

    public function show(User $user)
    {
        return view('admin.user.show', compact('user'));
    }
}
