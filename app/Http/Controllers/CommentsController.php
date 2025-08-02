<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\CommentsPost; // Certifique-se de que o modelo posts está importado
use Illuminate\Support\Facades\Auth;
use App\Models\posts;
use App\Models\User;
use App\Notifications\NovoComment;


class CommentsController extends Controller
{



    public function postCommentsCreate(Request $request, $id)
    {
         $request->validate([
        'comment' => 'required|string|max:255',
        ]);

        $comment = CommentsPost::create([
            'id_post' => $id,
            'id_user' => Auth::id(),
            'text' => $request->comment,
        ]);

        // Carrega o usuário para enviar o nome junto
        $comment->load('user');



        $alvodanotificacao = User::findOrFail($comment->id_user);

        
        $alvodanotificacao->notify(new NovoComment($comment)); // Envia a notificação para o usuário que fez o comentário

        return response()->json([ // Reposta JSON com o nome do usuário e o texto do comentário para ser recebido com AJAX.
            'success' => true,
            'comment' => [
                'user_name' => $comment->user->name,
                'text' => $comment->text,
                'id' => $comment->id,
            ],
        ]);


        
    }



      
    public function deleteComment($id){
        $comment = CommentsPost::findOrFail($id); // Encontra o comentário pelo ID
        $comment->delete(); // Deleta o comentário
        return redirect()->back(); // Redireciona de volta
    }



    public function respondComment(Request $request, $id)
    {
        $request->validate([
            'response' => 'required|string|max:255',
        ]);

        $comment = CommentsPost::findOrFail($id);
        $response = CommentsPost::create([
            'id_post' => $comment->id_post,
            'id_user' => Auth::id(),
            'text' => $request->response,
        ]);

        // Carrega o usuário para enviar o nome junto
        $response->load('user');

        return response()->json([
            'success' => true,
            'response' => [
                'user_name' => $response->user->name,
                'text' => $response->text,
                'id' => $response->id,
            ],
        ]);
    }
    public function postComments($id)
    {
        

    }

 
}
