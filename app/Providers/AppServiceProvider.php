<?php

namespace App\Providers;

use App\Models\Hospital;
use App\Support\FormBuilder;
use App\Support\HtmlBuilder;
use Illuminate\Foundation\AliasLoader;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Blade;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    public function register(): void
    {
        $this->app->singleton('laravel.form', fn () => new FormBuilder());
        $this->app->singleton('laravel.html', fn () => new HtmlBuilder());

        $loader = AliasLoader::getInstance();
        $loader->alias('Form', \App\Facades\Form::class);
        $loader->alias('Html', \App\Facades\Html::class);
    }

    public function boot(): void
    {
        Schema::defaultStringLength(191);

        Blade::directive('permission', function ($permission) {
            return "<?php if (Auth::check() && Auth::user()->role && in_array($permission, Auth::user()->role->permissions->pluck('name')->toArray())): ?>";
        });

        Blade::directive('endpermission', function () {
            return '<?php endif; ?>';
        });

        view()->composer('*', function ($view) {
            static $setting = null;
            static $loaded = false;

            if (! $loaded) {
                $loaded = true;
                try {
                    if (Schema::hasTable('hospitals')) {
                        $setting = Hospital::query()->first();
                    }
                } catch (\Throwable $e) {
                    $setting = null;
                }
            }

            $view->with('setting', $setting);
        });
    }
}
