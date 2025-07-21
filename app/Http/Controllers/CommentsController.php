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
        // Lógica para criar um novo comentário

        
        $request->validate([
            'comment' => 'required|string|max:255',
        ]);

        CommentsPost::create([
            'id_post' => $id, // Certifique-se de que o ID do post está sendo passado corretamente, recebe o ID do post
            'id_user' => Auth::id(), // Supondo que o usuário esteja autenticado
            'text' => $request->comment,
        ]);
    
         $post = posts::findOrFail($id); // Obtém o post para o qual o comentário foi criado

         $comment['success'] = true;
         return response()->json($comment);
         //return redirect()->route('site.postdetails', $id);

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
