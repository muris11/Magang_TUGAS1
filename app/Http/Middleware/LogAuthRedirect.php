<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Symfony\Component\HttpFoundation\Response;

class LogAuthRedirect
{
    public function handle(Request $request, Closure $next): Response
    {
        $response = $next($request);

        if ($response->getStatusCode() === 302) {
            $location = $response->headers->get('Location') ?: '';
            if (str_contains($location, '/login')) {
                Log::warning('Auth redirect to login', [
                    'from' => $request->fullUrl(),
                    'method' => $request->method(),
                    'ip' => $request->ip(),
                    'auth_check' => auth()->check(),
                    'auth_id' => auth()->id(),
                    'session_id' => $request->session()->getId(),
                    'has_session' => $request->session()->isStarted(),
                ]);
            }
        }

        return $response;
    }
}
