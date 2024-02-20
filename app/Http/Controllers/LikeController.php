<?php

namespace App\Http\Controllers;

use App\Models\Like;
use Illuminate\Support\Facades\Auth;

class LikeController extends Controller
{

    public function like ($image_id) {
        $user = Auth::user();
        $isset_like = Like::where('user_id' , $user->id )
                        ->where('image_id', $image_id)
                        ->count();
        if($isset_like==0){
            $like = new Like();
            $like->image_id = (int)$image_id;
            $like->user_id = $user->id;         
            $like->save();
            return response()->json([
                'like' =>$like
            ]);
        }else{
            return response()->json([
                'like' => 'El Like ya existe'
            ]);
        }
    }

    public function dislike ($image_id) {
        $user = Auth::user();
        $isset_like = Like::where('user_id' , $user->id )
                        ->where('image_id', $image_id)
                        ->first();
        if($isset_like){
            $isset_like->delete();
            return response()->json([
                'dislike'=>$isset_like,
                'message'=>'Has dado dislike'
            ]);
        }else{
            return response()->json([
                'message'=>'El like no existe'
            ]);
        }
    }
    public function index(){
        $user = Auth::user();
        $isset_like = Like::where('user_id',$user->id)->orderBy('id','desc')->paginate(5);
        return view('like.index',[
            'likes'=>$isset_like,
            'user'=>$user
        ]);
    }
}
