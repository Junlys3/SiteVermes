<?php

use App\Http\Controllers\ImagemPostController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PostsController;
use App\Models\posts;
use App\Http\Controllers\ImagemPostControllerController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\CommentsController;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\PostDetails;





Route::get('/',[PostsController::class,'index'])->name('site.home');


Route::get('/postform', function () {
    return view('site.postform');
})->middleware('auth')->name('site.form');
Route::post('/posts',[PostsController::class,'store'])->name('site.store'); 
Route::get('/postdetails/{id}', [PostDetails::class, 'PostDetails'])->name('site.postdetails'); // Rota para detalhes do post

Route::post('/postcomments/{id}', [CommentsController::class, 'postCommentsCreate']); // Rota para exibir comentários do post


//Rotas login,logout
    Route::get('/logint', function(){//Redireciona para a rota login, pq por padrão middleware auth vai para a rota com name login
        return redirect('/login');
    })->name('login');
    Route::get('/login', function(){ // Rota para exibir  o formulário de login
        return view('site.login');
    })->name('site.login');
    Route::post('/login', [LoginController::class, 'login']); // Rota para processar o login
    Route::get('/logout', [LoginController::class, 'logout'])->name('site.logout'); // Rota para processar o logout
    Route::get('/register',function(){
        return view('site.register');
    })->name('site.register'); // Rota para exibir o formulário de registro
    Route::post('/register', [LoginController::class, 'register'])->name('register');
    Route::delete('/delete/{id}', [PostsController::class, 'destroy'])->name('site.delete')->middleware('auth'); // Rota para deletar o post





