<?php

use App\Models\Image;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\LikeController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\ImageController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\CommentController;
use App\Http\Controllers\WelcomeController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('welcome');})->name('welcome');

Route::view('/login',"user/login")->name('login');//funciona
Route::view('/registro',"user/register")->name('registro');//funciona

Route::post('/validar-registro',[LoginController::class,'register'])->name('validar-registro');//ruta que valida el post del registro
Route::post('/iniciar-sesion',[LoginController::class,'login'])->name('iniciar-sesion');//ruta que valida el post del inicio de sesion
Route::get('/logout',[LoginController::class,'logout'])->name('logout');//funciona
Route::get('/index',[WelcomeController::class,'index'])->name('image.galeria');
Route::get('/user/avatar/{filename}',[UserController::class,"Get_image"])->name('user.avatar');//funciona
Route::get('/shot/galeria/{filename}',[ImageController::class,'Get_Image'])->name('image.Get_img');//funciona
Route::get('/shot/show/{id}',[ImageController::class,'Get_details'])->name('image.Get_detail');//funciona
Route::get('/perfil/{id}',[UserController::class,"profile"])->name('user.profile');
Route::get('/config',[UserController::class,"configura"])->name('user.config');//funciona
Route::post('user/update/',[UserController::class,"POST_update"])->name('user.update');


Route::middleware(['web', 'auth','can:publicacion.like'])->group(function () {

    Route::get('/shot/{id}/delete',[ImageController::class,'delete'])->name('image.eliminar');//funciona

    // Creacion de imagen 
    Route::get('/shot/new',[ImageController::class,'create'])->name('image.create');//funciona
    Route::post('/shot/store',[ImageController::class,'Pcreate'])->name('image.Post_create');//funciona

    //Creacion de comentarios
    Route::post('/comment/save',[CommentController::class,'store'])->name('comment.store');//funciona

    //Creacion de like
    Route::get('/shot/add/like/{img}',[LikeController::class,'like'])->name('like.Post_store');//funciona
    Route::get('/shot/dislike/{img}',[LikeController::class,'dislike'])->name('like.delete');//funciona

    //Creacion de Paginacion de Likes
    Route::get('/shot/favs',[LikeController::class,'index'])->name('like.index');//funciona
});

//Validaciones del Admin

Route::middleware(['web', 'auth', 'can:usuarios.listar'])->group(function () {
    Route::get('/admin/users', [AdminController::class,'userList'])->name('user.admin.list');
    Route::get('/admin/datatable', [AdminController::class,'GET_datatable'])->name('admin.datatable');
    
    Route::post('/admin/users/{user}/permissions', [AdminController::class,'updatePermissions'])->name('user.admin.update_permissions');
    Route::post('/admin/users/{user}/block', [AdminController::class,'blockUser'])->name('user.admin.block');
});