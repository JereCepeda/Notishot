<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Image;
use Illuminate\Http\Request;
use Spatie\Permission\Models\Role;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class WelcomeController extends Controller
{
    public function index(){

        $images = Image::orderBy('id','desc')->get();
        return view('image.galeria',[
            'images'=>$images
        ]);
    }
}
