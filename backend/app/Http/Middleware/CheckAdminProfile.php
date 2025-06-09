<?php

namespace App\Http\Middleware;

use App\Enums\ProfileEnum;
use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class CheckAdminProfile
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        $profiles = $request->user()->profiles();
        $haveAdmin = $profiles
            ->whereName(ProfileEnum::ADMIN->value)
            ->exists();

        if (!$haveAdmin) {
            return response()->json([
                'message' => 'Unauthorized'],
                403
            );
        }

        return $next($request);
    }
}
