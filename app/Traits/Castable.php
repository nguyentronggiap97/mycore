<?php

namespace App\Traits;

/**
 * Add cast method to model support cast data before save
 */
trait Castable
{
    /**
     * Get the casts array.
     *
     * @return array
     */
    public function cast() {
        foreach($this->casts as $key => $format) {
            if (isset($this->{$key}) && $this->{$key} !== null) {
                $this->{$key} = $this->castAttribute($key, $this->{$key});
            }
        }
    }
}
