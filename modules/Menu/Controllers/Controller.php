<?php

namespace Modules\Menu\Controllers;

use View;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;

class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

    /**
     * Set controller theme folder
     * 
     * @example $this->theme(__DIR__ . '/users');
     * @example $this->theme(__DIR__ . '/users', 'users');
     * 
     * @param string $name The theme name
     * @return Controller
     */
    public function theme($path = null, $namespace = null)
    {
    	$path = $path ?? __DIR__;

    	if ($namespace === null) {
    		View::addLocation($path);
    	} else {
    		View::addNamespace($namespace, $path);
    	}

    	return $this;
    }

    /**
     * Get absolute path from relation path
     * @example $this->folder('profile')
     */
    public function folder($path)
    {
    	return __DIR__ . '/' . trim($path, '/');
    }
}