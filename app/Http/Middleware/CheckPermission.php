<?php

namespace App\Http\Middleware;

use App\Exceptions\PermissionDenied;
use Closure;
use Illuminate\Contracts\Auth\Guard;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class CheckPermission
{
    public function __construct(protected Guard $auth)
    {
    }

    public function handle(Request $request, Closure $next): Response
    {
        $permissionName = $request->route()?->getName();
        $permissions = $this->auth->user()->role->permissions->pluck('name')->toArray();

        if (in_array($permissionName, $permissions, true)) {
            return $next($request);
        }

        throw new PermissionDenied();
    }
}
