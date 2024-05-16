<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Manager;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use Mail;
use App\Mail\SendPasswordToManager;

class ManagerController extends Controller
{
    public function index(){
        return view('managers')->with(['managers'=>Manager::all()]);
    }

    public function add(){
        return view('managers-add');
    }

    public function edit(Manager $manager){
        return view('managers-edit')->with(['manager'=>$manager]);
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
        $u->is_man = true;
        $u->save();
        Mail::to($u->email)->send(new SendPasswordToManager($u, $pwd));
        //TODO: send email to manager with his new password
        $m = new Manager;
        $m->user_id = $u->id;
        $m->save();
        return redirect()->route('managers');
    }

    public function save(Manager $manager, Request $request){
        $manager->user->name = $request->name;
        $manager->user->save();
        return redirect()->route('managers');
    }

    public function delete(Manager $manager){
        $manager->user->delete();
        $manager->delete();
        return redirect()->back();
    }
}
