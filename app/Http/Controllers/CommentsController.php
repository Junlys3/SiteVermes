<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\CommentsPost; // Certifique-se de que o modelo posts está importado
use Illuminate\Support\Facades\Auth;
use App\Models\posts;

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

        return response()->json([
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

    public function postComments($id)
    {
        

      
    }
}
