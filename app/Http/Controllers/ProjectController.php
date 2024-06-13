<?php

namespace App\Http\Controllers;

use App\Models\Manager;
use Illuminate\Http\Request;
use App\Models\Project;
use App\Models\ProjectUpload;
use App\Models\ProjectPatronage;
use App\Models\Patronage;
use App\Models\ProjectMessage;
use App\Models\ProjectNote;
use App\Models\Order;
use App\Models\Option;
use App\Models\Discount;
use App\Models\OrderStatus;
use Mail;
use Illuminate\Support\Facades\Storage;
use App\Mail\OrderStatusChanged;
use App\Mail\NewMessageNotificationCustomer;
use App\Mail\NewMessageNotificationManager;
use App\Mail\ManagerPickedOrder;
use Dcblogdev\Dropbox\Facades\Dropbox;



class ProjectController extends Controller
{
    public function index(){
        $projects = collect(); // Initialiser comme une collection vide
        $managers = Manager::with('user')->get();
        $options = Option::first();
        $projectmessages = [];
        
        if(auth()->user()->is_customer())
            $projects = Project::where('customer_id', auth()->user()->customer->id)->where('is_confirmed', true)->orderBy('created_at', 'desc')->paginate(10);
            $managers = Manager::with('user')->get();
            $options = Option::first();
            $projectmessages = 'test';
            
            

        if(auth()->user()->is_manager())
            $projects = Project::where('is_confirmed', true)->where('is_ordered', false)->where(function($q){
                $q->where('manager_id', auth()->user()->manager->id)->orWhereNull('manager_id');
            })->orderBy('created_at', 'asc')->paginate(10);
            $managers = Manager::with('user')->get();
            $options = Option::first();
            $projectmessages = [];
            foreach($projects as $project) {
                    $projectmessages[$project->customer_id] = ProjectMessage::where('is_sent_by_customer', true)
                        ->where('customer_id', $project->customer_id)
                        ->orderByDesc('created_at')
                       ->limit(1)
                        ->get();
            }
            
        if(auth()->user()->is_admin()){
            if(isset($_GET['search']) && !empty($_GET['search'])){
                $projects = Project::where('is_confirmed', true)
                    ->join('customers', 'projects.customer_id', '=', 'customers.id' )
                    ->join('users', 'customers.user_id', '=', 'users.id' )
                    ->where('is_confirmed', true)
                    ->where(function($query){
                        $query
                        ->where('uid', 'like', '%'.$_GET['search'].'%')
                        ->orWhere('users.name', 'like', '%'.$_GET['search'].'%')
                        ->orWhere('users.email', 'like', '%'.$_GET['search'].'%');
                    })
                    ->select('projects.*')
                    ->orderBy('created_at', 'desc')
                    ->paginate(10);  
            }else{
                $projects = Project::where('is_confirmed', true)->orderBy('created_at', 'desc')->paginate(10);
                // $managers = Project::select('manager_id')->first();
                $managers = Manager::with('user')->get();

                $options = Option::first();

                
                $projectmessages = [];
                foreach($projects as $project) {
                    $projectmessages[$project->customer_id] = ProjectMessage::where('is_sent_by_customer', true)
                        ->where('customer_id', $project->customer_id)
                        ->orderByDesc('created_at')
                       ->limit(1)
                        ->get();
                }


 
                }
        }
            
        return view('projects')->with(['projects'=>$projects , 'managers' => $managers , 'options'=> $options ,'projectmessages' => $projectmessages]);
    }


    public function updateManager(Request $request)
    {
    $projectId = $request->input('project_id');
    $managerId = $request->input('manager_id');

    // Rechercher le projet correspondant au project_id
    $project = Project::findOrFail($projectId);

    // Mettre à jour le manager_id du projet
    $project->manager_id = $managerId;
    $project->save();

    // Vérifier s'il existe des commandes correspondant au project_id
    if (Order::where('project_id', $projectId)->exists()) {
        // Mettre à jour le manager_id dans la table "orders"
        Order::where('project_id', $projectId)->update(['manager_id' => $managerId]);

        return response()->json(['success' => true]);
    } else {
        // Si aucune commande correspondant au project_id n'a été trouvée dans la table "orders"
        return response()->json(['success' => false, 'message' => 'La mise à jour du designer a été réalisée, bien que le projet correspondant n ait pas encore franchi l étape de commande.']);
    }
    }




