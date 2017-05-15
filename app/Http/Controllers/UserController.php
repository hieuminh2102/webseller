<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;

class UserController extends Controller
{

	public function __construct()
    {
        $this->middleware('auth');
    }

    public function anyAddInformation(){
    	$user = \App\User::find(\Auth::id());
    	$form = \DataForm::source($user);
    	$form->add('address', 'Địa chỉ', 'text')->rule('required');
    	$form->add('phone', 'Số điện thoại', 'text')->rule('required|min:10|max:11');
    	$form->saved(function() use ($form) {
    		\Session::flash('message', 'Success');
    		return redirect('/user-setting/add-information');
    	});
    	$form->submit('Update');
    	$form->build();
    	return $form->view('user.add_info', compact('form'));
    }
}
