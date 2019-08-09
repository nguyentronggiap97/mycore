<?php

namespace Modules\Backend\Classes;

class Store
{
	protected $stores = [];

    /**
     * Load store data from a file
     */
    public function load($path)
	{
		$this->stores = $this->append(
            include($path)
        );

        return $this;
    }

    /**
     * Push new item to store
     */
	public function push($items)
	{
		$this->stores[] = $items;
		return $this;
    }
    
    /**
     * Push new item to store
     */
	public function add($items)
	{
		return $this->append($items);
	}

    /**
     * Append new data to store
     */
    public function append(array $items)
	{
		$this->stores = array_unique(
            array_merge($this->stores, $items)
        );

        return $this;
    }
    
    /**
     * Reset store
     */
	public function reset()
	{
        $this->stores = [];
        return $this;
	}

    /**
     * Get store data
     */
	public function get()
	{
		return $this->stores;
    }
    
    /**
     * Get store all data
     */
    public function all()
	{
		return $this->stores;
	}
}