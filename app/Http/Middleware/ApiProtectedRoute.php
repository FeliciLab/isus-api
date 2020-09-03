<?php

namespace App\Http\Middleware;

use App\Http\Services\KeycloakService;
use Closure;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class ApiProtectedRoute
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     *
     * @return mixed
     */
    public function handle(Request $request, Closure $next)
    {
        $accessToken = $request->header('Authorization');
        $keycloakService = new KeycloakService();
        if (empty($accessToken)) {
            return response()->json(['sucesso' => false, 'erros' =>  'Token não autorizado'], Response::HTTP_UNAUTHORIZED);
        }
        try {
            $resposta = $keycloakService->userProfile($accessToken);
            if ($resposta->getStatusCode() == Response::HTTP_OK) {
                return $next($request);
            } else {
                return response()->json(['sucesso' => false, 'erros' =>  'Token não autorizado'], Response::HTTP_UNAUTHORIZED);
            }
        } catch (Exception $error) {
            return response()->json(['sucesso' => false, 'erros' =>  'Token não autorizado'], Response::HTTP_UNAUTHORIZED);
        }
    }
}