    public function add(){
        $managers = Manager::with('user')->get();
        return view('projects-add')->with(['managers' => $managers]);
    }

    public function view(Project $project){
        if(auth()->user()->is_manager() || auth()->user()->is_admin()){
            if(auth()->user()->is_manager() && auth()->user()->manager->id == $project->manager_id){
                $project->is_read_manager = true;
                $project->save();
            }
            return view('projects-view')->with(['project'=>$project]);
        }
        if(auth()->user()->is_customer()){
            if($project->customer_id == auth()->user()->customer->id){
                $project->is_read_customer = true;
                $project->save();
                return view('projects-view')->with(['project'=>$project]);
            }else{
                return redirect()->route('projects');
            }
        }
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
        $m = new Project;
        $m->user_id = $u->id;
        $m->save();
        return redirect()->route('managers');
    }

    public function save(Project $project, Request $request){
        $project->user->name = $request->name;
        $project->user->save();
        return redirect()->route('managers');
    }

    public function delete(Project $project){
        $project->delete();
        return redirect()->back();
    }

    public function jsonCreate(Request $request){
        $title = $request->json('title');
        $project_id = $request->json('project_id');
        $patronages = $request->json('patronages');

        $project = Project::findOrFail($project_id);
        $project->title = $title;
        $project->is_confirmed = true;
        $project->save();

        foreach($patronages as $patronage){
            $db_patronage = new ProjectPatronage;
            $db_patronage->project_id = $project->id;
            $db_patronage->is_custom_patronage = $patronage['patronage_type']!='existing';
            $qty = 0;
            foreach($patronage['details'] as $row){
                $qty+=$row['quantity'];
            }
            $db_patronage->total_quantity = $qty;
            if($patronage['patronage_type']=='existing'){
                $db_patronage->patronage_id = $patronage['patronage_id'];
                $tmp_patronage = Patronage::findOrFail($patronage['patronage_id']);
                $db_patronage->price_per_item = $tmp_patronage->price;
                $price_w_discount = $tmp_patronage->price;
                if(Discount::where('is_overall', true)->exists()){
                    $global_discount = Discount::where('is_overall', true)->orderBy('discount', 'desc')->first();
                    $discount = $global_discount->discount/100;
                    $price_w_discount = $tmp_patronage->price * (1-$discount);
                }else{
                    if(auth()->user()->is_customer() && auth()->user()->customer->discount()!=1){
                        $discount = auth()->user()->customer->discount();
                        $price_w_discount = $tmp_patronage->price * (1-$discount);
                    }else{
                        if($tmp_patronage->discount()!=1){
                            $price_w_discount = $tmp_patronage->price * (1-$tmp_patronage->discount());
                        }
                    }
                }
                $db_patronage->price_per_item_with_discount = $price_w_discount;
                $db_patronage->price_per_row_with_discount_and_tax = $price_w_discount * $qty;
            }else{
                $files = [];
                $previews = [];
                foreach($patronage['uploads'] as $upload){
                    if(strpos($upload['filetype'], 'image/'))
                        $previews[] = $upload['url'];
                    $files[] = $upload;
                    $project_upload = new ProjectUpload;
                    $project_upload->project_id = $project->id;
                    $project_upload->is_uploaded_by_customer = true;
                    $project_upload->preview = $upload['url'];
                    $project_upload->download = $upload['url'];
                    $project_upload->upload = json_encode($upload);
                    $project_upload->file = $upload['file'];
                    $project_upload->filetype = $upload['filetype'];
                    $project_upload->save();
                    $this->uploadToDropbox($project_upload);
                }
                $db_patronage->custom_patronage = json_encode($files);
                $db_patronage->custom_patronage_preview = json_encode($previews);
            }
            $db_patronage->details = json_encode($patronage['details']);
            $db_patronage->images = json_encode($patronage['category_images']);
            $db_patronage->custom_design = json_encode($patronage['custom_columns']);
            $db_patronage->save();
        }
        return response()->json(['redirect'=>route('projects-view', $project)]);
    }

