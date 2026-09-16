<?php

namespace Database\Seeders;

use App\Models\Permission;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Route;

class PermissionSeeder extends Seeder
{
    public function run(): void
    {
        Permission::truncate();

        foreach (Route::getRoutes()->getRoutes() as $route) {
            $action = $route->getAction();

            if (empty($action['controller']) || empty($action['as'])) {
                continue;
            }

            $middleware = $action['middleware'] ?? [];
            if (! is_array($middleware)) {
                $middleware = [$middleware];
            }

            if (! in_array('auth', $middleware, true)) {
                continue;
            }

            $parts = explode('.', $action['as']);
            Permission::create([
                'object' => $parts[0] ?? $action['as'],
                'action' => $parts[1] ?? 'index',
                'name' => $action['as'],
            ]);
        }
    }
}
