<?php

namespace App\Http\Controllers;


use Illuminate\Http\Request;

use Kreait\Laravel\Firebase\Facades\Firebase;

class AuthController extends Controller
{
    protected $firebaseAuth;

    public function __construct()
    {
        $this->firebaseAuth = Firebase::auth();
    }

    public function login(Request $request)
    {
        $customToken = $request->input('token');
        try {
            // Intercambiar el token personalizado por un token de ID de Firebase
            $verifiedIdToken = $this->firebaseAuth->verifyIdToken($customToken);

            // Opcional: obtener el UID de usuario de Firebase
            $uid = $verifiedIdToken->claims()->get('sub');

            // Opcional: obtener el usuario de Firebase
            $user = $this->firebaseAuth->getUser($uid);

            // Aquí puedes realizar operaciones adicionales,
            // como crear un token de API personalizado, si es necesario.

            // Devolver una respuesta exitosa con el token de ID
            return response()->json(['token' => $customToken]);
        } catch (\Throwable $e) {
            // Manejar el error si el token no es válido o expira, etc.
            return response()->json(['error' => $e->getMessage()], 401);
        }
    }
}
