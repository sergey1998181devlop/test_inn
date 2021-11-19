<?php
namespace  App\Providers;

use Illuminate\Support\ServiceProvider;

class ApiCheckInnProvider extends ServiceProvider
{
    public function register()
    {
        $this->app->bind('App\Components\ApiCheckInnInterface', 'App\Components\ApiFns' );
    }
}
