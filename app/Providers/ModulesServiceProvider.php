<?php

namespace App\Providers;

use Illuminate\Routing\Router;
use Illuminate\Support\ServiceProvider;

class ModulesServiceProvider extends ServiceProvider {

    /**
     * Bootstrap the application services.
     *
     * @return void
     */
    public function boot(Router $router) {
        
        foreach (glob(base_path('modules/*')) as $module) {
            $module_name = basename($module);
            if (is_dir($module)) {
                if (file_exists($module.'/Routes/web.php')) {
                    $web_route = true;
                    $router
                        ->middleware('web')
                        ->namespace("Modules\\".$module_name."\\Controllers")
                        ->group(base_path("modules/$module_name/Routes/web.php"));
                }
                if (file_exists($module.'/Routes/api.php')) {
                    $api_route = true;
                    $router
                        ->prefix('api')
                        ->middleware('api')
                        ->namespace("Modules\\".$module_name."\\Controllers")
                        ->group(base_path("modules/$module_name/Routes/api.php"));
                }
                if (!isset($web_route, $api_route) && file_exists($module.'/routes.php')) {
                    $router
                        ->namespace("Modules\\".$module_name."\\Controllers")
                        ->group(base_path("modules/$module_name/routes.php"));
                }
                if (is_dir($module.'/views')) {
                    $this->loadViewsFrom(base_path("modules/$module_name/Views"),$module_name);
                }
            }
        }
    }

    /**
     * Register the application services.
     *
     * @return void
     */
    public function register() {}
}
