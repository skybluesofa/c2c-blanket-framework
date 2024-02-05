<?php

namespace SkyBlueSofa\C2CBlanketFramework\Facades;

use Illuminate\Support\Facades\Facade;
use SkyBlueSofa\C2CBlanketFramework\Apis\GeoNames\GeoNames as GeoNamesApi;

class GeoNames extends Facade
{
    protected static function getFacadeAccessor()
    {
        return GeoNamesApi::class;
    }
}
