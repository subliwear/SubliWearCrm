<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Order;
use Barryvdh\DomPDF\Facade\Pdf;
use Mail;
use App\Mail\SendInvoiceToCustomer;
use Maatwebsite\Excel\Facades\Excel;
use App\Exports\OrdersExport;

class OrderController extends Controller
{
    public function index(){
        if(auth()->user()->is_customer())
            $orders = Order::where('customer_id', auth()->user()->customer->id)->orderBy('order_status_id', 'desc')->orderBy('created_at', 'desc')->paginate(10);
        if(auth()->user()->is_manager())
            $orders = Order::where('manager_id', auth()->user()->manager->id)->orderBy('order_status_id', 'desc')->orderBy('created_at', 'desc')->paginate(10);
        if(auth()->user()->is_admin()){
            if(isset($_GET['search']) && !empty($_GET['search'])){
                $orders = Order::orderBy('order_status_id', 'desc')
                    ->orderBy('created_at', 'desc')
                    ->join('customers', 'orders.customer_id', '=', 'customers.id' )
                    ->join('users', 'customers.user_id', '=', 'users.id' )
                    ->where('uid', 'like', '%'.$_GET['search'].'%')
                    ->orWhere('users.name', 'like', '%'.$_GET['search'].'%')
                    ->orWhere('users.email', 'like', '%'.$_GET['search'].'%')
                    ->select('orders.*')
                    ->paginate(10);            
            }else{
                $orders = Order::orderBy('order_status_id', 'desc')->orderBy('created_at', 'desc')->paginate(10);            
            }
            
        }
        return view('orders')->with(['orders'=>$orders]);
    }

    public function view(Order $order){
        return view('orders-view')->with(['order'=>$order]);
    }

    public function delete(Order $order){
        $order->delete();
        return redirect()->back();
    }

    public function jsonCode(Order $order, Request $request){
        $code = $request->json('code');

        $order->uid = $code;
        $order->save();
    }

    public function download_invoice(Order $order){
        $pdf = Pdf::loadView('components.invoice', ['order'=>$order]);
        return $pdf->download('invoice-'.$order->id.'.pdf');
    }
    public function send_invoice(Order $order){
        $pdf = Pdf::loadView('components.invoice', ['order'=>$order]);
        Mail::to($order->customer->user)->send(new SendInvoiceToCustomer($order, $pdf));
        return redirect()->back();
    }
    public function download_xls(Order $order){
        return Excel::download(new OrdersExport($order->id), 'order-'.$order->id.'.xlsx');
    }
}
