<?php

namespace App\Providers;

use App\Channel;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
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
        $queryLog = env('QUERY_LOGS',false);

        if($queryLog){
            DB::listen(function ($query){
                Log::info("=====START LOG====");
                    Log::info($query->sql."  took time:".$query->time);
                Log::info("=====STOP LOG====");
            });
        }
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
