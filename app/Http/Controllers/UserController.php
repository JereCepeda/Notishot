<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\File;
use Spatie\Permission\Traits\HasRoles;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;
use Illuminate\Routing\Controller as BaseController;

class UserController extends BaseController
{
    use HasRoles;
    public function configura()
    {
        return view('user.config');
    }

    public function POST_update(Request $request)  {
        $user = Auth::user();   
        $id = $user->id;
        
        $validador = Validator::make($request->all(),[
            'name' => 'string|max:250',
            'surname' => 'string|max:250',
            'email' => 'string|max:250|unique:users,email,'.$id ,
            'nick' => 'string|max:250|min:5|unique:users,nick,'.$id 
        ])->validated();

        $user->name=$request->input('name');
        $user->email=$request->input('email');
        $user->surname=$request->input('surname');
        $user->nick=$request->input('nick');
        
        $imgpath = $request->file('image');
        if(is_file($imgpath))
            {
                $imgname= $imgpath->getClientOriginalName();
                Storage::disk('public')->put('users/'.$imgname,File::get($imgpath));
                $user->image = $imgname;
            } 
        $user->save();
        
        return redirect()->route('user.config')->with(['message'=>'Usuario Actualizado correctamente']);
    }
    public function profile($id){
        $user = User::find($id);

        return view('user.profile',[
            'user' => $user
        ]);
        
    }

    public function Get_image($filename) {
        
        $file = Storage::disk('public')->get('users/'.$filename);

        return new Response($file,200);
    }
}
