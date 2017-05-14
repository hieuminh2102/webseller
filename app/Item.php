<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Item extends Model
{
    public static function getNewItem(){
    	$items = \App\Item::orderBy('created_at', 'desc')->take(5)->get();
    	return $items;
    }
}
