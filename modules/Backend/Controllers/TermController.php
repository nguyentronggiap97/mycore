<?php

namespace Modules\Backend\Controllers;

use Illuminate\Http\Request;
use Modules\Backend\Models\Term;

/**
 * Handle term requests
 * @package Modules\Backend
 */
class TermController extends Controller
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
     *
     * @return \Illuminate\Http\Response
     */
    public function search(Request $request)
    {
        $request->validate([
            'type' => ['required', 'string', 'max:255'],
            'term' => ['nullable', 'string', 'max:255'],
            'field' => ['nullable', 'string', 'max:255'],
        ]);

        $type  = $request->input('type');
        $term  = $request->input('term');
        $limit = $request->input('limit', 20);
        $field = $request->input('field', 'name,name'); // mapping with select2 {id, text} -> {name, name}

        return Term::search($type, $term, $field, $limit);
    }
}

