<?php

namespace SkyBlueSofa\C2CBlanketFramework\Facades;

use Illuminate\Support\Facades\Facade;
use SkyBlueSofa\C2CBlanketFramework\Apis\TemperatureBlanketDotCom\TemperatureBlanketDotCom as TemperatureBlanketDotComApi;

class TemperatureBlanketDotCom extends Facade
{
    protected static function getFacadeAccessor()
    {
        return TemperatureBlanketDotComApi::class;
    }
}
