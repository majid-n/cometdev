<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Schema;
use Validator;
use App\Post;
use Storage;
use Blade;

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
        if( Schema::hasTable('posts') )
            $totalnewposts = Post::whereRaw('DATE(created_at) >= DATE_SUB(NOW(),INTERVAL 30 DAY)')->count();
        else
            $totalnewposts = 0;

        # Get all backgrounds filenames in an array
        # For random Background $backgrounds->random()
        $backgrounds = collect(Storage::disk('backgrounds')->allFiles());

        view()->share([
            'totalnewposts'=> $totalnewposts,
            'backgrounds'  => $backgrounds
        ]);

        Validator::extend('farsi', function($attribute,$value,$parameters){
            return preg_match('/^[اآإأبپتثجچحخدذرزژسشصضظطعغفقکگلمنوؤهةۀیئيءـًٌٍَُِِّ\s]+$/', $value);
        });

        Blade::extend(function($value) {
            return preg_replace('/\@define(.+)/', '<?php ${1}; ?>', $value);
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
