<?php
namespace Modules\Menu\Helpers;

use Carbon\Carbon;
use Illuminate\Support\Facades\Redis;
use Modules\Menu\Models\Menu;

class CommonHelper
{

    /**
     *
     */
    public static function updateMenuRecursiveRedis(){
        $data = Menu::query()
            ->select(['id', 'name', 'pid', 'link'])
            ->get()
            ->toArray()
        ;
        $dataRecursive = static::getMenuChild($data);
        Redis::set(Menu::MENU_RECURSIVE_KEY, json_encode($dataRecursive));
    }

    public static function getMenuChild(&$data, $key = 'pid', $pd = 0){
        if (is_object($data)){
            $data = (array) $data;
        }

        $arrTmp = [];
        foreach ($data as $k => $val){
            if ($pd == $val[$key]){
                $tmp = $val;
                unset($data[$k]);
                $tmp['child'] = self::getMenuChild($data, $key, $tmp['_id']);
                $arrTmp[] = $tmp;
            }
        }
        return $arrTmp;
    }


    public static function getAllByRedis() {
        try {
            $data = Redis::get(Menu::MENU_RECURSIVE_KEY_LIST_ALL);

            if (empty($data)) {
                return self::makeTreeMenu();
            }

            $data = unserialize($data);
        } catch (\Exception $exception) {
            $data = self::makeTreeMenu();
        }

        return $data;
    }


    public static function makeTreeMenu() {
        $data = Menu::query()
            ->orderBy('sort', 'ASC')
            ->orderBy('created_at', 'DESC')
            ->get();
        $result = '';

        if (!empty($data)) {
            $result = self::mergeTreeMenu($data);

            // Save nav infomation to Redis
            Redis::set(Menu::MENU_RECURSIVE_KEY_LIST_ALL, serialize($result));
        }

        return $result;
    }

    public static function mergeTreeMenu($data, $pid = 0, $space = '', $return = []) {
        foreach ($data as $val) {
            if ($val->pid == $pid){
                $val->name = $space . $val->name;
                $return[] = $val;

                if (self::hasChildren($data, $val['_id'])) {
                    $return = static::mergeTreeMenu($data, $val->_id, $space.' --- ', $return);
                }
            }
        }

        return $return;
    }

    public static function hasChildren($data, $id) {
        foreach ($data as $val) {
            if ($val->pid == $id) {
                return true;
            }
        }

        return false;
    }
}
