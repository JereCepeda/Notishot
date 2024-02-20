<?php

namespace App\Http\Controllers;

use App\Models\Comment;
use App\Models\Image;
use App\Models\Like;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\File;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Storage;

class ImageController extends Controller
{
    
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
            Storage::disk('public')->put('images/'.$img_name,File::get($request->file('image_path')));
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
        $file = Storage::disk('public')->get('images/'.$filename);
        return new Response($file,200);
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
            Storage::disk('public')->delete('images/'.$image->image_path);
            $image->delete();
            $msj = array('message'=>'La imagen se ha borrado');
        }else{
            $msj = array('message'=>'La imagen no se ha borrad');
        }
        return redirect()->route('image.galeria')->with($msj);

    }
}
