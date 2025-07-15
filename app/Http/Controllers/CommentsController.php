<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\CommentsPost; // Certifique-se de que o modelo posts está importado
use Illuminate\Support\Facades\Auth;


class CommentsController extends Controller
{



    public function postCommentsCreate(Request $request)
    {
        // Lógica para criar um novo comentário

        $request->validate([
            'comment' => 'required|string|max:255',
        ]);

        CommentsPost::create([
            'post_id' => $request->id, // Certifique-se de que o ID do post está sendo passado corretamente
            'user_id' => auth()->id(), // Supondo que o usuário esteja autenticado
            'comment' => $request->comment,
        ]);
    

         $comments = CommentsPost::where('post_id', $request->id)->with('user')->get(); // Obtém os comentários do post com os usuários

         return view('site.postdetails', compact('comments')); // Retorna a view com os comentários
    }

      
    

    public function postComments($id)
    {
        

      
    }
}
