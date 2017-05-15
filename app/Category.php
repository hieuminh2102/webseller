<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    public static function getCategoriesList(){
    	$source = \App\Category::lists('name', 'id');
    	return $source;
    }

    public static function getCateNameByID($id){
    	$source = \App\Category::find($id);
    	return $source->name;
    }
}
