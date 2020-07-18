<?php

declare(strict_types=1);

namespace Nthmedia\Stockbase\Facades;

use Illuminate\Support\Facades\Facade;

class Stockbase extends Facade
{
    protected static function getFacadeAccessor()
    {
        return 'stockbase';
    }
}
