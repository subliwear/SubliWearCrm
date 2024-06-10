<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Option;

class OptionController extends Controller
{
    public function index(){
        return view('options')->with(['option'=>Option::get()]);
    }

    public function save(Request $request){
        $o = Option::get();
        if($request->has('logo')){
            $logo = $request->file('logo')->store('public/logos');
            $o->logo = url(str_replace('public', 'storage', $logo));
        }

        if($request->has('left_column_image')){
            $left_column_image = $request->file('left_column_image')->store('public/logos');
            $o->left_column_image = url(str_replace('public', 'storage', $left_column_image));
        }
        if($request->has('right_column_image')){
            $right_column_image = $request->file('right_column_image')->store('public/logos');
            $o->right_column_image = url(str_replace('public', 'storage', $right_column_image));
        }
        
        $o->left_column_title1 = $request->left_column_title1;
        $o->left_column_title2 = $request->left_column_title2;
        $o->right_column_title = $request->right_column_title;

        $o->left_column_text = $request->left_column_text;
        $o->right_column_text = $request->right_column_text;
        $o->deadline = $request->deadline;


        $o->title = $request->title;
        $o->help = $request->help;
        $o->invoice_from = $request->invoice_from;
        $o->save();
        return redirect()->back();
    }
}
