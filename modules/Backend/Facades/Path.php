<?php

namespace Modules\Backend\Facades;

use Modules\Backend\Classes\Path as Manager;

use Illuminate\Support\Facades\Facade;

/**
 * Admin breadcrumb container
 * @example Path::push($item);
 */
class Path extends Facade
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