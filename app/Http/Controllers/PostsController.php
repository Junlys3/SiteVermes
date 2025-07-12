<?php

namespace App\Http\Controllers;

use App\Models\posts;
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
        $posts = posts::paginate(2);

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
        'imagem' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048'
    ]);

    $fileName = null;

    if ($request->hasFile('imagem')) {
        $file = $request->file('imagem');
        $fileContent = file_get_contents($file->getRealPath());
        $uniqueName = uniqid() . '.' . $file->getClientOriginalExtension();
        $bucket = env('SUPABASE_BUCKET');

        $response = Http::withHeaders([
            'apikey' => env('SUPABASE_API_KEY'),
            'Authorization' => 'Bearer ' . env('SUPABASE_API_KEY'),
            'Content-Type' => $file->getMimeType(),
        ])->put(
            env('SUPABASE_PROJECT_URL') . "/storage/v1/object/public/{$bucket}/{$uniqueName}",
            $fileContent
        );

        if (!$response->successful()) {
            dd('Erro Supabase', $response->status(), $response->body());
        }

        $fileName = $uniqueName;
    }

    posts::create([
        'nome' => $request->name,
        'text' => $request->content,
        'imagem' => $fileName,
        'id_user' => Auth::id()
    ]);

    return redirect()->route('site.home')->with('success', 'Post criado com sucesso!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $post = posts::findOrFail($id);

        // Se quiser, pode remover a imagem do Supabase aqui também (opcional)

        $post->delete();

        return redirect()->route('site.home')->with('success', 'Post deletado com sucesso!');
    }
}
