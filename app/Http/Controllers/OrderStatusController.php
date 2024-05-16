<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\OrderStatus;

class OrderStatusController extends Controller
{
    public function index(){
        return view('order-statuses')->with(['order_statuses'=>OrderStatus::all()]);
    }

    public function add(){
        return view('order-statuses-add');
    }

    public function edit(OrderStatus $order_status){
        return view('order-statuses-edit')->with(['order_status'=>$order_status]);
    }

    public function create(Request $request){
        $this->validate($request, [
            'title'=>'required',
            'background_color'=>'required',
            'text_color'=>'required'
        ]);
        $os = new OrderStatus;
        $os->title = $request->title;
        $os->background_color = $request->background_color;
        $os->text_color = $request->text_color;
        $os->save();
        return redirect()->route('order-statuses');
    }

    public function save(OrderStatus $order_status, Request $request){
        $order_status->title = $request->title;
        $order_status->background_color = $request->background_color;
        $order_status->text_color = $request->text_color;
        $order_status->save();
        return redirect()->route('order-statuses');
    }

    public function delete(OrderStatus $order_status){
        $order_status->delete();
        return redirect()->back();
    }

    public function json(){
        return response()->json(['statuses'=>OrderStatus::all()]);
    }
}
