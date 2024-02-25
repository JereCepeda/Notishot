<?php

namespace App\Http\Controllers;

use App\Models\Like;
use App\Models\Image;
use App\Models\Comment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Auth;
use App\Models\GoogleCloudCredential;
use Illuminate\Http\RedirectResponse;
use Google\Cloud\Storage\StorageClient;
use Illuminate\Support\Facades\Storage;

class ImageController extends Controller
{
    protected $storage;    
    protected $bucket;

    public function __construct()
    {
        $credentials= GoogleCloudCredential::first();
        $temp =[ 'type' => 'service_account','project_id' => $credentials->project_id,'private_key_id' => $credentials->private_key_id,'private_key' => $credentials->private_key,'client_email' => $credentials->client_email,'client_id' => $credentials->client_id,"auth_uri"=> "https://accounts.google.com/o/oauth2/auth","token_uri"=> "https://oauth2.googleapis.com/token","auth_provider_x509_cert_url"=> "https://www.googleapis.com/oauth2/v1/certs","client_x509_cert_url"=> "https://www.googleapis.com/robot/v1/metadata/x509/laravel-notishot%40beaming-theorem-415323.iam.gserviceaccount.com","universe_domain"=> "googleapis.com"];
        $tempFilePath = tempnam(sys_get_temp_dir(), 'gcloud_credentials');
        file_put_contents($tempFilePath, json_encode($temp));
        $this->storage = new StorageClient(['keyFilePath' => $tempFilePath]);
        $this->bucket = $this->storage->bucket(env('GOOGLE_CLOUD_STORAGE_BUCKET'));
    }
    
    public function create()  {
        return view('image.create');
    }

    public function Pcreate(Request $request) {

        
        $user = Auth::user();
        $img = new Image();
        $img->user_id= $user->id;
        $img->description = $request->descripcion;
        
        if($request->file('image_path')){
            $img_name = time().$request->file('image_path')->getClientOriginalName();
            $imageContents = file_get_contents($request->file('image_path')->path());
            $this->bucket->upload($imageContents,
                [
                    'name' => 'public/storage/images/' . $img_name, 
                    'metadata' => ['contentType' => 'image/jpeg',],
                ]);
            if (is_resource($imageContents)) {
                fclose($imageContents);
            }
            $img->image_path = $img_name;    
        }

        $img->save(); 
        return redirect()->route('welcome')->with([
            "message" => "Archivo subido correctamente"
        ]);
    }

    public function Get_details($id) {
        $img = Image::find($id);
        return view('image.detail',[
            'imagen'=>$img
        ]);
    }

    public function Get_Image($filename) {
        $object = $this->bucket->object('public/storage/images/' . $filename);
        $file = $object->signedUrl(now()->addMinutes(200), [
            'version' => 'v4',
        ]);
        return new RedirectResponse($file);
    }

    public function delete($id) {
        $user = Auth::user();
        $image = Image::find($id);
        $comments= Comment::where('image_id',$id)->get();
        $likes= Like::where('image_id',$id)->get();
        if($user && $image && $image->user->id == $user->id ){
            if($comments && count($comments) >= 1 ){
                foreach($comments as $comment)
                {$comment->delete();}
            }
            if($likes && count($likes) >= 1 ){
                foreach($likes as $like)
                {$like->delete();}
            }
            $object = $this->bucket->object('public/storage/images/'.$image->image_path);
            $object->delete();

            $image->delete();
            $msj = array('message'=>'La imagen se ha borrado');
        }else{
            $msj = array('message'=>'La imagen no se ha borrado');
        }
        return redirect()->route('image.galeria')->with($msj);

    }
}
