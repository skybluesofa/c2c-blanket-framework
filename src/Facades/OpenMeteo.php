<?php

namespace SkyBlueSofa\C2CBlanketFramework\Facades;

use Illuminate\Support\Facades\Facade;
use SkyBlueSofa\C2CBlanketFramework\Apis\OpenMeteo\OpenMeteo as OpenMeteoApi;

class OpenMeteo extends Facade
{
    protected static function getFacadeAccessor()
    {
        return OpenMeteoApi::class;
    }
}
