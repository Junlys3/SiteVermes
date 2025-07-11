<?php

use App\Http\Controllers\ImagemPostController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PostsController;
use App\Models\Posts;
use App\Http\Controllers\ImagemPostControllerController;
use App\Http\Controllers\LoginController;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\File;


// Rota temporária: copia as imagens de storage → public/uploads e atualiza o campo
Route::get('/migrate-old-images', function () {
    $uploadsDir = public_path('uploads');
    if (! File::exists($uploadsDir)) {
        File::makeDirectory($uploadsDir, 0755, true);
    }

    $migrated = 0;
    $notFound = [];

    $posts = Posts::whereNotNull('imagem')->get();
    foreach ($posts as $post) {
        $oldRel = $post->imagem;                // ex: "posts/abc123.jpg"
        $oldFull = storage_path('app/public/' . $oldRel);
        if (File::exists($oldFull)) {
            $filename = basename($oldRel);
            $newRel = 'uploads/' . $filename;   // ex: "uploads/abc123.jpg"
            $newFull = public_path($newRel);

            File::copy($oldFull, $newFull);
            $post->imagem = $newRel;
            $post->save();
            $migrated++;
        } else {
            $notFound[] = $oldRel;
        }
    }

    return response()->json([
        'migrated'  => $migrated,
        'not_found' => $notFound,
    ]);
});



Route::get('/',[PostsController::class,'index'])->name('site.home');
 
Route::get('/storage-link', function () {
    Artisan::call('storage:link');
    return 'Link simbólico criado com sucesso!';
});



Route::get('/postform', function () {
    return view('site.postform');
})->middleware('auth')->name('site.form');


Route::post('/posts',[PostsController::class,'store'])->name('site.store'); 


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





