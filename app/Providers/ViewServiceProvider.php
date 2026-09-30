<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\View;
use App\Models\SiteSetting;


class ViewServiceProvider extends ServiceProvider
{


    /**
     * Register services.
     */
    public function register()
    {

    }





    /**
     * Bootstrap services.
     */
    public function boot()
    {


        View::composer('*', function ($view) {


            $settings = SiteSetting::pluck(
                'value',
                'key'
            );



            $view->with(
                'settings',
                $settings
            );


        });


    }


}