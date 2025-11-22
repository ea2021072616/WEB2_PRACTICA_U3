<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class ValidateUptEmail
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        $user = $request->user();
        
        if ($user && !$this->isValidUptEmail($user->email)) {
            auth()->logout();
            return redirect('/login')->withErrors(['email' => 'Solo se permiten correos institucionales UPT (@upt.pe o @virtual.upt.pe)']);
        }
        
        return $next($request);
    }
    
    private function isValidUptEmail($email): bool
    {
        return str_ends_with($email, '@upt.pe') || str_ends_with($email, '@virtual.upt.pe');
    }
}
