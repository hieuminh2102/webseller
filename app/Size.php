<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Size extends Model
{
    public static function getSizeList(){
    	$source = \App\Size::lists('size', 'id');
    	return $source;
    }
}