    public function takeProject(Project $project){
        $project->manager_id = auth()->user()->manager->id;
        $project->save();
        Mail::to($project->customer->user)->send(new ManagerPickedOrder($project));
        return redirect()->back();
    }

    public function jsonProject(Project $project){
        $messages = [];
        $notes = [];
        $uploads = [];

        foreach($project->patronages as $patronage){
            $message = [];
            $message['type'] = 'patronage';
            $message['details'] = json_decode($patronage->details, true);
            $message['columns'] = json_decode($patronage->custom_design, true);
            $message['is_from_customer'] = true;
            $message['is_custom'] = $patronage->is_custom_patronage;

            if(!$patronage->is_custom_patronage){
                $message['patronage'] = $patronage->patronage;
                $message['preview'] = json_decode($patronage->images, true);
            }else{
                $message['previews'] = json_decode($patronage->custom_patronage_preview, true);
                $message['downloads'] = json_decode($patronage->custom_patronage, true);
            }
            $message['date'] = $patronage->created_at->format('d.m.Y H:i:s');
            $message['date_sort'] = strtotime($patronage->created_at);
            $messages[] = $message;
        }

        foreach($project->uploads as $upload){
            $message = [];
            $message['type'] = 'upload';
            $message['is_from_customer'] = $upload->is_uploaded_by_customer;
            $message['upload'] = json_decode($upload->upload, true);
            $message['preview'] = $upload->preview;
            $message['download'] = $upload->preview;
            $message['date'] = $upload->created_at->format('d.m.Y H:i:s');
            $message['date_sort'] = strtotime($upload->created_at);
            $messages[] = $message;
            $upload->upload = json_decode($upload->upload, true);
            $uploads[] = $upload;
        }

        foreach($project->messages as $message_){
            $message = [];
            $message['type'] = 'message';
            $message['is_from_customer'] = $message_->is_sent_by_customer;
            $message['text'] = $message_->message;
            $message['date'] = $message_->created_at->format('d.m.Y H:i:s');
            $message['date_sort'] = strtotime($message_->created_at);
            $messages[] = $message;
        }

        foreach($project->notes as $note){
            $notes[] = $note;
        }

        $messages = collect($messages);
        $messages = $messages->sortBy('date_sort');
        return response()->json([
            'messages'=>$messages->values()->all(),
            'uploads'=>$uploads,
            'notes'=>$notes
        ]);
    }

    public function jsonMessage(Request $request){
        $text = $request->json('text');
        $project_id = $request->json('project_id');
        $project = Project::findOrFail($project_id);
        if(auth()->user()->is_customer())
            $project->is_read_manager = false;
        else
            $project->is_read_customer = false;
        $project->save();

        $files = $request->json('files');
        if(!empty($text)){
            $m = new ProjectMessage;
            $m->message = $text;
            if(auth()->user()->is_customer()){
                $m->customer_id = auth()->user()->customer->id;
                $m->is_sent_by_customer = true;
            }
            else if(auth()->user()->is_manager())
                $m->manager_id = auth()->user()->manager->id;
            $m->project_id = $project_id;
            $m->save();
        }

        foreach($files as $file){
            $project_upload = new ProjectUpload;
            $project_upload->project_id = $project_id;
            if(auth()->user()->is_customer()){
                $project_upload->is_uploaded_by_customer = true;
            }else{
                $project_upload->is_uploaded_by_customer = false;
            }
            $project_upload->preview = $file['url'];
            $project_upload->download = $file['url'];
            $project_upload->upload = json_encode($file);
            $project_upload->file = $file['file'];
            $project_upload->filetype = $file['filetype'];
            $project_upload->save();
            $this->uploadToDropbox($project_upload);

            
        }
        if(auth()->user()->is_customer()){
            if($project->manager)
                Mail::to($project->manager->user)->send(new NewMessageNotificationManager($project));
        }else{
            Mail::to($project->customer->user)->send(new NewMessageNotificationCustomer($project));
        }
    }

