<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Storage;
use Imagick;
use Dcblogdev\Dropbox\Facades\Dropbox;
use App\Models\ProjectUpload;

class UploadController extends Controller
{
    public function upload(Request $request){
        $file = $request->file('test')->store('public/uploads');
        $url = url(str_replace('public', 'storage', $file));
        return response()->json(['file'=>$file, 'url'=>$url]);
    }
    public function unUpload(Request $request){
        $data = $request->json('file');
        Storage::delete($data);
    }

    public function magic_upload(Request $request){
        $project_id = $request->project_id;
        $file = $request->file('file')->store('public/uploads');
        $this->uploadToDropbox($file, $project_id);
        $image = new Imagick();
        $image->readImage(storage_path('/app/'.$file));
        $tmp = '/app/public/uploads/'.time().'.jpg';
        $image->writeImage(storage_path($tmp));
        $image->readImage(storage_path($tmp));
        $image->scaleImage(300, 0);
        $buf = $image->getimageblob();
        $image->clear(); 
        Storage::delete($tmp);
        $p = new ProjectUpload;
        $p->project_id = $project_id;
        $p->is_uploaded_by_customer = true;
        $p->preview = url(str_replace('public', 'storage', $file));
        $p->download = url(str_replace('public', 'storage', $file));
        $p->save();

        return response()->json(['image'=>'data:image/jpeg;base64,'.base64_encode($buf)]);
    }

    public function uploadToDropbox($file, $project_id){
        // $client = new Spatie\Dropbox\Client(env('DROPBOX_TOKEN'));
        // $upload = json_decode($file->upload, true);
        $content = Storage::get($file);
        $filename = basename($file);
        Dropbox::files()->upload('/A'.str_pad($project_id, 4, '0', STR_PAD_LEFT), storage_path('/app/'.$file));
        // $client->upload('/A'.$file->project_id.'/'.$filename, $content, $mode='add');
    }
}
