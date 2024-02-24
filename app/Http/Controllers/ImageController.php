<?php

namespace App\Http\Controllers;

use App\Models\Like;
use App\Models\Image;
use App\Models\Comment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\RedirectResponse;
use Google\Cloud\Storage\StorageClient;
use Illuminate\Support\Facades\Storage;

class ImageController extends Controller
{
    protected $storage;    
    protected $bucket;

    public function __construct()
    {
        $this->storage= new StorageClient(['keyFilePath' => env('GOOGLE_CLOUD_KEY_FILE')]);
        $this->bucket = $this->storage->bucket('uploadsimg');
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
