<?php

namespace App\Http\Controllers;

use App\Models\Posts;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Http;

class PostsController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $posts = Posts::paginate(2);

        return view('site.home', compact('posts'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|max:100',
            'content' => 'required|max:1000',
            'imagem' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        $fileName = null;
        $bucket = 'posts'; // nome do bucket no Supabase, ajuste se precisar

        if ($request->hasFile('imagem')) {
            $file = $request->file('imagem');
            $fileContent = file_get_contents($file->getPathname());
            $fileName = uniqid() . '.' . $file->getClientOriginalExtension();

            $response = Http::withHeaders([
                'apikey' => env('SUPABASE_KEY'),
                'Authorization' => 'Bearer ' . env('SUPABASE_KEY'),
                'Content-Type' => $file->getMimeType(),
            ])->put(env('SUPABASE_URL') . "/storage/v1/object/{$bucket}/{$fileName}", $fileContent);

            if (!$response->successful()) {
                return back()->withErrors(['upload' => 'Erro ao fazer upload na Supabase.']);
            }
        }

        Posts::create([
            'nome' => $request->name,
            'text' => $request->content,
            'imagem' => $fileName, // salva só o nome do arquivo no DB
            'id_user' => Auth::id(),
        ]);

        return redirect()->route('site.home')->with('success', 'Post criado com sucesso!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $post = Posts::findOrFail($id);

        // Se quiser, pode remover a imagem do Supabase aqui também (opcional)

        $post->delete();

        return redirect()->route('site.home')->with('success', 'Post deletado com sucesso!');
    }
}
