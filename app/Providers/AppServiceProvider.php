<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Schema;
use Blade;
use Response;
use DB;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        //
		/* Blade::directive('myDir', function($var){
			return "<h1>New directive - $var</h1>";
		}); */
		Schema::defaultStringLength(191); //добавила
		
		Response::macro('myRes', function($value){
			return Response::make($value);
		});
		
		/* DB::listen(function($query) {  //прослушивание sql-запоса
			dump($query->sql); //просмотр sql запроса
			//dump($query->bindings); //передаваемые параметры sql запроса
		}); */
    }

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }
}
