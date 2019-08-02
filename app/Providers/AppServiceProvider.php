<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\Models\Lops;
class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        view()->composer('menu',function($view){
            $lops = Lops::orderBy('tenlop')->get();
            $view->with(compact('lops'));
        });
    }
}
