<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\File;
use App\Models\GoogleCloudCredential;
use Illuminate\Http\RedirectResponse;
use Spatie\Permission\Traits\HasRoles;
use Google\Cloud\Storage\StorageClient;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;
use Illuminate\Routing\Controller as BaseController;

class UserController extends BaseController
{
    use HasRoles;

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
        
        $imgpath = file_get_contents($request->file('image')->path());
        if(is_file($imgpath))
            {
                $imgname=$request->file('image')->getClientOriginalName();
                $this->bucket->upload($imgpath,
                    [
                        'name' => 'public/storage/users/' . $imgname, 
                        'metadata' => ['contentType' => 'image/jpeg',],
                    ]);
                if (is_resource($imgpath)) {
                    fclose($imgpath);
                }
                $user->image = $imgname;
            } 
        $user->save();
        $msj = array('message'=>'Usuario Actualizado correctamente');
       
        return redirect()->route('user.config')->with($msj);
    }
    public function profile($id){
        $user = User::find($id);

        return view('user.profile',[
            'user' => $user
        ]);
        
    }

    public function Get_image($filename) {
        $object = $this->bucket->object('public/storage/users/' . $filename);
        $file = $object->signedUrl(now()->addMinutes(200), ['version' => 'v4']);
        
        return new RedirectResponse($file);
    }
}
