<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Customer;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use App\Mail\SendPasswordToClient;
use Mail;

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
    
        // Création d'un nouvel utilisateur
        $user = new User;
        $user->name = $request->name;
        $user->email = $request->email;
        $pwd = Str::random(6);
        $user->password = Hash::make($pwd);
        $user->save();
    
        // Création d'un client lié à cet utilisateur
        $customer = new Customer;
        $customer->user_id = $user->id;
        $customer->save();
    
        // Envoi d'un email au nouvel utilisateur avec son mot de passe
        Mail::to($user->email)->send(new SendPasswordToClient($user, $pwd));
        
        // Redirection vers la page des clients après la création réussie
        return redirect()->route('customers');
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
            // $customers = Customer::with('user')->whereIn('user_id', User::where('name', 'like', '%'.$_GET['ss'].'%')->pluck('id'))->get();
            $customers = Customer::with('user')
              ->whereIn('user_id', function($query) {
                  $query->select('id')
              ->from('users')
              ->where('name', 'like', '%'.$_GET['ss'].'%')
              ->orWhere('email', 'like', '%'.$_GET['ss'].'%');
              })
              ->get();

        }else{
            $customers = Customer::with('user')->get();
        }
        return response()->json($customers);
    }
}
