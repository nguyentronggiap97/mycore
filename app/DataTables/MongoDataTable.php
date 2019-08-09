<?php

namespace App\DataTables;

use Cedu\Mongodb\Eloquent\Model;
use Cedu\Mongodb\Eloquent\Builder;

use Yajra\DataTables\Exceptions\Exception;

use Illuminate\Database\Eloquent\Relations\Relation;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasOneOrMany;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

/**
 * Fix bug working with mongodb
 * @link(https://github.com/pimlie/laravel-datatables-mongodb)
 * @link(https://github.com/yajra/laravel-datatables/issues/1725)
 */
class MongoDataTable extends MongoQueryDataTable
{
    /**
     * @var \Illuminate\Database\Eloquent\Builder
     */
    protected $query;

    /**
     * Can the DataTable engine be created with these parameters.
     *
     * @param mixed $source
     * @return bool
     */
    public static function canCreate($source)
    {
        return $source instanceof Model || $source instanceof Builder || strpos(get_class($source), 'Cedu\Mongodb\Relations') !== false;
    }

    /**
     * EloquentEngine constructor.
     *
     * @param mixed $model
     */
    public function __construct($model)
    {
        $builder = $model instanceof Model || $model instanceof Builder ? $model : $model->getQuery();
        parent::__construct($builder->getQuery());
        $this->query = $builder;
    }

    /**
     * Add columns in collection.
     *
     * @param  array  $names
     * @param  bool|int  $order
     * @return $this
     */
    public function addColumns(array $names, $order = false)
    {
        foreach ($names as $name => $attribute) {
            if (is_int($name)) {
                $name = $attribute;
            }

            $this->addColumn($name, function ($model) use ($attribute) {
                return $model->getAttribute($attribute);
            }, is_int($order) ? $order++ : $order);
        }

        return $this;
    }

    /**
     * If column name could not be resolved then use primary key.
     *
     * @return string
     */
    protected function getPrimaryKeyName()
    {
        return $this->query->getModel()->getKeyName();
    }
}
