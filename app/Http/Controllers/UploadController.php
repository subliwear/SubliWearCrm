<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Imagick;
use Dcblogdev\Dropbox\Facades\Dropbox;
use App\Models\ProjectUpload;
use Spatie\Dropbox\Client;

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

    public function magic_upload(Request $request)
{
    try {
        // Récupérer l'ID du projet depuis la requête
        $project_id = $request->project_id;

        // Vérifier si un fichier a été attaché à la requête
        if (!$request->hasFile('file')) {
            throw new \Exception('No file uploaded');
        }

        // Récupérer le fichier de la requête
        $file = $request->file('file');

        // Vérifier si le fichier est valide
        if (!$file->isValid()) {
            throw new \Exception('Invalid file uploaded');
        }

        // Stocker le fichier dans le système de fichiers
        $filePath = $file->store('public/uploads');

        // Sauvegarder le fichier sur Dropbox
        $this->uploadToDropbox($filePath, $project_id);

        // Créer une nouvelle instance de Imagick
        $image = new Imagick();

        // Lire l'image depuis le stockage
        $image->readImage(storage_path('app/'.$filePath));

        // Créer un nom de fichier temporaire unique
        $tmp = 'public/uploads/'.time().'.jpg';

        // Écrire l'image redimensionnée dans un fichier temporaire
        $image->writeImage(storage_path('app/'.$tmp));

        // Lire l'image redimensionnée depuis le stockage
        $image->readImage(storage_path('app/'.$tmp));

        // Redimensionner l'image à une largeur de 300 pixels
        $image->scaleImage(300, 0);

        // Récupérer les données de l'image sous forme de blob
        $buf = $image->getimageblob();

        // Nettoyer l'objet Imagick
        $image->clear(); 

        // Supprimer le fichier temporaire
        Storage::delete($tmp);

        // Créer une nouvelle instance de ProjectUpload
        $p = new ProjectUpload;

        // Définir les propriétés de ProjectUpload
        $p->project_id = $project_id;
        $p->is_uploaded_by_customer = true;
        $p->preview = url(str_replace('public', 'storage', $filePath));
        $p->download = url(str_replace('public', 'storage', $filePath));

        // Enregistrer l'objet ProjectUpload
        $p->save();

        // Renvoyer une réponse JSON avec l'image encodée en base64
        return response()->json(['image' => 'data:image/jpeg;base64,'.base64_encode($buf)]);
    } catch (\Exception $e) {
        // Gérer l'erreur et renvoyer une réponse JSON avec le message d'erreur
        return response()->json(['error' => $e->getMessage()], 400);
    }
}

    public function uploadToDropbox($file, $project_id){
        $client = new Client(env('DROPBOX_TOKEN'));
        $upload = json_decode($file->upload, true);
        $content = Storage::get($file);
        $filename = basename($file);
        Dropbox::files()->upload('/A'.str_pad($project_id, 4, '0', STR_PAD_LEFT), storage_path('/app/'.$file));
        $client->upload('/A'.$file->project_id.'/'.$filename, $content, $mode='add');
    }
}
