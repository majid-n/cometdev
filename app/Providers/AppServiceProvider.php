<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Validator;
use App\Post;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        # Share variable cross views
        $totalnewposts = Post::whereRaw('DATE(created_at) >= DATE_SUB(NOW(),INTERVAL 30 DAY)')->count();
        view()->share('totalnewposts', $totalnewposts);

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
