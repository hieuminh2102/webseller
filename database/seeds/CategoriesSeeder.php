<?php

use Illuminate\Database\Seeder;

class CategoriesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
    	$list_cate = ['Đất', 'Gốm', 'Sứ'];
    	foreach($list_cate as $cate){
    		$new_cate = \App\Category::firstOrNew(['name' => $cate]);
    		$new_cate->save();
    	}
    }
}
