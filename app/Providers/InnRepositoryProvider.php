<?php
namespace  App\Providers;

use Illuminate\Support\ServiceProvider;

class InnRepositoryProvider extends ServiceProvider
{
    public function register()
    {
        $this->app->bind('App\Repositories\InnRepositoryInterface', 'App\Components\ApiFns' );
    }
}
