<?php
/**
 * ========================================================================
 * MIDDLEWARE: IsAdmin
 * ========================================================================
 * Middleware de autorización que verifica si el usuario autenticado tiene
 * rol de administrador (docente). Si no es admin, aborta con error 403.
 *
 * Se registra como alias 'admin' en bootstrap/app.php y se usa así:
 *   Route::middleware(['auth', 'admin'])->group(function () { ... });
 *
 * El middleware 'auth' debe ejecutarse ANTES que 'admin' para garantizar
 * que haya un usuario logueado antes de verificar su rol.
 * ========================================================================
 */

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class IsAdmin
{
    /**
     * Intercepta la petición y verifica permisos.
     *
     * Si el usuario NO está autenticado O NO es admin, retorna error 403.
     * Si es admin, deja pasar la petición al siguiente middleware/controlador.
     *
     * @param  \Illuminate\Http\Request  $request  Petición HTTP entrante
     * @param  \Closure  $next  Siguiente middleware o controlador
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function handle(Request $request, Closure $next): Response
    {
        // Verificar que el usuario esté logueado Y que sea administrador
        if (!auth()->check() || !auth()->user()->isAdmin()) {
            abort(403, 'No tenés permiso para acceder a esta sección.');
        }

        return $next($request);
    }
}
