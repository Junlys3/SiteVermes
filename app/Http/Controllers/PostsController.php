<?php

namespace App\Http\Controllers;

use App\Models\posts;
use App\Models\User;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;


class PostsController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $posts = posts::paginate(2);


        return view('site.home', compact('posts'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|max:100',
            'content' => 'required|max:1000',
            'imagem' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048'
        ]);
         

        $pathimage = null;
       if ($request->hasFile('imagem')) {
         $pathimage = $request->file('imagem')->store('posts', 'public');
        }



        posts::create([
            'nome' => $request->name,
            'text' => $request->content,
            'imagem' => $pathimage, // Store the image path
            'id_user' => Auth::id() // Get the authenticated user's ID
        ]);

         return redirect()->route('site.home')->with('success', 'Post criado com sucesso!');

    }

    /**
     * Display the specified resource.
     */
    public function show(posts $posts)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(posts $posts)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, posts $posts)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $post = Posts::findOrFail($id); // Busca o post pelo ID

        $post->delete(); // Exclui o post

        return redirect()->route('site.home')->with('success', 'Post deletado com sucesso!');
    }
}
