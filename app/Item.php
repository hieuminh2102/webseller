<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Item extends Model
{
    public static function getNewItem(){
    	$items = \App\Item::orderBy('created_at', 'desc')->take(5)->get();
    	return $items;
    }
    public static function getAllItem(){
    	$item = \App\Item::paginate(5);
    	return $item;
    }

    public static function getCategoryItem($keyword){
    	$category_id = 0;
    	switch ($keyword) {
    		case 'dat':
    			$category_id = 1;
    			break;
    		case 'gom':
    			$category_id = 2;
    			break;
    		case 'su':
    			$category_id = 3;
    			break;
    		default:
    			break;
    	}

    	$item = \App\Item::where('id_category', $category_id)
    						->paginate(5);
    	return $item;
    }

    public static function getSizeItem($keyword){
    	$size_id = 0;
    	switch ($keyword) {
    		case 'large':
    			$size_id = 1;
    			break;
    		case 'medium':
    			$size_id = 2;
    			break;
    		case 'small':
    			$size_id = 3;
    			break;
    		default:
    			break;
    	}

    	$item = \App\Item::where('id_size', $size_id)
    						->paginate(5);
    	return $item;
    }

    public static function countTypeSearch(){
    	$type = ['dat', 'gom', 'su', 'large', 'medium', 'small'];
    	$count = [];
    	$dat = \App\Item::where('id_category', 1)->count();
    	$gom = \App\Item::where('id_category', 2)->count();
    	$su = \App\Item::where('id_category', 3)->count();
    	$large = \App\Item::where('id_size', 1)->count();
    	$medium = \App\Item::where('id_size', 2)->count();
    	$small = \App\Item::where('id_size', 3)->count();

    	array_push($count, $dat);
    	array_push($count, $gom);
    	array_push($count, $su);
    	array_push($count, $large);
    	array_push($count, $medium);
    	array_push($count, $small);
    	
    	return array_combine($type, $count);
    }

    public static function getNameItemByID($id){
        $item = \App\Item::find($id);

        if($item){
            return $item->name;
        }
        return "";
    }

    public static function getCostItemByID($id){
        $item = \App\Item::find($id);
        if($item){
            return $item->cost;
        }
        return "";
    }

    public static function getQuatityItem($id){
        $item = \App\Item::find($id);
        if($item){
            if($item->quatity != 0)
                return $item->quatity;
            return "<span style='color:red'>Hết hàng</span>";
        }
    }
}
