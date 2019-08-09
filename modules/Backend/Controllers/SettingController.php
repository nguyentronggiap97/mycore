<?php

namespace Modules\Backend\Controllers;

use Auth;
use Datatables;
use Exception;

use App\Setting;

use Illuminate\Http\Request;

use Modules\Backend\DataTables\SettingDataTable;

/**
 * Handle setting requests
 * @package Modules\Backend
 */
class SettingController extends Controller
{
    /**
     * Show datatable actions in header
     */
    protected $actions = true;

    /**
     * List query columns for datatable
     * 
     * @var array
     */
    protected $columns = ['id', 'name', 'value', 'status', 'updated'];

    /**
     * This is module name
     * 
     * @var string
     */
    protected $name = 'setting';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {

    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $nodes = [];
        return view('backend::settings.index', [
            'actions' => $this->actions,
            'columns' => $this->columns,
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('backend::settings.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        request()->validate([
            '_id' => 'required',
            'name' => 'required',
            'value' => 'required',
            'status' => ['required', 'boolean'],
        ]);
        
        try {
            Setting::create($request->all());
        } catch(Exception $e) {
            return back()->withInput()->withErrors([$e->getMessage()]);
        }

        return redirect()
            ->route('settings.index')
            ->with('success','Setting created successfully.');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function show(Setting $setting)
    {
        return view('backend::settings.show', ['node' => $setting]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function edit(Setting $setting)
    {
        return view('backend::settings.edit', ['node' => $setting]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Setting $setting)
    {
        request()->validate([
            'name' => 'required',
            'value' => 'required',
            'status' => ['required', 'boolean'],
        ]);

        $setting->update($request->all());

        return redirect()
            ->route('settings.index')
            ->with('success','Setting updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function destroy(Config $config)
    {
        $config->delete();

        return redirect()
            ->route('settings.index')
            ->with('success','Setting deleted successfully');
    }

    /**
     * Datatable ajax request
     *
     * @return \Illuminate\Http\Response
     */
    public function ajax(SettingDataTable $datatable)
    {
        return $datatable->build()->toJson();
    }
}