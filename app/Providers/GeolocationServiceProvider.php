<?php

namespace App\Providers;

use App\Services\Geolocation\Geolocation;
use App\Services\Map\Map;
use App\Services\Satellite\Satellite;
use Illuminate\Support\ServiceProvider;

class GeolocationServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->bind(Geolocation::class, function ($app) {
            $map = new Map();
            $satellite = new Satellite();

            return new Geolocation($map, $satellite);
            //use it in tinker دلوقتي بيرجع ب اوبجيكت من الكلاس ومعنتش بشغل بالي باني اباصي البارمترز بتاعة الكونستاركتور هو بيعملها لوحده
            //app()->make(App\Services\Geolocation\Geolocation::class)->search('abc')
        });
    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {

    }
}
