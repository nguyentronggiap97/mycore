<?php

namespace Modules\Backend\Facades;

use Modules\Backend\Classes\Nav as Manager;

use Illuminate\Support\Facades\Facade;

/**
 * Admin top nav container
 * @example Nav::push($item);
 */
class Nav extends Facade
{
    /**
     * Get the name of the class registered in the Application container.
     *
     * @return string
     */
    protected static function getFacadeAccessor(): string
    {
        return Manager::class;
    }
}