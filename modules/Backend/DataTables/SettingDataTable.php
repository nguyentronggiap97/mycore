<?php

namespace Modules\Backend\DataTables;

use Auth;
use Datatables;

use App\Setting;

use Illuminate\Support\Arr;
use Illuminate\Support\Str;
use Illuminate\Http\Request;

class SettingDataTable extends DataTable
{
    /**
     * DataTable only columns
     */
    protected $only = [
        '_id',
        'name',
        'value',
        'status',
        'updated',
        'action'
    ];

    /**
     * DataTable raw columns
     */
    protected $columns = [
        '_id',
        'status',
        'action'
    ];

    /**
     * Build datatable data
     * @example $datatable->build()->toJson();
     */
    public function build()
    {
        $query = Setting::query();

        $datatable = Datatables::from($query);
        $datatable->only($this->only);
        $datatable->rawColumns($this->columns);

        $datatable->editColumn('_id', function(Setting $node) {
            return '<a class="" href="' . route('settings.show', $node->_id) . '">' . $node->_id . '</a>';
        });

        $datatable->editColumn('status', function(Setting $node) {
            if ($node->status) {
                return '<span class="label label-success">Enable</span>';
            } else {
                return '<span class="label label-danger">Disable</span>';
            }
        });

        $datatable->addColumn('action', function(Setting $node) {
            $html = '';
            if (Auth::user()->can('setting.update')) {
                $html .= '<a href="' . route('settings.edit', $node->_id) . '" class="btn btn-warning btn-xs" style="display:inline;padding:2px 5px 3px 5px;margin-right:5px;"><i class="fa fa-edit"></i></a>';
            }
            if (Auth::user()->can('setting.delete')) {
                $html .= '<form method="POST" action="' . route('settings.destroy', $node->_id) .'" accept-charset="UTF-8" style="display:inline">';
                $html .= '<input name="_method" type="hidden" value="DELETE">';
                $html .= csrf_field();
                $html .= '<button class="btn btn-danger btn-xs" type="submit"><i class="fa fa-times"></i></button>';
                $html .= '</form>';
            }
            return $html;
        });

        return $datatable;
    }
}