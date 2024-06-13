<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Spatie\Dropbox\Client;
use App\Models\ProjectUpload;
use Illuminate\Filesystem\Filesystem;




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

    // public function magic_upload(Request $request){
    //     $project_id = $request->project_id;
    //     $file = $request->file('file')->store('public/uploads');
    //     $this->uploadToDropbox($file, $project_id);
    //     $image = new Imagick();
    //     $image->readImage(storage_path('/app/'.$file));
    //     $tmp = '/app/public/uploads/'.time().'.jpg';
    //     $image->writeImage(storage_path($tmp));
    //     $image->readImage(storage_path($tmp));
    //     $image->scaleImage(300, 0);
    //     $buf = $image->getimageblob();
    //     $image->clear(); 
    //     Storage::delete($tmp);
    //     $p = new ProjectUpload;
    //     $p->project_id = $project_id;
    //     $p->is_uploaded_by_customer = true;
    //     $p->preview = url(str_replace('public', 'storage', $file));
    //     $p->download = url(str_replace('public', 'storage', $file));
    //     $p->save();

    //     return response()->json(['image'=>'data:image/jpeg;base64,'.base64_encode($buf)]);
    // }

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

            // Stocker le fichier dans le système de fichiers local
            $filePath = $file->store('public/uploads');

            // Télécharger le fichier vers Dropbox
            $this->uploadToDropbox3($file, $project_id);

            // Créer une image GD à partir du fichier téléchargé
            $image = imagecreatefromstring(file_get_contents(storage_path('app/' . $filePath)));

            // Créer un nom de fichier temporaire unique
            $tmp = 'public/uploads/' . time() . '.jpg';

            // Redimensionner l'image à une largeur de 300 pixels
            $resizedImage = imagescale($image, 300);

            // Sauvegarder l'image redimensionnée
            imagejpeg($resizedImage, storage_path('app/' . $tmp));

            // Libérer la mémoire
            imagedestroy($image);
            imagedestroy($resizedImage);

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

            // Renvoyer une réponse JSON avec succès
            return response()->json(['success' => true, 'image' => $p->preview], 200);
        } catch (\Exception $e) {
            // Gérer l'erreur et renvoyer une réponse JSON avec le message d'erreur
            return response()->json(['error' => $e->getMessage()], 400);
        }
    }
    
    

    /* public function magic_upload(Request $request)
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
    }  */


    public function uploadToDropbox($file, $project_id){
        $client = new Client(env('DROPBOX_REFRESH_TOKEN'));
        
        // Récupérer le contenu du fichier
        $content = file_get_contents($file->path());
        
        // Nom du fichier
        $filename = $file->getClientOriginalName();
        
        // Chemin dans Dropbox
        $dropboxPath = '/A'.str_pad($project_id, 4, '0', STR_PAD_LEFT).'/'.$filename;
        
        // Télécharger le fichier vers Dropbox
        $client->upload($dropboxPath, $content, 'add');
    
        // Vous pouvez également utiliser l'API Dropbox PHP comme suit :
        // \Dropbox::upload($dropboxPath, $content, 'add');
    }

    public function uploadToDropbox2($file, $project_id)
    {
        // Nom du fichier
        $filename = $file->getClientOriginalName();

        // Chemin dans Dropbox
        $dropboxPath = '/A' . str_pad($project_id, 4, '0', STR_PAD_LEFT) . '/' . $filename;

        // Télécharger le fichier vers Dropbox
        Storage::disk('dropbox')->put($dropboxPath, file_get_contents($file->path()));
    }
    public function uploadToDropbox3($file, $project_id)
    {
    try {
        // Nom du fichier
        $filename = $file->getClientOriginalName();

        // Chemin dans Dropbox
        $dropboxPath = '/A' . str_pad($project_id, 4, '0', STR_PAD_LEFT) . '/' . $filename;

        // Télécharger le fichier vers Dropbox
        Storage::disk('dropbox')->put($dropboxPath, file_get_contents($file->path()));
    } catch (\Exception $e) {
        throw new \Exception('Erreur lors du téléchargement vers Dropbox : ' . $e->getMessage());
    }
    }
    
    

    public function getImage($projectId)
    {
    // Récupérer toutes les sources (preview) pour un project_id spécifique
    $projectUploads = ProjectUpload::where('project_id', $projectId)->pluck('preview');

    if ($projectUploads->isNotEmpty()) {
        return response()->json($projectUploads);
    }

    return response()->json(['error' => 'Images not found for the given project_id'], 404);
    }

}
