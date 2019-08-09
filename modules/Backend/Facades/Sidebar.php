<?php

namespace Modules\Backend\Facades;

use Modules\Backend\Classes\Sidebar as Manager;

use Illuminate\Support\Facades\Facade;

/**
 * Admin sidebar container
 * @example Sidebar::push($item);
 */
class Sidebar extends Facade
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