<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;

class ItemController extends Controller
{
	public function __construct()
    {
        $this->middleware('auth');
    }

    public function anyCreateItem(){
    	if(\Auth::user()->id_user_type != 1 && \Auth::user()->id_user_type != 2){
    		return redirect('/');
    	}
    	$category = \App\Category::getCategoriesList();
    	$size = \App\Size::getSizeList();

    	$form = \DataForm::create();
    	$form->add('name', 'Tên chậu cây', 'text')->rule('required|max:20');
    	$form->add('quatity', 'Số lượng', 'number')->rule('required');
    	$form->add('cost', 'Giá', 'text')->rule('required')->attributes(['data-v-max'=>'9999', 'data-v-min'=>'0']);
    	$form->add('id_category', 'Category', 'select')->options($category);
    	$form->add('id_size', 'Size', 'select')->options($size);
    	$form->add('photo','Photo', 'image', false, true)
    				->move('uploads/', date('YmdHis') . $this->generateRandomString())
    				->preview(80,80);

    	$form->saved(function() use ($form) {
    		$input = \Request::input();

    		$item = new \App\Item();
    		$item->name = $input['name'];
    		$item->quatity = $input['quatity'];
    		$item->cost = str_replace(['.','$'], '', $input['cost']);
    		$item->id_category = $input['id_category'];
    		$item->id_size = $input['id_size'];

    		if (\Input::hasFile('photo')) {
                $tempName = $form->fields['photo']->new_value;
            	$item->image_src = $tempName;
            }
    		$item->save();

    		\Session::flash('message', 'Success');
    		return redirect('/manage-item/create-item');
    	});
    	$form->submit('Create');
    	$form->build();
    	return $form->view('item.create-item', compact('form'));
    }

    public function generateRandomString($length = 10) {
    	$characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
    	$charactersLength = strlen($characters);
    	$randomString = '';
    	for ($i = 0; $i < $length; $i++) {
    		$randomString .= $characters[rand(0, $charactersLength - 1)];
    	}
    	return $randomString . '.jpg';
    }
}
