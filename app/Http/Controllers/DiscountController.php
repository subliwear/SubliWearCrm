<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Discount;
use App\Models\Customer;
use App\Models\Patronage;

class DiscountController extends Controller
{
    public function index(){
        return view('discounts')->with(['discounts'=>Discount::all()]);
    }

    public function add(){
        return view('discounts-add')->with(['customers'=>Customer::all(), 'patronages'=>Patronage::all()]);
    }

    public function edit(Discount $discount){
        return view('discounts-edit')->with(['discount'=>$discount, 'customers'=>Customer::all(), 'patronages'=>Patronage::all()]);
    }

    public function create(Request $request){
        $this->validate($request, [
            'title'=>'required',
            'discount'=>'required',
        ]);
        $os = new Discount;
        $os->title = $request->title;
        $os->discount = $request->discount;
        if(!empty($request->customer_id))
            $os->customer_id = $request->customer_id;
        if(!empty($request->patronage_id))
            $os->patronage_id = $request->patronage_id;
        $os->is_overall = $request->has('is_overall');
        
        $os->save();
        return redirect()->route('discounts');
    }

    public function save(Discount $discount, Request $request){
        $discount->title = $request->title;
        $discount->discount = $request->discount;
        if(!empty($request->customer_id))
            $discount->customer_id = $request->customer_id;
        if(!empty($request->patronage_id))
            $discount->patronage_id = $request->patronage_id;
        $discount->is_overall = $request->has('is_overall');
        $discount->save();
        return redirect()->route('discounts');
    }

    public function delete(Discount $discount){
        $discount->delete();
        return redirect()->back();
    }
}
