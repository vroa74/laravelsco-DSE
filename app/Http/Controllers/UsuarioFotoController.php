<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Support\Facades\Storage;
use Symfony\Component\HttpFoundation\StreamedResponse;

/**
 * Sirve la fotografia de perfil desde el disco "public".
 *
 * La instalacion no tiene el enlace simbolico public/storage, por lo que la
 * URL /storage/... de Jetstream apunta a una copia que no recibe las cargas
 * nuevas. Estas rutas leen el archivo real del disco y solo aceptan el
 * directorio profile-photos, de modo que no pueden servir otros archivos.
 */
class UsuarioFotoController extends Controller
{
    /**
     * Foto del registro, tomada de la ruta guardada en la base de datos.
     */
    public function __invoke(User $usuario): StreamedResponse
    {
        return $this->servir($usuario->profile_photo_path);
    }

    /**
     * Compatibilidad con las URLs /storage/profile-photos/{archivo} que ya
     * emiten las vistas actuales mientras se migran a profile_photo_url.
     */
    public function porArchivo(string $archivo): StreamedResponse
    {
        return $this->servir('profile-photos/'.$archivo);
    }

    private function servir(?string $ruta): StreamedResponse
    {
        // Misma validacion que el modelo: solo fotos de perfil con formato web.
        $ruta = User::rutaFotoValida($ruta);

        abort_if($ruta === null, 404);

        abort_unless(Storage::disk('public')->exists($ruta), 404);

        return Storage::disk('public')->response($ruta);
    }
}
