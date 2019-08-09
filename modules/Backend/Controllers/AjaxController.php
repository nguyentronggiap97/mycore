<?php

namespace Modules\Backend\Controllers;

use DB;
use Illuminate\Http\Request;

/**
 * Handle ajax search
 * @package Modules\Backend
 */
class AjaxController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Search term for select2 ajax
     * @param /backend/ajax/search
     * @param 
     * @return \Illuminate\Http\Response
     */
    public function search(Request $request)
    {
        $request->validate([
            'term' => ['nullable', 'string', 'max:255'],
            'field' => ['nullable', 'string', 'max:255'],
            'table' => ['required', 'string', 'max:50'],
        ]);

        $term  = $request->input('term');
        $limit = $request->input('limit', 20);
        $table = $request->input('table');
        $field = $request->input('field', 'name');
        $filter = $request->input('filter', '');

        $query = DB::collection($table);

        // Check {field} value
        $filter = explode(',', $filter);

        // Check {limit} value
        if ($limit > 100) {
            $limit = 100;
        }

        foreach($filter as $item) {
            if (strpos($item, '=')) {
                list($key, $value) = explode('=', $item);
                $query->where($key, $value);
            }
        }
        
        if ($term) {
            $query->where($field, 'like', "%{$term}%");    
        }

        $bucket = [];
        $results = $query->take($limit)->get([$field]);

        foreach($results as $item) {
            $bucket[] = [
                'id' => $item[$field],
                'text' => $item[$field],
            ];
        }

        return $bucket;
    }
}

