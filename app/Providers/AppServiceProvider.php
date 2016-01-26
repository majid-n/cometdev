<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Validator;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        Validator::extend('farsi', function($attribute,$value,$parameters){
            return preg_match('/[اآإأبپتثجچحخدذرزژسشصضظطعغفقکگلمنوؤهةۀیئيءـًٌٍَُِِّ\s]+/', $value);
        });
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
