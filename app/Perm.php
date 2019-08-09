<?php

namespace App;

use Illuminate\Support\Str;
use Illuminate\Support\Facades\Gate;

class Perm
{
    /**
     * Get application all permissions
     */
    public static function all()
    {
        $perms = [];
        $gates = Gate::abilities();

        foreach($gates as $name => $item) {
            $perms[] = $name;
        }

        return $perms;
    }

    /**
     * Get application all permissions with group by module
     */
    public static function group()
    {
        $group = [];
        $perms = Gate::abilities();

        foreach($perms as $name => $item) {
            if (Str::contains($name, '.')) {
                list($module, $perm) = explode('.', $name);
                $group[$module][] = $perm;
            }
        }

        return $group;
    }

    /**
     * Get application all permissions group by columns
     */
    public static function modules()
    {
        $modules = [];
        $columns = [];
        $perms = Gate::abilities();

        foreach($perms as $name => $item) {
            if (Str::contains($name, '.')) {
                list($module, $perm) = explode('.', $name);
                $modules[$module][$perm] = $perm;
                $columns[$perm] = $perm;
            }
        }

        ksort($modules);

        return [
            'modules' => $modules,
            'columns' => $columns,
        ];
    }
}