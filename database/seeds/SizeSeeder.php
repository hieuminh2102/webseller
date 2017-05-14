<?php

use Illuminate\Database\Seeder;

class SizeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
    	$list_size = ['Lớn', 'Trung Bình', 'Nhỏ'];
    	foreach($list_size as $size){
    		$new_size = \App\Size::firstOrNew(['size' => $size]);
    		$new_size->save();
    	}
    }
}
