<?php

namespace App\Providers;

use App\Repositories\Eloquent\FilmEloquent;
use App\Repositories\Eloquent\PeopleEloquent;
use App\Repositories\Eloquent\PeopleFilmEloquent;
use App\Repositories\Interfaces\FilmInterface;
use App\Repositories\Interfaces\PeopleFilmInterface;
use App\Repositories\Interfaces\PeopleInterface;
use App\Services\FilmService;
use App\Services\GhibliService;
use App\Services\PeopleFilmService;
use App\Services\PeopleService;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->bind(PeopleInterface::class,PeopleEloquent::class);
        $this->app->bind(FilmInterface::class,FilmEloquent::class);
        $this->app->bind(PeopleFilmInterface::class,PeopleFilmEloquent::class);
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        $this->app->bind('film',FilmService::class);
        $this->app->bind('people',PeopleService::class);
        $this->app->bind('ghibli',GhibliService::class);
        $this->app->bind('peoplefilm',PeopleFilmService::class);
    }
}
