<?php

namespace Modules\Backend\Models;

use App\Model;
use App\Traits\Objectable;
use Illuminate\Support\Str;

class Term extends Model
{
    use Objectable;

    protected $connection = 'mongodb';
    protected $collection = 'sys.terms';
    
    const CREATED_AT = 'created';
    const UPDATED_AT = 'updated';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        '_id',      // ObjectID
        'type',     // string   Term type: language, author, translator, ...
        'name',     // string
        'slug',     // string
        'about',    // string
        'search',   // string   Term searchable field
        'status',
    ];

    /**
     * Save new term with {type} and {value}
     */
    public static function createWithName($type, $value)
    {
        $value = trim($value);
        $slug  = Str::slug($value);
        $search = $value . ', ' . str_replace('-', ' ', $slug);
        $search = mb_strtolower($search, 'UTF-8');

        return Term::firstOrCreate([
            'type' => $type,
            'name' => $value
        ], [
            'type' => $type,
            'name' => $value,
            'slug' => $slug,
            'about' => '',
            'search' => $search,
            'status' => 1
        ]);
    }

    /**
     * Search term for select2 ajax
     */
    public static function search($type, $term, $field, $limit)
    {
        $bucket = [];
        $query  = static::query();

        // Check {limit} value
        if ($limit > 100) {
            $limit = 100;
        }

        // Check {field} value
        if (is_string($field)) {
            $field = explode(',', $field);
        }

        if ($type) {
            $query->where('type', $type);    
        }
        
        if ($term) {
            $query->where('search', 'like', "%{$term}%");    
        }

        $results = $query->take($limit)->get($field);

        foreach($results as $item) {
            $bucket[] = [
                'id' => $item->{$field[0]},
                'text' => $item->{$field[1]},
            ];
        }

        return $bucket;
    }
}