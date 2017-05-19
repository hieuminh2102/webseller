<?php

use Illuminate\Database\Seeder;

class StatusSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
    	$list_status = ['Mới đặt', 'Đang vận chuyển', 'Hoàn thành'];
    	foreach($list_status as $status){
    		$new_status = \App\Status::firstOrNew(['status' => $status]);
    		$new_status->save();
    	}
    }
}
