<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Customer;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class CustomerController extends Controller
{
    public function index(){
        return view('customers')->with(['customers'=>Customer::all()]);
    }

    public function add(){
        return view('customers-add');
    }

    public function edit(Customer $customer){
        return view('customers-edit')->with(['customer'=>$customer]);
    }

    public function create(Request $request){
        $this->validate($request, [
            'email'=>'email|required|unique:users',
            'name'=>'required'
        ]);

        $u = new User;
        $u->name = $request->name;
        $u->email = $request->email;
        $pwd = Str::random(6);
        $u->password = Hash::make($pwd);
        $u->save();
        //TODO: send email to manager with his new password
        $m = new Customer;
        $m->user_id = $u->id;
        $m->save();
        //TODO: redirect to success
        return redirect()->route('managers');
    }

    public function save(Customer $customer, Request $request){
        $customer->user->name = $request->name;
        $customer->user->save();
        return redirect()->route('customers');
    }

    public function delete(Customer $customer){
        $customer->user->delete();
        $customer->delete();
        return redirect()->back();
    }

    public function json(){
        if(isset($_GET['ss']) && !empty($_GET['ss'])){
            $customers = Customer::with('user')->whereIn('user_id', User::where('name', 'like', '%'.$_GET['ss'].'%')->pluck('id'))->get();
        }else{
            $customers = Customer::with('user')->get();
        }
        return response()->json($customers);
    }
}
