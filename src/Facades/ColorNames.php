<?php

namespace SkyBlueSofa\C2CBlanketFramework\Facades;

use Illuminate\Support\Facades\Facade;
use SkyBlueSofa\C2CBlanketFramework\Apis\ColorNames\ColorNames as ColorNamesApi;

class ColorNames extends Facade
{
    protected static function getFacadeAccessor()
    {
        return ColorNamesApi::class;
    }
}
