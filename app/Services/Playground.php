<?php

namespace App\Services;

use App\Services\Geolocation\Geolocation;
use App\Services\Geolocation\GeolocationFacade;


class Playground
{
    public function __construct(Geolocation $geolocation)
    {
        $result = GeolocationFacade::search('a');
        dd($result);
    }
}