    public function jsonNote(Request $request){
        $text = $request->json('text');
        $project_id = $request->json('project_id');
        $m = new ProjectNote;
        $m->note = $text;
        $m->project_id = $project_id;
        $m->save();
    }

    public function jsonCode(Project $project, Request $request){
        $code = $request->json('code');

        $project->uid = $code;
        $project->save();
    }

    public function jsonOrder(Project $project){
        $o = new Order;
        $o->project_id = $project->id;
        $o->order_status_id = OrderStatus::first()->id;
        $o->customer_id = $project->customer_id;
        $o->manager_id = $project->manager_id;
        $o->total = $project->total();
        $o->uid = $project->uid;
        $o->save();
        $project->is_ordered = true;
        $project->save();
        Mail::to($project->manager->user)->send(new OrderStatusChanged($o));
        Mail::to($project->customer->user)->send(new OrderStatusChanged($o));
        return response()->json(['redirect'=>route('orders-view', $o)]);
    }

    public function jsonOrderStatus(Project $project){
        $order = Order::where('project_id', $project->id)->firstOrFail();
        return response()->json(['status'=>$order->status]);
    }

    public function jsonOrderChangeStatus(Project $project, Request $request){
        $order = Order::where('project_id', $project->id)->firstOrFail();
        $status = $request->json('status');
        $order->order_status_id = $status;
        $order->save();
        Mail::to($project->manager->user)->send(new OrderStatusChanged($order));
        Mail::to($project->customer->user)->send(new OrderStatusChanged($order));
        return response('.');
    }

    public function dashboard(){
        $projects = collect(); // Collection vide pour les projets
        $orders = collect();   // Collection vide pour les commandes
        if(auth()->user()->is_customer())
            $projects = Project::where('customer_id', auth()->user()->customer->id)->where('is_confirmed', true)->where('is_ordered', false)->orderBy('created_at', 'desc')->take(10)->get();
        if(auth()->user()->is_manager())
            $projects = Project::where('is_confirmed', true)->where('is_ordered', false)->where(function($q){
                $q->where('manager_id', auth()->user()->manager->id)->orWhereNull('manager_id');
            })->orderBy('created_at', 'asc')->take(10)->get();
        if(auth()->user()->is_admin())
            $projects = Project::orderBy('created_at', 'desc')->where('is_confirmed', true)->take(10)->get();  
    
        if(auth()->user()->is_customer())
            $orders = Order::where('customer_id', auth()->user()->customer->id)->orderBy('order_status_id', 'asc')->orderBy('created_at', 'desc')->take(10)->get();
        if(auth()->user()->is_manager())
            $orders = Order::where('manager_id', auth()->user()->manager->id)->orderBy('order_status_id', 'asc')->orderBy('created_at', 'desc')->take(10)->get();
        if(auth()->user()->is_admin())
            $orders = Order::orderBy('order_status_id', 'asc')->orderBy('created_at', 'desc')->take(10)->get();
                 
        return view('dashboard')->with(['projects'=>$projects, 'orders'=>$orders]);
    }

    public function uploadToDropbox(ProjectUpload $file){
        // $client = new Spatie\Dropbox\Client(env('DROPBOX_REFRESH_TOKEN'));
        // $upload = json_decode($file->upload, true);
        $content = Storage::get($file->file);
        $filename = basename($file->file);
        Dropbox::files()->upload('/A'.str_pad($file->project_id, 4, '0', STR_PAD_LEFT), storage_path('/app/'.$file->file));
        // $client->upload('/A'.$file->project_id.'/'.$filename, $content, $mode='add');
    }

    public function ajaxCreate(){
        $project = new Project;
        $project->customer_id = auth()->user()->customer->id;
        $project->title = '';
        $project->save();
        return response()->json(['id'=>$project->id]);
    }
}
