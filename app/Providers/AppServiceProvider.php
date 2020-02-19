<?php

namespace App\Providers;

use App\Channel;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\View;
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
        Schema::defaultStringLength(191);
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
//        View::share('channels',Channel::orderBy('name','ASC')->get());
        View::composer(['threads.create','layouts.app'],function($view){
          $view->with('channels',Channel::orderBy('name','ASC')->get()) ;
        });
    }
}
