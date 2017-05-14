<?php

use Illuminate\Database\Seeder;

class UserRoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
    	$list_role = ['Admin', 'Staff', 'Normal', 'Shipper'];
    	foreach($list_role as $role){
    		$new_role = \App\UserType::firstOrNew(['role' => $role]);
    		$new_role->save();
    	}
    }
}
