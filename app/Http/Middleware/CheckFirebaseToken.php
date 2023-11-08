<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Kreait\Laravel\Firebase\Facades\Firebase;
use Symfony\Component\HttpFoundation\Response;

class CheckFirebaseToken
{
    protected $firebaseAuth;

    public function __construct()
    {
        $this->firebaseAuth = Firebase::auth();
    }
    /**
     * Maneja la petición entrante para verificar el token de Firebase.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle($request, Closure $next)
    {
        $token = $request->bearerToken();

        if ($token) {
            try {
                $verifiedIdToken = $this->firebaseAuth->verifyIdToken($token);
                $request->attributes->set('uid', $verifiedIdToken->claims()->get('sub'));
            } catch (\Kreait\Firebase\Exception\FirebaseException $e) {
                // El token es inválido
                return response()->json(['error' => 'Unauthorized'], 401);
            }
        } else {
            // No se proporcionó token
            return response()->json(['error' => 'Unauthorized'], 401);
        }

        return $next($request);
    }
}
