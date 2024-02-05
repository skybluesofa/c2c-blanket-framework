<?php

namespace SkyBlueSofa\C2CBlanketFramework\Facades;

use Illuminate\Support\Facades\Facade;
use SkyBlueSofa\C2CBlanketFramework\Repositories\TemperatureBlanketRepository;

class TemperatureBlanketConfig extends Facade
{
    protected static function getFacadeAccessor()
    {
        return TemperatureBlanketRepository::class;
    }
}
