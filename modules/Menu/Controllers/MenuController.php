<?php

namespace Modules\Menu\Controllers;

use Auth;
use Datatables;

use App\Guid;
use App\User;

use Illuminate\Support\Arr;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redis;

use Modules\Menu\Models\Menu;
use Modules\Menu\Helpers\CommonHelper;

/**
 * Handle user requests
 * @package Modules\Store
 */
class MenuController extends Controller
{

    protected $modelMenu;

    public function __construct(Menu $modelMenu)
    {
        $this->modelMenu = $modelMenu;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $listAll = CommonHelper::getAllByRedis();
        return view('menu::index', [
            'publisher' => Auth::user()->publisherOrCreate,
            'listAll' => $listAll,
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $user = Auth::user();
        $listAll = CommonHelper::getAllByRedis();

        return view('menu::create', [
            'menu' => $listAll,
            'publisher' => $user,
            'collection' => Menu::getCollection(),
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $rule = [
            'name' => 'required|max:255',
            'link' => 'required|max:5000',
            'status' => 'required|in:' . Menu::STATUS_ACTIVE . ',' . Menu::STATUS_DRAFT,
        ];
        $message = [
            'name.required' => sprintf(__('menu::menu.validate.required'), __('menu::menu.name')),
            'name.max' => sprintf(__('menu::menu.validate.max'), __('menu::menu.name'),255),
            'link.required' => sprintf(__('menu::menu.validate.required'), __('menu::menu.link')),
            'link.max' => sprintf(__('menu::menu.validate.max'), __('menu::menu.link'), 5000),
            'status.required' => sprintf(__('menu::menu.validate.required'), __('menu::menu.status')),
            'status.in' => sprintf(__('menu::menu.validate.in'), __('menu::menu.status')),
        ];

        if (!empty($request->get('parent'))) {
            $rule = array_merge($rule, [
                'parent' => 'sometimes|exists:menu,_id',
            ]);
            $message = array_merge($message, [
                'parent.exists' => sprintf(__('menu::menu.validate.exists'), __('menu::menu.parent')),
            ]);
        }

        request()->validate($rule, $message);

        $menu = $request->all();
        $menu['_id'] = Guid::next();
        $menu['status'] = intval($menu['status']);
        $menu['sort'] = intval($menu['sort']);

        Menu::create($menu);

        // Clear key Redis
        Redis::del(Menu::MENU_RECURSIVE_KEY_LIST_ALL);

        return redirect()->route('menu.index')->with('success', __('menu::menu.created_success'));
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function show(Menu $menu)
    {
        $user = Auth::user();
        return view('menu::show', [
            'node' => $menu,
            'publisher' => $user,
            'collection' => Menu::getCollection(),
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function edit(Menu $menu)
    {
        $listAll = CommonHelper::getAllByRedis();
        return view('menu::edit', [
            'publisher' => Auth::user(),
            'node' => $menu,
            'menu' => $listAll,
            'collection' => Menu::getCollection(),
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Menu $menu)
    {
        $rule = [
            'name' => 'required|max:255',
            'link' => 'required|max:5000',
            'status' => 'required|in:' . Menu::STATUS_ACTIVE . ',' . Menu::STATUS_DRAFT,
        ];
        $message = [
            'name.required' => sprintf(__('menu::menu.validate.required'), __('menu::menu.name')),
            'name.max' => sprintf(__('menu::menu.validate.max'), __('menu::menu.name'),255),
            'link.required' => sprintf(__('menu::menu.validate.required'), __('menu::menu.link')),
            'link.max' => sprintf(__('menu::menu.validate.max'), __('menu::menu.link'), 5000),
            'status.required' => sprintf(__('menu::menu.validate.required'), __('menu::menu.status')),
            'status.in' => sprintf(__('menu::menu.validate.in'), __('menu::menu.status')),
        ];

        if (!empty($request->get('parent'))) {
            $rule = array_merge($rule, [
                'parent' => 'sometimes|exists:menu,_id',
            ]);
            $message = array_merge($message, [
                'parent.exists' => sprintf(__('menu::menu.validate.exists'), __('menu::menu.parent')),
            ]);
        }

        request()->validate($rule, $message);

        $user = Auth::user();
        $menu->fill($request->only($menu->getFillable()));
        $menu['status'] = intval($request->get('status'));
        $menu['sort'] = intval($request->get('sort'));
        $menu->save();

        // Clear key Redis
        Redis::del(Menu::MENU_RECURSIVE_KEY_LIST_ALL);

        return redirect()->back()->with('success', __('menu::menu.updated_success'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function destroy(Menu $menu)
    {
        $menu->with('grandchildren');

        $ids = [$menu->_id];
        if (isset($menu->grandchildren) && !empty($menu->grandchildren)) {
            $listAllTree = self::listAllTree($menu->grandchildren);

            if (!empty($listAllTree)) {
                foreach ($listAllTree as $val) {
                    $ids = array_merge($ids, [$val->_id]);
                }
            }
        }

        Menu::query()
            ->whereIn('_id', $ids)
            ->delete();

        // Clear key Redis
        Redis::del(Menu::MENU_RECURSIVE_KEY_LIST_ALL);

        return redirect()
            ->route('menu.index')
            ->with('success', __('menu::menu.deleted_success'));
    }

    public function listAllTree($data, $result = null) {
        foreach ($data as $val) {
            $result[] = $val;

            if (isset($val->grandchildren) && !empty($val->grandchildren)) {
                $result = self::listAllTree($val->grandchildren, $result);
            }
        }

        return $result;
    }

    /**
     * Datatable ajax request
     *
     * @return \Illuminate\Http\Response
     */
    public function ajax(Request $request)
    {
        $user  = Auth::user();
        $query = Menu::query();

        return Datatables::from($query)
            ->filter(function ($query) {
                // Check for filter:search
                if ($search = request()->input('search.value')) {
                    $field = 'name';
                    $operator = 'like';

                    if (Str::contains($search, ':')) {
                        list($field, $search) = explode(':', $search);
                    }

                    if ($field == 'id') {
                        $field = '_id';
                        $operator = '=';
                    } else {
                        $search = '%' . $search . '%';
                    }

                    $field = trim($field);
                    $search = trim($search);
                    $query->where($field, $operator, $search);
                }
            })
            ->editColumn('name', function(Menu $node) {
                return '<a class="" href="' . route('campaigns.edit', $node->_id) . '">' . $node->name . '</a>';
            })
            ->editColumn('status', function(Menu $node) {
                return $this->getMarkupStatus($node);
            })
            ->addColumn('action', function(Menu $node) {
                return $this->getMarkupAction($node);
            })
            ->rawColumns(['name','link','status', 'action'])
            ->only(['_id', 'name', 'link','status', 'action'])
            ->toJson();
    }

    public static function getMarkupStatus(Menu $node)
    {
        if ($node->status == Menu::STATUS_DRAFT) {
            return '<span class="label label-danger">Ẩn</span>';
        } if ($node->status == Menu::STATUS_ACTIVE) {
            return '<span class="label label-success">Kích hoạt</span>';
        } else {
            return '<span class="label label-default">Unknow</span>';
        }
    }

    public static function getMarkupAction(Menu $node)
    {
        // Show action buttons
        $html = '';

        // Check for edit action
        if (Auth::user()->can('menu.update', $node)) {
            $html .= '<a href="' . route('menu.edit',  $node->_id) . '" class="btn btn-warning btn-xs" style="display:inline;padding:2px 5px 3px 5px;margin-right:5px;"><i class="fa fa-edit"></i></a>';
        }

        // Check for delete action
        if (Auth::user()->can('menu.delete', $node)) {
            $html .= '<form method="POST" action="' . route('menu.destroy', $node->_id) .'" accept-charset="UTF-8" style="display:inline">';
            $html .= '<input name="_method" type="hidden" value="DELETE">';
            $html .= csrf_field();
            $html .= '<button class="btn btn-danger btn-xs" type="submit"><i class="fa fa-times"></i></button>';
            $html .= '</form>';
        }

        return $html;
    }
}