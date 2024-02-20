<?php

namespace App\Http\Controllers;

use App\Models\Comment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CommentController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function store(Request $request) {
        $this->validate($request,array(
            'image_id' => 'integer|required',
            'content' => 'string|required'
        ));
        
        $comment = new Comment();
        $comment->user_id = Auth::user()->id;
        $comment->image_id = $request->input('image_id');
        $comment->content = $request->input('content');
        $comment->save();
        return redirect(route('image.Get_detail',['id'=>$comment->image_id]))
                        ->with(array(
                            'message' => 'Se publico el comentario correctamente'
                        ));
    }
}
