<?php


namespace ghun\CouponCodeGenerator\Facades;

use Illuminate\Support\Facades\Facade;

class CouponCodeGenerator extends Facade
{
    protected static function getFacadeAccessor()
    {
        return 'CouponCodeGenerator';
    }

}